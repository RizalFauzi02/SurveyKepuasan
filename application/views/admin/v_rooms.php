<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Kelola Ruangan</h2>
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>"><i class="ti ti-home"></i></a></li>
                    <li class="breadcrumb-item active">Ruangan</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Daftar Ruangan</h4>
                <button class="btn btn-primary" id="btn-add-room"><i class="fa fa-plus mr-1"></i> Tambah Ruangan</button>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table id="room-table" class="table mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Ruangan</th>
                                <th>Slug</th>
                                <th>Lantai</th>
                                <th>Tipe Fasilitas</th>
                                <th>Status</th>
                                <th>Urutan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Room -->
<div class="modal fade" id="roomModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roomModalLabel">Tambah Ruangan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="roomForm">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <input type="hidden" name="id" id="room-id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Ruangan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="room-name" required>
                    </div>
                    <div class="form-group">
                        <label>Lantai <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="floor" id="room-floor" required min="1">
                    </div>
                    <div class="form-group">
                        <label>Tipe Fasilitas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="facility_type" id="room-facility" required>
                    </div>
                    <div class="form-group">
                        <label>Urutan</label>
                        <input type="number" class="form-control" name="sort_order" id="room-sort" value="0">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="is_active" id="room-active" value="1" checked>
                            <label class="custom-control-label" for="room-active">Aktif</label>
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
        var table = $('#room-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('admin/get_rooms'); ?>',
                type: 'GET'
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                {
                    data: 1
                },
                {
                    data: 2
                },
                {
                    data: 3,
                    className: 'text-center'
                },
                {
                    data: 4
                },
                {
                    data: 5,
                    className: 'text-center'
                },
                {
                    data: 6,
                    className: 'text-center'
                },
                {
                    data: 7,
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ],
            order: [
                [6, 'asc']
            ]
        });

        // Add room
        $('#btn-add-room').click(function() {
            $('#roomModalLabel').text('Tambah Ruangan');
            $('#roomForm')[0].reset();
            $('#room-id').val('');
            $('#room-active').prop('checked', true);
            $('#roomModal').modal('show');
        });

        // Edit room
        $('#room-table').on('click', '.btn-edit-room', function() {
            var id = $(this).data('id');
            $.get('<?= base_url('admin/get_room_by_id'); ?>?id=' + id, function(data) {
                if (data) {
                    if (typeof data === 'string') {
                        data = JSON.parse(data);
                    }
                    $('#roomModalLabel').text('Edit Ruangan');
                    $('#room-id').val(data.id);
                    $('#room-name').val(data.name);
                    $('#room-floor').val(data.floor);
                    $('#room-facility').val(data.facility_type);
                    $('#room-sort').val(data.sort_order);
                    $('#room-active').prop('checked', data.is_active === '1');
                    $('#roomModal').modal('show');
                }
            });
        });

        // Save room (create/update)
        $('#roomForm').on('submit', function(e) {
            e.preventDefault();
            var id = $('#room-id').val();
            var url = id ? '<?= base_url('admin/update_room'); ?>' : '<?= base_url('admin/create_room'); ?>';

            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.status === 'success') {
                        $('#roomModal').modal('hide');
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

        // Delete room
        $('#room-table').on('click', '.btn-delete-room', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            Swal.fire({
                title: 'Hapus Ruangan?',
                text: 'Data pertanyaan di ruangan "' + name + '" juga akan dihapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('<?= base_url('admin/delete_room'); ?>', {
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