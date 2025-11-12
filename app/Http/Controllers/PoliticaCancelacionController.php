<?php

namespace App\Http\Controllers;

use App\Models\PoliticaCancelacion;
use Illuminate\Http\Request;

/**
 * Class PoliticaCancelacionController
 * @package App\Http\Controllers
 */
class PoliticaCancelacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $politicaCancelacions = PoliticaCancelacion::paginate();

        return view('politica-cancelacion.index', compact('politicaCancelacions'))
            ->with('i', (request()->input('page', 1) - 1) * $politicaCancelacions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $politicaCancelacion = new PoliticaCancelacion();
        return view('politica-cancelacion.create', compact('politicaCancelacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(PoliticaCancelacion::$rules);

        $politicaCancelacion = PoliticaCancelacion::create($request->all());

        return redirect()->route('politica-cancelacions.index')
            ->with('success', 'PoliticaCancelacion created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $politicaCancelacion = PoliticaCancelacion::find($id);

        return view('politica-cancelacion.show', compact('politicaCancelacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $politicaCancelacion = PoliticaCancelacion::find($id);

        return view('politica-cancelacion.edit', compact('politicaCancelacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PoliticaCancelacion $politicaCancelacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PoliticaCancelacion $politicaCancelacion)
    {
        request()->validate(PoliticaCancelacion::$rules);

        $politicaCancelacion->update($request->all());

        return redirect()->route('politica-cancelacions.index')
            ->with('success', 'PoliticaCancelacion updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $politicaCancelacion = PoliticaCancelacion::find($id)->delete();

        return redirect()->route('politica-cancelacions.index')
            ->with('success', 'PoliticaCancelacion deleted successfully');
    }
}
