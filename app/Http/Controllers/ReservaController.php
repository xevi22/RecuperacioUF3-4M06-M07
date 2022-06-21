<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            if (auth()->id() === 1){
                return Reserva::all()->where('isAccepted',0);
            }else{
                return Reserva::all()->where('user_id', auth()->user()->getAuthIdentifier())->where('isAccepted',0);
            }
        }else{
            return view('Reserves.reserves');
        }
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
        $reserva = new Reserva();
        $reserva->date = $request->date;
        $reserva->user_id = auth()->user()->getAuthIdentifier();
        $reserva->game_id= $request->game_id;
        $reserva->isAccepted=0;
        $reserva->save();
        return $reserva;
    }

    public function takeUserLoged(){
        return auth()->user()->getAuthIdentifier();
    }

    public function takeResValo(){
        return Reserva::all()->where('isAccepted',1);
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
    public function update($id)
    {
        $res = Reserva::find($id);
        $res->isAccepted = 1;
        $res->save();
        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resDele = Reserva::find($id);
        $resDele->delete();
    }
}
