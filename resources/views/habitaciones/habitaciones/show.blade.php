@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Habitacione {{ $habitacione->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/habitaciones') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/habitaciones/' . $habitacione->id . '/edit') }}" title="Edit Habitacione"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/habitaciones' . '/' . $habitacione->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Habitacione" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $habitacione->id }}</td>
                                    </tr>
                                    <tr><th> Id Sucursal </th><td> {{ $habitacione->id_sucursal }} </td></tr><tr><th> Clasificacion </th><td> {{ $habitacione->clasificacion }} </td></tr><tr><th> Valor Dia </th><td> {{ $habitacione->valor_dia }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
