<div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
    <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
         data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
         data-kt-menu-placement="bottom-end">
        <img src="<?= base_url('assets/media/avatars/300-1.jpg') ?>" alt="Avatar usuario"/>
    </div>
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <div class="symbol symbol-50px me-5">
                    <img alt="Logo" src="<?= base_url('assets/media/avatars/300-1.jpg') ?>"/>
                </div>
                <div class="d-flex flex-column">
                    <div class="fw-bold d-flex align-items-center fs-6"><?= ucwords(session()->get('nombres')) . " " ?>
                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                            <?= "ADMIN" ?>
                        </span>
                    </div>
                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7"><?= session()->get('correo') ?></a>
                </div>
            </div>
        </div>
        <div class="menu-item px-5">
            <a href="#" class="menu-link px-5">Mi perfil</a>
        </div>
        <div class="separator my-2"></div>
        <div class="menu-item px-5">
            <form id="frm-logout" action="<?= route_to('salir') ?>" method="POST">
                <a class="menu-link px-5" onclick="document.getElementById('frm-logout').submit()">Cerrar sesión</a>
            </form>
        </div>
    </div>
</div>
