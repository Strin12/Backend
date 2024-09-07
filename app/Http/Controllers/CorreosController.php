<?php

namespace App\Http\Controllers;

use App\Repositories\CorreosRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class CorreosController extends Controller
{
    protected $correo_repository;

    public function __construct(CorreosRepository $repository)
    {
        $this->correo_repository = $repository;
    }

    public function create(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'correo' => 'required|string|unique:correos|max:50',
            'tipo' => 'required',
        ], [
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.string' => 'El correo debe ser una cadena de texto.',
            'correo.unique' => 'El correo ya está registrado.',
            'correo.max' => 'El correo no debe tener más de 50 caracteres.',
            'tipo.required' => 'El campo apellido es obligatorio.'
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
            $contactos = $this->correo_repository->create($request->get('correo'), $request->get('tipo'),$request->get('contacto_id'));
            DB::commit();
            return response()->json(compact('contactos'));
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function updated(Request $request, $id)
    {
        $validador = Validator::make($request->all(), [
            'correo' => 'required|string|unique:correos|max:50',
            'tipo' => 'required',
        ], [
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.string' => 'El correo debe ser una cadena de texto.',
            'correo.unique' => 'El correo ya está registrado.',
            'correo.max' => 'El correo no debe tener más de 50 caracteres.',
            'tipo.required' => 'El campo apellido es obligatorio.'
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
            $contactos = $this->correo_repository->update($id,$request->get('correo'), $request->get('tipo'),$request->get('contacto_id'));
            DB::commit();
            return response()->json(compact('contactos'));
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function delete($id)
    {

        try {
            return response()->json($this->correo_repository->delete($id));
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function edit($id)
    {

        try {
            return response()->json($this->correo_repository->find($id));
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function list()
    {
        try {
            return response()->json($this->correo_repository->list());
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}

