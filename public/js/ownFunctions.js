
var valorDiaHabitacion = 0;
var reservationId = $("#reservation_id").val();
if (reservationId != undefined) {
    obtenerSucursales();
}
function obtenerSucursales() {
    var idHotel = $("#id_hotel").val();
    var id_sucursal_selected = $("#id_sucursal_selected").val();
    $('#id_sucursal').empty().append('<option value="">Seleccione</option>');
    if (idHotel != "") {
        $.ajax({
            type: 'GET',
            url: '/info-hote/obtener-sucursales/' + idHotel,
            success: function (data) {
                var response = JSON.parse(data);
                var options = "";
                response.sucursales.forEach(el => {
                    if (id_sucursal_selected != undefined && id_sucursal_selected == el.id) {
                        $('#id_sucursal').append(`<option value="${el.id}" selected> ${el.nombre}</option>`);
                        obtenerHabitaciones();
                    } else {
                        $('#id_sucursal').append(`<option value="${el.id}"> ${el.nombre}</option>`);
                    }
                });
                // id_sucursal
            }
        });
    }

}
function obtenerHabitaciones() {
    var idSucursal = $("#id_sucursal").val();
    $('#id_habitacion').empty().append('<option value="">Seleccione</option>');
    var id_habitacion_selected = $("#id_habitacion_selected").val();
    console.log("habitacion selected " + id_habitacion_selected);
    if (idSucursal != "") {
        $.ajax({
            type: 'GET',
            url: '/sucursal/obtener-habitaciones/' + idSucursal,
            success: function (data) {
                var response = JSON.parse(data);
                var options = "";
                response.habitaciones.forEach(el => {
                    if (id_habitacion_selected != undefined && id_habitacion_selected == el.id) {
                        $('#id_habitacion').append(`<option value="${el.id}" data-valordia="${el.valor_dia}" selected> ${el.numero_habitacion}-${el.clasificacion}</option>`);
                    } else {
                        $('#id_habitacion').append(`<option value="${el.id}" data-valordia="${el.valor_dia}"> ${el.numero_habitacion}-${el.clasificacion}</option>`);
                    }
                });
                // id_sucursal
            }
        });
    }

}


function calcularValorDia() {
    var id_habitacion = $("#id_habitacion").val();
    if (id_habitacion != "") {
        valorDiaHabitacion = $("#id_habitacion").find(':selected').data('valordia');
        var valorfinal = $("#dias_reservacion").val() * valorDiaHabitacion;
        var valor_parcial_reserva = (valorfinal * 30) / 100;
        $("#valor_reservacion").val(valorfinal);
        $("#valor_parcial_reserva").val(valor_parcial_reserva);
    }
}

function validarDocumento() {
    var numerIdentificacion = $("#numero_documento").val();
    if (numerIdentificacion != "") {
        $.ajax({
            type: 'GET',
            url: '/reservacion/validarCliente/' + numerIdentificacion,
            success: function (data) {
                var response = JSON.parse(data);
                if (response.cliente == null) {
                    alert("No tenemos sus datos, por favor llenarlos");
                    location.replace("/admin/clientes/create")
                } else {
                    $("#id_cliente").val(response.cliente.id);
                }
            }
        });
    }
}

function checkOut(idReservacion) {
    console.log("id reservacion " + idReservacion);
    if (idReservacion != "") {
        $.ajax({
            type: 'GET',
            url: '/admin/reservaciones/validarPagoReserva/' + idReservacion,
            success: function (data) {
                var response = JSON.parse(data);
                if (response.pagado) {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/reservaciones/checkout/' + idReservacion,
                        success: function (data) {
                            alert("Checkout exitoso");
                            location.replace("/admin/reservaciones");
                        }
                    });
                } else {
                    alert("Se debe hacer el cobre del excedente");
                    $("#pago_restante").val(response.valorFaltante);
                    $("#id_reservarcion_pagar").val(idReservacion);
                    $('#realizarPagoFinalModal').modal('show');
                }

            }
        });

    }
}

function calificarReserva(idReservacion) {

    if (idReservacion != "") {
        $('#id_reservarcion_calificada').val(idReservacion);
        $('#calificacionModal').modal('show');
    }
}


