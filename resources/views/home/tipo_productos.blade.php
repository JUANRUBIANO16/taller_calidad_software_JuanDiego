@extends('layout.app')

@section('titulo', 'Tipos de Productos')

@section('contenido')
<div class="content-header">
    <h2>Tipos de Productos</h2>
    <label for="modal-create-toggle" class="btn btn-primary">+ NUEVO TIPO</label>
</div>

@if ($errors->any())
    <div class="alert alert-danger" style="margin-bottom: 1rem;">
        <strong>Revisa los campos:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success" style="margin-bottom: 1rem;">
        {{ session('success') }}
    </div>
@endif

<div class="table-container">
    <table class="crud-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tipos as $tipo)
            <tr>
                <td>{{ $tipo->id }}</td>
                <td>{{ $tipo->nombre }}</td>
                <td class="action-cell">
                    <label for="modal-edit-tipo-{{ $tipo->id }}" class="btn-action btn-edit">✏️ EDITAR</label>

                    <input type="checkbox" id="modal-edit-tipo-{{ $tipo->id }}" class="modal-toggle" hidden>
                    <div class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Editar Tipo</h2>
                                <label for="modal-edit-tipo-{{ $tipo->id }}" class="modal-close">✕</label>
                            </div>
                            <form action="{{ route('tipo_productos.update', $tipo) }}" method="POST" class="modal-form">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Nombre:</label>
                                    <input type="text" name="nombre" value="{{ old('nombre', $tipo->nombre) }}" required>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                    <label for="modal-edit-tipo-{{ $tipo->id }}" class="btn btn-secondary">Cancelar</label>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form action="{{ route('tipo_productos.destroy', $tipo) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn-action btn-delete"
                            onclick="return confirm('¿Seguro que deseas eliminar este tipo?')">🗑️ ELIMINAR</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<input type="checkbox" id="modal-create-toggle" class="modal-toggle" hidden>
<div class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Nuevo Tipo</h2>
            <label for="modal-create-toggle" class="modal-close">✕</label>
        </div>
        <form action="{{ route('tipo_productos.store') }}" method="POST" class="modal-form">
            @csrf
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <label for="modal-create-toggle" class="btn btn-secondary">Cancelar</label>
            </div>
        </form>
    </div>
</div>

@endsection

