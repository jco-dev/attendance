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
                        // setTimeout(function () {
                        //     submitButton.removeAttribute("data-kt-indicator");
                        //     submitButton.disabled = !1;
                        //     Swal.fire({
                        //         text: "You have successfully logged in!",
                        //         icon: "success",
                        //         buttonsStyling: !1,
                        //         confirmButtonText: "Bienvenido al sistema Juan Carlos",
                        //         customClass: {confirmButton: "btn btn-primary"},
                        //     }).then(function (t) {
                        //         if (t.isConfirmed) {
                        //             form.querySelector('[name="email"]').value = "";
                        //             form.querySelector('[name="password"]').value = "";
                        //             const i = form.getAttribute("data-kt-redirect-url");
                        //             i && (location.href = i);
                        //         }
                        //     });
                        // }, 2e3)
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
