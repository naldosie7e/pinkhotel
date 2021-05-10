@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Crear Cliente</div>
                <div class="card-body">
                    @if (Auth::user()->rol_id==2)
                    <a href="{{ url('/admin/clientes') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                                class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button></a>
                    <br />
                    <br />
                    @endif
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    <form method="POST" action="{{ url('/admin/clientes') }}" accept-charset="UTF-8"
                        class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('cliente.clientes.form', ['formMode' => 'create'])

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
