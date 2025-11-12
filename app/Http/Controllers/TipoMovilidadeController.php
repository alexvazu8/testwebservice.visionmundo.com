<?php

namespace App\Http\Controllers;

use App\Models\TipoMovilidade;
use Illuminate\Http\Request;

/**
 * Class TipoMovilidadeController
 * @package App\Http\Controllers
 */
class TipoMovilidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoMovilidades = TipoMovilidade::paginate();

        return view('tipo-movilidade.index', compact('tipoMovilidades'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoMovilidades->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoMovilidade = new TipoMovilidade();
        return view('tipo-movilidade.create', compact('tipoMovilidade'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TipoMovilidade::$rules);

        $tipoMovilidade = TipoMovilidade::create($request->all());

        return redirect()->route('tipo-movilidades.index')
            ->with('success', 'TipoMovilidade created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoMovilidade = TipoMovilidade::find($id);

        return view('tipo-movilidade.show', compact('tipoMovilidade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoMovilidade = TipoMovilidade::find($id);

        return view('tipo-movilidade.edit', compact('tipoMovilidade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TipoMovilidade $tipoMovilidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoMovilidade $tipoMovilidade)
    {
        request()->validate(TipoMovilidade::$rules);

        $tipoMovilidade->update($request->all());

        return redirect()->route('tipo-movilidades.index')
            ->with('success', 'TipoMovilidade updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoMovilidade = TipoMovilidade::find($id)->delete();

        return redirect()->route('tipo-movilidades.index')
            ->with('success', 'TipoMovilidade deleted successfully');
    }
    public function getFotoPrincipalMovilidad(Request $request)
    {   //echo $request['Tipo_movilidad_id'];
        $tipo_movilidad = TipoMovilidade::where('id', '=', $request['Tipo_movilidad_id'])
        ->selectRaw("Foto_tipo_movilidad")
                    ->first();

      
                    if ($tipo_movilidad) {
                        $base64Image = base64_encode($tipo_movilidad->Foto_tipo_movilidad);
                        return response()->json($base64Image, 200);
                        //return view('hotel.foto', ['base64Image' => $base64Image]);
                    } else {
                        return response()->json(['error' => 'No hay foto para ese ID.'], 401);
                    }

    }
}
