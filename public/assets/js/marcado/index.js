"use strict";

const KTMarcado = (function () {
    var form;
    var submitButtonMarcado;
    var validator;
    return {
        init: function () {
            form = document.querySelector("#frm_marcado");
            submitButtonMarcado = document.querySelector("#btn_marcado_submit");
            validator = FormValidation.formValidation(form, {
                fields: {
                    ci: {
                        validators: {
                            notEmpty: {message: "El número de carnet es requerido."},
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: "",
                    }),
                },
            });

            function marcarSalida(id) {
                $.ajax({
                    url: "/asistencia/marcarSalidaConfirmacion",
                    type: "POST",
                    data: {id: id},
                    dataType: "json",
                    success: function (response) {
                        if (typeof response.simple != "undefined" && response.simple === true) {
                            Swal.fire({
                                icon: response.icono,
                                title: response.titulo,
                                text: response.msg,
                                showConfirmButton: false,
                                timer: 2000,
                            });

                            $("#ci").val("");
                            $("#ci").focus();
                            submitButtonMarcado.setAttribute("data-kt-indicator", "off");
                            submitButtonMarcado.disabled = false;
                        }

                        if (typeof response.compuesto !== "undefined" && response.compuesto === true) {
                            Swal.fire({
                                title: response.titulo,
                                icon: response.icono,
                                html: response.msg,
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: `btn btn-${response.button}`,
                                },
                            });

                            $("#ci").val("");
                            $("#ci").focus();
                            submitButtonMarcado.setAttribute("data-kt-indicator", "off");
                            submitButtonMarcado.disabled = false;
                        }
                    },
                });
            }

            submitButtonMarcado.addEventListener("click", function (n) {
                n.preventDefault();
                validator.validate().then(function (status) {
                    if ("Valid" === status) {
                        submitButtonMarcado.setAttribute("data-kt-indicator", "on");
                        submitButtonMarcado.disabled = !0;
                        $.ajax({
                            'url': form.action,
                            'type': form.method,
                            'data': $('#frm_marcado').serialize(),
                            'dataType': 'JSON',
                        }).done(function(response){
                            if (typeof response.simple != "undefined" && response.simple === true) {
                                Swal.fire({
                                    icon: response.icono,
                                    title: response.titulo,
                                    html: response.msg,
                                    showConfirmButton: false,
                                    timer: 3000,
                                });

                                $("#ci").val("");
                                $("#ci").focus();
                                submitButtonMarcado.setAttribute("data-kt-indicator", "off");
                                submitButtonMarcado.disabled = false;
                            }

                            if (typeof response.compuesto !== "undefined" && response.compuesto === true) {
                                Swal.fire({
                                    icon: response.icono,
                                    title: response.titulo,
                                    html: response.msg,
                                    buttonsStyling: true,
                                    confirmButtonText: "Ok",
                                    customClass: {
                                        confirmButton: `btn btn-${response.button}`,
                                    },
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $("#ci").val("");
                                        $("#ci").focus();
                                        submitButtonMarcado.setAttribute("data-kt-indicator", "off");
                                        submitButtonMarcado.disabled = false;
                                    }
                                });
                            }

                            if (typeof response.confirmado !== "undefined" && response.confirmado === true) {
                                Swal.fire({
                                    title: response.titulo,
                                    html: response.msg,
                                    icon: response.icono,
                                    showCancelButton: true,
                                    confirmButtonColor: "#d33",
                                    cancelButtonColor: "#3085d6",
                                    confirmButtonText: "Si, Marcar salida",
                                    cancelButtonText: "Cancelar",
                                }).then((result) => {

                                    if (result.isConfirmed) {
                                        marcarSalida(response.id);
                                    } else {
                                        $("#ci").val("");
                                        $("#ci").focus();
                                        submitButtonMarcado.setAttribute("data-kt-indicator", "off");
                                        submitButtonMarcado.disabled = false;
                                    }
                                });
                            }
                        })
                    }else{
                        form.querySelector('[name="ci"]').value = "";
                    }
                });
            });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTMarcado.init();
});