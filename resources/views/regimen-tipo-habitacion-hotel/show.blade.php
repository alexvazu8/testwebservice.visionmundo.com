@extends('layouts.app')

@section('template_title')
    {{ $regimenTipoHabitacionHotel->name ?? 'Show Regimen Tipo Habitacion Hotel' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Regimen Tipo Habitacion Hotel</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('regimen-tipo-habitacion-hotels.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Costo Regimen:</strong>
                            {{ $regimenTipoHabitacionHotel->costo_regimen }}
                        </div>
                        <div class="form-group">
                            <strong>Id Tipo Habitacion Hotel:</strong>
                            {{ $regimenTipoHabitacionHotel->id_tipo_habitacion_hotel }}
                        </div>
                        <div class="form-group">
                            <strong>Id Regimen:</strong>
                            {{ $regimenTipoHabitacionHotel->id_regimen }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
