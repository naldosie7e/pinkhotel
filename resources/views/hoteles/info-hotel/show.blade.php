@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">InfoHotel {{ $infohotel->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/info-hotel') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/info-hotel/' . $infohotel->id . '/edit') }}" title="Edit InfoHotel"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/infohotel' . '/' . $infohotel->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete InfoHotel" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $infohotel->id }}</td>
                                    </tr>
                                    <tr><th> Codigo </th><td> {{ $infohotel->codigo }} </td></tr><tr><th> Nit </th><td> {{ $infohotel->nit }} </td></tr><tr><th> Nombre </th><td> {{ $infohotel->nombre }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
