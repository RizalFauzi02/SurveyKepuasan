<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class Superadmin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
        $this->load->model('M_superadmin');
        if ($this->session->userdata('is_Loggin') != true) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['survey'] = $this->M_superadmin->get_all_byOrder();
        // var_dump($data['survey']);exit;

        $this->load->view('superadmin/v_superadmin', $data);
    }

    public function export_excel()
    {
        date_default_timezone_set('Asia/Jakarta');

        $data = $this->M_superadmin->get_all_byOrder();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // =========================
        // JUDUL
        // =========================
        $sheet->mergeCells('A2:H2');
        $sheet->mergeCells('A4:H21'); // MERGE UNTUK CHART
        $sheet->setCellValue('A2', 'Hasil Data Survey - Primaya Hospital Karawang');

        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(22);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
        );

        // =========================
        // HEADER KOLOM
        // =========================
        $sheet->setCellValue('A22', 'No');
        $sheet->setCellValue('B22', 'Nama Lokasi');
        $sheet->setCellValue('C22', 'Lantai');
        $sheet->setCellValue('D22', 'Tipe Fasilitas');
        $sheet->setCellValue('E22', 'Survey Kepuasan');
        $sheet->setCellValue('F22', 'Ket Survey');
        $sheet->setCellValue('G22', 'Survey Memuaskan');
        $sheet->setCellValue('H22', 'Timestamp');

        $sheet->getStyle('A22:H22')->getFont()->setBold(true);
        $sheet->getStyle('A22:H22')->getAlignment()->setHorizontal(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
        );

        // =========================
        // DATA
        // =========================
        $row = 23;
        $no = 1;

        foreach ($data as $d) {

            // LOGIKA KET SURVEY
            switch ($d->survey_kepuasan) {
                case 1:
                    $ket = 'Sangat Tidak Puas';
                    break;
                case 2:
                    $ket = 'Tidak Puas';
                    break;
                case 3:
                    $ket = 'Cukup Puas';
                    break;
                case 4:
                    $ket = 'Puas';
                    break;
                case 5:
                    $ket = 'Sangat Puas';
                    break;
                default:
                    $ket = '-';
            }

            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $d->nama_lokasi);
            $sheet->setCellValue('C' . $row, $d->lantai);
            $sheet->setCellValue('D' . $row, $d->tipe_fasilitas);
            $sheet->setCellValue('E' . $row, $d->survey_kepuasan);
            $sheet->setCellValue('F' . $row, $ket);
            $sheet->setCellValue('G' . $row, $d->survey_memuaskan);
            $sheet->setCellValue('H' . $row, $d->created_at);

            // WARNA BERDASARKAN NILAI
            $nilai = $d->survey_kepuasan;

            if ($nilai == 1) {
                $warna = 'EF4444';
            } elseif ($nilai == 2) {
                $warna = 'F97316';
            } elseif ($nilai == 3) {
                $warna = 'F59E0B';
            } elseif ($nilai == 4) {
                $warna = '22C55E';
            } elseif ($nilai == 5) {
                $warna = '16A34A';
            } else {
                $warna = '6B7280';
            }

            // APPLY KE KOLOM E (Survey Kepuasan)
            $sheet->getStyle('E' . $row)->getFill()->setFillType(
                \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID
            )->getStartColor()->setARGB($warna);

            // APPLY KE KOLOM F (Ket Survey)
            $sheet->getStyle('F' . $row)->getFill()->setFillType(
                \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID
            )->getStartColor()->setARGB($warna);

            $sheet->getStyle('E' . $row)->getFont()->setBold(true);
            $sheet->getStyle('F' . $row)->getFont()->setBold(true);

            // CENTER KOLOM
            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('C' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('E' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('F' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

            // WRAP TEXT
            $sheet->getStyle('G' . $row)->getAlignment()->setWrapText(true);

            // VERTICAL
            $sheet->getStyle('A' . $row . ':H' . $row)->getAlignment()->setVertical(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            );

            $row++;
        }

        // =========================
        // LEBAR KOLOM
        // =========================
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(8);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(18);
        $sheet->getColumnDimension('F')->setWidth(16);
        $sheet->getColumnDimension('G')->setWidth(60);
        $sheet->getColumnDimension('H')->setWidth(20);

        // =========================
        // BORDER
        // =========================
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $startRow = 22;
        $sheet->getStyle('A' . $startRow . ':H' . ($row - 1))->applyFromArray($styleArray);

        // =========================
        // REKAP DATA SURVEY
        // =========================
        $rekap = [
            'Sangat Tidak Puas' => 0,
            'Tidak Puas' => 0,
            'Cukup Puas' => 0,
            'Puas' => 0,
            'Sangat Puas' => 0,
        ];

        foreach ($data as $d) {
            switch ($d->survey_kepuasan) {
                case 1:
                    $rekap['Sangat Tidak Puas']++;
                    break;
                case 2:
                    $rekap['Tidak Puas']++;
                    break;
                case 3:
                    $rekap['Cukup Puas']++;
                    break;
                case 4:
                    $rekap['Puas']++;
                    break;
                case 5:
                    $rekap['Sangat Puas']++;
                    break;
            }
        }

        // =========================
        // TARUH DATA REKAP (UNTUK CHART)
        // =========================
        $startRow = 6;
        $i = 0;
        foreach ($rekap as $label => $val) {
            $cellLabel = 'J' . ($startRow + $i);
            $cellValue = 'K' . ($startRow + $i);

            $sheet->setCellValue($cellLabel, $label);
            $sheet->setCellValue($cellValue, $val);

            // WARNA TEXT PUTIH
            $sheet->getStyle($cellLabel . ':' . $cellValue)
                ->getFont()
                ->getColor()
                ->setARGB('FFFFFF');

            $i++;
        }

        // =========================
        // PIE CHART (KIRI)
        // =========================
        $labels = [new DataSeriesValues('String', 'Worksheet!$J$6:$J$10', null, 5)];
        $values = [new DataSeriesValues('Number', 'Worksheet!$K$6:$K$10', null, 5)];

        $series = new DataSeries(
            DataSeries::TYPE_PIECHART,
            null,
            range(0, count($values) - 1),
            [],
            $labels,
            $values
        );

        $plotArea = new PlotArea(null, [$series]);
        $legend = new Legend(Legend::POSITION_RIGHT, null, false);

        $pieChart = new Chart(
            'pie_chart',
            new Title('Pie Chart Kepuasan'),
            $legend,
            $plotArea
        );

        // POSISI (KIRI ATAS)
        $pieChart->setTopLeftPosition('B6');
        $pieChart->setBottomRightPosition('E20');

        $sheet->addChart($pieChart);

        // =========================
        // BAR CHART (KANAN)
        // =========================
        $seriesBar = new DataSeries(
            DataSeries::TYPE_BARCHART,
            DataSeries::GROUPING_CLUSTERED,
            range(0, count($values) - 1),
            [],
            $labels,
            $values
        );

        $plotAreaBar = new PlotArea(null, [$seriesBar]);

        $barChart = new Chart(
            'bar_chart',
            new Title('Bar Chart Kepuasan'),
            new Legend(Legend::POSITION_RIGHT, null, false),
            $plotAreaBar
        );

        // POSISI (KANAN ATAS)
        $barChart->setTopLeftPosition('F6');
        $barChart->setBottomRightPosition('H20');

        $sheet->addChart($barChart);
        // FREEZE
        $sheet->freezePane('A23');

        // =========================
        // FILE
        // =========================
        $filename = 'data_survey_' . date('d-m-Y') . '.xlsx';

        $sheet->setSelectedCell('A1');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->setIncludeCharts(true); // WAJIB!
        $writer->save('php://output');
        exit;
    }

    public function get_chart_kepuasan()
    {
        $this->db->select('survey_kepuasan, COUNT(*) as total');
        $this->db->from('tb_survey');
        $this->db->group_by('survey_kepuasan');
        $query = $this->db->get()->result();

        // Default semua 0
        $data = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        ];

        foreach ($query as $row) {
            $data[$row->survey_kepuasan] = (int)$row->total;
        }

        echo json_encode(array_values($data));
    }
}
