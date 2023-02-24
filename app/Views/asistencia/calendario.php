<?= $this->extend('base') ?>

<?= $this->section('title') ?>
Calendario
<?= $this->endSection() ?>

<?= $this->section('toolbar') ?>
Calendario
<?= $this->endSection() ?>


<?= $this->section('css'); ?>
<link href="<?= base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') ?>" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>





<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card">
        <div class="card-header pt-5">
            <select id="personas" class="form-control form-control-sm">
                <option value="0">Seleccione una persona</option>
                <?php foreach ($personas as $persona) : ?>
                    <option value="<?= $persona->id ?>"><?= $persona->nombres . ' ' . $persona->paterno . ' ' . $persona->materno . ' - ' . $persona->ci ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="card-body">

            <div id="kt_calendar_app"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdl_asistencia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" id="mdl_asistencia_dialog">
        <div class="modal-content rounded">
            <div class="modal-header mb-5">
                <h3 class="modal-title" id="mdl_asistencia_titulo"></h3>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15" id="mdl_asistencia_body">
                <form id="form_marcado_calendario" class="form" >
                    <div class="row g-9 mb-8">
                        <div class="col-12 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Personal:</label>
                            <div class="position-relative d-flex align-items-center">
                                <input class="form-control form-control-solid" placeholder="" id="nombre_persona" required readonly />
                            </div>
                        </div>

                        <div class="col-12 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Tipo Marcado:</label>
                            <div class="position-relative d-flex align-items-center">
                                <input class="form-control form-control-solid" value="" id="tipo_marcado" name="tipo_marcado" required readonly />
                            </div>
                        </div>


                        <div class="col-md-12 fv-row">
                            <label class="fs-6 fw-semibold mb-2" id="tipo">Fecha y Hora</label>
                            <div class="position-relative d-flex align-items-center">
                                <input class="form-control form-control-solid" type="datetime-local"  name="fecha" id="fecha" value="" required />
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="persona_id" id="persona_id" required />

                    <div class="text-center">
                        <button type="button" id="btn_cancelar" class="btn btn-light me-3">Cancelar</button>
                        <button type="submit" id="btn_enviar" class="btn btn-primary">
                            <span class="indicator-label">Registrar</span>
                            <span class="indicator-progress">Por favor espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script> -->
<script src="<?= base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') ?>"></script>


<script src="<?= base_url('assets/js/marcado/indexCalendario.js') ?>"></script>
<?= $this->endSection() ?>