@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Reservaciones</div>
                <div class="card-body">
                    <a href="{{ url('/admin/reservaciones/create') }}" class="btn btn-success btn-sm"
                        title="Add New Reservacione">
                        <i class="fa fa-plus" aria-hidden="true"></i> Agregar
                    </a>

                    <form method="GET" action="{{ url('/admin/reservaciones') }}" accept-charset="UTF-8"
                        class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..."
                                value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <br />
                    <br />
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hotel</th>
                                    <th>Sucursal</th>
                                    <th>Habitacion</th>
                                    <th>Cliente</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservaciones as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->hotel->nombre }}</td>
                                    <td>{{ $item->sucursal->nombre }}</td>
                                    <td>{{ $item->habitacion->numero_habitacion }}</td>
                                    <td>{{ $item->cliente->nombre }} {{ $item->cliente->apellidos }}</td>
                                    <td>
                                        <a href="{{ url('/admin/reservaciones/' . $item->id . '/edit') }}"
                                            title="Edit Reservacione"><button class="btn btn-primary btn-sm"><i
                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                Editar</button></a>
                                        @if (Auth::user()->rol_id==2)
                                        @if ( $item->estado==1)
                                        <form method="POST"
                                            action="{{ url('/admin/reservaciones/checkin' . '/' . $item->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('POST') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                title="Delete Reservacione"><i class="fa fa-trash-o"
                                                    aria-hidden="true"></i> Checkin</button>
                                        </form>
                                        @endif
                                        @if ( $item->estado==2)
                                        <button class="btn btn-primary btn-sm" onclick="checkOut({{$item->id}})">
                                            Checkout</button>
                                        @endif

                                        @endif
                                        @if (Auth::user()->rol_id==1 && $item->estado==3)
                                        <button class="btn btn-primary btn-sm"
                                            onclick="calificarReserva({{$item->id}})">
                                            Calificar</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $reservaciones->appends(['search' =>
                            Request::get('search')])->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="calificacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Calificar reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    Para nosotros es un placer haberlo atendido, le agrecemos calificar nuestra atencion donde 1 es Malo
                    y 5 Excelente
                </div>
                <form method="POST" action="{{ url('/admin/reservaciones/calificacion') }}" accept-charset="UTF-8"
                    style="display:inline">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="calificacion_hotel" class="control-label">{{ 'Calificion Hotel' }}</label>
                        <select name="calificacion_hotel" class="form-control" id="calificacion_hotel" required>
                            <option value=""> Seleccione</option>
                            @foreach (range(1, 5) as $hotelCalification)
                            <option value="{{ $hotelCalification }}">
                                {{ $hotelCalification }}</option>
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="calificacion_hotel" class="control-label">{{ 'Calificion Habitacion' }}</label>
                        <select name="calificacion_habitacion" class="form-control" id="calificacion_habitacion"
                            required>
                            <option value=""> Seleccione</option>
                            @foreach (range(1, 5) as $habitacionCalificacion)
                            <option value="{{ $habitacionCalificacion }}">
                                {{ $habitacionCalificacion }}</option>
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="calificacion_hotel" class="control-label">{{ 'Calificion Servicio' }}</label>
                        <select name="calificacion_servicio" class="form-control" id="calificacion_servicio" required>
                            <option value=""> Seleccione</option>
                            @foreach (range(1, 5) as $habitacionServicio)
                            <option value="{{ $habitacionServicio }}">
                                {{ $habitacionServicio }}</option>
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="calificacion_hotel" class="control-label">{{ 'Calificion Servicio' }}</label>
                        <select name="calificacion_atencion" class="form-control" id="calificacion_atencion" required>
                            <option value=""> Seleccione</option>
                            @foreach (range(1, 5) as $habitacionServicio)
                            <option value="{{ $habitacionServicio }}">
                                {{ $habitacionServicio }}</option>
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="calificacion_hotel" class="control-label">{{ 'Observacion' }}</label>
                        <input class="form-control" name="observacion" type="text" id="observacion" value="" required>
                        <input hidden class="form-control" name="id_reservacion" type="text"
                            id="id_reservarcion_calificada" value="" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="realizarPagoFinalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pago Final</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('/admin/reservaciones/pagoOnCheckOut') }}" accept-charset="UTF-8"
                    style="display:inline">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="calificacion_hotel" class="control-label">{{ 'Valor a cobrar' }}</label>
                        <input readonly class="form-control" name="pago_restante" type="text" id="pago_restante"
                            value="" required>
                        <input hidden class="form-control" name="id_reservacion" type="text" id="id_reservarcion_pagar"
                            value="" required>
                    </div>
                    <div class="form-group">
                        <label for="medio_pago" class="control-label">{{ 'Medio pago' }}</label>
                        <select name="medio_pago" class="form-control" id="medio_pago" required>
                            <option value=""> Seleccione</option>
                            <option value="ef"
                                {{ (isset($reservacione->medio_pago) && $reservacione->medio_pago =='ef') ? 'selected' : ''}}>
                                Efectivo
                            </option>
                            <option value="tc"
                                {{ (isset($reservacione->medio_pago) && $reservacione->medio_pago =='tc') ? 'selected' : ''}}>
                                Tarjeta
                                credito</option>
                            <option value="td"
                                {{ (isset($reservacione->medio_pago) && $reservacione->medio_pago =='td') ? 'selected' : ''}}>
                                Tarjeta
                                debito</option>
                            <option value="tb"
                                {{ (isset($reservacione->medio_pago) && $reservacione->medio_pago =='tb') ? 'selected' : ''}}>
                                Transferencia
                                bancaria</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



@endsection
