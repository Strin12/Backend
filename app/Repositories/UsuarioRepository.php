<?php
namespace App\Repositories;

use App\Models\User;

class UsuarioRepository{

    public function create($nombre, $correo, $contrasenia){
        $usuario['nombre'] = $nombre;
        $usuario['correo'] = $correo;
        $usuario['contrasenia'] = $contrasenia;
        return User::create($usuario);

    }
    public function update($id, $nombre, $correo){

        $usuario = $this->find($id);
        $usuario->nombre = $nombre;
        $usuario->correo = $correo;
        return $usuario;

    }

    public function find($id){

        return User::Where('id', '=' ,$id)->first();
    }

    function delete($id){
        $usuario = $this->find($id);
        return $usuario->delete();
    }

    function list(){
        return User::all();
    }

}
