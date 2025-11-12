<?php

namespace App\Http\Controllers;

use App\Models\DetalleHotel;
use Illuminate\Http\Request;

/**
 * Class DetalleHotelController
 * @package App\Http\Controllers
 */
class DetalleHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalleHotels = DetalleHotel::paginate();

        return view('detalle-hotel.index', compact('detalleHotels'))
            ->with('i', (request()->input('page', 1) - 1) * $detalleHotels->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detalleHotel = new DetalleHotel();
        return view('detalle-hotel.create', compact('detalleHotel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(DetalleHotel::$rules);

        $detalleHotel = DetalleHotel::create($request->all());

        return redirect()->route('detalle-hotels.index')
            ->with('success', 'DetalleHotel created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalleHotel = DetalleHotel::find($id);

        return view('detalle-hotel.show', compact('detalleHotel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalleHotel = DetalleHotel::find($id);

        return view('detalle-hotel.edit', compact('detalleHotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  DetalleHotel $detalleHotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleHotel $detalleHotel)
    {
        request()->validate(DetalleHotel::$rules);

        $detalleHotel->update($request->all());

        return redirect()->route('detalle-hotels.index')
            ->with('success', 'DetalleHotel updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detalleHotel = DetalleHotel::find($id)->delete();

        return redirect()->route('detalle-hotels.index')
            ->with('success', 'DetalleHotel deleted successfully');
    }
}
