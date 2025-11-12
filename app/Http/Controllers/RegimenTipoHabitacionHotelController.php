<?php

namespace App\Http\Controllers;

use App\Models\RegimenTipoHabitacionHotel;
use Illuminate\Http\Request;

/**
 * Class RegimenTipoHabitacionHotelController
 * @package App\Http\Controllers
 */
class RegimenTipoHabitacionHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regimenTipoHabitacionHotels = RegimenTipoHabitacionHotel::paginate();

        return view('regimen-tipo-habitacion-hotel.index', compact('regimenTipoHabitacionHotels'))
            ->with('i', (request()->input('page', 1) - 1) * $regimenTipoHabitacionHotels->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regimenTipoHabitacionHotel = new RegimenTipoHabitacionHotel();
        return view('regimen-tipo-habitacion-hotel.create', compact('regimenTipoHabitacionHotel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(RegimenTipoHabitacionHotel::$rules);

        $regimenTipoHabitacionHotel = RegimenTipoHabitacionHotel::create($request->all());

        return redirect()->route('regimen-tipo-habitacion-hotels.index')
            ->with('success', 'RegimenTipoHabitacionHotel created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $regimenTipoHabitacionHotel = RegimenTipoHabitacionHotel::find($id);

        return view('regimen-tipo-habitacion-hotel.show', compact('regimenTipoHabitacionHotel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regimenTipoHabitacionHotel = RegimenTipoHabitacionHotel::find($id);

        return view('regimen-tipo-habitacion-hotel.edit', compact('regimenTipoHabitacionHotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  RegimenTipoHabitacionHotel $regimenTipoHabitacionHotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegimenTipoHabitacionHotel $regimenTipoHabitacionHotel)
    {
        request()->validate(RegimenTipoHabitacionHotel::$rules);

        $regimenTipoHabitacionHotel->update($request->all());

        return redirect()->route('regimen-tipo-habitacion-hotels.index')
            ->with('success', 'RegimenTipoHabitacionHotel updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $regimenTipoHabitacionHotel = RegimenTipoHabitacionHotel::find($id)->delete();

        return redirect()->route('regimen-tipo-habitacion-hotels.index')
            ->with('success', 'RegimenTipoHabitacionHotel deleted successfully');
    }
}
