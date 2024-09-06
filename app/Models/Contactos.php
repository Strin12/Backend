<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactos extends Model
{
    use HasFactory;
    protected $table ='contactos';

    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'usuario_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function telefonos()
    {
        return $this->hasOne(Telefonos::class);
    }
    public function correos()
    {
        return $this->hasOne(Correos::class);
    }
    public function Direcciones()
    {
        return $this->hasOne(Direcciones::class);
    }
}
