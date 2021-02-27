<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $idUser = $user->id;
        $verMisAgendas=Agenda::where('idUser',$idUser)->get();
        return view('home', array(
            "verMisAgendas" => $verMisAgendas
        ));
        
    }
}
