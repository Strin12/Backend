<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Correos extends Model
{
    use HasFactory;
    protected $table ='correos';

    protected $fillable = [
        'correo',
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
        return $this->belongsTo(contactos::class);
    }
}
