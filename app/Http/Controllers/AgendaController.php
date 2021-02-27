<?php

namespace App\Http\Controllers;

use App\Agenda;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use DateInterval;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function agendarCita(Request $request){
        $validatedData = $this->validate($request, [
            'fecha' => 'required',
            'hora' => 'required',
        ]);
        $fecha=$request->input('fecha');
        $hora=$request->input('hora');
        $user = \Auth::user();
        $idUser = $user->id;
        $hoy = new  DateTime();
        $hoy->setTimezone(new DateTimeZone('America/Bogota'));
        $fechaInicio = new  DateTime($fecha.' '.$hora);
        $fechaInicioTime = $fechaInicio->format('Y-m-d H:i:s');
        $fechaFin=$fechaInicio->modify('+30 minute');
        $fechaFinTime = $fechaFin->format('Y-m-d H:i:s');
        
        $existeAgenda = Agenda::whereBetween('fechaCitaFin', [$fechaInicioTime, $fechaFinTime])->first();
        if (!$existeAgenda) {
            $nuevaAgenda = new Agenda();
            $nuevaAgenda->lugar = "Bogotá";
            $nuevaAgenda->nombre = "Diego Acosta";
            $nuevaAgenda->fechaCitaInicio = $fechaInicioTime; 
            $nuevaAgenda->fechaCitaFin = $fechaFinTime;
            $nuevaAgenda->idUser = $idUser ;
            $nuevaAgenda->estado = 1; // estado agendado
            $nuevaAgenda->save();
        }else{
            $message = "Elija otra fecha, porque ya se encuentra una cita en ese horario";
            return redirect()->route('home')->with(array(
                'message' => $message
            ));
            
            
        }
        return redirect()->route('home')->with(array(
            
        ));

    }
    public function cambiarEstadoCita(Request $request){
        $idCita=$request->input('id');
        $cita = Agenda::find($idCita);
        $cita->estado=2;
        $cita->save();
        return redirect()->route('home')->with(array(
            
        ));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        //
    }
    
}
