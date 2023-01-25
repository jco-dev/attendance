"use strict";

const KTSigninGeneral = (function () {
    let form;
    let submitButton;
    let validator;
    return {
        init: function () {
            form = document.querySelector("#frm_login");
            submitButton = document.querySelector("#btn_login_submit");
            validator = FormValidation.formValidation(form, {
                fields: {
                    correo: {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: "El valor no es una dirección de correo electrónico válida",
                            },
                            notEmpty: {message: "El correo electrónico es requerido"},
                        },
                    },
                    clave: {
                        validators: {notEmpty: {message: "La contraseña es requerida"}},
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

            submitButton.addEventListener("click", function (n) {
                n.preventDefault();
                validator.validate().then(function (status) {
                    if ("Valid" === status) {
                        submitButton.setAttribute("data-kt-indicator", "on");
                        submitButton.disabled = !0;
                        form.submit();
                    }else{
                        form.querySelector('[name="clave"]').value = "";
                    }
                });
            });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});
