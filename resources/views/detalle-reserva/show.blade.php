@extends('layouts.app')

@section('template_title')
    {{ $detalleReserva->name ?? 'Show Detalle Reserva' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Detalle Reserva</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detalle-reservas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fecha In:</strong>
                            {{ $detalleReserva->Fecha_in }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Out:</strong>
                            {{ $detalleReserva->Fecha_out }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Servicio:</strong>
                            {{ $detalleReserva->Precio_Servicio }}
                        </div>
                        <div class="form-group">
                            <strong>Reserva Id Reserva:</strong>
                            {{ $detalleReserva->Reserva_Id_reserva }}
                        </div>
                        <div class="form-group">
                            <strong>Usuario Id:</strong>
                            {{ $detalleReserva->Usuario_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo Habitacion Id Tipo Habitacion Hotel:</strong>
                            {{ $detalleReserva->Tipo_Habitacion_Id_tipo_habitacion_hotel }}
                        </div>
                        <div class="form-group">
                            <strong>Tour Id Tour:</strong>
                            {{ $detalleReserva->Tour_Id_tour }}
                        </div>
                        <div class="form-group">
                            <strong>Empresa Traslados Tipo Movilidades Id:</strong>
                            {{ $detalleReserva->Empresa_traslados_tipo_movilidades_Id }}
                        </div>
                        <div class="form-group">
                            <strong>Costo Servicio:</strong>
                            {{ $detalleReserva->Costo_servicio }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
