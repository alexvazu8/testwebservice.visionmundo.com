<?php

namespace App\Http\Controllers;

use App\Models\Penalidad;
use Illuminate\Http\Request;

/**
 * Class PenalidadController
 * @package App\Http\Controllers
 */
class PenalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penalidads = Penalidad::paginate();

        return view('penalidad.index', compact('penalidads'))
            ->with('i', (request()->input('page', 1) - 1) * $penalidads->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penalidad = new Penalidad();
        return view('penalidad.create', compact('penalidad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Penalidad::$rules);

        $penalidad = Penalidad::create($request->all());

        return redirect()->route('penalidads.index')
            ->with('success', 'Penalidad created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penalidad = Penalidad::find($id);

        return view('penalidad.show', compact('penalidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penalidad = Penalidad::find($id);

        return view('penalidad.edit', compact('penalidad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Penalidad $penalidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penalidad $penalidad)
    {
        request()->validate(Penalidad::$rules);

        $penalidad->update($request->all());

        return redirect()->route('penalidads.index')
            ->with('success', 'Penalidad updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $penalidad = Penalidad::find($id)->delete();

        return redirect()->route('penalidads.index')
            ->with('success', 'Penalidad deleted successfully');
    }
}
