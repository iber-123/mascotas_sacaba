@extends('adminlte::page')

@section('title', 'Panel Administrador')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-dark mb-2">
                <i class="fas fa-tachometer-alt mr-2"></i>Panel de Administración
            </h1>
            <p class="text-muted mb-0">Bienvenido, Administrador! Resumen completo del sistema.</p>
        </div>
        <div class="text-right">
            <span class="badge badge-success badge-lg">
                <i class="fas fa-circle mr-1"></i>Sistema Activo
            </span>
        </div>
    </div>
@stop

@section('content')
@php
    // Estadísticas reales del sistema
    $totalUsuarios = \App\Models\User::count();
    $totalMascotas = \App\Models\Mascota::count();
    $totalReportes = \App\Models\Reporte::count();
    
    // Distribución por estado
    $mascotasPerdidas = \App\Models\Mascota::where('estado', 'perdida')->count();
    $mascotasEncontradas = \App\Models\Mascota::where('estado', 'encontrada')->count();
    $mascotasAdopcion = \App\Models\Mascota::where('estado', 'adopcion')->count();
    
    // Distribución por especie
    $perrosCount = \App\Models\Mascota::where('especie', 'Perro')->count();
    $gatosCount = \App\Models\Mascota::where('especie', 'Gato')->count();
    $otrosCount = \App\Models\Mascota::whereNotIn('especie', ['Perro', 'Gato'])->count();
@endphp

<!-- Estadísticas Principales -->
<div class="row">
    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="small-box bg-gradient-info elevation-3 h-100">
            <div class="inner">
                <h3 class="font-weight-bold">{{ $totalUsuarios }}</h3>
                <p class="font-weight-bold">Usuarios Registrados</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                Gestionar Usuarios <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="small-box bg-gradient-success elevation-3 h-100">
            <div class="inner">
                <h3 class="font-weight-bold">{{ $totalMascotas }}</h3>
                <p class="font-weight-bold">Total Mascotas</p>
            </div>
            <div class="icon">
                <i class="fas fa-paw"></i>
            </div>
            <a href="{{ route('buscar') }}" class="small-box-footer">
                Ver Todas <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="small-box bg-gradient-warning elevation-3 h-100">
            <div class="inner">
                <h3 class="font-weight-bold">{{ $totalReportes }}</h3>
                <p class="font-weight-bold">Reportes Totales</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <a href="#" class="small-box-footer">
                Ver Reportes <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>
    </div>
</div>

<!-- Métricas Detalladas -->
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary elevation-2 h-100">
            <div class="card-header border-bottom-0">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>Métricas del Sistema
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="info-box bg-gradient-info shadow h-100">
                            <span class="info-box-icon"><i class="fas fa-search-location"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Mascotas Perdidas</span>
                                <span class="info-box-number">{{ $mascotasPerdidas }}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ $totalMascotas > 0 ? round(($mascotasPerdidas / $totalMascotas) * 100) : 0 }}%"></div>
                                </div>
                                <span class="progress-description">
                                    {{ $totalMascotas > 0 ? round(($mascotasPerdidas / $totalMascotas) * 100) : 0 }}% del total
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="info-box bg-gradient-success shadow h-100">
                            <span class="info-box-icon"><i class="fas fa-home"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Mascotas Encontradas</span>
                                <span class="info-box-number">{{ $mascotasEncontradas }}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ $totalMascotas > 0 ? round(($mascotasEncontradas / $totalMascotas) * 100) : 0 }}%"></div>
                                </div>
                                <span class="progress-description">
                                    {{ $totalMascotas > 0 ? round(($mascotasEncontradas / $totalMascotas) * 100) : 0 }}% del total
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="info-box bg-gradient-warning shadow h-100">
                            <span class="info-box-icon"><i class="fas fa-heart"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">En Adopción</span>
                                <span class="info-box-number">{{ $mascotasAdopcion }}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ $totalMascotas > 0 ? round(($mascotasAdopcion / $totalMascotas) * 100) : 0 }}%"></div>
                                </div>
                                <span class="progress-description">
                                    {{ $totalMascotas > 0 ? round(($mascotasAdopcion / $totalMascotas) * 100) : 0 }}% del total
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Análisis Visual - Gráficos Compactos -->
<div class="row mt-4">
    <!-- Gráfica de Estados -->
    <div class="col-lg-6 col-md-6 col-12 mb-4">
        <div class="card card-outline card-primary elevation-2 h-100">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-2"></i>Distribución por Estado
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div style="height: 220px;">
                    <canvas id="chartEstados"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfica de Especies -->
    <div class="col-lg-6 col-md-6 col-12 mb-4">
        <div class="card card-outline card-success elevation-2 h-100">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar mr-2"></i>Distribución por Especie
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div style="height: 220px;">
                    <canvas id="chartEspecies"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Información Adicional -->
