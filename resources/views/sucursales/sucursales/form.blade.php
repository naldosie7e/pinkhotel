<div class="form-group {{ $errors->has('id_hotel') ? 'has-error' : ''}}">
    <label for="id_hotel" class="control-label">{{ 'Id Hotel' }}</label>
    <select name="id_hotel" class="form-control" id="id_hotel" required>
        <option value=""> Seleccione</option>
        @foreach ($hotels as $hotel)
        <option value="{{ $hotel->id }}"
            {{ (isset($sucursale->id_hotel) && $sucursale->id_hotel == $hotel->id) ? 'selected' : ''}}>
            {{ $hotel->nombre }}</option>
        </option>
        @endforeach
    </select>
    {!! $errors->first('id_hotel', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    <label for="nombre" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" name="nombre" type="text" id="nombre"
        value="{{ isset($sucursale->nombre) ? $sucursale->nombre : ''}}" required>
    {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('codigo') ? 'has-error' : ''}}">
    <label for="codigo" class="control-label">{{ 'Codigo' }}</label>
    <input class="form-control" name="codigo" type="text" id="codigo"
        value="{{ isset($sucursale->codigo) ? $sucursale->codigo : ''}}" required>
    {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('direccion') ? 'has-error' : ''}}">
    <label for="direccion" class="control-label">{{ 'Direccion' }}</label>
    <input class="form-control" name="direccion" type="text" id="direccion"
        value="{{ isset($sucursale->direccion) ? $sucursale->direccion : ''}}" required>
    {!! $errors->first('direccion', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('fecha_creacion') ? 'has-error' : ''}}">
    <label for="fecha_creacion" class="control-label">{{ 'Fecha Creacion' }}</label>
    <input class="form-control" name="fecha_creacion" type="date" id="fecha_creacion"
        value="{{ isset($sucursale->fecha_creacion) ? $sucursale->fecha_creacion : ''}}" required>
    {!! $errors->first('fecha_creacion', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
    <label for="telefono" class="control-label">{{ 'Telefono' }}</label>
    <input class="form-control" name="telefono" type="text" id="telefono"
        value="{{ isset($sucursale->telefono) ? $sucursale->telefono : ''}}" required>
    {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>