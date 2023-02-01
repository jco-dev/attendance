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
                                    <button class="btn btn-primary">
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
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="<?= base_url('assets/plugins/custom/datatables/datatables.bundle.js') ?>"></script>
    <script>
        $('*:input[type!=hidden]:first').focus();
        // Class definition
        const KTDatatablesExample = function () {
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
            KTDatatablesExample.init();
        });
    </script>
<?= $this->endSection() ?>