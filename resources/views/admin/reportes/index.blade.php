@extends('adminlte::page')

@section('title', 'Reportes - Administración')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-flag mr-2"></i>Reportes del Sistema</h1>
        <div class="btn-group">
            <a href="{{ route('admin.reportes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i> Nuevo Reporte
            </a>
        </div>
    </div>
@stop

@section('content')
    <!-- Estadísticas Rápidas -->
    <div class="row mb-4">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $reportes->where('estado', 'pendiente')->count() }}</h3>
                    <p>Reportes Pendientes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <a href="#" class="small-box-footer filter-link" data-estado="pendiente">
                    Ver detalles <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $reportes->where('estado', 'en_proceso')->count() }}</h3>
                    <p>En Proceso</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cog"></i>
                </div>
                <a href="#" class="small-box-footer filter-link" data-estado="en_proceso">
                    Ver detalles <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $reportes->where('estado', 'resuelto')->count() }}</h3>
                    <p>Resueltos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check"></i>
                </div>
                <a href="#" class="small-box-footer filter-link" data-estado="resuelto">
                    Ver detalles <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $reportes->count() }}</h3>
                    <p>Total Reportes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-flag"></i>
                </div>
                <a href="#" class="small-box-footer filter-link" data-estado="todos">
                    Ver todos <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- NUEVA SECCIÓN: REPORTES ESTADÍSTICOS DEL SISTEMA -->
    <div class="card card-outline card-info mb-4">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-bar mr-2"></i>Reportes Estadísticos del Sistema
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabla-reportes-estadisticos" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="25%">Tipo de Reporte</th>
                            <th width="35%">Descripción</th>
                            <th width="15%">Total Registros</th>
                            <th width="25%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Reporte de Usuarios -->
                        <tr>
                            <td>
                                <i class="fas fa-users text-primary mr-2"></i>
                                <strong>Reporte de Usuarios</strong>
                            </td>
                            <td>Lista completa de todos los usuarios registrados en el sistema</td>
                            <td>
                                <span class="badge badge-primary badge-lg">{{ $estadisticas['total_usuarios'] }}</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'usuarios', 'formato' => 'pdf']) }}" 
                                       class="btn btn-danger" title="Descargar PDF">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'usuarios', 'formato' => 'excel']) }}" 
                                       class="btn btn-success" title="Descargar Excel">
                                        <i class="fas fa-file-excel"></i> Excel
                                    </a>
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'usuarios', 'formato' => 'word']) }}" 
                                       class="btn btn-primary" title="Descargar Word">
                                        <i class="fas fa-file-word"></i> Word
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Reporte General de Mascotas -->
                        <tr>
                            <td>
                                <i class="fas fa-paw text-success mr-2"></i>
                                <strong>Reporte General de Mascotas</strong>
                            </td>
                            <td>Todas las mascotas registradas en el sistema</td>
                            <td>
                                <span class="badge badge-success badge-lg">{{ $estadisticas['total_mascotas'] }}</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'usuarios', 'formato' => 'pdf']) }}" 
                                       class="btn btn-danger" title="Descargar PDF">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'mascotas', 'formato' => 'excel']) }}" 
                                       class="btn btn-success" title="Descargar Excel">
                                        <i class="fas fa-file-excel"></i> Excel
                                    </a>
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'mascotas', 'formato' => 'word']) }}" 
                                       class="btn btn-primary" title="Descargar Word">
                                        <i class="fas fa-file-word"></i> Word
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Reporte de Mascotas Perdidas -->
                        <tr>
                            <td>
                                <i class="fas fa-search-location text-danger mr-2"></i>
                                <strong>Mascotas Perdidas</strong>
                            </td>
                            <td>Mascotas reportadas como perdidas</td>
                            <td>
                                <span class="badge badge-danger badge-lg">{{ $estadisticas['mascotas_perdidas'] }}</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'mascotas-perdidas', 'formato' => 'pdf']) }}" 
                                       class="btn btn-danger" title="Descargar PDF">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'mascotas-perdidas', 'formato' => 'excel']) }}" 
                                       class="btn btn-success" title="Descargar Excel">
                                        <i class="fas fa-file-excel"></i> Excel
                                    </a>
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'mascotas-perdidas', 'formato' => 'word']) }}" 
                                       class="btn btn-primary" title="Descargar Word">
                                        <i class="fas fa-file-word"></i> Word
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Reporte de Mascotas Encontradas -->
                        <tr>
                            <td>
                                <i class="fas fa-home text-success mr-2"></i>
                                <strong>Mascotas Encontradas</strong>
                            </td>
                            <td>Mascotas reportadas como encontradas</td>
                            <td>
                                <span class="badge badge-success badge-lg">{{ $estadisticas['mascotas_encontradas'] }}</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'mascotas-encontradas', 'formato' => 'pdf']) }}" 
                                       class="btn btn-danger" title="Descargar PDF">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'mascotas-encontradas', 'formato' => 'excel']) }}" 
                                       class="btn btn-success" title="Descargar Excel">
                                        <i class="fas fa-file-excel"></i> Excel
                                    </a>
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'mascotas-encontradas', 'formato' => 'word']) }}" 
                                       class="btn btn-primary" title="Descargar Word">
                                        <i class="fas fa-file-word"></i> Word
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Reporte de Mascotas en Adopción -->
                        <tr>
                            <td>
                                <i class="fas fa-heart text-warning mr-2"></i>
                                <strong>Mascotas en Adopción</strong>
                            </td>
                            <td>Mascotas disponibles para adopción</td>
                            <td>
                                <span class="badge badge-warning badge-lg">{{ $estadisticas['mascotas_adopcion'] }}</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'mascotas-adopcion', 'formato' => 'pdf']) }}" 
                                       class="btn btn-danger" title="Descargar PDF">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'mascotas-adopcion', 'formato' => 'excel']) }}" 
                                       class="btn btn-success" title="Descargar Excel">
                                        <i class="fas fa-file-excel"></i> Excel
                                    </a>
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'mascotas-adopcion', 'formato' => 'word']) }}" 
                                       class="btn btn-primary" title="Descargar Word">
                                        <i class="fas fa-file-word"></i> Word
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Reporte de Estadísticas Generales -->
                        <tr>
                            <td>
                                <i class="fas fa-chart-pie text-info mr-2"></i>
                                <strong>Estadísticas Generales</strong>
                            </td>
                            <td>Resumen completo de estadísticas del sistema</td>
                            <td>
                                <span class="badge badge-info badge-lg">Consolidado</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'estadisticas', 'formato' => 'pdf']) }}" 
                                       class="btn btn-danger" title="Descargar PDF">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'estadisticas', 'formato' => 'excel']) }}" 
                                       class="btn btn-success" title="Descargar Excel">
                                        <i class="fas fa-file-excel"></i> Excel
                                    </a>
                                    <a href="{{ route('admin.reportes.exportar', ['tipo' => 'estadisticas', 'formato' => 'word']) }}" 
                                       class="btn btn-primary" title="Descargar Word">
                                        <i class="fas fa-file-word"></i> Word
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SECCIÓN ORIGINAL: REPORTES DE LA COMUNIDAD -->
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-list mr-2"></i>Reportes de la Comunidad
            </h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="15%">Mascota</th>
                            <th width="15%">Usuario</th>
                            <th width="15%">Tipo</th>
                            <th width="10%">Estado</th>
                            <th width="15%">Fecha</th>
                            <th width="15%">Ubicación</th>
                            <th width="10%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reportes as $reporte)
                        <tr>
                            <td><strong>#{{ $reporte->id }}</strong></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($reporte->mascota->foto)
                                        <img src="{{ asset('storage/' . $reporte->mascota->foto) }}" 
                                             alt="{{ $reporte->mascota->nombre }}" 
                                             class="img-circle img-size-32 mr-2">
                                    @else
                                        <div class="img-circle img-size-32 bg-secondary d-flex align-items-center justify-content-center mr-2">
                                            <i class="fas fa-paw text-white"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-weight-bold">{{ $reporte->mascota->nombre }}</div>
                                        <small class="text-muted">{{ $reporte->mascota->especie }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="font-weight-bold">{{ $reporte->user->name }}</div>
                                <small class="text-muted">{{ $reporte->user->email }}</small>
                            </td>
                            <td>
                                <span class="badge 
                                    @if($reporte->tipo == 'perdida') badge-danger
                                    @elseif($reporte->tipo == 'encontrada') badge-success
                                    @elseif($reporte->tipo == 'adopcion') badge-primary
                                    @else badge-secondary @endif">
                                    {{ ucfirst($reporte->tipo) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge 
                                    @if($reporte->estado == 'pendiente') badge-warning
                                    @elseif($reporte->estado == 'en_proceso') badge-info
                                    @else badge-success @endif" 
                                    id="estado-{{ $reporte->id }}">
                                    {{ ucfirst(str_replace('_', ' ', $reporte->estado)) }}
                                </span>
                            </td>
                            <td>
                                <div class="small">
                                    <div>{{ $reporte->created_at->format('d/m/Y') }}</div>
                                    <div class="text-muted">{{ $reporte->created_at->format('h:i A') }}</div>
                                </div>
                            </td>
                            <td>
                                <small>{{ Str::limit($reporte->ubicacion, 20) }}</small>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.reportes.show', $reporte) }}" 
                                       class="btn btn-sm btn-info" 
                                       title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-warning dropdown-toggle dropdown-toggle-split" 
                                            data-toggle="dropdown"
                                            title="Cambiar estado">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item cambiar-estado" 
                                           href="#" 
                                           data-id="{{ $reporte->id }}" 
                                           data-estado="pendiente">
                                            <i class="fas fa-clock text-warning mr-2"></i>Pendiente
                                        </a>
                                        <a class="dropdown-item cambiar-estado" 
                                           href="#" 
                                           data-id="{{ $reporte->id }}" 
                                           data-estado="en_proceso">
                                            <i class="fas fa-cog text-info mr-2"></i>En Proceso
                                        </a>
                                        <a class="dropdown-item cambiar-estado" 
                                           href="#" 
                                           data-id="{{ $reporte->id }}" 
                                           data-estado="resuelto">
                                            <i class="fas fa-check text-success mr-2"></i>Resuelto
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-inbox fa-2x text-muted mb-3"></i>
                                <h5 class="text-muted">No hay reportes registrados</h5>
                                <p class="text-muted">Los reportes aparecerán aquí cuando los usuarios los creen.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $reportes->links() }}
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    .img-size-32 {
        width: 32px;
        height: 32px;
        object-fit: cover;
    }
    .table tbody tr:hover {
        background-color: rgba(0,0,0,0.075);
    }
    .small-box .icon i {
        font-size: 70px;
        top: -10px;
    }
    .badge-lg {
        font-size: 0.9em;
        padding: 0.35em 0.65em;
    }
    .btn-group-sm > .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.775rem;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // DataTable para Reportes Estadísticos
        $('#tabla-reportes-estadisticos').DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay reportes estadísticos disponibles",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Reportes",
                "infoEmpty": "Mostrando 0 a 0 de 0 Reportes",
                "infoFiltered": "(Filtrado de _MAX_ total Reportes)",
                "lengthMenu": "Mostrar _MENU_ Reportes",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "ordering": true,
            "info": true,
            buttons: [
                { 
                    text: '<i class="fas fa-copy mr-1"></i> COPIAR', 
                    extend: 'copy', 
                    className: 'btn btn-default btn-sm' 
                },
                { 
                    text: '<i class="fas fa-file-pdf mr-1"></i> PDF', 
                    extend: 'pdf', 
                    className: 'btn btn-danger btn-sm' 
                },
                { 
                    text: '<i class="fas fa-file-csv mr-1"></i> CSV', 
                    extend: 'csv', 
                    className: 'btn btn-info btn-sm' 
                },
                { 
                    text: '<i class="fas fa-file-excel mr-1"></i> EXCEL', 
                    extend: 'excel', 
                    className: 'btn btn-success btn-sm' 
                },
                { 
                    text: '<i class="fas fa-print mr-1"></i> IMPRIMIR', 
                    extend: 'print', 
                    className: 'btn btn-warning btn-sm' 
                }
            ]
        }).buttons().container().appendTo('#tabla-reportes-estadisticos_wrapper .row:eq(0)');

        // Filtros para reportes de comunidad
        $('#filtroEstado, #filtroTipo, #filtroFecha').change(function() {
            aplicarFiltros();
        });

        // Cambiar estado de reportes
        $('.cambiar-estado').click(function(e) {
            e.preventDefault();
            const reporteId = $(this).data('id');
            const nuevoEstado = $(this).data('estado');
            
            cambiarEstadoReporte(reporteId, nuevoEstado);
        });

        // Filtros por estadísticas
        $('.filter-link').click(function(e) {
            e.preventDefault();
            const estado = $(this).data('estado');
            $('#filtroEstado').val(estado);
            aplicarFiltros();
        });

        function aplicarFiltros() {
            // Aquí implementarías la lógica de filtrado
            console.log('Aplicando filtros...');
        }

        function cambiarEstadoReporte(reporteId, nuevoEstado) {
            if(confirm('¿Estás seguro de cambiar el estado de este reporte?')) {
                $.ajax({
                    url: '/admin/reportes/' + reporteId,
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        estado: nuevoEstado
                    },
                    success: function(response) {
                        if(response.success) {
                            // Actualizar badge de estado
                            const badge = $('#estado-' + reporteId);
                            badge.removeClass('badge-warning badge-info badge-success');
                            
                            if(nuevoEstado === 'pendiente') {
                                badge.addClass('badge-warning');
                            } else if(nuevoEstado === 'en_proceso') {
                                badge.addClass('badge-info');
                            } else {
                                badge.addClass('badge-success');
                            }
                            
                            badge.text(nuevoEstado.charAt(0).toUpperCase() + nuevoEstado.slice(1).replace('_', ' '));
                            
                            // Mostrar notificación
                            Swal.fire({
                                icon: 'success',
                                title: 'Estado actualizado',
                                text: 'El estado del reporte ha sido actualizado correctamente',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo actualizar el estado del reporte',
                            timer: 3000
                        });
                    }
                });
            }
        }

        // Inicializar tooltips
        $('[title]').tooltip();

        // Loading al exportar reportes
        $('a[href*="exportar"]').click(function(e) {
            const formato = $(this).text().trim().toLowerCase();
            Swal.fire({
                title: 'Generando reporte...',
                text: `Preparando archivo ${formato}`,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Cerrar automáticamente después de 3 segundos
            setTimeout(() => {
                Swal.close();
            }, 3000);
        });
    });
</script>
@stop