        <!-- Navigation-->
        <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
        <nav id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="{!! asset('plantilla') !!}">Principal</a>
                </li>
                <!-- @ auth -->
                @if(isset($usuario))
                <li class="sidebar-nav-item">
                    <a href="#">Usuario {{ $usuario->username }}</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{!! asset('productos') !!}">Productos</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{!! asset('pedidos') !!}">Pedidos</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{!! asset('closesession') !!}">Salir</a>
                </li>                                

                @else
                
                <li class="sidebar-nav-item">
                    <a href="{!! asset('logeo') !!}">Inicio de sesion</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{!! asset('alta') !!}">Dar de alta</a>
                </li>
                
                @endif
                <!-- @ endauth-->
            </ul>
        </nav>