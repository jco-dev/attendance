$(function() {

    "use strict";

    $("#personas").select2();

    var calendar;

    var calendarEl = document.getElementById('kt_calendar_app');
    var todayDate = moment().startOf('day');
    var TODAY = todayDate.format('YYYY-MM-DD');

    // Init calendar --- more info: https://fullcalendar.io/docs/initialize-globals
    calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
        },
        initialDate: TODAY,
        navLinks: true,
        selectable: false,
        selectMirror: true,
        locale: 'es',
        navLinks: false,
        editable: false,
        // eventColor: '#f5f8fa',
        // eventTextColor: '#7e8299',
        dayMaxEvents: true,
        events: [],

        dateClick: function(info) {


            // verificar que la fecha no se inferior la fecha "2022-04-01"
            if (moment(info.dateStr).isBefore("2022-04-01")) {
                return false;
            }

            // verificar que la fecha seleccionada no sea mayor a la actual
            if (moment(info.dateStr).isAfter(moment().format('YYYY-MM-DD'))) {
                return false;
            }


            let eventosFiltrados = calendar.getEvents().filter(function(evento) {
                return moment(evento.start).format('YYYY-MM-DD') === info.dateStr;
            });

            if (eventosFiltrados.length == 2 || $("#personas").val() == 0) {
                return false;
            }
            asignarAsistencia(info.dateStr, $("#personas").val(), eventosFiltrados.length);

        },

        datesSet: function(info) {

            let mes = new Date(info.view.currentStart).getMonth() + 1;
            let anio = new Date(info.view.currentStart).getFullYear();
            let personaId = $("#personas").val();

            listarAsistenciaMensual(personaId, mes, anio)
        }
    });

    calendar.render();

    function asignarAsistencia(fechaSeleccionada, personaId, cantidadEventos) {


        parametrosModal("mdl_asistencia", "Marcado Asistencia en Fecha: " + formatearFecha(fechaSeleccionada), "modal-md")

        cantidadEventos == 0 ? $("#tipo_marcado").val("ENTRADA") : $("#tipo_marcado").val("SALIDA");

        $("#nombre_persona").val(($("#personas").select2("data")[0].text));
        let horaActual = new Date().getHours() + ":" + new Date().getMinutes();
        $("#fecha").val(fechaSeleccionada + " " + horaActual);
        $("#persona_id").val(personaId);

    }

    $("#form_marcado_calendario").submit(function(e) {
        e.preventDefault();

        let datos = $(this).serializeArray();


        $.post("marcado-calendario", datos)
            .done(function(data) {

                if (data.exito) {
                    swal.fire({
                        title: "Exito",
                        text: data.mensaje || "Se registro correctamente.",
                        icon: "success",
                    })
                    if (data.datos) {
                        ingresarAsistencia(data.datos);
                    }
                    $("#mdl_asistencia").modal("hide");

                } else {
                    swal.fire({
                        title: "Error",
                        text: data.mensaje || "Ocurrio un error.",
                        icon: "error",
                    })

                }

            })
            .fail(function() {
                swal.fire({
                    title: "Error",
                    text: "Ocurrio un error Inesperado, contacte con el administrador...",
                    icon: "error",
                })
            })
    })

    $("#btn_cancelar").click(function() {
        limpiarformulario();
        $("#mdl_asistencia").modal("hide");
    })

    function formatearFecha(fecha) {
        let fechaFormateada = fecha.split("-");
        return fechaFormateada[2] + "/" + fechaFormateada[1] + "/" + fechaFormateada[0];

    }

    function limpiarformulario() {
        $("#form_marcado_calendario")[0].reset();
        $("#persona_id").val("");
        $("#fecha").val("");
        $("#tipo_marcado").val("");
        $("#nombre_persona").val("");

    }


    function listarAsistenciaMensual(personaId, mes, anio) {


        calendar.getEvents().forEach(function(evento) {
            evento.remove();
        });

        $.post("calendario", { mes: mes, anio: anio, personaId: personaId })
            .done(function(data) {

                if (data.length == 0) return;
                let nuevosEventos = [];


                data.forEach(function(item) {

                    let horaEntrada = item.entrada.split(" ")[1];
                    let horaSalida = item.salida ? item.salida.split(" ")[1] : "";

                    nuevosEventos.push({
                        id: item.id,
                        title: horaEntrada,
                        start: item.fecha,
                        end: item.fecha,
                        // className: "fc-event-success",


                    })
                    if (horaSalida != "") {
                        nuevosEventos.push({
                            id: item.id,
                            title: horaSalida,
                            start: item.fecha,
                            end: item.fecha,
                        })
                    }

                });

                calendar.addEventSource(nuevosEventos);
            })
    }

    function ingresarAsistencia(datos) {

        let nuevoMarcado = [];
        let horaEntrada = datos.marcado.split(" ")[1];

        nuevoMarcado.push({
            id: datos.id,
            title: horaEntrada,
            start: datos.fecha,
            end: datos.fecha,
            className: "fc-event-success",
        })

        calendar.addEventSource(nuevoMarcado);
    }

    $("#personas").change(function() {
        let personaId = $(this).val();
        let mes = new Date(calendar.view.currentStart).getMonth() + 1;
        let anio = new Date(calendar.view.currentStart).getFullYear();

        listarAsistenciaMensual(personaId, mes, anio);
    })


})