<?php

namespace App\Http\Controllers;

use App\Models\Paise;
use Illuminate\Http\Request;

/**
 * Class PaiseController
 * @package App\Http\Controllers
 */
class PaiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = Paise::paginate();

        return view('paise.index', compact('paises'))
            ->with('i', (request()->input('page', 1) - 1) * $paises->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paise = new Paise();
        return view('paise.create', compact('paise'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Paise::$rules);

        $paise = Paise::create($request->all());

        return redirect()->route('paises.index')
            ->with('success', 'Paise created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paise = Paise::find($id);

        return view('paise.show', compact('paise'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paise = Paise::find($id);

        return view('paise.edit', compact('paise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Paise $paise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paise $paise)
    {
        request()->validate(Paise::$rules);

        $paise->update($request->all());

        return redirect()->route('paises.index')
            ->with('success', 'Paise updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $paise = Paise::find($id)->delete();

        return redirect()->route('paises.index')
            ->with('success', 'Paise deleted successfully');
    }
}
