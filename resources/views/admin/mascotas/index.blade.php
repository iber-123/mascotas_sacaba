@extends('adminlte::page')

@section('title', 'Gestión de Mascotas - Admin')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-primary">
                <i class="fas fa-paw mr-2"></i>Gestión de Mascotas
            </h1>
            <p class="text-muted mb-0">Administra todas las mascotas del sistema</p>
        </div>
        <div>
            <a href="{{ route('admin.mascotas.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle mr-2"></i>Registrar Nueva Mascota
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Volver al Dashboard
            </a>
        </div>
    </div>
@stop

@section('content')
    <!-- Estadísticas Rápidas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="info-box bg-info">
                <span class="info-box-icon"><i class="fas fa-paw"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Mascotas</span>
                    <span class="info-box-number">{{ $mascotas->total() }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fas fa-search"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Perdidas</span>
                    <span class="info-box-number">{{ \App\Models\Mascota::where('estado', 'perdida')->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fas fa-home"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Encontradas</span>
                    <span class="info-box-number">{{ \App\Models\Mascota::where('estado', 'encontrada')->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-warning">
                <span class="info-box-icon"><i class="fas fa-heart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">En Adopción</span>
                    <span class="info-box-number">{{ \App\Models\Mascota::where('estado', 'adopcion')->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Mascotas -->
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-list mr-2"></i>Lista de Mascotas Registradas
            </h3>
            <div class="card-tools">
                <span class="badge badge-primary">Mostrando {{ $mascotas->count() }} de {{ $mascotas->total() }}</span>
            </div>
        </div>
        <div class="card-body p-0">
            @if($mascotas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="bg-lightblue">
                            <tr>
                                <th width="80">Foto</th>
                                <th>Nombre</th>
                                <th>Especie</th>
                                <th>Raza</th>
                                <th>Dueño</th>
                                <th>Estado</th>
                                <th>Ubicación</th>
                                <th>Registro</th>
                                <th width="150">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mascotas as $mascota)
                                <tr>
                                    <td class="text-center">
                                        @if($mascota->foto)
                                            <img src="{{ asset('storage/' . $mascota->foto) }}" 
                                                 alt="{{ $mascota->nombre }}" 
                                                 class="img-circle img-size-50"
                                                 style="object-fit: cover;">
                                        @else
                                            <div class="img-circle img-size-50 bg-secondary d-flex align-items-center justify-content-center">
                                                <i class="fas fa-paw text-white"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $mascota->nombre }}</strong>
                                        @if($mascota->edad)
                                            <br><small class="text-muted">{{ $mascota->edad }} años</small>
                                        @endif
                                    </td>
                                    <td>{{ $mascota->especie }}</td>
                                    <td>{{ $mascota->raza ?? 'N/A' }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="img-circle img-size-32 bg-primary d-flex align-items-center justify-content-center mr-2">
                                                <i class="fas fa-user text-white fa-xs"></i>
                                            </div>
                                            <div>
                                                <strong>{{ $mascota->user->name }}</strong>
                                                <br><small class="text-muted">{{ $mascota->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            @if($mascota->estado == 'perdida') badge-danger
                                            @elseif($mascota->estado == 'encontrada') badge-success
                                            @else badge-warning @endif">
                                            {{ ucfirst($mascota->estado) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($mascota->ubicacion)
                                            <small>{{ Str::limit($mascota->ubicacion, 30) }}</small>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $mascota->created_at->format('d/m/Y') }}<br>
                                            <span class="text-info">{{ $mascota->created_at->diffForHumans() }}</span>
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.mascotas.show', $mascota) }}" 
                                               class="btn btn-info" 
                                               title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.mascotas.edit', $mascota) }}" 
                                               class="btn btn-warning" 
                                               title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-danger" 
                                                    title="Eliminar"
                                                    data-toggle="modal" 
                                                    data-target="#deleteModal{{ $mascota->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Modal de Eliminación -->
                                        <div class="modal fade" id="deleteModal{{ $mascota->id }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title">
                                                            <i class="fas fa-exclamation-triangle mr-2"></i>Confirmar Eliminación
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estás seguro de eliminar a <strong>{{ $mascota->nombre }}</strong>?</p>
                                                        <p class="text-danger mb-0">
                                                            <i class="fas fa-info-circle mr-1"></i>
                                                            Esta acción eliminará la mascota y todos sus datos asociados.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('admin.mascotas.destroy', $mascota) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $mascotas->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-paw fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted">No hay mascotas registradas</h4>
                    <p class="text-muted">Comienza registrando la primera mascota en el sistema.</p>
                    <a href="{{ route('admin.mascotas.create') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-plus-circle mr-2"></i>Registrar Primera Mascota
                    </a>
                </div>
            @endif
        </div>
    </div>
@stop

@section('css')
<style>
    .table th {
        border-top: none;
        font-weight: 600;
    }
    .bg-lightblue {
        background-color: #e3f2fd !important;
    }
    .img-size-32 {
        width: 32px;
        height: 32px;
    }
    .img-size-50 {
        width: 50px;
        height: 50px;
    }
    .btn-group-sm > .btn {
        padding: 0.25rem 0.5rem;
    }
    .info-box {
        border-radius: 8px;
    }
</style>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Confirmación adicional para eliminar
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('¿Estás completamente seguro de que quieres eliminar esta mascota? Esta acción es permanente.')) {
                    e.preventDefault();
                }
            });
        });

        // Mostrar notificaciones
        @if(session('success'))
            toastr.success('{{ session('success') }}');
        @endif

        @if(session('error'))
            toastr.error('{{ session('error') }}');
        @endif
    });
</script>
@stop