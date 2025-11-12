@extends('layouts.app')

@section('template_title')
    {{ $servicioTraslado->name ?? 'Show Servicio Traslado' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Servicio Traslado</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('servicio-traslados.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre Servicio:</strong>
                            {{ $servicioTraslado->Nombre_Servicio }}
                        </div>
                        <div class="form-group">
                            <strong>Detalle Servicio:</strong>
                            {{ $servicioTraslado->Detalle_servicio }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo Servicio Tansfer:</strong>
                            {{ $servicioTraslado->Tipo_servicio_tansfer }}
                        </div>
                        <div class="form-group">
                            <strong>Empresa Traslado Tipo Movilidades Id:</strong>
                            {{ $servicioTraslado->empresa_traslado_tipo_movilidades_Id }}
                        </div>
                        <div class="form-group">
                            <strong>Zona Origen Id:</strong>
                            {{ $servicioTraslado->Zona_Origen_id }}
                        </div>
                        <div class="form-group">
                            <strong>Zona Destino Id:</strong>
                            {{ $servicioTraslado->Zona_Destino_id }}
                        </div>
                        <div class="form-group">
                            <strong>Email Contacto Traslado:</strong>
                            {{ $servicioTraslado->Email_contacto_traslado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
