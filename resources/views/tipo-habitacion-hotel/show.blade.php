@extends('layouts.app')

@section('template_title')
    {{ $tipoHabitacionHotel->name ?? 'Show Tipo Habitacion Hotel' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Tipo Habitacion Hotel</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tipo-habitacion-hotels.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Hotel Id Hotel:</strong>
                            {{ $tipoHabitacionHotel->Hotel_Id_Hotel }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo Habitacion General Id Tipo Habitacion General:</strong>
                            {{ $tipoHabitacionHotel->Tipo_Habitacion_general_Id_tipo_Habitacion_general }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Habitacion:</strong>
                            {{ $tipoHabitacionHotel->Nombre_Habitacion }}
                        </div>
                        <div class="form-group">
                            <strong>Edad Menores Gratis:</strong>
                            {{ $tipoHabitacionHotel->Edad_menores_gratis }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
