<?php
$username = htmlspecialchars($this->session->userdata('username'), ENT_QUOTES, 'UTF-8');
$role = $this->session->userdata('is_role') === '1' ? 'Superadmin' : 'Admin';
?>
<header class="header">
    <style>
        .navbar .nav-link {
            border-radius: 999px;
            padding: 0.3rem 0.6rem;
            transition: all 0.2s ease-in-out;
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: flex-start;
            gap: 0.5rem;
            flex-direction: row;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link:focus {
            background: #f3f5ff;
            box-shadow: 0 4px 12px rgba(93, 83, 134, 0.08);
        }

        .navbar .user-avatar {
            width: 36px;
            height: 36px;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
        }

        .navbar .user-menu-card {
            background: linear-gradient(135deg, #f8f9ff 0%, #eef2ff 100%);
        }

        .navbar .dropdown-menu {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            margin-top: 0.5rem;
        }

        .navbar .user-menu-role {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
            background: #e9ecff;
            color: #5d5386;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .navbar .user-menu-logout {
            color: #d9534f;
            font-weight: 600;
        }

        .navbar .user-menu-logout:hover {
            background: #fff5f5;
            color: #c82333;
        }
    </style>
    <nav class="navbar fixed-top">
        <div class="search-box">
            <button class="dismiss"><i class="ion-close-round"></i></button>
            <form id="searchForm" role="search">
                <input type="search" placeholder="Cari..." class="form-control">
            </form>
        </div>
        <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
            <div class="navbar-header">
                <a href="<?= base_url('admin'); ?>" class="navbar-brand">
                    <div class="brand-image brand-big">
                        <img src="<?= base_url('assets-tamplate/img/logo-primaya.png'); ?>" alt="logo" class="logo-big">
                    </div>
                    <div class="brand-image brand-small">
                        <img src="<?= base_url('assets-tamplate/img/logo-primaya.png'); ?>" alt="logo" class="logo-small">
                    </div>
                </a>
                <a id="toggle-btn" href="#" class="menu-btn active">
                    <span></span><span></span><span></span>
                </a>
            </div>
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center pull-right">
                <!-- User -->
                <li class="nav-item dropdown"><a id="user" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><img src="<?= base_url('assets-tamplate/img/user.png'); ?>" alt="..." class="avatar rounded-circle"></a>
                    <ul aria-labelledby="user" class="user-size dropdown-menu">
                        <li class="welcome">
                            <a href="<?= base_url('admin/profile'); ?>" class="edit-profil"><i class="la la-gear"></i></a>
                            <img src="<?= base_url('assets-tamplate/img/user.png'); ?>" alt="..." class="rounded-circle">
                        </li>
                        <li>
                            <a href="<?= base_url('admin/profile'); ?>" class="dropdown-item">
                                Logged as <?= $this->session->userdata('username'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/settings'); ?>" class="dropdown-item no-padding-bottom">
                                Settings
                            </a>
                        </li>
                        <li class="separator"></li>
                        <li><a rel="nofollow" href="<?= base_url('auth/logout'); ?>" class="dropdown-item logout text-center"><i class="ti-power-off"></i></a></li>
                    </ul>
                </li>
                <!-- End User -->
            </ul>
        </div>
    </nav>
</header>