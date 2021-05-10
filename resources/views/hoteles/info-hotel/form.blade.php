<div class="form-group {{ $errors->has('codigo') ? 'has-error' : ''}}">
    <label for="codigo" class="control-label">{{ 'Codigo' }}</label>
    <input class="form-control" name="codigo" type="text" id="codigo"
        value="{{ isset($infohotel->codigo) ? $infohotel->codigo : ''}}">
    {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('nit') ? 'has-error' : ''}}">
    <label for="nit" class="control-label">{{ 'Nit' }}</label>
    <input class="form-control" name="nit" type="text" id="nit"
        value="{{ isset($infohotel->nit) ? $infohotel->nit : ''}}">
    {!! $errors->first('nit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    <label for="nombre" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" name="nombre" type="text" id="nombre"
        value="{{ isset($infohotel->nombre) ? $infohotel->nombre : ''}}">
    {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('fecha_creacion') ? 'has-error' : ''}}">
    <label for="fecha_creacion" class="control-label">{{ 'Fecha Creacion' }}</label>
    <input class="form-control" name="fecha_creacion" type="date" id="fecha_creacion"
        value="{{ isset($infohotel->fecha_creacion) ? $infohotel->fecha_creacion : ''}}">
    {!! $errors->first('fecha_creacion', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('representante_legal') ? 'has-error' : ''}}">
    <label for="representante_legal" class="control-label">{{ 'Representante Legal' }}</label>
    <input class="form-control" name="representante_legal" type="text" id="representante_legal"
        value="{{ isset($infohotel->representante_legal) ? $infohotel->representante_legal : ''}}">
    {!! $errors->first('representante_legal', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
    <label for="telefono" class="control-label">{{ 'Telefono' }}</label>
    <input class="form-control" name="telefono" type="text" id="telefono"
        value="{{ isset($infohotel->telefono) ? $infohotel->telefono : ''}}">
    {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Actualizar' : 'Crear' }}">
</div>