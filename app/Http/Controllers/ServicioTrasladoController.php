<?php

namespace App\Http\Controllers;

use App\Models\ServicioTraslado;
use Illuminate\Http\Request;

/**
 * Class ServicioTrasladoController
 * @package App\Http\Controllers
 */
class ServicioTrasladoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicioTraslados = ServicioTraslado::paginate();

        return view('servicio-traslado.index', compact('servicioTraslados'))
            ->with('i', (request()->input('page', 1) - 1) * $servicioTraslados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicioTraslado = new ServicioTraslado();
        return view('servicio-traslado.create', compact('servicioTraslado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ServicioTraslado::$rules);

        $servicioTraslado = ServicioTraslado::create($request->all());

        return redirect()->route('servicio-traslados.index')
            ->with('success', 'ServicioTraslado created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicioTraslado = ServicioTraslado::find($id);

        return view('servicio-traslado.show', compact('servicioTraslado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicioTraslado = ServicioTraslado::find($id);

        return view('servicio-traslado.edit', compact('servicioTraslado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ServicioTraslado $servicioTraslado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServicioTraslado $servicioTraslado)
    {
        request()->validate(ServicioTraslado::$rules);

        $servicioTraslado->update($request->all());

        return redirect()->route('servicio-traslados.index')
            ->with('success', 'ServicioTraslado updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $servicioTraslado = ServicioTraslado::find($id)->delete();

        return redirect()->route('servicio-traslados.index')
            ->with('success', 'ServicioTraslado deleted successfully');
    }

    


}
