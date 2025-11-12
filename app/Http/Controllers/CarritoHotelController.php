<?php

namespace App\Http\Controllers;

use App\Models\CarritoHotel;
use Illuminate\Http\Request;

/**
 * Class CarritoHotelController
 * @package App\Http\Controllers
 */
class CarritoHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carritoHotels = CarritoHotel::paginate();

        return view('carrito-hotel.index', compact('carritoHotels'))
            ->with('i', (request()->input('page', 1) - 1) * $carritoHotels->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carritoHotel = new CarritoHotel();
        return view('carrito-hotel.create', compact('carritoHotel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(CarritoHotel::$rules);

        $carritoHotel = CarritoHotel::create($request->all());

        return redirect()->route('carrito-hotels.index')
            ->with('success', 'CarritoHotel created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carritoHotel = CarritoHotel::find($id);

        return view('carrito-hotel.show', compact('carritoHotel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carritoHotel = CarritoHotel::find($id);

        return view('carrito-hotel.edit', compact('carritoHotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  CarritoHotel $carritoHotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarritoHotel $carritoHotel)
    {
        request()->validate(CarritoHotel::$rules);

        $carritoHotel->update($request->all());

        return redirect()->route('carrito-hotels.index')
            ->with('success', 'CarritoHotel updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $carritoHotel = CarritoHotel::find($id)->delete();

        return redirect()->route('carrito-hotels.index')
            ->with('success', 'CarritoHotel deleted successfully');
    }
}
