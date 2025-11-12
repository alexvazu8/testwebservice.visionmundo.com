<?php

namespace App\Http\Controllers;

use App\Models\Estrella;
use Illuminate\Http\Request;

/**
 * Class EstrellaController
 * @package App\Http\Controllers
 */
class EstrellaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estrellas = Estrella::paginate();

        return view('estrella.index', compact('estrellas'))
            ->with('i', (request()->input('page', 1) - 1) * $estrellas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estrella = new Estrella();
        return view('estrella.create', compact('estrella'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Estrella::$rules);

        $estrella = Estrella::create($request->all());

        return redirect()->route('estrellas.index')
            ->with('success', 'Estrella created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estrella = Estrella::find($id);

        return view('estrella.show', compact('estrella'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estrella = Estrella::find($id);

        return view('estrella.edit', compact('estrella'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Estrella $estrella
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estrella $estrella)
    {
        request()->validate(Estrella::$rules);

        $estrella->update($request->all());

        return redirect()->route('estrellas.index')
            ->with('success', 'Estrella updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $estrella = Estrella::find($id)->delete();

        return redirect()->route('estrellas.index')
            ->with('success', 'Estrella deleted successfully');
    }
}
