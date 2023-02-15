<?= $this->extend('base') ?>

<?= $this->section('title') ?>
    Listado de Oficinas
<?= $this->endSection() ?>

<?= $this->section('toolbar') ?>
    Oficinas
<?= $this->endSection() ?>

<?= $this->section('css') ?>
    <link href="<?= base_url('assets/plugins/custom/datatables/datatables.bundle.css') ?>" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card ">
            <div class="card-header card-header-stretch">
                <h3 class="card-title">Listado Oficinas</h3>
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#listado">Listado</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="listado" role="tabpanel">
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
                                                   placeholder="Buscar oficina"/>
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
                                        Agregar Oficina
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100"
                                       id="tbl_listado_oficinas">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                            <th class="text-center">#</th>
                                            <th class="text-center">Oficina</th>
                                            <th class="text-center">Descripción</th>
                                            <th class="text-center">Encargado</th>
                                            <th class="text-center">Creado</th>
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

<div class="modal fade" id="modal_editar_oficina" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" id="modal_editar_oficina_dialog">
        <div class="modal-content rounded">
            <div class="modal-header mb-5">
                <h3 class="modal-title" id="modal_editar_oficina_titulo"></h3>
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
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15" id="modal_editar_oficina_body">
                <form id="formulario_editar_oficina" class="form"
                      action="<?= base_url(route_to('actualizar-oficina')) ?>" method="POST">
                    <div class="row g-9 mb-8">
                        <div class="col-md-12 fv-row">
                            <label for="nombre" class="required fs-6 fw-semibold mb-2">Nombre Oficina</label>
                            <div class="position-relative d-flex align-items-center">
                                <input class="form-control form-control-solid" name="nombre" required/>
                                <input type="hidden" name="id" id="id">
                            </div>
                        </div>
                    </div>

                    <div class="row g-9 mb-8">
                        <div class="col-md-12 fv-row">
                            <label class=" required fs-6 fw-semibold mb-2">Descripción</label>
                            <div class="position-relative d-flex align-items-center">
                                <textarea class="form-control form-control-solid" name="descripcion" id="descripcion"  rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row g-9 mb-8">
                        <div class="col-md-12 fv-row">
                            <label class=" required fs-6 fw-semibold mb-2">Encargado</label>
                            <div class="position-relative d-flex align-items-center">
                                <select class="form-select form-select-solid" data-control="select2" data-placeholder="Seleccione encargado" name="persona_id" data-allow-clear="true" data-dropdown-parent="#modal_editar_oficina">
                                    <option></option>
                                    <?php foreach ($personas as $persona):?>
                                        <option value="<?= $persona->id?>"><?= $persona->nombres . ' ' . $persona->paterno . ' ' . $persona->materno?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class=" required fs-6 fw-semibold mb-2">Sede:</label>
                            <div class="position-relative d-flex align-items-center">
                                <select class="form-select form-select-solid" data-control="select2" data-placeholder="Seleccione sede" name="sede_id" data-allow-clear="true" data-dropdown-parent="#modal_editar_oficina">
                                    <option></option>
                                    <?php foreach ($sedes as $sede):?>
                                        <option value="<?= $sede->id?>"><?= $sede->denominacion_sede ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label for="nombre" class="required fs-6 fw-semibold mb-2">IP</label>
                            <div class="position-relative d-flex align-items-center">
                                <input class="form-control form-control-solid" name="ip" id="ip" required/>
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

    const DatatableOficina = function () {
        let table;
        let datatable;

        function asignarValoresFormulario(response) {
            $("input[name='id']").val(response.id);
            $("select[name='persona_id']").val(response.persona_id).trigger('change');
            $("select[name='sede_id']").val(response.sede_id).trigger('change');
            $("input[name='nombre']").val(response.nombre);
            $("textarea[name='descripcion']").val(response.descripcion);
            $("input[name='ip']").val(response.ip);

        }

        const editarOficina = (id) => {
            function limpiarValidacion(inputs) {
                inputs.forEach(input => {
                    let elements = input.parentNode.parentElement.getElementsByClassName('validacion');
                    while (elements.length > 0) {
                        elements[0].parentNode.removeChild(elements[0]);
                    }
                });
            }

            $.post("<?= base_url(route_to('editar-oficina'))?>", { id }, function(response){
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
                    parametrosModal("modal_editar_oficina", "Editar Oficina", "modal-lg");
                    let form = document.querySelector('#formulario_editar_oficina');
                    let submitButtonEditar = document.getElementById('boton_enviar_formulario_editar');
                    let cancelButtonEditar = document.getElementById('boton_cancelar_formulario_editar');
                    let inputs = form.querySelectorAll('input, select, textarea');

                    submitButtonEditar.addEventListener('click', function (e) {
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        if (form.checkValidity() === false) {
                            e.stopPropagation();
                        } else {
                            submitButtonEditar.setAttribute('data-kt-indicator', 'on');
                            submitButtonEditar.disabled = true;
                            $.post("<?= base_url(route_to('actualizar-oficina'))?>", $(form).serialize(), function(response){
                                if(typeof response.error !== 'undefined') {
                                    submitButtonEditar.removeAttribute('data-kt-indicator');
                                    submitButtonEditar.disabled = false;
                                    limpiarValidacion(inputs);
                                    let errors = Object.entries(response.error);
                                    errors.forEach(error => {
                                        let child = `<div class="form-text text-danger validacion validacion-${error[0]}">${error[1]}</div>`;
                                        let input = document.querySelector('form#formulario_editar_oficina [name="'+error[0]+'"]');
                                        input.parentElement.insertAdjacentHTML('afterend', child);
                                    });
                                }

                                if (typeof response.exito !== 'undefined') {
                                    submitButtonEditar.setAttribute('data-kt-indicator', 'of');
                                    submitButtonEditar.disabled = false;
                                    limpiarValidacion(inputs);
                                    $("#modal_editar_oficina").modal('hide');
                                    DatatableOficina.init();
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
                                $("#modal_editar_oficina").modal('hide');
                                let inputs = form.querySelectorAll('input, select');
                                limpiarValidacion(inputs);
                            }
                        });
                    });

                }
            })
        }

        const initDatatable = function () {
            datatable = $(table).DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                destroy: true,
                paginate: false,
                ajax: {
                    url: "<?= base_url(route_to('ajax-listado-oficinas'))?>",
                    method: 'GET',
                },
            }).on('click', '#ul-options li a', function (e) {
                e.stopImmediatePropagation();
                let id = $(this).data('id');
                if ($(this)[0].classList.contains('editar'))
                    editarOficina(id);
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
                table = document.querySelector('#tbl_listado_oficinas');
                if (!table) {
                    return;
                }
                initDatatable();
                handleSearchDatatable();
            }
        };
    }();

    KTUtil.onDOMContentLoaded(function () {
        DatatableOficina.init();
    });
</script>
<?= $this->endSection() ?>
