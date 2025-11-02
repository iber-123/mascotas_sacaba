@extends('adminlte::page')

@section('title', 'Registrar Nueva Mascota - Admin')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-primary">
                <i class="fas fa-plus-circle mr-2"></i>Registrar Nueva Mascota
            </h1>
            <p class="text-muted mb-0">Registra una nueva mascota en el sistema</p>
        </div>
        <div>
            <a href="{{ route('admin.mascotas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Volver al Listado
            </a>
        </div>
    </div>
@stop

@section('content')
    <div classrow">
        <div class="col-md-8 mx-auto">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-paw mr-2"></i>Información de la Mascota
                    </h3>
                </div>
                <form action="{{ route('admin.mascotas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <!-- Dueño de la Mascota -->
                        <div class="form-group">
                            <label for="user_id">Dueño de la Mascota *</label>
                            <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                <option value="">Seleccionar Dueño</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Nombre -->
                                <div class="form-group">
                                    <label for="nombre">Nombre de la Mascota *</label>
                                    <input type="text" name="nombre" id="nombre" 
                                           class="form-control @error('nombre') is-invalid @enderror"
                                           value="{{ old('nombre') }}" 
                                           placeholder="Ej: Max, Luna, Toby..." required>
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Especie -->
                                <div class="form-group">
                                    <label for="especie">Especie *</label>
                                    <select name="especie" id="especie" 
                                            class="form-control @error('especie') is-invalid @enderror" required>
                                        <option value="">Seleccionar Especie</option>
                                        <option value="Perro" {{ old('especie') == 'Perro' ? 'selected' : '' }}>Perro</option>
                                        <option value="Gato" {{ old('especie') == 'Gato' ? 'selected' : '' }}>Gato</option>
                                        <option value="Otro" {{ old('especie') == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    @error('especie')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Raza -->
                                <div class="form-group">
                                    <label for="raza">Raza</label>
                                    <input type="text" name="raza" id="raza" 
                                           class="form-control @error('raza') is-invalid @enderror"
                                           value="{{ old('raza') }}" 
                                           placeholder="Ej: Labrador, Siames, Mestizo...">
                                    @error('raza')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Edad -->
                                <div class="form-group">
                                    <label for="edad">Edad (años)</label>
                                    <input type="number" name="edad" id="edad" 
                                           class="form-control @error('edad') is-invalid @enderror"
                                           value="{{ old('edad') }}" 
                                           min="0" max="30" 
                                           placeholder="Ej: 3">
                                    @error('edad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Sexo -->
                                <div class="form-group">
                                    <label for="sexo">Sexo</label>
                                    <select name="sexo" id="sexo" 
                                            class="form-control @error('sexo') is-invalid @enderror">
                                        <option value="">Seleccionar Sexo</option>
                                        <option value="Macho" {{ old('sexo') == 'Macho' ? 'selected' : '' }}>Macho</option>
                                        <option value="Hembra" {{ old('sexo') == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                                    </select>
                                    @error('sexo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Color -->
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input type="text" name="color" id="color" 
                                           class="form-control @error('color') is-invalid @enderror"
                                           value="{{ old('color') }}" 
                                           placeholder="Ej: Negro, Blanco, Marrón...">
                                    @error('color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Tamaño -->
                                <div class="form-group">
                                    <label for="tamaño">Tamaño</label>
                                    <select name="tamaño" id="tamaño" 
                                            class="form-control @error('tamaño') is-invalid @enderror">
                                        <option value="">Seleccionar Tamaño</option>
                                        <option value="pequeño" {{ old('tamaño') == 'pequeño' ? 'selected' : '' }}>Pequeño</option>
                                        <option value="mediano" {{ old('tamaño') == 'mediano' ? 'selected' : '' }}>Mediano</option>
                                        <option value="grande" {{ old('tamaño') == 'grande' ? 'selected' : '' }}>Grande</option>
                                    </select>
                                    @error('tamaño')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Estado -->
                                <div class="form-group">
                                    <label for="estado">Estado *</label>
                                    <select name="estado" id="estado" 
                                            class="form-control @error('estado') is-invalid @enderror" required>
                                        <option value="">Seleccionar Estado</option>
                                        <option value="perdida" {{ old('estado') == 'perdida' ? 'selected' : '' }}>Perdida</option>
                                        <option value="encontrada" {{ old('estado') == 'encontrada' ? 'selected' : '' }}>Encontrada</option>
                                        <option value="adopcion" {{ old('estado') == 'adopcion' ? 'selected' : '' }}>En Adopción</option>
                                    </select>
                                    @error('estado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Ubicación -->
                        <div class="form-group">
                            <label for="ubicacion">Ubicación</label>
                            <input type="text" name="ubicacion" id="ubicacion" 
                                   class="form-control @error('ubicacion') is-invalid @enderror"
                                   value="{{ old('ubicacion') }}" 
                                   placeholder="Ej: Sacaba Centro, Villa Tunari, Calle...">
                            @error('ubicacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" 
                                      class="form-control @error('descripcion') is-invalid @enderror"
                                      rows="4" 
                                      placeholder="Describe características especiales, comportamiento, etc.">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Foto -->
                        <div class="form-group">
                            <label for="foto">Fotografía de la Mascota</label>
                            <div class="custom-file">
                                <input type="file" name="foto" id="foto" 
                                       class="custom-file-input @error('foto') is-invalid @enderror"
                                       accept="image/*">
                                <label class="custom-file-label" for="foto">Seleccionar archivo...</label>
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                Formatos permitidos: JPEG, PNG, JPG, GIF. Tamaño máximo: 2MB
                            </small>
                        </div>

                        <!-- Vista previa de la imagen -->
                        <div class="form-group text-center" id="image-preview" style="display: none;">
                            <img id="preview" src="#" alt="Vista previa" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save mr-2"></i>Registrar Mascota
                        </button>
                        <a href="{{ route('admin.mascotas.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times mr-2"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    .card {
        border-radius: 12px;
    }
    .card-outline {
        border-top: 3px solid #007bff !important;
    }
    .form-group label {
        font-weight: 600;
        color: #495057;
    }
    .required label::after {
        content: " *";
        color: #dc3545;
    }
</style>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Vista previa de imagen
        const fotoInput = document.getElementById('foto');
        const preview = document.getElementById('preview');
        const imagePreview = document.getElementById('image-preview');

        fotoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
            }
        });

        // Actualizar label del file input
        fotoInput.addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Seleccionar archivo...';
            const nextSibling = this.nextElementSibling;
            nextSibling.innerText = fileName;
        });

        // Validación en tiempo real
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let valid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        valid = false;
                        field.classList.add('is-invalid');
                    }
                });

                if (!valid) {
                    e.preventDefault();
                    toastr.error('Por favor, completa todos los campos obligatorios.');
                }
            });
        });
    });
</script>
@stop