<?php

namespace App\Http\Controllers;

use App\Repositories\UsuarioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class UsuariosController extends Controller
{

    protected $usuarios_repository;

    public function __construct(UsuarioRepository $repository)
    {
        $this->usuarios_repository = $repository;
    }

    public function create(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'nombre' => 'required|string|max:35',
            'correo' => 'required|string|unique:users|max:50',
            'contrasenia' => 'required|min:6',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no debe tener más de 35 caracteres.',
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.string' => 'El correo debe ser una cadena de texto.',
            'correo.unique' => 'El correo ya está registrado.',
            'correo.max' => 'El correo no debe tener más de 50 caracteres.',
            'contrasenia.required' => 'La contraseña es obligatoria.',
            'contrasenia.min' => 'La contraseña debe tener al menos 6 caracteres.',
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
            $usuario = $this->usuarios_repository->create($request->get('nombre'), $request->get('correo'), $request->get('contrasenia'));
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
            'correo' => 'required|string|unique:users|max:50',
            'contrasenia' => 'required|min:6',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no debe tener más de 35 caracteres.',
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.string' => 'El correo debe ser una cadena de texto.',
            'correo.unique' => 'El correo ya está registrado.',
            'correo.max' => 'El correo no debe tener más de 50 caracteres.',
            'contrasenia.required' => 'La contraseña es obligatoria.',
            'contrasenia.min' => 'La contraseña debe tener al menos 6 caracteres.',
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
            $usuario = $this->usuarios_repository->update($id, $request->get('nombre'), $request->get('correo'), $request->get('contrasenia'));
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
            return response()->json($this->usuarios_repository->delete($id));
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function edit($id)
    {

        try {
            return response()->json($this->usuarios_repository->find($id));
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function list()
    {
        try {
            return response()->json($this->usuarios_repository->list());
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
