<!DOCTYPE html>
<html lang="es">
<head>
    <title><?= $this->renderSection('title') ?> | Control de Asistencia Posgrado</title>
    <meta charset="utf-8"/>
    <meta name="description" content="Control de asistencia posgrado"/>
    <meta name="keywords" content="Control, asistencia, Posgrado, Upea."/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:url" content="https://adminposgrado.upea.bo/"/>
    <meta property="og:site_name" content="Asistencia | Posgrado"/>
    <link rel="shortcut icon" href="<?= base_url('assets/media/logos/favicon.ico') ?>"/>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <link href="<?= base_url('assets/plugins/global/plugins.bundle.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url('assets/css/style.bundle.css') ?>" rel="stylesheet" type="text/css"/>
    <?= $this->renderSection('css') ?>
</head>
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
      data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
      data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
      data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <?= $this->include("layout/theme-mode") ?>
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <div id="kt_app_header" class="app-header">
                <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
                     id="kt_app_header_container">
                    <!--Mobile toggle-->
                    <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
                        <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                            <span class="svg-icon svg-icon-2 svg-icon-md-1">
                               <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                  <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                        fill="currentColor"/>
                                  <path opacity="0.3"
                                        d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                        fill="currentColor"/>
                               </svg>
                            </span>
                        </div>
                    </div>
                    <!--Mobile toggle-->
                    <!--Mobile logo-->
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                        <a href="/" class="d-lg-none">
                            <img alt="Logo" src="<?= base_url('assets/media/logos/default-small.png') ?>" class="h-30px"/>
                        </a>
                    </div>
                    <!--Mobile logo-->
                    <!--Header wrapper-->
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
                         id="kt_app_header_wrapper">
                        <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                             data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                             data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                             data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                             data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                             data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                        </div>
                        <div class="app-navbar flex-shrink-0">
                            <?= $this->include("layout/theme-mode-menu") ?>
                            <?= $this->include("layout/user-menu") ?>
                        </div>
                    </div>
                    <!--Header wrapper-->
                </div>
            </div>
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <?= $this->include("layout/sidebar") ?>
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">
                        <?= $this->include('layout/toolbar') ?>
                        <!--Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <?= $this->renderSection('content') ?>
                        </div>
                        <!--Content-->
                    </div>
                    <?= $this->include('layout/footer') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" id="modal_dialog">
            <div class="modal-content rounded">
                <div class="modal-header mb-5">
                    <h3 class="modal-title" id="modal_titulo"></h3>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                      transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="currentColor"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15" id="modal_body"></div>
            </div>
        </div>
    </div>

    <?= $this->include("layout/scrolltop") ?>
    <script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/js/asistencia.js') ?>"></script>
    <script>
        setInterval(function() {
            const ahora = new Date();
            $('span#hour').html('<i class="fa fa-clock text-dark"></i> <span class="fs-6">&nbsp;' + (ahora.getHours() < 10 ? '0' : '') + ahora.getHours() + ':' + (ahora.getMinutes() < 10 ? '0' : '') + ahora.getMinutes() + ':' + (ahora.getSeconds() < 10 ? '0' : '') + ahora.getSeconds() + '</span>');
        }, 1000);
    </script>
    <script>
        <?php if (session()->getFlashdata('msg')) { ?>
            Swal.fire({
                title: "<?= session()->getFlashdata('titulo') ?>",
                text: "<?= session()->getFlashdata('msg') ?>",
                icon: "<?= session()->getFlashdata('icono') ?>",
                timer: 3000,
                showConfirmButton: false,
            });
        <?php } ?>
    </script>
    <?= $this->renderSection('js') ?>
</body>
</html>
