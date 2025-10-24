<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mascota_id',
        'estado',
        'ubicacion',
        'sexo',
        'edad',
        'raza',
        'color',
        'fecha',
        'descripcion',
        'foto'
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
