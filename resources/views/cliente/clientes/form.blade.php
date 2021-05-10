<div class="form-group {{ $errors->has('users_id') ? 'has-error' : ''}}" hidden>
    <label for="users_id" class="control-label">{{ 'Users Id' }}</label>
    <input class="form-control" name="users_id" type="number" id="users_id"
        value="{{ isset($cliente->users_id) ? $cliente->users_id : ''}}">
    {!! $errors->first('users_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('numero_documento') ? 'has-error' : ''}}">
    <label for="numero_documento" class="control-label">{{ 'Numero Documento' }}</label>
    <input class="form-control" name="numero_documento" type="text" id="numero_documento"
        value="{{ isset($cliente->numero_documento) ? $cliente->numero_documento : ''}}" required>
    {!! $errors->first('numero_documento', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    <label for="nombre" class="control-label">{{ 'Nombre' }}</label>
    <input class="form-control" name="nombre" type="text" id="nombre"
        value="{{ isset($cliente->nombre) ? $cliente->nombre : ''}}" required>
    {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('apellidos') ? 'has-error' : ''}}">
    <label for="apellidos" class="control-label">{{ 'Apellidos' }}</label>
    <input class="form-control" name="apellidos" type="text" id="apellidos"
        value="{{ isset($cliente->apellidos) ? $cliente->apellidos : ''}}" required>
    {!! $errors->first('apellidos', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('genero') ? 'has-error' : ''}}">
    <label for="genero" class="control-label">{{ 'Genero' }}</label>
    <select name="genero" class="form-control" id="genero" required>
        @foreach (json_decode('{"":"Seleccione","1":"Femenino","2":"Masculino","3":"Otro"}', true) as $optionKey =>
        $optionValue)
        <option value="{{ $optionKey }}"
            {{ (isset($cliente->genero) && $cliente->genero == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}
        </option>
        @endforeach
    </select>
    {!! $errors->first('genero', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('edad') ? 'has-error' : ''}}">
    <label for="edad" class="control-label">{{ 'Edad' }}</label>
    <input class="form-control" name="edad" type="number" id="edad"
        value="{{ isset($cliente->edad) ? $cliente->edad : ''}}" required>
    {!! $errors->first('edad', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('fecha_nacimiento') ? 'has-error' : ''}}">
    <label for="fecha_nacimiento" class="control-label">{{ 'Fecha Nacimiento' }}</label>
    <input class="form-control" name="fecha_nacimiento" type="date" id="fecha_nacimiento"
        value="{{ isset($cliente->fecha_nacimiento) ? $cliente->fecha_nacimiento : ''}}">
    {!! $errors->first('fecha_nacimiento', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('correo_electronico') ? 'has-error' : ''}}">
    <label for="correo_electronico" class="control-label">{{ 'Correo Electronico' }}</label>
    <input class="form-control" name="correo_electronico" type="email" id="correo_electronico"
        value="{{ isset($cliente->correo_electronico) ? $cliente->correo_electronico : ''}}" required>
    {!! $errors->first('correo_electronico', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
    <label for="telefono" class="control-label">{{ 'Telefono' }}</label>
    <input class="form-control" name="telefono" type="text" id="telefono"
        value="{{ isset($cliente->telefono) ? $cliente->telefono : ''}}" required>
    {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Actualizar' : 'Crear' }}">
</div>