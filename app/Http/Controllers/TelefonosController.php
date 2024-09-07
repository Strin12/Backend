<?php

namespace App\Http\Controllers;

use App\Repositories\TelefonosRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TelefonosController extends Controller
{
    protected $telefonos_repository;

    public function __construct(TelefonosRepository $repository)
    {
        $this->telefonos_repository = $repository;
    }

    public function create(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'numero' => 'required|string|max:10',
            'tipo' => 'required|',
        ], [
            'numero.required' => 'El campo numero es obligatorio.',
            'numero.string' => 'El campo numero debe ser una cadena de texto.',
            'numero.max' => 'El numero no debe tener más de 10 caracteres.',
            'tipo.required' => 'El campo tipo es obligatorio.'
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
            $telefonos = $this->telefonos_repository->create($request->get('numero'), $request->get('tipo'),$request->get('contacto_id'));
            DB::commit();
            return response()->json(compact('telefonos'));
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function updated(Request $request, $id)
    {
        $validador = Validator::make($request->all(), [
            'numero' => 'required|string|max:10',
            'tipo' => 'required|',
        ], [
            'numero.required' => 'El campo nombre es obligatorio.',
            'numero.string' => 'El campo nombre debe ser una cadena de texto.',
            'numero.max' => 'El nombre no debe tener más de 10 caracteres.',
            'tipo.required' => 'El campo tipo es obligatorio.'
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
            $telefonos = $this->telefonos_repository->update($id,$request->get('numero'), $request->get('tipo'),$request->get('contacto_id'));
            DB::commit();
            return response()->json(compact('telefonos'));
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function delete($id)
    {

        try {
            return response()->json($this->telefonos_repository->delete($id));
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function edit($id)
    {

        try {
            return response()->json($this->telefonos_repository->find($id));
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function list()
    {
        try {
            return response()->json($this->telefonos_repository->list());
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
