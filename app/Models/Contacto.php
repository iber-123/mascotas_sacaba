<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $fillable = [
        'mascota_id',
        'user_id',
        'dueño_id',
        'nombre',
        'email',
        'telefono',
        'mensaje',
        'tipo',
        'leido'
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dueño()
    {
        return $this->belongsTo(User::class, 'dueño_id');
    }
}