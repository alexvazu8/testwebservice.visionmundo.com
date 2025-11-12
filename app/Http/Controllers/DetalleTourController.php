<?php

namespace App\Http\Controllers;

use App\Models\DetalleTour;
use Illuminate\Http\Request;

/**
 * Class DetalleTourController
 * @package App\Http\Controllers
 */
class DetalleTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalleTours = DetalleTour::paginate();

        return view('detalle-tour.index', compact('detalleTours'))
            ->with('i', (request()->input('page', 1) - 1) * $detalleTours->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detalleTour = new DetalleTour();
        return view('detalle-tour.create', compact('detalleTour'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(DetalleTour::$rules);

        $detalleTour = DetalleTour::create($request->all());

        return redirect()->route('detalle-tours.index')
            ->with('success', 'DetalleTour created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalleTour = DetalleTour::find($id);

        return view('detalle-tour.show', compact('detalleTour'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalleTour = DetalleTour::find($id);

        return view('detalle-tour.edit', compact('detalleTour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  DetalleTour $detalleTour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleTour $detalleTour)
    {
        request()->validate(DetalleTour::$rules);

        $detalleTour->update($request->all());

        return redirect()->route('detalle-tours.index')
            ->with('success', 'DetalleTour updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detalleTour = DetalleTour::find($id)->delete();

        return redirect()->route('detalle-tours.index')
            ->with('success', 'DetalleTour deleted successfully');
    }
}
