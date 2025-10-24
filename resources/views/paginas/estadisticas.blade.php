@extends('layouts.app')

@section('title', 'Estadísticas - Mascotas Sacaba')

@push('styles')
<style>
    .stats-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    .success-rate {
        background: linear-gradient(135deg, #f0f9f0 0%, #e6f4e6 100%);
    }
    .activity-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    .inspirational-section {
        background: linear-gradient(135deg, #3ed5c6ff 0%, #374151 100%);
    }
    .progress-bar {
        height: 8px;
        background-color: #e5e7eb;
        border-radius: 4px;
        overflow: hidden;
    }
    .progress-fill {
        height: 100%;
        background-color: #22c55e;
        border-radius: 4px;
    }
</style>
@endpush

@section('content')
    <!-- Contenido Principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Encabezado -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Estadísticas de la Comunidad</h1>
            <p class="text-gray-600 max-w-3xl">
                Conoce el impacto de nuestra plataforma en la búsqueda y reunificación de mascotas en Sacaba.
            </p>
        </div>

        <!-- Tarjetas de Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Mascotas Registradas -->
            <div class="stats-card p-6 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-paw text-green-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Mascotas Registradas</h3>
                <div class="text-4xl font-bold text-green-600">{{ $totalMascotas ?? '0' }}</div>
                <p class="text-sm text-gray-600 mt-2">Total de mascotas</p>
            </div>
            
            <!-- Reportes Totales -->
            <div class="stats-card p-6 text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-bar text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Reportes Totales</h3>
                <div class="text-4xl font-bold text-blue-600">{{ $totalReportes ?? '0' }}</div>
                <p class="text-sm text-gray-600 mt-2">Reportes realizados</p>
            </div>
            
            <!-- Mascotas Perdidas -->
            <div class="stats-card p-6 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Mascotas Perdidas</h3>
                <div class="text-4xl font-bold text-red-600">{{ $porEstado['perdida'] ?? '0' }}</div>
                <p class="text-sm text-gray-600 mt-2">Buscando a sus familias</p>
            </div>
            
            <!-- Mascotas Encontradas -->
            <div class="stats-card p-6 text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-purple-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Mascotas Encontradas</h3>
                <div class="text-4xl font-bold text-purple-600">{{ $porEstado['encontrada'] ?? '0' }}</div>
                <p class="text-sm text-gray-600 mt-2">Encontradas por la comunidad</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Tasa de Éxito -->
            <div class="success-rate rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">La Tasa de Éxito</h2>
                <div class="flex items-end mb-6">
                    <div class="text-5xl font-bold text-green-600 mr-4">
                        @php
                            $encontradas = $porEstado['encontrada'] ?? 0;
                            $tasaExito = ($totalMascotas > 0) ? round(($encontradas / $totalMascotas) * 100) : 0;
                        @endphp
                        {{ $tasaExito }}%
                    </div>
                    <p class="text-gray-600 mb-2">De las mascotas reportadas han sido reunidas con su familia.</p>
                </div>
                <div class="progress-bar mb-2">
                    <div class="progress-fill" style="width: {{ $tasaExito }}%"></div>
                </div>
                <p class="text-sm text-gray-600">Sí, la búsqueda es posible.</p>
            </div>
            
            <!-- Distribución por Estado -->
            <div class="stats-card p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Distribución por Estado</h2>
                <div class="space-y-4">
                    @php
                        $totalEstados = array_sum($porEstado);
                    @endphp
                    
                    @foreach($porEstado as $estado => $cantidad)
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="font-medium text-gray-700">{{ ucfirst($estado) }}</span>
                            <span class="font-medium text-gray-700">
                                @if($totalEstados > 0)
                                    {{ round(($cantidad / $totalEstados) * 100) }}%
                                @else
                                    0%
                                @endif
                            </span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 
                                @if($totalEstados > 0)
                                    {{ ($cantidad / $totalEstados) * 100 }}%
                                @else
                                    0%
                                @endif
                            "></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Actividad Reciente -->
        <div class="activity-card p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Resumen de la Plataforma</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Mascotas por Especie</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Perros</span>
                            <span class="font-medium text-gray-800">65%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 65%"></div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Gatos</span>
                            <span class="font-medium text-gray-800">25%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 25%"></div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Otros</span>
                            <span class="font-medium text-gray-800">10%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 10%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Actividad Mensual</h3>
                    <div class="text-center py-8">
                        <i class="fas fa-chart-line text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Datos en tiempo real</h3>
                        <p class="text-gray-600">Las estadísticas se actualizan automáticamente</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección Inspiradora -->
        <div class="inspirational-section rounded-2xl p-8 text-white border-2 border-black bg-black/30 backdrop-blur-sm shadow-lg max-w-5xl mx-auto my-12">
            <h2 class="text-3xl font-extrabold mb-4 text-center">Juntos Hacemos la Diferencia</h2>
            <p class="text-lg mb-8 max-w-3xl mx-auto text-center leading-relaxed">
                Cada reporte, cada búsqueda, cada esfuerzo que hacemos puede significar la reunificación de una mascota con su familia. 
                Gracias a la comunidad de <span class="text-green-400 font-semibold">Sacaba</span> por hacer posible que cada día más mascotas regresen a casa.
            </p>
            <div class="flex items-center justify-center mt-6">
                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-4 shadow-md">
                    <i class="fas fa-heart text-white text-xl"></i>
                </div>
                <div class="text-center">
                    <p class="font-semibold text-white">Mascotas Sacaba</p>
                    <p class="text-green-200 text-sm">Comunidad Activa</p>
                </div>
            </div>
        </div>
    </div>
@endsection