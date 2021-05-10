<div class="form-group {{ $errors->has('id_sucursal') ? 'has-error' : ''}}">
    <label for="id_sucursal" class="control-label">{{ 'Sucursal' }}</label>
    <select name="id_sucursal" class="form-control" id="id_sucursal" required>
        <option value=""> Seleccione</option>
        @foreach ($sucursales as $sucursal)
        <option value="{{ $sucursal->id }}"
            {{ (isset($habitacione->id_sucursal) && $habitacione->id_sucursal == $sucursal->id) ? 'selected' : ''}}>
            {{ $sucursal->codigo }}-{{ $sucursal->hotel->nombre }}</option>
        </option>
        @endforeach
    </select>
    {!! $errors->first('id_sucursal', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('numero_habitacion') ? 'has-error' : ''}}">
    <label for="numero_habitacion" class="control-label">{{ 'Numero habitación' }}</label>
    <input class="form-control" name="numero_habitacion" type="text" id="numero_habitacion"
        value="{{ isset($habitacione->numero_habitacion) ? $habitacione->numero_habitacion : ''}}" required>
    {!! $errors->first('numero_habitacion', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('clasificacion') ? 'has-error' : ''}}">
    <label for="clasificacion" class="control-label">{{ 'Clasificacion' }}</label>
    <select name="clasificacion" class="form-control" id="clasificacion" required>
        <option value=""> Seleccione</option>
        <option value="Sencilla"
            {{ (isset($habitacione->clasificacion) && $habitacione->clasificacion =='Sencilla') ? 'selected' : ''}}>
            Sencilla
        </option>
        <option value="Doble"
            {{ (isset($habitacione->clasificacion) && $habitacione->clasificacion =='Doble') ? 'selected' : ''}}> Doble
        </option>
        <option value="Suite"
            {{ (isset($habitacione->clasificacion) && $habitacione->clasificacion =='Suite') ? 'selected' : ''}}> Suite
        </option>
        <option value="Presidencial"
            {{ (isset($habitacione->clasificacion) && $habitacione->clasificacion =='Presidencial') ? 'selected' : ''}}>
            Presidencial
        </option>
    </select>
</div>
<div class="form-group {{ $errors->has('valor_dia') ? 'has-error' : ''}}">
    <label for="valor_dia" class="control-label">{{ 'Valor Dia' }}</label>
    <input class="form-control" name="valor_dia" type="number" id="valor_dia"
        value="{{ isset($habitacione->valor_dia) ? $habitacione->valor_dia : ''}}" required>
    {!! $errors->first('valor_dia', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Actualizar' : 'Crear' }}">
</div>
