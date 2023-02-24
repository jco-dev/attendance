<?= $this->extend('base') ?>

<?= $this->section('title') ?>
    Asignación de Horario
<?= $this->endSection() ?>

<?= $this->section('toolbar') ?>
    Horario
<?= $this->endSection() ?>

<?= $this->section('css') ?>
    <link href="<?= base_url('assets/plugins/custom/datatables/datatables.bundle.css') ?>" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card ">
            <div class="card-header card-header-stretch">
                <h3 class="card-title">Asignación de Horario</h3>
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#registrado">Listado</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="registrado" role="tabpanel">
                        <div class="card card-flush p-0">
                            <div class="card-header align-items-center p-0">
                                <div class="card-title">
                                    <div class="d-flex align-items-center position-relative">
                                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                      rx="1" transform="rotate(45 17.0365 15.1223)"
                                                      fill="currentColor"/>
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                      fill="currentColor"/>
                                            </svg>
                                        </span>
                                        <label>
                                            <input type="text" data-kt-filter="search"
                                                   class="form-control form-control-solid w-250px ps-14"
                                                   placeholder="Buscar asignación"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                    <button class="btn btn-primary" id="boton_agregar_personal">
                                        <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5"
                                                      fill="currentColor"></rect>
                                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
                                                      transform="rotate(-90 10.8891 17.8033)"
                                                      fill="currentColor"></rect>
                                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1"
                                                      fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                        Asignar Horario
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100"
                                       id="tbl_listado_asignacion_horario_registrado">
                                    <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                        <th class="text-center">#</th>
                                        <th class="text-center">CI</th>
                                        <th class="text-center">Nombres</th>
                                        <th class="text-center">Personal</th>
                                        <th class="text-center">Turno</th>
                                        <th class="text-center">Entrada</th>
                                        <th class="text-center">Horas</th>
                                        <th class="text-center">Oficina</th>
                                        <th class="text-center">Inicio</th>
                                        <th class="text-center">Fin</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_asistencia" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" id="modal_asistencia_dialog">
            <div class="modal-content rounded">
                <div class="modal-header mb-5">
                    <h3 class="modal-title" id="modal_asistencia_titulo"></h3>
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
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15" id="modal_asistencia_body">
                    <form id="formulario_agregar_persona" class="form"
                          action="<?= base_url(route_to('guardar-persona')) ?>" method="POST">
                        <div class="row g-9 mb-8">
                            <div class="col-md-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">CI</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input class="form-control form-control-solid" placeholder="carnet de identidad"
                                           name="ci" required/>
                                </div>
                            </div>
                            <div class="col-md-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Expedido</label>
                                <div class="position-relative d-flex align-items-center">
                                    <select class="form-select form-select-solid" data-control="select2"
                                            data-hide-search="true" data-placeholder="Seleccione" name="expedido"
                                            required>
                                        <option></option>
                                        <option value="QR">Nueva cédula con código QR</option>
                                        <option value="CH">Chuquisaca</option>
                                        <option value="LP">La Paz</option>
                                        <option value="CB">Cochabamba</option>
                                        <option value="OR">Oruro</option>
                                        <option value="PT">Potosí</option>
                                        <option value="TJ">Tarija</option>
                                        <option value="SC">Santa Cruz</option>
                                        <option value="BE">Beni</option>
                                        <option value="PD">Pando</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 fv-row">
                                <label class="fs-6 fw-semibold mb-2">R.U.</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input class="form-control form-control-solid"
                                           placeholder="registro universitario" name="ru" />
                                </div>
                            </div>
                        </div>

                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Nombre(s)</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input class="form-control form-control-solid" name="nombres" required/>
                                </div>
                            </div>
                        </div>

                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Paterno</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input class="form-control form-control-solid" name="paterno" required/>
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Materno</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input class="form-control form-control-solid" name="materno"/>
                                </div>
                            </div>
                        </div>

                        <div class="row g-9 mb-8">
                            <div class="col-md-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Celular</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="number" class="form-control form-control-solid" placeholder="celular"
                                           name="celular" required/>
                                </div>
                            </div>
                            <div class="col-md-8 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Correo</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="email" class="form-control form-control-solid"
                                           placeholder="correo electrónico" name="correo" required/>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="reset" id="boton_cancelar_formulario" class="btn btn-light me-3">Cancelar</button>
                            <button type="submit" id="boton_enviar_formulario" class="btn btn-primary">
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

    <div class="modal fade" id="modal_asistencia_editar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" id="modal_asistencia_editar_dialog">
            <div class="modal-content rounded">
                <div class="modal-header mb-5">
                    <h3 class="modal-title" id="modal_asistencia_editar_titulo"></h3>
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
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15" id="modal_asistencia_editar_body">
                    <form id="formulario_editar_persona" class="form"
                          action="<?= base_url(route_to('update-persona')) ?>" method="POST">
                        <div class="row g-9 mb-8">
                            <div class="col-md-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">CI</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input class="form-control form-control-solid" placeholder="carnet de identidad"
                                           name="ci" required/>
                                    <input type="hidden" name="id" value="" />
                                </div>
                            </div>
                            <div class="col-md-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Expedido</label>
                                <div class="position-relative d-flex align-items-center">
                                    <select class="form-select form-select-solid" data-placeholder="Seleccione" name="expedido" required>
                                        <option></option>
                                        <option value="QR">Nueva cédula con código QR</option>
                                        <option value="CH">Chuquisaca</option>
                                        <option value="LP">La Paz</option>
                                        <option value="CB">Cochabamba</option>
                                        <option value="OR">Oruro</option>
                                        <option value="PT">Potosí</option>
                                        <option value="TJ">Tarija</option>
                                        <option value="SC">Santa Cruz</option>
                                        <option value="BE">Beni</option>
                                        <option value="PD">Pando</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 fv-row">
                                <label class="fs-6 fw-semibold mb-2">R.U.</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input class="form-control form-control-solid"
                                           placeholder="registro universitario" name="ru" form="formulario_editar_persona"/>
                                </div>
                            </div>
                        </div>

                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Nombre(s)</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input class="form-control form-control-solid" name="nombres" required/>
                                </div>
                            </div>
                        </div>

                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Paterno</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input class="form-control form-control-solid" name="paterno" required/>
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Materno</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input class="form-control form-control-solid" name="materno"/>
                                </div>
                            </div>
                        </div>

                        <div class="row g-9 mb-8">
                            <div class="col-md-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Celular</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="number" class="form-control form-control-solid" placeholder="celular"
                                           name="celular" required/>
                                </div>
                            </div>
                            <div class="col-md-8 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Correo</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="email" class="form-control form-control-solid"
                                           placeholder="correo electrónico" name="correo" required/>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="reset" id="boton_cancelar_formulario_editar" class="btn btn-light me-3">Cancelar</button>
                            <button type="submit" id="boton_enviar_formulario_editar" class="btn btn-primary">
                                <span class="indicator-label">Editar</span>
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
    <script src="<?= base_url('assets/plugins/custom/datatables/datatables.bundle.js') ?>"></script>
    <script>
        $('*:input[type!=hidden]:first').focus();

        const limpiarCamposFormulario = () => {
            $("input[name='id']").val("");
            $("input[name='ci']").val("");
            $("select[name='expedido']").val("").trigger('change');
            $("input[name='ru']").val("");
            $("input[name='nombres']").val("");
            $("input[name='paterno']").val("");
            $("input[name='materno']").val("");
            $("input[name='celular']").val("");
            $("input[name='correo']").val("");
        }

        const DatatableAsignacionHorario = function () {
            let table;
            let datatable;

            function asignarValoresFormulario(response) {
                $("input[name='id']").val(response.id);
                $("input[name='ci']").val(response.ci);
                $("select[name='expedido']").val(response.expedido).trigger('change');
                $("input[name='ru']").val(response.ru);
                $("input[name='nombres']").val(response.nombres);
                $("input[name='paterno']").val(response.paterno);
                $("input[name='materno']").val(response.materno);
                $("input[name='celular']").val(response.celular);
                $("input[name='correo']").val(response.correo);
            }

            const editarPersona = (id) => {
                function limpiarValidacion(inputs) {
                    inputs.forEach(input => {
                        let elements = input.parentNode.parentElement.getElementsByClassName('validacion');
                        while (elements.length > 0) {
                            elements[0].parentNode.removeChild(elements[0]);
                        }
                    });
                }

                $.post("<?= base_url(route_to('editar-persona'))?>", { id }, function(response){
                    if(response == null){
                        Swal.fire({
                            title: "Error",
                            text: "Error al editar",
                            icon: "error",
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    }else{
                        asignarValoresFormulario(response);
                        parametrosModal("modal_asistencia_editar", "Editar Personal", "modal-lg");
                        let form = document.querySelector('#formulario_editar_persona');
                        let submitButtonEditar = document.getElementById('boton_enviar_formulario_editar');
                        let cancelButtonEditar = document.getElementById('boton_cancelar_formulario_editar');
                        let inputs = form.querySelectorAll('input, select');

                        submitButtonEditar.addEventListener('click', function (e) {
                            e.preventDefault();
                            e.stopImmediatePropagation();
                            if (form.checkValidity() === false) {
                                e.stopPropagation();
                            } else {
                                submitButtonEditar.setAttribute('data-kt-indicator', 'on');
                                submitButtonEditar.disabled = true;
                                $.post("<?= base_url(route_to('actualizar-persona'))?>", $(form).serialize(), function(response){
                                    if(typeof response.error !== 'undefined') {
                                        submitButtonEditar.removeAttribute('data-kt-indicator');
                                        submitButtonEditar.disabled = false;
                                        limpiarValidacion(inputs);
                                        let errors = Object.entries(response.error);
                                        errors.forEach(error => {
                                            let child = `<div class="form-text text-danger validacion validacion-${error[0]}">${error[1]}</div>`;
                                            let input = document.querySelector('form#formulario_editar_persona [name="'+error[0]+'"]');
                                            input.parentElement.insertAdjacentHTML('afterend', child);
                                        });
                                    }

                                    if (typeof response.exito !== 'undefined') {
                                        submitButtonEditar.setAttribute('data-kt-indicator', 'of');
                                        submitButtonEditar.disabled = false;
                                        limpiarValidacion(inputs);
                                        $("#modal_asistencia_editar").modal('hide');
                                        $("#modal_asistencia").modal('hide');
                                        DatatablePersonal.init();
                                        Swal.fire({
                                            title: "Control de Asistencia",
                                            text: response.exito,
                                            icon: "success",
                                            timer: 3000,
                                            showConfirmButton: false,
                                        });

                                    }

                                })
                            }
                        });

                        cancelButtonEditar.addEventListener('click', function (e) {
                            e.preventDefault();
                            e.stopImmediatePropagation();
                            Swal.fire({
                                text: "¿Estás seguro de cancelar la edición?",
                                icon: "warning",
                                showCancelButton: true,
                                buttonsStyling: false,
                                confirmButtonText: "Si, Cancelar!",
                                cancelButtonText: "No",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                    cancelButton: "btn btn-active-light"
                                }
                            }).then(function (result) {
                                if (result.value) {
                                    form.reset();
                                    $("#modal_asistencia_editar").modal('hide');
                                    let inputs = form.querySelectorAll('input, select');
                                    limpiarValidacion(inputs);
                                }
                            });
                        });

                    }
                })
            }

            const eliminarPersona = (id, nombre) => {
                Swal.fire({
                    text:  `¿Estás seguro de eliminar el registro del usuario: ${nombre}?`,
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Si, Eliminar!",
                    cancelButtonText: "No",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {
                        $.post("<?= base_url(route_to('eliminar-persona'))?>", { id }, function(response){
                            if(typeof response.error !== 'undefined'){
                                Swal.fire({
                                    title: "Control de Asistencia",
                                    text: response.error,
                                    icon: "error",
                                    timer: 3000,
                                    showConfirmButton: false,
                                });
                            }
                            if(typeof response.exito !== 'undefined'){
                                DatatablePersonal.init();
                                Swal.fire({
                                    title: "Control de Asistencia",
                                    text: response.exito,
                                    icon: "success",
                                    timer: 3000,
                                    showConfirmButton: false,
                                });
                            }
                        })
                    }
                })
            }

            const activarPersona = (id, nombre) => {
                Swal.fire({
                    text:  `¿Estás seguro de activar el registro del usuario: ${nombre}?`,
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Si, Activar!",
                    cancelButtonText: "No",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {
                        $.post("<?= base_url(route_to('activar-persona'))?>", { id }, function(response){
                            if(typeof response.error !== 'undefined'){
                                Swal.fire({
                                    title: "Control de Asistencia",
                                    text: response.error,
                                    icon: "error",
                                    timer: 3000,
                                    showConfirmButton: false,
                                });
                            }
                            if(typeof response.exito !== 'undefined'){
                                DatatablePersonal.init();
                                Swal.fire({
                                    title: "Control de Asistencia",
                                    text: response.exito,
                                    icon: "success",
                                    timer: 3000,
                                    showConfirmButton: false,
                                });
                            }
                        })
                    }
                })
            }

            const verAsignacionesHorario = (id) => {
                $.post("<?= base_url(route_to('ver-asignaciones-horario'))?>", { id }, function(response){
                    console.log(response)
                    if(typeof response.exito !== 'undefined'){
                        $("#modal .modal-body").html(response.exito);
                        parametrosModal('modal', 'Asignaciones de Horario', 'modal-lg');
                    }
                })
            }
            const initDatatable = function () {
                datatable = $(table).DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: {
                        url: "<?= base_url(route_to('ajax-listado-asignacion-horario'))?>",
                        method: 'GET',
                    },
                }).on('click', '#ul-options li a', function (e) {
                    e.stopImmediatePropagation();
                    let id = $(this).data('id');
                    if ($(this)[0].classList.contains('editar'))
                        editarPersona(id);
                    if ($(this)[0].classList.contains('eliminar')) {
                        let nombre = $(this).data('nombre');
                        eliminarPersona(id, nombre);
                    }
                    if ($(this)[0].classList.contains('activar')) {
                        let nombre = $(this).data('nombre');
                        activarPersona(id, nombre);
                    }
                    if ($(this)[0].classList.contains('asignar_horario'))
                        verAsignacionesHorario(id);

                })
            };

            const handleSearchDatatable = () => {
                const filterSearch = document.querySelector('[data-kt-filter="search"]');
                filterSearch.addEventListener('keyup', function (e) {
                    datatable.search((e.target.value).toUpperCase()).draw();
                });
            };

            return {
                init: function () {
                    table = document.querySelector('#tbl_listado_asignacion_horario_registrado');
                    if (!table) {
                        return;
                    }
                    initDatatable();
                    handleSearchDatatable();
                }
            };
        }();

        $("#boton_agregar_personal").on("click", function (e) {
            limpiarCamposFormulario();
            parametrosModal("modal_asistencia", "Agregar Personal", "modal-lg");
            function verificarRegistroPersona(ci) {
                $.post("<?= base_url(route_to('verificar-registro-ci-persona'))?>", {ci}, function (response) {
                    if (response) {
                        Swal.fire({
                            title: "Registro encontrado",
                            text: `el ci: ${ci} ya se encuentra registrado.`,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                        let form = document.getElementById('formulario_agregar_persona');
                        for (let i = 0; i < form.elements.length; i++) {
                            let element = form.elements[i];
                            if (element.type === "text")
                                element.value = "";
                            else if (element.type === "select")
                                element.selectedIndex = 0;
                        }
                    }
                })
            }
            $("input[name='ci']").change(function (e) {
                let ci = $(this).val();
                verificarRegistroPersona(ci);
            });
        });

        const RegistrarPersona = function () {
            let submitButton;
            let cancelButton;
            let validator;
            let form;

            const handleForm = function () {

                validator = FormValidation.formValidation(
                    form,
                    {
                        fields: {
                            ci: {
                                validators: {
                                    notEmpty: {
                                        message: 'Este campo es requerido'
                                    }
                                }
                            },
                            expedido: {
                                validators: {
                                    notEmpty: {
                                        message: 'Este campo es requerido'
                                    }
                                }
                            },
                            nombres: {
                                validators: {
                                    notEmpty: {
                                        message: 'Este campo es requerido'
                                    },
                                    regexp: {
                                        regexp: /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i,
                                        message:
                                            "El nombre(s) puede contener letras",
                                    }
                                }
                            },
                            paterno: {
                                validators: {
                                    notEmpty: {
                                        message: 'Este campo es requerido'
                                    },
                                    regexp: {
                                        regexp: /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i,
                                        message:
                                            "El apellido paterno puede contener letras",
                                    }
                                }
                            },
                            materno: {
                                validators: {
                                    regexp: {
                                        regexp: /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i,
                                        message:
                                            "El apellido materno puede contener letras",
                                    }
                                }
                            },
                            correo: {
                                validators: {
                                    regexp: {
                                        regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                        message: "El valor no es una dirección de correo electrónico válida",
                                    },
                                    notEmpty: {message: "El correo electrónico es requerido"},
                                },
                            },
                            celular: {
                                validators: {
                                    notEmpty: {
                                        message: "Este campo es requerido",
                                    },
                                    regexp: {
                                        regexp: /^(7|6)?[0-9]{7}$/i,
                                        message: "El número de celular debe empezar por 6 o 7",
                                    },
                                    integer: {
                                        message: "El número de celular no es válido",
                                    },
                                },
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: '.fv-row',
                                eleInvalidClass: '',
                                eleValidClass: ''
                            })
                        }
                    }
                );

                function limpiarValidacion(inputs) {
                    inputs.forEach(input => {
                        let elements = input.parentNode.parentElement.getElementsByClassName('validacion');
                        while (elements.length > 0) {
                            elements[0].parentNode.removeChild(elements[0]);
                        }
                    });
                }
                // Enviar Formulario
                submitButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (validator) {
                        validator.validate().then(function (status) {
                            if (status === 'Valid') {
                                submitButton.setAttribute('data-kt-indicator', 'on');
                                submitButton.disabled = true;

                                let inputs = form.querySelectorAll('input, select');
                                const data = new FormData();
                                inputs.forEach(input => {
                                    data.append(input.name, input.value);
                                });

                                $.ajax({
                                    'url': form.action,
                                    'type': form.method,
                                    'data': data,
                                    'dataType': 'JSON',
                                    'processData': false,
                                    'contentType': false
                                }).done(function (response) {
                                    if (typeof response.error !== 'undefined') {
                                        submitButton.setAttribute('data-kt-indicator', 'of');
                                        submitButton.disabled = false;
                                        limpiarValidacion(inputs);
                                        let errors = Object.entries(response.error);
                                        errors.forEach(error => {
                                            let child = `<div class="form-text text-danger validacion validacion-${error[0]}">${error[1]}</div>`;
                                            let input = document.getElementsByName(error[0])[0];
                                            input.parentElement.insertAdjacentHTML('afterend', child);
                                        });
                                    }

                                    if (typeof response.exito !== 'undefined') {
                                        submitButton.setAttribute('data-kt-indicator', 'of');
                                        submitButton.disabled = false;
                                        form.reset();
                                        limpiarValidacion(inputs);
                                        $("#modal_asistencia").modal('hide');
                                        DatatablePersonal.init();

                                        Swal.fire({
                                            title: "Control de Asistencia",
                                            text: response.exito,
                                            icon: "success",
                                            timer: 3000,
                                            showConfirmButton: false,
                                        });
                                    }
                                });
                            }
                        });
                    }
                });

                cancelButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        text: "¿Estás seguro de cancelar la edición?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Si, Cancelar!",
                        cancelButtonText: "No",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-active-light"
                        }
                    }).then(function (result) {
                        if (result.value) {
                            form.reset();
                            $("#modal_asistencia").modal('hide');
                            let inputs = form.querySelectorAll('input, select');
                            limpiarValidacion(inputs);
                        }
                    });
                });
            };

            return {
                init: function () {
                    form = document.querySelector('#formulario_agregar_persona');
                    submitButton = document.getElementById('boton_enviar_formulario');
                    cancelButton = document.getElementById('boton_cancelar_formulario');
                    handleForm();
                }
            };
        }();

        KTUtil.onDOMContentLoaded(function () {
            DatatableAsignacionHorario.init();
            RegistrarPersona.init();
        });

    </script>
<?= $this->endSection() ?>