<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cargos';

    protected $fillable = [
        'codigo',
        'nombre',
        'activo',
    ];

    // Relación con los Users asignados a este cargo
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'idCargo');
    }

}
