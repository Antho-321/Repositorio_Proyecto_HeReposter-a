<!-- Sidebar Menu -->
<div class="sidebar-menu">
    <ul>
        <!-- Cliente -->
        <li><a href="{{ route('AdministradorClientesIndex') }}">Clientes</a></li>
        
        <!-- Usuarios -->
        <li>
            <a href="{{ route('AdministradorUsuariosIndex') }}">Usuarios</a>
            <ul> 
                <!-- Submenu de Usuarios -->
                <li><a href="{{ route('AdministradorRolesIndex') }}">Roles</a></li>
            </ul>
        </li>

        <!-- Pedidos -->
        <li>
            <a href="{{ route('AdministradorPedidosIndex') }}">Pedidos</a>
            <ul>
                <!-- Submenu de Pedidos -->
                <li><a href="{{ route('AdministradorDetallePedidoIndex') }}">Detalles de pedido</a></li>
                <li><a href="{{ route('AdministradorVariosIndex') }}">Varios</a></li>
            </ul>
        </li>

        <!-- Pastel -->
        <li>
            <a href="{{ route('AdministradorPastelIndex') }}">Pastel</a>
            <ul>
                <!-- Submenu de Pastel -->
                <li>
                    <a href="#">Tamaños y Formas</a>
                    <ul>
                        <!-- Submenu de Tamaños y Formas -->
                        <li><a href="{{ route('AdministradorTamanoIndex') }}">Tamaños</a></li>
                        <li><a href="{{ route('AdministradorFormasIndex') }}">Formas</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('AdministradorTipoIndex') }}">Tipo</a></li>
                <li><a href="{{ route('AdministradorRellenosIndex') }}">Rellenos</a></li>
                <li><a href="{{ route('AdministradorCoberturaIndex') }}">Cobertura</a></li>
                <li><a href="{{ route('AdministradorSaboresIndex') }}">Sabores</a></li>
                <li><a href="{{ route('AdministradorCategoriaIndex') }}">Categoria</a></li>
            </ul>
        </li>

        <!-- Comprobante Venta -->
        <li><a href="{{ route('AdministradorComprobanteVentaIndex') }}">Comprobante Venta</a></li>
    </ul>
</div>
