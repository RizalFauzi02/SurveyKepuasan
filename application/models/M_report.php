<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class M_report extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_summary($room_id = 0, $date_from = '', $date_to = '')
    {
        $sql = "SELECT
                    COUNT(*) as total_responses,
                    AVG(satisfaction_score) as avg_score,
                    MIN(satisfaction_score) as min_score,
                    MAX(satisfaction_score) as max_score
                FROM survey_responses sr
                JOIN rooms r ON sr.room_id = r.id
                WHERE 1=1";

        $bindings = [];

        if ($room_id > 0) {
            $sql .= " AND sr.room_id = ?";
            $bindings[] = $room_id;
        }
        if (!empty($date_from)) {
            $sql .= " AND sr.created_at >= ?";
            $bindings[] = $date_from . ' 00:00:00';
        }
        if (!empty($date_to)) {
            $sql .= " AND sr.created_at <= ?";
            $bindings[] = $date_to . ' 23:59:59';
        }

        $query = $this->db->query($sql, $bindings);
        return $query->row();
    }

    public function get_chart_data($room_id = 0, $date_from = '', $date_to = '')
    {
        $sql = "SELECT
                    sr.satisfaction_score,
                    COUNT(*) as total
                FROM survey_responses sr
                WHERE 1=1";

        $bindings = [];

        if ($room_id > 0) {
            $sql .= " AND sr.room_id = ?";
            $bindings[] = $room_id;
        }
        if (!empty($date_from)) {
            $sql .= " AND sr.created_at >= ?";
            $bindings[] = $date_from . ' 00:00:00';
        }
        if (!empty($date_to)) {
            $sql .= " AND sr.created_at <= ?";
            $bindings[] = $date_to . ' 23:59:59';
        }

        $sql .= " GROUP BY sr.satisfaction_score ORDER BY sr.satisfaction_score ASC";

        $query = $this->db->query($sql, $bindings);
        $result = $query->result();

        $data = [0, 0, 0, 0, 0];
        foreach ($result as $row) {
            $idx = $row->satisfaction_score - 1;
            if ($idx >= 0 && $idx < 5) {
                $data[$idx] = (int) $row->total;
            }
        }

        return $data;
    }

    public function get_responses($room_id = 0, $date_from = '', $date_to = '')
    {
        $sql = "SELECT
                    sr.id,
                    r.name as room_name,
                    sr.respondent_name,
                    sr.satisfaction_score,
                    sr.feedback,
                    sr.created_at
                FROM survey_responses sr
                JOIN rooms r ON sr.room_id = r.id
                WHERE 1=1";

        $bindings = [];

        if ($room_id > 0) {
            $sql .= " AND sr.room_id = ?";
            $bindings[] = $room_id;
        }
        if (!empty($date_from)) {
            $sql .= " AND sr.created_at >= ?";
            $bindings[] = $date_from . ' 00:00:00';
        }
        if (!empty($date_to)) {
            $sql .= " AND sr.created_at <= ?";
            $bindings[] = $date_to . ' 23:59:59';
        }

        $sql .= " ORDER BY sr.created_at DESC";

        $query = $this->db->query($sql, $bindings);
        return $query->result();
    }

    public function export_excel($room_id = 0, $date_from = '', $date_to = '')
    {
        date_default_timezone_set('Asia/Jakarta');

        $responses = $this->get_responses($room_id, $date_from, $date_to);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Title
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'Laporan Survei Kepuasan Pasien - Primaya Hospital Karawang');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        // Date range
        $sheet->mergeCells('A2:F2');
        $date_text = 'Periode: ';
        $date_text .= !empty($date_from) ? $date_from : 'Semua';
        $date_text .= ' s/d ';
        $date_text .= !empty($date_to) ? $date_to : 'Sekarang';
        $sheet->setCellValue('A2', $date_text);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        // Header
        $headers = ['No', 'Nama Ruangan', 'Responden', 'Skor', 'Komentar', 'Tanggal'];
        $header_row = 4;
        foreach ($headers as $col => $header) {
            $sheet->setCellValueByColumnAndRow($col + 1, $header_row, $header);
        }
        $sheet->getStyle('A' . $header_row . ':F' . $header_row)->getFont()->setBold(true);
        $sheet->getStyle('A' . $header_row . ':F' . $header_row)->getFill()
            ->setFillType('solid')
            ->getStartColor()->setARGB('0A4FA8');
        $sheet->getStyle('A' . $header_row . ':F' . $header_row)->getFont()->getColor()->setARGB('FFFFFF');

        // Data
        $row = $header_row + 1;
        $no = 1;
        foreach ($responses as $r) {
            $ket = $this->get_score_label($r->satisfaction_score);

            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $r->room_name);
            $sheet->setCellValue('C' . $row, $r->respondent_name ?: 'Anonymous');
            $sheet->setCellValue('D' . $row, $r->satisfaction_score . ' - ' . $ket);
            $sheet->setCellValue('E' . $row, $r->feedback);
            $sheet->setCellValue('F' . $row, $r->created_at);

            // Color based on score
            $warna = $this->get_score_color($r->satisfaction_score);
            $sheet->getStyle('D' . $row)->getFill()
                ->setFillType('solid')
                ->getStartColor()->setARGB($warna);

            $row++;
        }

        // Column widths
        $sheet->getColumnDimension('A')->setWidth(6);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(50);
        $sheet->getColumnDimension('F')->setWidth(20);

        // Border
        $style = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                ],
            ],
        ];
        $sheet->getStyle('A' . $header_row . ':F' . ($row - 1))->applyFromArray($style);

        // Export
        $filename = 'laporan_survei_' . date('d-m-Y_His') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    private function get_score_label($score)
    {
        $labels = [
            1 => 'Sangat Tidak Puas',
            2 => 'Tidak Puas',
            3 => 'Cukup Puas',
            4 => 'Puas',
            5 => 'Sangat Puas',
        ];
        return $labels[$score] ?? '-';
    }

    private function get_score_color($score)
    {
        $colors = [
            1 => 'EF4444',
            2 => 'F97316',
            3 => 'F59E0B',
            4 => '22C55E',
            5 => '16A34A',
        ];
        return $colors[$score] ?? '6B7280';
    }
}
