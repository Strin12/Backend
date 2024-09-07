<?php
namespace App\Repositories;

use App\Models\Contactos;

class ContactosRepository{

    public function create($nombre, $apellido, $fecha_nacimiento,$usuario_id){
        $contactos['nombre'] = $nombre;
        $contactos['apellido'] = $apellido;
        $contactos['fecha_nacimiento'] = $fecha_nacimiento;
        $contactos['usuario_id'] = $usuario_id;
        return Contactos::create($contactos);

    }
    public function update($id, $nombre, $apellido, $fecha_nacimiento,$usuario_id){

        $contactos = $this->find($id);
        $contactos->nombre = $nombre;
        $contactos->apellido = $apellido;
        $contactos->fecha_nacimiento = $fecha_nacimiento;
        $contactos->usuario_id = $usuario_id;
        return $contactos;

    }

    public function find($id){

        return Contactos::Where('id', '=' ,$id)->first();
    }

    function delete($id){
        $contactos = $this->find($id);
        return $contactos->delete();
    }

    function list(){

        $contactos = contactos::with('user', 'telefonos','correos','Direcciones')->get();
        return $contactos->toArray();
    }

}
