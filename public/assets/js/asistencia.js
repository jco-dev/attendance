$(document).ready(function () {
    window.parametrosModal = function (idModal, titulo, tamano = "modal-lg", onEscape = false, backdrop = 'static') {
        $("#" + idModal + '_titulo').html(titulo);
        $("#" + idModal + '_dialog').removeClass('modal-lg');
        $("#" + idModal + '_dialog').removeClass('modal-xl');
        $("#" + idModal + '_dialog').removeClass('modal-fullscreen');
        $("#" + idModal + '_dialog').addClass(tamano);

        let modal = new bootstrap.Modal(document.getElementById(idModal), {
            keyboard: onEscape,
            backdrop: backdrop,
        });
        modal.show();
    };
});
