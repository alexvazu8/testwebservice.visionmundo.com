<?php

namespace App\Http\Controllers;

use App\Models\CarritoTraslado;
use Illuminate\Http\Request;

/**
 * Class CarritoTrasladoController
 * @package App\Http\Controllers
 */
class CarritoTrasladoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carritoTraslados = CarritoTraslado::paginate();

        return view('carrito-traslado.index', compact('carritoTraslados'))
            ->with('i', (request()->input('page', 1) - 1) * $carritoTraslados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carritoTraslado = new CarritoTraslado();
        return view('carrito-traslado.create', compact('carritoTraslado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(CarritoTraslado::$rules);

        $carritoTraslado = CarritoTraslado::create($request->all());

        return redirect()->route('carrito-traslados.index')
            ->with('success', 'CarritoTraslado created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carritoTraslado = CarritoTraslado::find($id);

        return view('carrito-traslado.show', compact('carritoTraslado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carritoTraslado = CarritoTraslado::find($id);

        return view('carrito-traslado.edit', compact('carritoTraslado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  CarritoTraslado $carritoTraslado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarritoTraslado $carritoTraslado)
    {
        request()->validate(CarritoTraslado::$rules);

        $carritoTraslado->update($request->all());

        return redirect()->route('carrito-traslados.index')
            ->with('success', 'CarritoTraslado updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $carritoTraslado = CarritoTraslado::find($id)->delete();

        return redirect()->route('carrito-traslados.index')
            ->with('success', 'CarritoTraslado deleted successfully');
    }
}
