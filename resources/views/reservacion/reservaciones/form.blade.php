<div class="form-group {{ $errors->has('id_cliente') ? 'has-error' : ''}}">
    <label for="id_cliente" class="control-label">{{ 'Numero identificacion' }}</label>
    <input class="form-control" name="numero_documento" type="text" id="numero_documento"
        value="{{ isset($reservacione->numero_documento) ? $reservacione->numero_documento : ''}}" required
        onfocusout="validarDocumento()">
    <input hidden class="form-control" name="id_cliente" type="text" id="id_cliente"
        value="{{ isset($reservacione->id_cliente) ? $reservacione->id_cliente : ''}}" required>
    {!! $errors->first('id_cliente', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('id_hotel') ? 'has-error' : ''}}">
    <label for="id_hotel" class="control-label">{{ 'Hotel' }}</label>
    <select name="id_hotel" class="form-control" id="id_hotel" required onchange="obtenerSucursales()">
        <option value=""> Seleccione</option>
        @foreach ($hotels as $hotel)
        <option value="{{ $hotel->id }}"
            {{ (isset($reservacione->id_hotel) && $reservacione->id_hotel == $hotel->id) ? 'selected' : ''}}>
            {{ $hotel->nombre }}</option>
        </option>
        @endforeach
    </select>
    {!! $errors->first('id_hotel', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('id_sucursal') ? 'has-error' : ''}}">
    <label for="id_sucursal" class="control-label">{{ 'Sucursal' }}</label>
    <input hidden id="id_sucursal_selected"
        value=" {{isset($reservacione->id_sucursal) ? $reservacione->id_sucursal : ''}}">
    <select name="id_sucursal" class="form-control" id="id_sucursal" required onchange="obtenerHabitaciones()">
        <option value=""> Seleccione</option>
    </select>
    {!! $errors->first('id_sucursal', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('id_habitacion') ? 'has-error' : ''}}">
    <label for="id_habitacion" class="control-label">{{ 'Habitacion' }}</label>
    <input hidden id="id_habitacion_selected"
        value="{{isset($reservacione->id_habitacion) ? $reservacione->id_habitacion : ''}}">
    <select name="id_habitacion" class="form-control" id="id_habitacion" required>
        <option value=""> Seleccione</option>
    </select>
    {!! $errors->first('id_habitacion', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('dias_reservacion') ? 'has-error' : ''}}">
    <label for="dias_reservacion" class="control-label">{{ 'Dias Reservacion' }}</label>
    <input class="form-control" name="dias_reservacion" type="number" id="dias_reservacion"
        value="{{ isset($reservacione->dias_reservacion) ? $reservacione->dias_reservacion : ''}}" required
        onkeyup="calcularValorDia()">
    {!! $errors->first('dias_reservacion', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('valor_reservacion') ? 'has-error' : ''}}">
    <label for="valor_reservacion" class="control-label">{{ 'Valor Total Reservacion' }}</label>
    <input readonly class="form-control" name="valor_reservacion" type="text" id="valor_reservacion"
        value="{{ isset($reservacione->valor_reservacion) ? $reservacione->valor_reservacion : ''}}">
    {!! $errors->first('valor_reservacion', '<p class="help-block">:message</p>') !!}
</div>
@if (Auth::user()->rol_id==1)
<div class="form-group ">
    <div class="alert alert-warning" role="alert">
        Para poder reservar debe pagar el 30% del valor total de la reservación
    </div>
    <label for="valor_reservacion" class="control-label">{{ 'Valor a pagar' }}</label>
    <input readonly class="form-control" name="valor_parcial_reserva" type="text" id="valor_parcial_reserva"
        value="{{ isset($reservacione->valor_parcial_reserva) ? $reservacione->valor_parcial_reserva : ''}}">
</div>
@endif
<div class="form-group">
    <label for="medio_pago" class="control-label">{{ 'Medio pago' }}</label>

    <select name="medio_pago" class="form-control" id="medio_pago" required>
        <option value=""> Seleccione</option>
        <option value="ef"
            {{ (isset($reservacione->medio_pago) && $reservacione->medio_pago =='ef') ? 'selected' : ''}}> Efectivo
        </option>
        <option value="tc"
            {{ (isset($reservacione->medio_pago) && $reservacione->medio_pago =='tc') ? 'selected' : ''}}> Tarjeta
            credito</option>
        <option value="td"
            {{ (isset($reservacione->medio_pago) && $reservacione->medio_pago =='td') ? 'selected' : ''}}> Tarjeta
            debito</option>
        <option value="tb"
            {{ (isset($reservacione->medio_pago) && $reservacione->medio_pago =='tb') ? 'selected' : ''}}> Transferencia
            bancaria</option>
    </select>
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Actualizar' : 'Crear' }}">
</div>