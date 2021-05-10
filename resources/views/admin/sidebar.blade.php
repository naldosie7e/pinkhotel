<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Sidebar
        </div>

        <div class="card-body">
            <nav class="navbar bg-light">

                <!-- Links -->
                <ul class="navbar-nav">
                    <li role="presentation">
                        <a href="{{ url('home') }}">
                            Inicio
                        </a>
                    </li>
                    @if (Auth::user()->rol_id==2)
                    <li role="presentation">
                        <a href="{{ url('admin/info-hotel') }}">
                            Hoteles
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="{{ url('admin/sucursales') }}">
                            Sucursales
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="{{ url('admin/habitaciones') }}">
                            Habitaciones
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="{{ url('admin/clientes') }}">
                            Clientes
                        </a>
                    </li>
                    @endif
                    <li role="presentation">
                        <a href="{{ url('admin/reservaciones') }}">
                            Reservaciones
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
    </div>
</div>