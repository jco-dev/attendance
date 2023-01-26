<?= $this->extend('base') ?>

<?= $this->section('title') ?>
Marcado
<?= $this->endSection() ?>

<?= $this->section('toolbar') ?>
Marcado
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-px text-center">
                <div class="d-flex flex-column flex-center">
                    <img src="<?= base_url("assets/media/logos/posgrado.png") ?>" class="mt-10" width="110" alt="Logo Posgrado" />
                    <p class="mt-5 text-center text-gray-900">
                        Centro de Estudios y Formación de Posgrado e Investigación de la
                        Universidad Pública de El Alto
                    </p>
                    <h3 class="pb-3">CONTROL DE ASISTENCIA</h3>
                </div>

                <form class="form w-100" novalidate="novalidate" id="frm_marcado"  method="POST" action="<?= route_to('verificar-registro')?>">
                    <div class="fv-row mb-8">
                        <label for="ci" class="required form-label mt-5">Carnet de Identidad
                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                               data-bs-toggle="tooltip"
                               title="Ingrese su Carnet de Identidad">
                            </i>
                        </label>
                        <input type="text" class="form-control form-control-solid" minlength="6"
                               maxlength="15" id="ci" name="ci" placeholder="Ingrese su número de carnet de identidad" autocomplete="off" autofocus
                               required />
                    </div>
                    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                        <button type="submit" id="btn_marcado_submit" class="btn btn-primary me-4">
                            <span class="indicator-label">Guardar</span>
                            <span class="indicator-progress">
                                Espere por favor...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>

                <p class="text-gray-500 mt-5 fs-3 fw-semibold py-7">
                    La puntualidad es el alma de la disciplina
                    <br/>
                    "WEPS"
                </p>
                <div class="d-flex flex-column-auto h-40px flex-center">
                    <span class="badge badge-warning p-3 text-dark" id="hour" data-bs-toggle="tooltip"
                          data-bs-custom-class="tooltip-dark" data-bs-placement="bottom"
                          title="<?= literal_date(date("Y-m-d"), 2) ?>">
                        <i class="fa fa-clock text-dark"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="<?= base_url('assets/js/marcado/index.js') ?>"></script>
<?= $this->endSection() ?>