<?php

namespace App\Http\Controllers;

use App\Models\CarritoTour;
use Illuminate\Http\Request;

/**
 * Class CarritoTourController
 * @package App\Http\Controllers
 */
class CarritoTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carritoTours = CarritoTour::paginate();

        return view('carrito-tour.index', compact('carritoTours'))
            ->with('i', (request()->input('page', 1) - 1) * $carritoTours->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carritoTour = new CarritoTour();
        return view('carrito-tour.create', compact('carritoTour'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(CarritoTour::$rules);

        $carritoTour = CarritoTour::create($request->all());

        return redirect()->route('carrito-tours.index')
            ->with('success', 'CarritoTour created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carritoTour = CarritoTour::find($id);

        return view('carrito-tour.show', compact('carritoTour'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carritoTour = CarritoTour::find($id);

        return view('carrito-tour.edit', compact('carritoTour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  CarritoTour $carritoTour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarritoTour $carritoTour)
    {
        request()->validate(CarritoTour::$rules);

        $carritoTour->update($request->all());

        return redirect()->route('carrito-tours.index')
            ->with('success', 'CarritoTour updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $carritoTour = CarritoTour::find($id)->delete();

        return redirect()->route('carrito-tours.index')
            ->with('success', 'CarritoTour deleted successfully');
    }
}
