<?= $this->extend('base') ?>

<?= $this->section('title') ?>
    Listado Personal
<?= $this->endSection() ?>

<?= $this->section('toolbar') ?>
    Personal
<?= $this->endSection() ?>

<?= $this->section('css') ?>
    <link href="<?= base_url('assets/plugins/custom/datatables/datatables.bundle.css') ?>" rel="stylesheet"
          type="text/css"/>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card ">
            <div class="card-header card-header-stretch">
                <h3 class="card-title">Listado Personal</h3>
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
                                                   placeholder="Buscar personal"/>
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
                                        Agregar personal
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100"
                                       id="tbl_listado_personal">
                                    <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                        <th class="text-center">#</th>
                                        <th class="text-center">ci</th>
                                        <th class="text-center">ru</th>
                                        <th class="text-center">Nombres</th>
                                        <th class="text-center">Celular</th>
                                        <th class="text-center">E-mail</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                    </tbody>
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
                                        <option value="QR"> Nueva cédula con código QR</option>
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
                                <label class="required fs-6 fw-semibold mb-2">R.U.</label>
                                <div class="position-relative d-flex align-items-center">
                                    <label>
                                        <input class="form-control form-control-solid"
                                               placeholder="registro universitario" name="ru" required/>
                                    </label>
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
                            <button type="reset" id="boton_cancelar_formulario" class="btn btn-light me-3">Cancel
                            </button>
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

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="<?= base_url('assets/plugins/custom/datatables/datatables.bundle.js') ?>"></script>
    <script>
        $('*:input[type!=hidden]:first').focus();
        // Class
        const DatatablePersonal = function () {
            let table;
            let datatable;

            const initDatatable = function () {
                datatable = $(table).DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "<?= base_url(route_to('ajax-listado-personas'))?>",
                        method: 'GET',
                    },
                }).on('click', '#ul-options li a', function (e) {
                    const editar = $(this)[0].classList.contains('editar');
                    const eliminar = $(this)[0].classList.contains('eliminar');
                    const asignarHorario = $(this)[0].classList.contains('asignar_horario');
                    console.log(editar, eliminar, asignarHorario)

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
                    table = document.querySelector('#tbl_listado_personal');
                    if (!table) {
                        return;
                    }

                    initDatatable();
                    handleSearchDatatable();
                }
            };
        }();

        KTUtil.onDOMContentLoaded(function () {
            DatatablePersonal.init();
        });

        $("#boton_agregar_personal").on("click", function (e) {
            parametrosModal("modal_asistencia", "Agregar Personal", "modal-lg");
            $("input[name='ci']").change(function (e) {
                let ci = $(this).val();
                $.post("<?= base_url(route_to('verificar-registro-ci-persona'))?>", {ci: $(this).val()}, function (response) {
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
            })
        });

        // Class definition
        const KTModalNewTarget = function () {
            let submitButton;
            let cancelButton;
            let validator;
            let form;
            let modal;
            let modalEl;

            // Handle form validation and submittion
            const handleForm = function () {
                // Stepper custom navigation

                // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                validator = FormValidation.formValidation(
                    form,
                    {
                        fields: {
                            // ci: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Este campo es requerido'
                            //         }
                            //     }
                            // },
                            // expedido: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Este campo es requerido'
                            //         }
                            //     }
                            // },
                            // ru: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Este campo es requerido'
                            //         }
                            //     }
                            // },
                            // nombres: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Este campo es requerido'
                            //         },
                            //         regexp: {
                            //             regexp: /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i,
                            //             message:
                            //                 "El nombre(s) puede contener letras",
                            //         }
                            //     }
                            // },
                            // paterno: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Este campo es requerido'
                            //         },
                            //         regexp: {
                            //             regexp: /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i,
                            //             message:
                            //                 "El apellido paterno puede contener letras",
                            //         }
                            //     }
                            // },
                            // materno: {
                            //     validators: {
                            //         regexp: {
                            //             regexp: /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i,
                            //             message:
                            //                 "El apellido materno puede contener letras",
                            //         }
                            //     }
                            // },
                            // correo: {
                            //     validators: {
                            //         regexp: {
                            //             regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                            //             message: "El valor no es una dirección de correo electrónico válida",
                            //         },
                            //         notEmpty: {message: "El correo electrónico es requerido"},
                            //     },
                            // },
                            // celular: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: "Este campo es requerido",
                            //         },
                            //         regexp: {
                            //             regexp: /^(7|6)?[0-9]{7}$/i,
                            //             message: "El número de celular debe empezar por 6 o 7",
                            //         },
                            //         integer: {
                            //             message: "El número de celular no es válido",
                            //         },
                            //     },
                            // },
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

                // Action buttons
                submitButton.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Validate form before submit
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
                                });
                            }
                        });
                    }
                });

                cancelButton.addEventListener('click', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        text: "Are you sure you would like to cancel?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, cancel it!",
                        cancelButtonText: "No, return",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-active-light"
                        }
                    }).then(function (result) {
                        if (result.value) {
                            form.reset(); // Reset form
                            modal.hide(); // Hide modal
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: "Your form has not been cancelled!.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                }
                            });
                        }
                    });
                });
            };

            return {
                // Public functions
                init: function () {
                    // Elements
                    modalEl = document.querySelector('#modal_asistencia');

                    if (!modalEl) {
                        return;
                    }

                    modal = new bootstrap.Modal(modalEl);

                    form = document.querySelector('#formulario_agregar_persona');
                    submitButton = document.getElementById('boton_enviar_formulario');
                    cancelButton = document.getElementById('boton_cancelar_formulario');

                    handleForm();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTModalNewTarget.init();
        });

    </script>
<?= $this->endSection() ?>