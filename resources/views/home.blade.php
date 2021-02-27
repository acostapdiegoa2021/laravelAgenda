@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card-body">
                            @if(session('message'))
                                <div class="alert alert-danger">
                                        {{session('message')}}
                                </div>
                            @endif
                            <h3 class="card-title">Agendar cita</h3>
                            <form action="{{route('agendarCita')}}" method="post" enctype="multipart/form-data" >
                                {!! csrf_field()!!}
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div> 
                                @endif
                                
                                
                                    Selecciona la fecha deseada:
                                    <input type="date" class="form-control" name="fecha" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> reqquired/>
                                
                                    Selecciona la hora deseada:
                                    <input type="time" class="form-control" name="hora" min="08:00" max="16:00"  />
                                  
                                <!--<div class="form-group">
                                    <label for="nombre">fecha</label>
                                    <input type="datetime-local" class="form-control" name="fecha" id="fecha" placeholder="Introduce una fecha" required min=<?php $hoy=date("Y-m-d"); echo $hoy;?> />
                                </div>-->
                                <!--<div class="form-group">
                                    <label for="nombre">hora</label>
                                    <input type="text" class="form-control" placeholder="" name="hora" id="hora" value="{{old('hora')}}">
                                </div>-->
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Crear</button>
                            </form>
                        </div>
                    </div>

                </div>
                <br>
                <br>
                

                </div>
            </div>
            <div class="panel row">
                <div class="col-12 ">
                    <div class="card">
                        <h3 class="card-title">ver citas</h3>
                        <div class="col-12">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table  table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Lugar</th>    
                                                    <th scope="col">Especialista</th>
                                                    <th scope="col">Fecha inicio</th>
                                                    <th scope="col">fecha fin</th>
                                                    <th scope="col">Estado</th>
                                                    <th scope="col">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                @foreach($verMisAgendas as $lista) 
                                                <tr class="table">
                                                    <td>{{$lista->lugar}}</td>
                                                    <td>{{$lista->nombre}}</td>
                                                    <td>{{$lista->fechaCitaInicio}}</td>
                                                    <td>{{$lista->fechaCitaFin}}</td>
                                                    <td>
                                                        @if ($lista->estado == 1)
                                                            Agendado
                                                        @else
                                                            cancelada
                                                        @endif
                                                    </td>                                                            
                                                    <td>
                                                        <a href="#cambiarEstado{{$lista->id}}" class="btn btn-outline-danger  btn-block" data-toggle="modal"> Cancelar</a>
                                                        <div id="cambiarEstado{{$lista->id}}" class="modal fade">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        <h5 class="modal-title" id="">Cancelar cita</h5>
                                                                            <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{route('cambiarEstadoCita')}}"  method="post" enctype="multipart/form-data">
                                                                                {!! csrf_field()!!}
                                                                                <p>¿Esta seguro de cambiar el estado de este cita?</p>
                                                                                <div class="col d-none">
                                                                                        <input type="hidden" class="form-control" placeholder="id" name="id" id="id" value="{{$lista->id}}">      
                                                                                </div>  
                                                                                
                                                                                        
                                                                               
                                                                                <div class="row justify-content-end">
                                                                                    <div class="columna col-auto">
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>     
                                                                                        <button type="submit" class="btn btn-danger">Si</button>   
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </td>
                                                </tr>
                                                @endforeach 
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
