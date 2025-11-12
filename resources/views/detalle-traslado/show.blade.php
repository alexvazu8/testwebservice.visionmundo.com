@extends('layouts.app')

@section('template_title')
    {{ $detalleTraslado->name ?? 'Show Detalle Traslado' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Detalle Traslado</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detalle-traslados.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Cantidad Adultos:</strong>
                            {{ $detalleTraslado->Cantidad_Adultos }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Menores:</strong>
                            {{ $detalleTraslado->Cantidad_Menores }}
                        </div>
                        <div class="form-group">
                            <strong>Detalle Reservas Id:</strong>
                            {{ $detalleTraslado->detalle_reservas_id }}
                        </div>
                        <div class="form-group">
                            <strong>Empresa Traslados Tipo Movilidades Id:</strong>
                            {{ $detalleTraslado->Empresa_traslados_tipo_movilidades_id }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Servicio:</strong>
                            {{ $detalleTraslado->fecha_servicio }}
                        </div>
                        <div class="form-group">
                            <strong>Hora Servicio:</strong>
                            {{ $detalleTraslado->hora_servicio }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Adulto:</strong>
                            {{ $detalleTraslado->Precio_Adulto }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Menor:</strong>
                            {{ $detalleTraslado->Precio_Menor }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Total:</strong>
                            {{ $detalleTraslado->Precio_Total }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
