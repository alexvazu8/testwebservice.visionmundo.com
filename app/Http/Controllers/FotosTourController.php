<?php

namespace App\Http\Controllers;

use App\Models\FotosTour;
use Illuminate\Http\Request;

/**
 * Class FotosTourController
 * @package App\Http\Controllers
 */
class FotosTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fotosTours = FotosTour::paginate();

        return view('fotos-tour.index', compact('fotosTours'))
            ->with('i', (request()->input('page', 1) - 1) * $fotosTours->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fotosTour = new FotosTour();
        return view('fotos-tour.create', compact('fotosTour'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(FotosTour::$rules);

        $fotosTour = FotosTour::create($request->all());

        return redirect()->route('fotos-tours.index')
            ->with('success', 'FotosTour created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fotosTour = FotosTour::find($id);

        return view('fotos-tour.show', compact('fotosTour'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fotosTour = FotosTour::find($id);

        return view('fotos-tour.edit', compact('fotosTour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  FotosTour $fotosTour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FotosTour $fotosTour)
    {
        request()->validate(FotosTour::$rules);

        $fotosTour->update($request->all());

        return redirect()->route('fotos-tours.index')
            ->with('success', 'FotosTour updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $fotosTour = FotosTour::find($id)->delete();

        return redirect()->route('fotos-tours.index')
            ->with('success', 'FotosTour deleted successfully');
    }
}
