@extends('layout.app')

@section('titulo', 'CRUD Productos')

@section('contenido')
<div class="content-header">
    <input type="text" class="search-input" placeholder="Buscar por nombre o proveedor...">
    <label for="modal-toggle" class="btn btn-primary">+ NUEVO PRODUCTO</label>
</div>

<div class="table-container">
    <table class="crud-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>STOCK</th>
                <th>PROVEEDOR</th>
                <th>TIPO</th>
                <th>ESTADO</th>
                <th>FECHA INGRESO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->proveedor ?? 'Sin registro' }}</td>
                <td>{{ $producto->tipoProducto->nombre ?? 'Sin tipo' }}</td>
                <td>
                    @if($producto->estado === 'disponible')
                        <span class="status status-activo">DISPONIBLE</span>
                    @else
                        <span class="status status-mantenimiento">NO DISPONIBLE</span>
                    @endif
                </td>
                <td>{{ optional($producto->fecha)->format('d M Y') ?? 'Sin fecha' }}</td>
                <td class="action-cell">
                    <label for="modal-edit-producto-{{ $producto->id }}" class="btn-action btn-edit">✏️ EDITAR</label>

                    <input type="checkbox" id="modal-edit-producto-{{ $producto->id }}" class="modal-toggle" hidden>
                    <div class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Editar Producto</h2>
                                <label for="modal-edit-producto-{{ $producto->id }}" class="modal-close">✕</label>
                            </div>
                            <form action="{{ route('productos.update', $producto) }}" method="POST" class="modal-form">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="edit-nombre-{{ $producto->id }}">Nombre:</label>
                                    <input type="text" id="edit-nombre-{{ $producto->id }}" name="nombre"
                                        value="{{ old('nombre', $producto->nombre) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-stock-{{ $producto->id }}">Stock:</label>
                                    <input type="number" min="0" id="edit-stock-{{ $producto->id }}" name="stock"
                                        value="{{ old('stock', $producto->stock) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-proveedor-{{ $producto->id }}">Proveedor:</label>
                                    <input type="text" id="edit-proveedor-{{ $producto->id }}" name="proveedor"
                                        value="{{ old('proveedor', $producto->proveedor) }}">
                                </div>
                                <div class="form-group">
                                    <label for="edit-tipo-{{ $producto->id }}">Tipo de producto:</label>
                                    <select id="edit-tipo-{{ $producto->id }}" name="tipo_producto_id" required>
                                        @foreach($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                @selected(old('tipo_producto_id', $producto->tipo_producto_id) == $tipo->id)>
                                                {{ $tipo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit-estado-{{ $producto->id }}">Estado:</label>
                                    <select id="edit-estado-{{ $producto->id }}" name="estado" required>
                                        <option value="disponible" @selected(old('estado', $producto->estado) === 'disponible')>Disponible</option>
                                        <option value="no_disponible" @selected(old('estado', $producto->estado) === 'no_disponible')>No disponible</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit-fecha-{{ $producto->id }}">Fecha de ingreso:</label>
                                    <input type="date" id="edit-fecha-{{ $producto->id }}" name="fecha"
                                        value="{{ old('fecha', optional($producto->fecha)->format('Y-m-d')) }}">
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                    <label for="modal-edit-producto-{{ $producto->id }}" class="btn btn-secondary">Cancelar</label>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn-action btn-delete"
                            onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                            🗑️ ELIMINAR
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<input type="checkbox" id="modal-toggle" class="modal-toggle" hidden>
<div class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Nuevo Producto</h2>
            <label for="modal-toggle" class="modal-close">✕</label>
        </div>
        <form action="{{ route('productos.store') }}" method="POST" class="modal-form">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre comercial" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" min="0" name="stock" id="stock" placeholder="Cantidad disponible" required>
            </div>
            <div class="form-group">
                <label for="proveedor">Proveedor:</label>
                <input type="text" name="proveedor" id="proveedor" placeholder="Proveedor principal">
            </div>
            <div class="form-group">
                <label for="tipo_producto_id">Tipo de producto:</label>
                <select name="tipo_producto_id" id="tipo_producto_id" required>
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" required>
                    <option value="disponible">Disponible</option>
                    <option value="no_disponible">No disponible</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha de ingreso:</label>
                <input type="date" name="fecha" id="fecha">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <label for="modal-toggle" class="btn btn-secondary">Cancelar</label>
            </div>
        </form>
    </div>
</div>

{{-- Sin JS: cada fila tiene su propio formulario de edición dentro de <details> --}}
@endsection

