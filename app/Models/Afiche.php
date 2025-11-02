<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afiche extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mascota_id', 
        'titulo',
        'descripcion',
        'telefono_contacto',
        'recompensa',
        'plantilla',
        'color_principal',
        'mostrar_recompensa',
        'mostrar_contacto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}