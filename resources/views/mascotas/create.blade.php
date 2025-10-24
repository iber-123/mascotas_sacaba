<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Mascota - Mascotas Sacaba</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .form-gradient {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .floating-card {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        .input-focus:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
        .section-divider {
            background: linear-gradient(90deg, transparent, #10b981, transparent);
            height: 2px;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-blue-50 min-h-screen font-sans">

    <!-- Header Simple -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-green-200">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 form-gradient rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-paw text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Registrar Mascota</h1>
                        <p class="text-gray-600 text-sm">Completa la información de la mascota</p>
                    </div>
                </div>
                
                <a href="{{ route('user.mascotas.index') }}" 
                   class="flex items-center px-4 py-2 text-gray-600 hover:text-green-600 transition-colors border border-gray-300 rounded-lg hover:border-green-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver
                </a>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="max-w-4xl mx-auto px-4 py-8">
        <!-- Alertas -->
        @if ($errors->any())
            <div class="glass-card rounded-2xl p-6 mb-6 border-l-4 border-red-500 floating-card">
                <div class="flex items-center mb-3">
                    <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Corrige los siguientes errores:</h3>
                </div>
                <ul class="text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-center">
                            <i class="fas fa-circle text-xs mr-2"></i>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="glass-card rounded-2xl p-6 mb-6 border-l-4 border-green-500 floating-card">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-check-circle text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">¡Éxito!</h3>
                        <p class="text-gray-600">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Formulario -->
        <form action="{{ route('user.mascotas.store') }}" method="POST" enctype="multipart/form-data" 
              class="glass-card rounded-2xl p-8 floating-card">
            @csrf

            <!-- Información Básica -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-info-circle text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Información Básica</h2>
                        <p class="text-gray-600">Datos principales de la mascota</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-signature text-green-600 mr-1"></i>
                            Nombre de la mascota *
                        </label>
                        <input type="text" name="nombre" id="nombre" 
                               value="{{ old('nombre') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus transition-all"
                               placeholder="Ej: Firulais, Luna, Max..."
                               required>
                    </div>

                    <!-- Especie -->
                    <div>
                        <label for="especie" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-paw text-green-600 mr-1"></i>
                            Especie *
                        </label>
                        <select name="especie" id="especie" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus transition-all" required>
                            <option value="">Selecciona una especie</option>
                            <option value="Perro" {{ old('especie') == 'Perro' ? 'selected' : '' }}>🐕 Perro</option>
                            <option value="Gato" {{ old('especie') == 'Gato' ? 'selected' : '' }}>🐈 Gato</option>
                            <option value="Ave" {{ old('especie') == 'Ave' ? 'selected' : '' }}>🐦 Ave</option>
                            <option value="Otro" {{ old('especie') == 'Otro' ? 'selected' : '' }}>❓ Otro</option>
                        </select>
                    </div>

                    <!-- Estado -->
                    <div>
                        <label for="estado" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt text-green-600 mr-1"></i>
                            Situación actual *
                        </label>
                        <select name="estado" id="estado" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus transition-all" required>
                            <option value="">¿Qué pasó con la mascota?</option>
                            <option value="perdida" {{ old('estado') == 'perdida' ? 'selected' : '' }}>🔍 Se perdió</option>
                            <option value="encontrada" {{ old('estado') == 'encontrada' ? 'selected' : '' }}>🏠 La encontré</option>
                            <option value="adopcion" {{ old('estado') == 'adopcion' ? 'selected' : '' }}>💖 En adopción</option>
                        </select>
                    </div>

                    <!-- Raza -->
                    <div>
                        <label for="raza" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-dna text-green-600 mr-1"></i>
                            Raza o tipo
                        </label>
                        <input type="text" name="raza" id="raza" 
                               value="{{ old('raza') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus transition-all"
                               placeholder="Ej: Labrador, Criollo, Siames...">
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="section-divider my-8"></div>

            <!-- Características Físicas -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-palette text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Características Físicas</h2>
                        <p class="text-gray-600">Ayuda a identificar a la mascota</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Edad -->
                    <div>
                        <label for="edad" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-birthday-cake text-purple-600 mr-1"></i>
                            Edad (años)
                        </label>
                        <input type="number" name="edad" id="edad" 
                               value="{{ old('edad') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus transition-all"
                               placeholder="Ej: 3" min="0" max="50">
                    </div>

                    <!-- Sexo -->
                    <div>
                        <label for="sexo" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-venus-mars text-purple-600 mr-1"></i>
                            Sexo
                        </label>
                        <select name="sexo" id="sexo" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus transition-all">
                            <option value="">Selecciona</option>
                            <option value="Macho" {{ old('sexo') == 'Macho' ? 'selected' : '' }}>Macho</option>
                            <option value="Hembra" {{ old('sexo') == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                        </select>
                    </div>

                    <!-- Tamaño -->
                    <div>
                        <label for="tamaño" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-ruler text-purple-600 mr-1"></i>
                            Tamaño
                        </label>
                        <select name="tamaño" id="tamaño" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus transition-all">
                            <option value="">Selecciona</option>
                            <option value="pequeño" {{ old('tamaño') == 'pequeño' ? 'selected' : '' }}>Pequeño</option>
                            <option value="mediano" {{ old('tamaño') == 'mediano' ? 'selected' : '' }}>Mediano</option>
                            <option value="grande" {{ old('tamaño') == 'grande' ? 'selected' : '' }}>Grande</option>
                        </select>
                    </div>

                    <!-- Color -->
                    <div>
                        <label for="color" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-palette text-purple-600 mr-1"></i>
                            Color
                        </label>
                        <input type="text" name="color" id="color" 
                               value="{{ old('color') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus transition-all"
                               placeholder="Ej: Marrón, Negro, Blanco...">
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="section-divider my-8"></div>

            <!-- Ubicación y Descripción -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-map-marked-alt text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Ubicación y Descripción</h2>
                        <p class="text-gray-600">Información adicional importante</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Ubicación -->
                    <div>
                        <label for="ubicacion" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt text-orange-600 mr-1"></i>
                            Ubicación
                        </label>
                        <input type="text" name="ubicacion" id="ubicacion" 
                               value="{{ old('ubicacion') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus transition-all"
                               placeholder="Ej: Centro Sacaba, Villa Túnari...">
                        <p class="text-gray-500 text-sm mt-2">Zona donde se perdió/encontró la mascota</p>
                    </div>

                    <!-- Foto -->
                    <div>
                        <label for="foto" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-camera text-orange-600 mr-1"></i>
                            Foto de la mascota
                        </label>
                        <input type="file" name="foto" id="foto" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus transition-all"
                               accept="image/*">
                        <p class="text-gray-500 text-sm mt-2">JPEG, PNG, JPG, GIF (Máx. 2MB)</p>
                        
                        <!-- Vista previa -->
                        <div id="imagePreview" class="mt-3 hidden">
                            <img id="preview" src="#" alt="Vista previa" class="rounded-xl shadow-md max-h-40">
                        </div>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mt-6">
                    <label for="descripcion" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-orange-600 mr-1"></i>
                        Descripción adicional
                    </label>
                    <textarea name="descripcion" id="descripcion" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus transition-all"
                              placeholder="Describe características únicas, comportamiento, collar, etc...">{{ old('descripcion') }}</textarea>
                    <p class="text-gray-500 text-sm mt-2">Esta información ayuda a identificar correctamente a la mascota</p>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex flex-col sm:flex-row justify-between items-center pt-6 border-t border-gray-200 space-y-4 sm:space-y-0">
                <button type="reset" 
                        class="flex items-center px-6 py-3 text-gray-600 hover:text-gray-800 border border-gray-300 rounded-xl hover:border-gray-400 transition-all">
                    <i class="fas fa-undo mr-2"></i>
                    Limpiar formulario
                </button>
                
                <button type="submit" 
                        class="flex items-center px-8 py-3 form-gradient text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                    <i class="fas fa-save mr-2"></i>
                    Registrar Mascota
                </button>
            </div>
        </form>
    </main>

    <!-- Footer Simple -->
    <footer class="bg-white/50 backdrop-blur-sm border-t border-green-200 mt-12">
        <div class="max-w-6xl mx-auto px-4 py-6 text-center">
            <p class="text-gray-600 text-sm">
                💚 Mascotas Sacaba - Unidos por nuestras mascotas
            </p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Vista previa de imagen
            const fotoInput = document.getElementById('foto');
            const imagePreview = document.getElementById('imagePreview');
            const preview = document.getElementById('preview');

            fotoInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    
                    reader.addEventListener('load', function() {
                        preview.src = reader.result;
                        imagePreview.classList.remove('hidden');
                    });
                    
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.classList.add('hidden');
                }
            });

            // Validación básica
            const form = document.querySelector('form');
            const submitBtn = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Registrando...';
            });

            // Efectos interactivos
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('transform', 'scale-105');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('transform', 'scale-105');
                });
            });
        });
    </script>

</body>
</html>