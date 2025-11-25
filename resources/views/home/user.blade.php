@extends('layout.app')

@section('titulo', 'CRUD Usuarios')

@section('contenido')

<div class="content-header">
    <input type="text" class="search-input" id="searchInput" placeholder="Buscar por nombre o email...">
    <label for="modal-toggle" class="btn btn-primary">+ NUEVO REGISTRO</label>
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
    <table class="crud-table" id="usersTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>EMAIL</th>
                <th>ESTADO</th>
                <th>FECHA</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->estado == 'ACTIVO')
                        <span class="status status-activo">ACTIVO</span>
                    @elseif($user->estado == 'INACTIVO')
                        <span class="status status-inactivo">INACTIVO</span>
                    @else
                        <span class="status status-pendiente">PENDIENTE</span>
                    @endif
                </td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
                <td class="action-cell">
                    <label for="modal-edit-user-{{ $user->id }}" class="btn-action btn-edit">✏️ EDITAR</label>

                    <input type="checkbox" id="modal-edit-user-{{ $user->id }}" class="modal-toggle" hidden>
                    <div class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Editar Usuario</h2>
                                <label for="modal-edit-user-{{ $user->id }}" class="modal-close">✕</label>
                            </div>
                            <form action="{{ route('users.update', $user->id) }}" method="POST" class="modal-form">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="edit-name-{{ $user->id }}">Nombre:</label>
                                    <input type="text" name="name" id="edit-name-{{ $user->id }}" value="{{ old('name', $user->name) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-username-{{ $user->id }}">Usuario:</label>
                                    <input type="text" name="username" id="edit-username-{{ $user->id }}" value="{{ old('username', $user->username) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-email-{{ $user->id }}">Email:</label>
                                    <input type="email" name="email" id="edit-email-{{ $user->id }}" value="{{ old('email', $user->email) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-password-{{ $user->id }}">Contraseña (opcional):</label>
                                    <input type="password" name="password" id="edit-password-{{ $user->id }}" placeholder="Deja en blanco para mantener">
                                </div>
                                <div class="form-group">
                                    <label for="edit-estado-{{ $user->id }}">Estado:</label>
                                    <select name="estado" id="edit-estado-{{ $user->id }}" required>
                                        <option value="ACTIVO" @selected(old('estado', $user->estado) === 'ACTIVO')>ACTIVO</option>
                                        <option value="INACTIVO" @selected(old('estado', $user->estado) === 'INACTIVO')>INACTIVO</option>
                                        <option value="PENDIENTE" @selected(old('estado', $user->estado) === 'PENDIENTE')>PENDIENTE</option>
                                    </select>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                    <label for="modal-edit-user-{{ $user->id }}" class="btn btn-secondary">Cancelar</label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn-action btn-delete" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">🗑️ Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal para nuevo usuario -->
<input type="checkbox" id="modal-toggle" class="modal-toggle" hidden>
<div class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Nuevo Registro</h2>
            <label for="modal-toggle" class="modal-close">✕</label>
        </div>
        <form action="{{ route('users.store') }}" method="POST" class="modal-form">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="name" id="nombre" placeholder="Ingrese el nombre completo" required>
            </div>
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" name="username" id="username" placeholder="Nombre de usuario" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Ingrese el email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" placeholder="Min. 6 caracteres" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" required>
                    <option value="ACTIVO">ACTIVO</option>
                    <option value="INACTIVO">INACTIVO</option>
                    <option value="PENDIENTE">PENDIENTE</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <label for="modal-toggle" class="btn btn-secondary">Cancelar</label>
            </div>
        </form>
    </div>
</div>

<!-- Script para búsqueda en la tabla -->
<script>
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('usersTable');
    searchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const nombre = row.cells[1].textContent.toLowerCase();
            const email = row.cells[2].textContent.toLowerCase();
            row.style.display = (nombre.includes(filter) || email.includes(filter)) ? '' : 'none';
        });
    });
</script>

@endsection
