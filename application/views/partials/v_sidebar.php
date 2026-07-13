<div class="default-sidebar">
    <nav class="side-navbar box-scroll sidebar-scroll">
        <ul class="list-unstyled">
            <?php if ($this->session->userdata('is_role') === '1'): ?>
                <li class="<?= (isset($active_menu) && $active_menu === 'users') ? 'active' : '' ?>">
                    <a href="<?= base_url('superadmin'); ?>">
                        <i class="fa-regular fa-user"></i><span>Kelola User</span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="<?= (isset($active_menu) && $active_menu === 'rooms') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/rooms'); ?>">
                    <i class="fa-solid fa-door-open"></i><span>Kelola Ruangan</span>
                </a>
            </li>
            <li class="<?= (isset($active_menu) && $active_menu === 'questions') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/questions'); ?>">
                    <i class="fa-regular fa-question-circle"></i><span>Pertanyaan Survei</span>
                </a>
            </li>
            <li class="<?= (isset($active_menu) && $active_menu === 'reports') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/reports'); ?>">
                    <i class="fa-regular fa-bar-chart"></i><span>Laporan</span>
                </a>
            </li>
        </ul>
    </nav>
</div>