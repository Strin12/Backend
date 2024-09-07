<?php

namespace App\Http\Controllers;

use App\Repositories\DireccionesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DireccionesController extends Controller
{
    protected $direcciones_repository;

    public function __construct(DireccionesRepository $repository)
    {
        $this->direcciones_repository = $repository;
    }

    public function create(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'direccion' => 'required|string',
            'ciudad' => 'required',
            'estado' => 'required|string',
            'codigo_postal' => 'required|string|max:5',
            'pais' => 'required|string',
        ], [
            'direccion.required' => 'El campo direccion es obligatorio.',
            'direccion.string' => 'El campo direccion debe ser una cadena de texto.',
            'ciudad.required' => 'El campo ciudad es obligatorio.',
            'ciudad.string' => 'El campo ciudad debe ser una cadena de texto.',
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.string' => 'El campo estado debe ser una cadena de texto.',
            'codigo_postal.required' => 'El campo codigo_postal es obligatorio.',
            'codigo_postal.string' => 'El campo codigo_postal debe ser una cadena de texto.',
            'codigo_postal.max' => 'El nombre no debe tener más de 5 caracteres.',
            'pais.required' => 'El campo pais es obligatorio.',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validador->errors(),
            ], 400);
        }
        try {
            DB::beginTransaction();
            $direcciones = $this->direcciones_repository->create($request->get('direccion'), $request->get('ciudad'), $request->get('estado'), $request->get('codigo_postal'), $$request->get('pais'), $request->get('contacto_id'));
            DB::commit();
            return response()->json(compact('direcciones'));
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function updated(Request $request, $id)
    {
        $validador = Validator::make($request->all(), [
            'direccion' => 'required|string',
            'ciudad' => 'required',
            'estado' => 'required|string',
            'codigo_postal' => 'required|string|max:5',
            'pais' => 'required|string',
        ], [
            'direccion.required' => 'El campo direccion es obligatorio.',
            'direccion.string' => 'El campo direccion debe ser una cadena de texto.',
            'ciudad.required' => 'El campo ciudad es obligatorio.',
            'ciudad.string' => 'El campo ciudad debe ser una cadena de texto.',
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.string' => 'El campo estado debe ser una cadena de texto.',
            'codigo_postal.required' => 'El campo codigo_postal es obligatorio.',
            'codigo_postal.string' => 'El campo codigo_postal debe ser una cadena de texto.',
            'codigo_postal.max' => 'El nombre no debe tener más de 5 caracteres.',
            'pais.required' => 'El campo pais es obligatorio.',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validador->errors(),
            ], 400);
        }
        try {

            DB::beginTransaction();
            $direcciones = $this->direcciones_repository->update($id, $request->get('direccion'), $request->get('ciudad'), $request->get('estado'), $request->get('codigo_postal'), $$request->get('pais'), $request->get('contacto_id'));
            DB::commit();
            return response()->json(compact('direcciones'));
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function delete($id)
    {

        try {
            return response()->json($this->direcciones_repository->delete($id));
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function edit($id)
    {

        try {
            return response()->json($this->direcciones_repository->find($id));
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function list()
    {
        try {
            return response()->json($this->direcciones_repository->list());
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function getPais($pais)
    {

        try {
            return response()->json($this->direcciones_repository->BuscarPais($pais));
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
