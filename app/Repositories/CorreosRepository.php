<?php
namespace App\Repositories;

use App\Models\Correos;

class CorreosRepository{

    public function create($correo, $tipo, $contacto_id){
        $correos['correo'] = $correo;
        $correos['tipo'] = $tipo;
        $correos['contacto_id'] = $contacto_id;
        return Correos::create($correos);

    }
    public function update($id,$correo, $tipo, $contacto_id){

        $correos = $this->find($id);
        $correos->correo = $correo;
        $correos->tipo = $tipo;
        $correos->contacto_id = $contacto_id;
        return $correos;

    }

    public function find($id){

        return Correos::Where('id', '=' ,$id)->first();
    }

    function delete($id){
        $correos = $this->find($id);
        return $correos->delete();
    }

    function list(){
        return Correos::all();
    }

}
