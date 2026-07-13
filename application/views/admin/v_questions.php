<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Kelola Pertanyaan Survei</h2>
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>"><i class="ti ti-home"></i></a></li>
                    <li class="breadcrumb-item active">Pertanyaan Survei</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Daftar Pertanyaan</h4>
                <div class="d-flex align-items-center">
                    <select class="form-control mr-2" id="filter-room" style="width:250px">
                        <option value="">-- Semua Ruangan --</option>
                        <?php foreach ($rooms as $r): ?>
                        <option value="<?= $r->id ?>"><?= $r->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-primary" id="btn-add-question"><i class="fa fa-plus mr-1"></i> Tambah Pertanyaan</button>
                </div>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table id="question-table" class="table mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pertanyaan</th>
                                <th>Tipe</th>
                                <th>Opsi</th>
                                <th>Urutan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Question -->
<div class="modal fade" id="questionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="questionModalLabel">Tambah Pertanyaan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="questionForm">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <input type="hidden" name="id" id="q-id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Ruangan <span class="text-danger">*</span></label>
                        <select class="form-control" name="room_id" id="q-room" required>
                            <option value="">-- Pilih Ruangan --</option>
                            <?php foreach ($rooms as $r): ?>
                            <option value="<?= $r->id ?>"><?= $r->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Teks Pertanyaan <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="question_text" id="q-text" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tipe Pertanyaan <span class="text-danger">*</span></label>
                        <select class="form-control" name="question_type" id="q-type" required>
                            <option value="radio">Single Choice (Radio)</option>
                            <option value="checkbox">Multiple Choice (Checkbox)</option>
                            <option value="text">Text Bebas</option>
                        </select>
                    </div>
                    <div class="form-group" id="options-group">
                        <label>Opsi (satu per baris)</label>
                        <textarea class="form-control" name="options" id="q-options" rows="5" placeholder="Opsi 1&#10;Opsi 2&#10;Opsi 3"></textarea>
                        <small class="form-text text-muted">Masukkan satu opsi per baris. Contoh: Sangat Baik, Baik, Cukup, dsb.</small>
                    </div>
                    <div class="form-group">
                        <label>Urutan</label>
                        <input type="number" class="form-control" name="sort_order" id="q-sort" value="0">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="is_active" id="q-active" value="1" checked>
                            <label class="custom-control-label" for="q-active">Aktif</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var table = $('#question-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url('admin/get_questions'); ?>',
            type: 'GET',
            data: function(d) {
                d.room_id = $('#filter-room').val();
            }
        },
        columns: [
            { data: 0, orderable: false, searchable: false },
            { data: 1 },
            { data: 2, className: 'text-center' },
            { data: 3 },
            { data: 4, className: 'text-center' },
            { data: 5, className: 'text-center' },
            { data: 6, orderable: false, searchable: false, className: 'text-center' }
        ],
        order: [[4, 'asc']]
    });

    // Filter by room
    $('#filter-room').change(function() {
        table.ajax.reload();
    });

    // Toggle options visibility
    $('#q-type').change(function() {
        if ($(this).val() === 'text') {
            $('#options-group').hide();
        } else {
            $('#options-group').show();
        }
    });

    // Add question
    $('#btn-add-question').click(function() {
        $('#questionModalLabel').text('Tambah Pertanyaan');
        $('#questionForm')[0].reset();
        $('#q-id').val('');
        $('#q-active').prop('checked', true);
        $('#options-group').show();
        $('#q-room').val($('#filter-room').val());
        $('#questionModal').modal('show');
    });

    // Edit question
    $('#question-table').on('click', '.btn-edit-question', function() {
        var id = $(this).data('id');
        $.get('<?= base_url('admin/get_question_by_id'); ?>?id=' + id, function(data) {
            if (data) {
                $('#questionModalLabel').text('Edit Pertanyaan');
                $('#q-id').val(data.id);
                $('#q-room').val(data.room_id);
                $('#q-text').val(data.question_text);
                $('#q-type').val(data.question_type);
                if (data.question_type === 'text') {
                    $('#options-group').hide();
                } else {
                    $('#options-group').show();
                }
                if (data.options) {
                    var opts = JSON.parse(data.options);
                    $('#q-options').val(opts.join('\n'));
                } else {
                    $('#q-options').val('');
                }
                $('#q-sort').val(data.sort_order);
                $('#q-active').prop('checked', data.is_active === '1');
                $('#questionModal').modal('show');
            }
        });
    });

    // Save question
    $('#questionForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#q-id').val();
        var url = id ? '<?= base_url('admin/update_question'); ?>' : '<?= base_url('admin/create_question'); ?>';

        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#questionModal').modal('hide');
                    table.ajax.reload(null, false);
                    Swal.fire('Berhasil', res.message, 'success');
                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan server.', 'error');
            }
        });
    });

    // Delete question
    $('#question-table').on('click', '.btn-delete-question', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Hapus Pertanyaan?',
            text: 'Data jawaban terkait juga akan dihapus.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('<?= base_url('admin/delete_question'); ?>', {
                    id: id,
                    '<?= $this->security->get_csrf_token_name(); ?>': CSRF_TOKEN
                }, function(res) {
                    if (res.status === 'success') {
                        table.ajax.reload(null, false);
                        Swal.fire('Berhasil', res.message, 'success');
                    } else {
                        Swal.fire('Gagal', res.message, 'error');
                    }
                }, 'json');
            }
        });
    });
});
</script>