<div class="row mt-4">
    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="card card-outline card-info elevation-2 h-100">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-dog mr-2"></i>Especie: Perros
                </h3>
            </div>
            <div class="card-body text-center">
                <h2 class="text-info">{{ $perrosCount }}</h2>
                <p class="text-muted">Total de perros registrados</p>
                <div class="progress mt-2">
                    <div class="progress-bar bg-info" style="width: {{ $totalMascotas > 0 ? round(($perrosCount / $totalMascotas) * 100) : 0 }}%"></div>
                </div>
                <small class="text-muted">
                    {{ $totalMascotas > 0 ? round(($perrosCount / $totalMascotas) * 100) : 0 }}% de todas las mascotas
                </small>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="card card-outline card-purple elevation-2 h-100">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-cat mr-2"></i>Especie: Gatos
                </h3>
            </div>
            <div class="card-body text-center">
                <h2 class="text-purple">{{ $gatosCount }}</h2>
                <p class="text-muted">Total de gatos registrados</p>
                <div class="progress mt-2">
                    <div class="progress-bar bg-purple" style="width: {{ $totalMascotas > 0 ? round(($gatosCount / $totalMascotas) * 100) : 0 }}%"></div>
                </div>
                <small class="text-muted">
                    {{ $totalMascotas > 0 ? round(($gatosCount / $totalMascotas) * 100) : 0 }}% de todas las mascotas
                </small>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="card card-outline card-teal elevation-2 h-100">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-dove mr-2"></i>Otras Especies
                </h3>
            </div>
            <div class="card-body text-center">
                <h2 class="text-teal">{{ $otrosCount }}</h2>
                <p class="text-muted">Otras especies registradas</p>
                <div class="progress mt-2">
                    <div class="progress-bar bg-teal" style="width: {{ $totalMascotas > 0 ? round(($otrosCount / $totalMascotas) * 100) : 0 }}%"></div>
                </div>
                <small class="text-muted">
                    {{ $totalMascotas > 0 ? round(($otrosCount / $totalMascotas) * 100) : 0 }}% de todas las mascotas
                </small>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
<style>
    .small-box {
        border-radius: 12px;
        border: none;
        transition: all 0.3s ease;
        min-height: 140px;
    }
    .small-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15) !important;
    }
    .info-box {
        border-radius: 10px;
        border: none;
        transition: all 0.3s ease;
        min-height: 120px;
    }
    .info-box:hover {
        transform: translateY(-2px);
    }
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
    .shadow {
        box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
    }
    .bg-purple {
        background-color: #6f42c1 !important;
    }
    .card-outline.card-purple {
        border-top-color: #6f42c1 !important;
    }
    .text-purple {
        color: #6f42c1 !important;
    }
    .bg-teal {
        background-color: #20c997 !important;
    }
    .card-outline.card-teal {
        border-top-color: #20c997 !important;
    }
    .text-teal {
        color: #20c997 !important;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Datos reales para las gráficas
    const datosEstados = [{{ $mascotasPerdidas }}, {{ $mascotasEncontradas }}, {{ $mascotasAdopcion }}];
    const datosEspecies = [{{ $perrosCount }}, {{ $gatosCount }}, {{ $otrosCount }}];

    // Gráfica de distribución por estado - Doughnut Chart (más compacto)
    const ctxEstados = document.getElementById('chartEstados').getContext('2d');
    new Chart(ctxEstados, {
        type: 'doughnut',
        data: {
            labels: ['Perdidas', 'Encontradas', 'En Adopción'],
            datasets: [{
                data: datosEstados,
                backgroundColor: [
                    'rgba(220, 53, 69, 0.8)',
                    'rgba(40, 167, 69, 0.8)', 
                    'rgba(255, 193, 7, 0.8)'
                ],
                borderColor: [
                    'rgb(220, 53, 69)',
                    'rgb(40, 167, 69)',
                    'rgb(255, 193, 7)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 10,
                        usePointStyle: true,
                        font: {
                            size: 10
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleFont: {
                        size: 11
                    },
                    bodyFont: {
                        size: 11
                    }
                }
            }
        }
    });

    // Gráfica de distribución por especie - Bar Chart compacto
    const ctxEspecies = document.getElementById('chartEspecies').getContext('2d');
    new Chart(ctxEspecies, {
        type: 'bar',
        data: {
            labels: ['Perros', 'Gatos', 'Otros'],
            datasets: [{
                label: 'Cantidad',
                data: datosEspecies,
                backgroundColor: [
                    'rgba(0, 123, 255, 0.8)',
                    'rgba(111, 66, 193, 0.8)',
                    'rgba(32, 201, 151, 0.8)'
                ],
                borderColor: [
                    'rgb(0, 123, 255)',
                    'rgb(111, 66, 193)',
                    'rgb(32, 201, 151)'
                ],
                borderWidth: 1,
                borderRadius: 4,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    },
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 10
                        },
                        padding: 5
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 10
                        },
                        padding: 5
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleFont: {
                        size: 11
                    },
                    bodyFont: {
                        size: 11
                    }
                }
            },
            layout: {
                padding: {
                    top: 10,
                    bottom: 10
                }
            }
        }
    });
});
</script>
@stop