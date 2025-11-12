<?php

namespace App\Http\Controllers;

use App\Models\DetalleTraslado;
use Illuminate\Http\Request;

/**
 * Class DetalleTrasladoController
 * @package App\Http\Controllers
 */
class DetalleTrasladoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalleTraslados = DetalleTraslado::paginate();

        return view('detalle-traslado.index', compact('detalleTraslados'))
            ->with('i', (request()->input('page', 1) - 1) * $detalleTraslados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detalleTraslado = new DetalleTraslado();
        return view('detalle-traslado.create', compact('detalleTraslado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(DetalleTraslado::$rules);

        $detalleTraslado = DetalleTraslado::create($request->all());

        return redirect()->route('detalle-traslados.index')
            ->with('success', 'DetalleTraslado created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalleTraslado = DetalleTraslado::find($id);

        return view('detalle-traslado.show', compact('detalleTraslado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalleTraslado = DetalleTraslado::find($id);

        return view('detalle-traslado.edit', compact('detalleTraslado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  DetalleTraslado $detalleTraslado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleTraslado $detalleTraslado)
    {
        request()->validate(DetalleTraslado::$rules);

        $detalleTraslado->update($request->all());

        return redirect()->route('detalle-traslados.index')
            ->with('success', 'DetalleTraslado updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detalleTraslado = DetalleTraslado::find($id)->delete();

        return redirect()->route('detalle-traslados.index')
            ->with('success', 'DetalleTraslado deleted successfully');
    }
}
