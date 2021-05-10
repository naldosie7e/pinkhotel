@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Inicio</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    Reservaciones
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
