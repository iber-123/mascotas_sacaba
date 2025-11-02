@extends('adminlte::page')

@section('title', $mascota->nombre . ' - Detalles - Admin')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-primary">
                <i class="fas fa-paw mr-2"></i>{{ $mascota->nombre }}
            </h1>
            <p class="text-muted mb-0">Detalles completos de la mascota - Vista Administrador</p>
        </div>
        <div class="text-right">
            <span class="badge badge-lg 
                @if($mascota->estado == 'perdida') badge-danger
                @elseif($mascota->estado == 'encontrada') badge-success
                @else badge-warning @endif">
                {{ ucfirst($mascota->estado) }}
            </span>
        </div>
    </div>
@stop

@section('content')
<div class="row">
    <!-- Información Principal -->
    <div class="col-lg-8">
        <div class="card card-outline card-primary elevation-2">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>Información de la Mascota
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.mascotas.edit', $mascota) }}" class="btn btn-sm btn-warning mr-2">
                        <i class="fas fa-edit mr-1"></i>Editar
                    </a>
                    <a href="{{ route('admin.mascotas.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i>Volver al Listado
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box bg-light">
                            <span class="info-box-icon bg-primary"><i class="fas fa-paw"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Especie</span>
                                <span class="info-box-number">{{ $mascota->especie }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box bg-light">
                            <span class="info-box-icon bg-info"><i class="fas fa-dna"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Raza</span>
                                <span class="info-box-number">{{ $mascota->raza ?? 'No especificada' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="info-box bg-light">
                            <span class="info-box-icon bg-success"><i class="fas fa-birthday-cake"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Edad</span>
                                <span class="info-box-number">
                                    @if($mascota->edad)
                                        {{ $mascota->edad }} años
                                    @else
                                        No especificada
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box bg-light">
                            <span class="info-box-icon bg-warning"><i class="fas fa-venus-mars"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Sexo</span>
                                <span class="info-box-number">{{ $mascota->sexo ?? 'No especificado' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box bg-light">
                            <span class="info-box-icon bg-purple"><i class="fas fa-ruler"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tamaño</span>
                                <span class="info-box-number">{{ $mascota->tamaño ?? 'No especificado' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="info-box bg-light">
                            <span class="info-box-icon bg-danger"><i class="fas fa-palette"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Color</span>
                                <span class="info-box-number">{{ $mascota->color ?? 'No especificado' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box bg-light">
                            <span class="info-box-icon bg-info"><i class="fas fa-map-marker-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Ubicación</span>
                                <span class="info-box-number">{{ $mascota->ubicacion ?? 'No especificada' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($mascota->descripcion)
                <div class="mt-4">
                    <h5><i class="fas fa-align-left mr-2"></i>Descripción</h5>
                    <div class="bg-light p-4 rounded">
                        <p class="mb-0">{{ $mascota->descripcion }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Información del Dueño -->
        <div class="card card-outline card-info elevation-2 mt-4">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user mr-2"></i>Información del Dueño
                </h3>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="img-circle img-size-64 bg-primary d-flex align-items-center justify-content-center mr-4 shadow-sm">
                        <i class="fas fa-user text-white fa-2x"></i>
                    </div>
                    <div>
                        <h4 class="mb-1">{{ $mascota->user->name }}</h4>
                        <p class="text-muted mb-1">
                            <i class="fas fa-envelope mr-2"></i>{{ $mascota->user->email }}
                        </p>
                        <p class="text-muted mb-0">
                            <i class="fas fa-calendar mr-2"></i>Registrado el {{ $mascota->user->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.users.show', $mascota->user) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-external-link-alt mr-1"></i>Ver Perfil del Usuario
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Foto y Metadatos -->
    <div class="col-lg-4">
        <!-- Foto de la Mascota -->
        <div class="card card-outline card-success elevation-2">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-camera mr-2"></i>Fotografía
                </h3>
            </div>
            <div class="card-body text-center">
                @if($mascota->foto)
                    <img src="{{ asset('storage/' . $mascota->foto) }}" 
                         alt="{{ $mascota->nombre }}" 
                         class="img-fluid rounded shadow-sm"
                         style="max-height: 300px; object-fit: cover;">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                         style="height: 300px;">
                        <div class="text-center">
                            <i class="fas fa-paw fa-4x text-muted mb-3"></i>
                            <p class="text-muted">No hay foto disponible</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Estadísticas Administrativas -->
        <div class="card card-outline card-warning elevation-2 mt-4">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar mr-2"></i>Estadísticas
                </h3>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-calendar-plus mr-2 text-primary"></i>
                            Fecha de Registro
                        </span>
                        <span class="badge badge-primary badge-pill">
                            {{ $mascota->created_at->format('d/m/Y') }}
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-clock mr-2 text-info"></i>
                            Registrado hace
                        </span>
                        <span class="badge badge-info badge-pill">
                            {{ $mascota->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-sync-alt mr-2 text-warning"></i>
                            Última Actualización
                        </span>
                        <span class="badge badge-warning badge-pill">
                            {{ $mascota->updated_at->diffForHumans() }}
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-id-card mr-2 text-success"></i>
                            ID de Mascota
                        </span>
                        <span class="badge badge-success badge-pill">
                            #{{ $mascota->id }}
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-user-tie mr-2 text-secondary"></i>
                            ID del Dueño
                        </span>
                        <span class="badge badge-secondary badge-pill">
                            #{{ $mascota->user_id }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones Rápidas del Admin -->
        <div class="card card-outline card-danger elevation-2 mt-4">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bolt mr-2"></i>Acciones Administrativas
                </h3>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.mascotas.edit', $mascota) }}" class="btn btn-warning btn-block">
                        <i class="fas fa-edit mr-2"></i>Editar Mascota
                    </a>
                    
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteModal">
                        <i class="fas fa-trash mr-2"></i>Eliminar Mascota
                    </button>
                    
                    <a href="{{ route('admin.users.show', $mascota->user) }}" class="btn btn-info btn-block">
                        <i class="fas fa-user mr-2"></i>Ver Dueño
                    </a>
                    
                    <a href="{{ route('admin.mascotas.index') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-list mr-2"></i>Ver Todas las Mascotas
                    </a>
                </div>
            </div>
        </div>

        <!-- Información del Estado -->
        <div class="card card-outline 
            @if($mascota->estado == 'perdida') card-danger
            @elseif($mascota->estado == 'encontrada') card-success
            @else card-warning @endif elevation-2 mt-4">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>Información del Estado
                </h3>
            </div>
            <div class="card-body">
                @if($mascota->estado == 'perdida')
                    <div class="text-center text-danger">
                        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                        <h5>Mascota Perdida</h5>
                        <p class="mb-0">Esta mascota ha sido reportada como perdida. Se recomienda contactar al dueño si es encontrada.</p>
                    </div>
                @elseif($mascota->estado == 'encontrada')
                    <div class="text-center text-success">
                        <i class="fas fa-home fa-2x mb-2"></i>
                        <h5>Mascota Encontrada</h5>
                        <p class="mb-0">Esta mascota fue encontrada y está buscando a su dueño original.</p>
                    </div>
                @else
                    <div class="text-center text-warning">
                        <i class="fas fa-heart fa-2x mb-2"></i>
                        <h5>En Adopción</h5>
                        <p class="mb-0">Esta mascota está disponible para adopción y busca un hogar permanente.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal de Eliminación -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Confirmar Eliminación
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar a <strong>{{ $mascota->nombre }}</strong>?</p>
                <p class="text-danger mb-0">
                    <i class="fas fa-info-circle mr-1"></i>
                    Esta acción no se puede deshacer y se eliminarán todos los datos asociados, incluyendo la foto.
                </p>
                <div class="alert alert-warning mt-3">
                    <strong>Dueño afectado:</strong> {{ $mascota->user->name }} ({{ $mascota->user->email }})
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Cancelar
                </button>
                <form action="{{ route('admin.mascotas.destroy', $mascota) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash mr-1"></i>Eliminar Mascota
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .card {
        border-radius: 12px;
        border: none;
    }
    .card-outline {
        border-top: 3px solid !important;
    }
    .elevation-2 {
        box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23) !important;
    }
    .img-size-64 {
        width: 64px;
        height: 64px;
        object-fit: cover;
    }
    .info-box {
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .info-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
    .list-group-item {
        border: none;
        padding: 0.75rem 0;
    }
</style>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Efectos de hover para las info-box
        const infoBoxes = document.querySelectorAll('.info-box');
        infoBoxes.forEach(box => {
            box.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            box.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Confirmación adicional para eliminar
        const deleteForm = document.querySelector('form[action*="destroy"]');
        if (deleteForm) {
            deleteForm.addEventListener('submit', function(e) {
                if (!confirm('¿Estás completamente seguro de que quieres eliminar esta mascota? Esta acción es permanente y afectará al dueño.')) {
                    e.preventDefault();
                }
            });
        }

        // Mostrar notificación si hay mensajes de sesión
        @if(session('success'))
            toastr.success('{{ session('success') }}');
        @endif

        @if(session('error'))
            toastr.error('{{ session('error') }}');
        @endif
    });
</script>
@stop