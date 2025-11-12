@extends('layouts.app')

@section('template_title')
    {{ $detalleTour->name ?? 'Show Detalle Tour' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Detalle Tour</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detalle-tours.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Cantidad Adultos:</strong>
                            {{ $detalleTour->Cantidad_Adultos }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Menores:</strong>
                            {{ $detalleTour->Cantidad_Menores }}
                        </div>
                        <div class="form-group">
                            <strong>Detalle Reservas Id:</strong>
                            {{ $detalleTour->detalle_reservas_id }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha In:</strong>
                            {{ $detalleTour->Fecha_In }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Out:</strong>
                            {{ $detalleTour->Fecha_Out }}
                        </div>
                        <div class="form-group">
                            <strong>Id Tours:</strong>
                            {{ $detalleTour->Id_tours }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Adulto:</strong>
                            {{ $detalleTour->Precio_Adulto }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Menor:</strong>
                            {{ $detalleTour->Precio_Menor }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Total:</strong>
                            {{ $detalleTour->Precio_Total }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
