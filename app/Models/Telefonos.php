<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefonos extends Model
{
    use HasFactory;
    protected $table ='telefonos';

    protected $fillable = [
        'numero',
        'tipo',
        'contacto_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function contactos()
    {
        return $this->belongsTo(Contactos::class, 'id', 'contacto_id');
    }
}
