<header class="header">
    <div class="header-content">
        <h1 class="header-title">
            @if(request()->routeIs('productos.*'))
                CRUD Productos
            @elseif(request()->routeIs('tipo_productos.*'))
                Catálogo de tipos
            @else
                CRUD Usuarios
            @endif
        </h1>
        <p class="header-description">
            @if(request()->routeIs('productos.*'))
                Gestión y control de inventario para la droguería
            @elseif(request()->routeIs('tipo_productos.*'))
                Clasificación de productos farmacéuticos
            @else
                Gestión y administración de usuarios del sistema
            @endif
        </p>
    </div>
</header>
