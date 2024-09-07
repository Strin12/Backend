<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direcciones extends Model
{
    use HasFactory;
    protected $table ='direcciones';

    protected $fillable = [
        'direccion',
        'ciudad',
        'estado',
        'codigo_postal',
        'pais',
        'contacto_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function contactos()
    {
        return $this->belongsTo(Contactos::class, 'contacto_id', 'id');
    }
}
