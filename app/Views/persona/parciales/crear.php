
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
            <label class="fs-6 fw-semibold mb-2">R.U.</label>
            <div class="position-relative d-flex align-items-center">
                <input class="form-control form-control-solid"
                       placeholder="registro universitario" name="ru" required/>
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
