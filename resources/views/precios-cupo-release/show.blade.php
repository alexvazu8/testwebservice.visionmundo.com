@extends('layouts.app')

@section('template_title')
    {{ $preciosCupoRelease->name ?? 'Show Precios Cupo Release' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Precios Cupo Release</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('precios-cupo-releases.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Costo Habitacion:</strong>
                            {{ $preciosCupoRelease->Costo_habitacion }}
                        </div>
                        <div class="form-group">
                            <strong>Release Habitacion:</strong>
                            {{ $preciosCupoRelease->Release_habitacion }}
                        </div>
                        <div class="form-group">
                            <strong>Cupo Habitacion:</strong>
                            {{ $preciosCupoRelease->Cupo_habitacion }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo Habitacion Hotel Id Tipo Habitacion Hotel:</strong>
                            {{ $preciosCupoRelease->Tipo_habitacion_hotel_id_tipo_habitacion_hotel }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Precio Cupo Release Noche:</strong>
                            {{ $preciosCupoRelease->Fecha_precio_cupo_release_noche }}
                        </div>
                        <div class="form-group">
                            <strong>Cierre:</strong>
                            {{ $preciosCupoRelease->Cierre }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
