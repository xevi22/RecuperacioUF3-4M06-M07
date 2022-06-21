<?php

namespace App\Http\Controllers;

use App\Models\Joc;
use App\Models\Reserva;
use Illuminate\Http\Request;

class JocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return Joc::all();
        }else{
            return view('Jocs.jocs');
        }
    }


    public function getRes()
    {
        return Reserva::all();
    }

    public function creaRes(Request $request)
    {
        $reserva = new Reserva();
        alert($request);

        $reserva->date = $request->date;
        $reserva->user_id = Auth::user()->id;
        $reserva->game_id = $request->game_id;
        $reserva->save();
        return $reserva;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $joc = new Joc();
        $joc->name = $request->name;
        $joc->img = $request->img;
        $joc->room_id= $request->room_id;
        $joc->save();
        return $joc;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jocDele = Joc::find($id);
        $jocDele->delete();
    }

    public function view(){
        return view('Jocs.jocs');
    }

}
