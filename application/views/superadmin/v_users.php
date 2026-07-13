<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Kelola User</h2>
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('superadmin'); ?>"><i class="ti ti-home"></i></a></li>
                    <li class="breadcrumb-item active">Kelola User</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Daftar User</h4>
                <button class="btn btn-primary" id="btn-add-user"><i class="fa fa-plus mr-1"></i> Tambah User</button>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table id="user-table" class="table mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Unit</th>
                                <th>Role</th>
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

<!-- Modal User -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="userForm">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <input type="hidden" name="id" id="u-id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" id="u-username" required minlength="3">
                    </div>
                    <div class="form-group">
                        <label>Password <span id="pw-label">*</span></label>
                        <input type="password" class="form-control" name="password" id="u-password" minlength="6">
                        <small class="form-text text-muted" id="pw-hint">Minimal 6 karakter</small>
                    </div>
                    <div class="form-group">
                        <label>Unit <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="unit" id="u-unit" required>
                    </div>
                    <div class="form-group">
                        <label>Role <span class="text-danger">*</span></label>
                        <select class="form-control" name="is_role" id="u-role" required>
                            <option value="2">Admin</option>
                            <option value="1">Superadmin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="is_active" id="u-active" value="1" checked>
                            <label class="custom-control-label" for="u-active">Aktif</label>
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
    var table = $('#user-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url('superadmin/get_users'); ?>',
            type: 'GET'
        },
        columns: [
            { data: 0, orderable: false, searchable: false },
            { data: 1 },
            { data: 2 },
            { data: 3, className: 'text-center' },
            { data: 4, className: 'text-center' },
            { data: 5, orderable: false, searchable: false, className: 'text-center' }
        ]
    });

    // Add user
    $('#btn-add-user').click(function() {
        $('#userModalLabel').text('Tambah User');
        $('#userForm')[0].reset();
        $('#u-id').val('');
        $('#u-active').prop('checked', true);
        $('#u-password').prop('required', true);
        $('#pw-label').text('*');
        $('#pw-hint').text('Minimal 6 karakter');
        $('#userModal').modal('show');
    });

    // Edit user
    $('#user-table').on('click', '.btn-edit-user', function() {
        var id = $(this).data('id');
        $.get('<?= base_url('superadmin/get_user_by_id'); ?>?id=' + id, function(data) {
            if (data) {
                $('#userModalLabel').text('Edit User');
                $('#u-id').val(data.id_user);
                $('#u-username').val(data.username);
                $('#u-password').val('').prop('required', false);
                $('#u-unit').val(data.unit);
                $('#u-role').val(data.is_role);
                $('#u-active').prop('checked', data.is_active === '1');
                $('#pw-label').text('');
                $('#pw-hint').text('Kosongkan jika tidak ingin mengubah password');
                $('#userModal').modal('show');
            }
        });
    });

    // Save user
    $('#userForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#u-id').val();
        var url = id ? '<?= base_url('superadmin/update_user'); ?>' : '<?= base_url('superadmin/create_user'); ?>';

        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#userModal').modal('hide');
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

    // Delete user
    $('#user-table').on('click', '.btn-delete-user', function() {
        var id = $(this).data('id');
        var username = $(this).data('username');
        Swal.fire({
            title: 'Hapus User?',
            text: 'User "' + username + '" akan dihapus permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('<?= base_url('superadmin/delete_user'); ?>', {
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
