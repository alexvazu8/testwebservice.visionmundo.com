<?php

namespace App\Http\Controllers;

use App\Models\ClienteDetalleReserva;
use Illuminate\Http\Request;

/**
 * Class ClienteDetalleReservaController
 * @package App\Http\Controllers
 */
class ClienteDetalleReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clienteDetalleReservas = ClienteDetalleReserva::paginate();

        return view('cliente-detalle-reserva.index', compact('clienteDetalleReservas'))
            ->with('i', (request()->input('page', 1) - 1) * $clienteDetalleReservas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clienteDetalleReserva = new ClienteDetalleReserva();
        return view('cliente-detalle-reserva.create', compact('clienteDetalleReserva'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ClienteDetalleReserva::$rules);

        $clienteDetalleReserva = ClienteDetalleReserva::create($request->all());

        return redirect()->route('cliente-detalle-reservas.index')
            ->with('success', 'ClienteDetalleReserva created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clienteDetalleReserva = ClienteDetalleReserva::find($id);

        return view('cliente-detalle-reserva.show', compact('clienteDetalleReserva'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clienteDetalleReserva = ClienteDetalleReserva::find($id);

        return view('cliente-detalle-reserva.edit', compact('clienteDetalleReserva'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ClienteDetalleReserva $clienteDetalleReserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClienteDetalleReserva $clienteDetalleReserva)
    {
        request()->validate(ClienteDetalleReserva::$rules);

        $clienteDetalleReserva->update($request->all());

        return redirect()->route('cliente-detalle-reservas.index')
            ->with('success', 'ClienteDetalleReserva updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $clienteDetalleReserva = ClienteDetalleReserva::find($id)->delete();

        return redirect()->route('cliente-detalle-reservas.index')
            ->with('success', 'ClienteDetalleReserva deleted successfully');
    }
}
