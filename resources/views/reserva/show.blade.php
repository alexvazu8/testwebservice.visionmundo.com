@extends('layouts.app')

@section('template_title')
    {{ $reserva->name ?? 'Show Reserva' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Reserva</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('reservas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Tipo Reserva:</strong>
                            {{ $reserva->tipo_reserva }}
                        </div>
                        <div class="form-group">
                            <strong>Localizador:</strong>
                            {{ $reserva->Localizador }}
                        </div>
                        <div class="form-group">
                            <strong>Importe Reserva:</strong>
                            {{ $reserva->Importe_Reserva }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Cliente:</strong>
                            {{ $reserva->Nombre_Cliente }}
                        </div>
                        <div class="form-group">
                            <strong>Numero Adultos:</strong>
                            {{ $reserva->Numero_Adultos }}
                        </div>
                        <div class="form-group">
                            <strong>Numero Menores:</strong>
                            {{ $reserva->Numero_menores }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
