<?php

namespace App\Http\Controllers;

use App\Membros_oficiais;
use Illuminate\Http\Request;

class MembrosOficiaisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oficios = Membros_oficiais::orderBy('cargo_oficial')->paginate(10);
        return view('membrosoficiais/index', compact('oficios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('membrosoficiais/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $membroOficial = new Membros_oficiais();
        $membroOficial->cargo_oficial = strtoupper($request->get('cargo_oficial'));
        $membroOficial->save();

        return redirect('oficiais-igreja');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $membroOficial = Membros_oficiais::findOrFail($request->get('id_oficio'));
        $membroOficial->cargo_oficial = strtoupper($request->get('cargo_oficial'));
        $membroOficial->save();

        return redirect('oficiais-igreja');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
