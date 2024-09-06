<?php

namespace App\Http\Controllers;

use App\Repositories\ContactosRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class ContactosController extends Controller
{
    protected $contactos_repository;

    public function __construct(ContactosRepository $repository)
    {
        $this->contactos_repository = $repository;
    }

    public function create(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'nombre' => 'required|string|max:35',
            'apellido' => 'required|string|max:35',
            'fecha_nacimiento' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no debe tener más de 35 caracteres.',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'apellido.string' => 'El campo apellido debe ser una cadena de texto.',
            'apellido.max' => 'El apellido no debe tener más de 35 caracteres.',
            'fecha_nacimiento.required' => 'El campo nombre es obligatorio.',
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
            $usuario = $this->contactos_repository->create($request->get('nombre'), $request->get('apellido'), $request->get('fecha_nacimiento'),$$request->get('usuario_id'));
            DB::commit();
            return response()->json(compact('usuario'));
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function updated(Request $request, $id)
    {
        $validador = Validator::make($request->all(), [
            'nombre' => 'required|string|max:35',
            'apellido' => 'required|string|max:35',
            'fecha_nacimiento' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no debe tener más de 35 caracteres.',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'apellido.string' => 'El campo apellido debe ser una cadena de texto.',
            'apellido.max' => 'El apellido no debe tener más de 35 caracteres.',
            'fecha_nacimiento.required' => 'El campo nombre es obligatorio.',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validador->errors(),
            ], 422);
        }
        try {

            DB::beginTransaction();
            $usuario = $this->contactos_repository->update($id, $request->get('nombre'), $request->get('apellido'), $request->get('fecha_nacimiento'),$$request->get('usuario_id'));
            DB::commit();
            return response()->json(compact('usuario'));
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function delete($id)
    {

        try {
            return response()->json($this->contactos_repository->delete($id));
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function edit($id)
    {

        try {
            return response()->json($this->contactos_repository->find($id));
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function list()
    {
        try {
            return response()->json($this->contactos_repository->list());
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
