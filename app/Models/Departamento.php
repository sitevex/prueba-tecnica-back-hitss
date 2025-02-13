<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'departamentos';

    protected $fillable = [
        'codigo',
        'nombre',
        'activo',
    ];

    // Relación con los Users asignados a este departamento
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'idDepartamento');
    }

}
