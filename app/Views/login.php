<!DOCTYPE html>

<html lang="es">
<head>
    <title>Login | Control de Asistencia Posgrado</title>
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
</head>
<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <?= $this->include("layout/theme-mode") ?>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url('assets/media/auth/bg10.jpeg');
            }
            [data-theme="dark"] body {
                background-image: url('assets/media/auth/bg10-dark.jpeg');
            }
        </style>
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                         src="<?= base_url('assets/media/logos/posgrado.png') ?>" alt=""/>
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                         src="<?= base_url('assets/media/logos/posgrado.png') ?>" alt=""/>
                    <div class="text-gray-600 fs-base text-center fw-semibold">
                        Centro de Estudios y Formación de Posgrado e Investigación de la
                        Universidad Pública de El Alto.
                        <br/>
                        <a href="#" class="opacity-75-hover text-primary me-1">CONTROL DE ASISTENCIA</a>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <div class="bg-body d-flex flex-center rounded-4 w-md-600px p-10">
                    <div class="w-md-400px">
                        <form class="form w-100" method="POST" novalidate="novalidate" id="frm_login" action="<?= route_to('login')?>">
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">Iniciar Sesión</h1>
                                <div class="text-gray-500 fw-semibold fs-6">con tus redes sociales</div>
                            </div>
                            <div class="row g-3 mb-9">
                                <div class="col-md-6">
                                    <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                        <img alt="Logo" src="<?= base_url('assets/media/svg/brand-logos/google-icon.svg') ?>"
                                             class="h-15px me-3"/>
                                        Iniciar con Google
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                        <img alt="Logo" src="<?= base_url('assets/media/svg/brand-logos/apple-black.svg') ?>"
                                             class="theme-light-show h-15px me-3"/>
                                        <img alt="Logo" src="<?= base_url('assets/media/svg/brand-logos/apple-black-dark.svg') ?>"
                                             class="theme-dark-show h-15px me-3"/>
                                        Iniciar con Apple
                                    </a>
                                </div>
                            </div>
                            <div class="separator separator-content my-14">
                                <span class="w-250px text-gray-500 fw-semibold fs-7">o con tu cuenta</span>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="email" placeholder="Usuario" name="correo" autocomplete="off"
                                       class="form-control bg-transparent" autofocus />
                            </div>
                            <div class="fv-row mb-3">
                                <input type="password" placeholder="Contraseña" name="clave" autocomplete="off"
                                       class="form-control bg-transparent"/>
                            </div>
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <a href="#" class="link-primary">¿Has olvidado tu contraseña?</a>
                            </div>
                            <div class="d-grid mb-10">
                                <button type="submit" id="btn_login_submit" class="btn btn-primary">
                                    <span class="indicator-label">Ingresar</span>
                                    <span class="indicator-progress">
                                        Espere por favor...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/js/login/index.js') ?>"></script>
    <script>
        <?php if (session()->getFlashdata('msg')) { ?>
            Swal.fire({
                title: "Error al ingresar al Sistema",
                text: "<?= session()->getFlashdata('msg') ?>",
                icon: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        <?php } ?>
    </script>
</body>
</html>
