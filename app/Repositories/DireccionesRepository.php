<?php

namespace App\Repositories;

use App\Models\Direcciones;

class DireccionesRepository
{

    public function create($direccion, $ciudad, $estado, $codigo_postal, $pais, $contacto_id)
    {
        $direcciones['direccion'] = $direccion;
        $direcciones['ciudad'] = $ciudad;
        $direcciones['estado'] = $estado;
        $direcciones['codigo_postal'] = $codigo_postal;
        $direcciones['pais'] = $pais;
        $direcciones['contacto_id'] = $contacto_id;
        return Direcciones::create($direcciones);
    }
    public function update(
        $id,
        $direccion,
        $ciudad,
        $estado,
        $codigo_postal,
        $pais,
        $contacto_id
    ) {

        $direcciones = $this->find($id);
        $direcciones->direccion = $direccion;
        $direcciones->ciudad = $ciudad;
        $direcciones->estado = $estado;
        $direcciones->codigo_postal = $codigo_postal;
        $direcciones->pais = $pais;
        $direcciones->contacto_id = $contacto_id;
        return $direcciones;
    }

    public function find($id)
    {

        return Direcciones::Where('id', '=', $id)->first();
    }

    function delete($id)
    {
        $direcciones = $this->find($id);
        return $direcciones->delete();
    }

    function list()
    {

        return Direcciones::all();
    }
    public function BuscarPais($pais)
    {
        return Direcciones::where('pais', '=', $pais)
            ->with('contactos')
            ->get();
    }
}
