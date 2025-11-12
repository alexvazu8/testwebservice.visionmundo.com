@extends('layouts.app')

@section('template_title')
    {{ $carritoTraslado->name ?? 'Show Carrito Traslado' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Carrito Traslado</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('carrito-traslados.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fecha Servicio:</strong>
                            {{ $carritoTraslado->fecha_servicio }}
                        </div>
                        <div class="form-group">
                            <strong>Hora Servicio:</strong>
                            {{ $carritoTraslado->hora_servicio }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Adultos:</strong>
                            {{ $carritoTraslado->Cantidad_Adultos }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Menores:</strong>
                            {{ $carritoTraslado->Cantidad_Menores }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Adulto:</strong>
                            {{ $carritoTraslado->Precio_Adulto }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Menor:</strong>
                            {{ $carritoTraslado->Precio_Menor }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Total:</strong>
                            {{ $carritoTraslado->Precio_Total }}
                        </div>
                        <div class="form-group">
                            <strong>Empresa Traslados Tipo Movilidades Id:</strong>
                            {{ $carritoTraslado->Empresa_traslados_tipo_movilidades_id }}
                        </div>
                        <div class="form-group">
                            <strong>Carrito Compras Items Id:</strong>
                            {{ $carritoTraslado->carrito_compras_items_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
