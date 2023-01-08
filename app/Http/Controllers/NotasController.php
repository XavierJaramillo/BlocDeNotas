<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Nota;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\View;

class NotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {
        return view('notas.index', [
            'notas' => Nota::paginate(6)
        ]);
    }

    public function getNotas(Request $request, int $pagina) 
    {
        if($request->ajax()) {
            $inicio = ($pagina * 6) - 6;

            $notas = Nota::select()
                        ->offset($inicio)
                        ->limit(6)
                        ->get();

            return Blade::render(
                '<x-notas :notas="$notas" />',
                [
                    "notas" => new LengthAwarePaginator($notas, Nota::count(), 6, $pagina)
                ]
            );
        }
    }

    public function search(Request $request) {
        if($request->ajax()) {
            $inicio = ($request->pagina * 6) - 6;

            $notas = new Nota;
                      
            if($request->where) {
                $notas = $notas->where('titulo', 'like', "%$request->where%")
                    ->orWhere('cuerpo', 'like', "%$request->where%");
            }

            $notas = $notas->offset($inicio)
                ->limit(6)
                ->get();

            $notaCount = Nota::count();
            if($request->where) {
                $notaCount = count($notas);
            }

            return Blade::render(
                '<x-notas :notas="$notas" />',
                [
                    "notas" => new LengthAwarePaginator($notas, $notaCount, 6, $request->pagina)
                ]
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Blade::render(
            '<x-form-nota-component />'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (!empty($request->nota_id)) {
                $nota = Nota::find($request->nota_id);
            } else {
                $nota = new Nota();
            }

            $nota->fill($request->all())->save();
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()], 400);
        }

        return response()->json(['success' => true, 'msg' => 'Nota guardado correctamente.'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Nota $nota)
    {
        return Blade::render(
            '<x-form-nota-component :nota="$nota" />',
            [
                "nota" => $nota
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nota $nota)
    {
        try {
            $nota->delete();
            return response()->json("Nota eliminada correctamente.");
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
