<?php
namespace App\Repositories;

use App\Models\Telefonos;

class TelefonosRepository{

    public function create($numero, $tipo, $contacto_id){
        $telefonos['numero'] = $numero;
        $telefonos['tipo'] = $tipo;
        $telefonos['contacto_id'] = $contacto_id;
        return Telefonos::create($telefonos);

    }
    public function update($id,$numero, $tipo, $contacto_id){

        $telefonos = $this->find($id);
        $telefonos->numero = $numero;
        $telefonos->tipo = $tipo;
        $telefonos->contacto_id = $contacto_id;
        return $telefonos;

    }

    public function find($id){

        return Telefonos::Where('id', '=' ,$id)->first();
    }

    function delete($id){
        $telefonos = $this->find($id);
        return $telefonos->delete();
    }

    function list(){
        return Telefonos::all();
    }

}
