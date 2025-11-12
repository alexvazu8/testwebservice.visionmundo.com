<?php

namespace App\Http\Controllers;

use App\Models\TipoHabitacionHotel;
use Illuminate\Http\Request;

/**
 * Class TipoHabitacionHotelController
 * @package App\Http\Controllers
 */
class TipoHabitacionHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoHabitacionHotels = TipoHabitacionHotel::paginate();

        return view('tipo-habitacion-hotel.index', compact('tipoHabitacionHotels'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoHabitacionHotels->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoHabitacionHotel = new TipoHabitacionHotel();
        return view('tipo-habitacion-hotel.create', compact('tipoHabitacionHotel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TipoHabitacionHotel::$rules);

        $tipoHabitacionHotel = TipoHabitacionHotel::create($request->all());

        return redirect()->route('tipo-habitacion-hotels.index')
            ->with('success', 'TipoHabitacionHotel created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoHabitacionHotel = TipoHabitacionHotel::find($id);

        return view('tipo-habitacion-hotel.show', compact('tipoHabitacionHotel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoHabitacionHotel = TipoHabitacionHotel::find($id);

        return view('tipo-habitacion-hotel.edit', compact('tipoHabitacionHotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TipoHabitacionHotel $tipoHabitacionHotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoHabitacionHotel $tipoHabitacionHotel)
    {
        request()->validate(TipoHabitacionHotel::$rules);

        $tipoHabitacionHotel->update($request->all());

        return redirect()->route('tipo-habitacion-hotels.index')
            ->with('success', 'TipoHabitacionHotel updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoHabitacionHotel = TipoHabitacionHotel::find($id)->delete();

        return redirect()->route('tipo-habitacion-hotels.index')
            ->with('success', 'TipoHabitacionHotel deleted successfully');
    }
}
