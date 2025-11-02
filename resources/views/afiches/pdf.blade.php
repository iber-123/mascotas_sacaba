<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Afiche - {{ $afiche->titulo }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .afiche { border: 2px solid {{ $afiche->color_principal }}; padding: 20px; max-width: 600px; margin: 0 auto; }
        .titulo { color: {{ $afiche->color_principal }}; font-size: 24px; font-weight: bold; text-align: center; margin-bottom: 20px; }
        .info { margin-bottom: 15px; }
        .contacto { background: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 20px; }
        .foto-mascota { text-align: center; margin: 15px 0; }
        .foto-mascota img { max-width: 200px; max-height: 200px; border: 2px solid {{ $afiche->color_principal }}; border-radius: 10px; }
        .recompensa { background: #fff3cd; padding: 15px; border-radius: 5px; margin: 15px 0; border: 1px solid #ffeaa7; }
    </style>
</head>
<body>
    <div class="afiche">
        <div class="titulo">{{ $afiche->titulo }}</div>
        
        <!-- Foto de la mascota -->
        @if($afiche->mascota->foto)
        <div class="foto-mascota">
            <img src="{{ storage_path('app/public/' . $afiche->mascota->foto) }}" alt="{{ $afiche->mascota->nombre }}">
        </div>
        @endif

        <div class="info">
            <strong>Mascota:</strong> {{ $afiche->mascota->nombre }}<br>
            <strong>Especie:</strong> {{ $afiche->mascota->especie }}<br>
            <strong>Raza:</strong> {{ $afiche->mascota->raza ?? 'No especificada' }}<br>
            <strong>Color:</strong> {{ $afiche->mascota->color ?? 'No especificado' }}<br>
            <strong>Edad:</strong> {{ $afiche->mascota->edad ?? 'No especificada' }}
        </div>

        @if($afiche->descripcion)
        <div class="info">
            <strong>Descripción:</strong><br>
            {{ $afiche->descripcion }}
        </div>
        @endif

        @if($afiche->mostrar_recompensa && $afiche->recompensa)
        <div class="recompensa">
            <strong>Recompensa:</strong> {{ $afiche->recompensa }}
        </div>
        @endif

        @if($afiche->mostrar_contacto)
        <div class="contacto">
            <strong>Contacto:</strong> {{ $afiche->telefono_contacto }}
        </div>
        @endif
    </div>
</body>
</html>