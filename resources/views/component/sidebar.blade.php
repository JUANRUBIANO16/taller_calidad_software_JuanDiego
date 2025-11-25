<aside class="sidebar">
    <div class="sidebar-header">
        <h1 class="sidebar-title">Admin</h1>
    </div>
    <div class="sidebar-content">
        <div class="modules-section">
            <span class="modules-label">Módulos</span>
            <a href="{{ route('users.index') }}" class="module-item {{ request()->routeIs('users.*') ? 'module-item-active' : '' }}">
                <span style="margin-right: 10px;">👤</span>
                Usuarios
            </a>
            <a href="{{ route('productos.index') }}" class="module-item {{ request()->routeIs('productos.*') ? 'module-item-active' : '' }}">
                <span style="margin-right: 10px;">💊</span>
                Productos
            </a>
            <a href="{{ route('tipo_productos.index')}}" class="module-item {{ request()->routeIs('tipo_productos.*') ? 'module-item-active' : '' }}">
                <span style="margin-right: 10px;">🗂️</span>
                Tipos de producto
            </a>
        </div>
    </div>
    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">🚪 Cerrar Sesión</button>
        </form>
    </div>
</aside>
