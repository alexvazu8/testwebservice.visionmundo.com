@extends('layouts.app')

@section('template_title')
    {{ $carritoTour->name ?? 'Show Carrito Tour' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Carrito Tour</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('carrito-tours.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fecha In:</strong>
                            {{ $carritoTour->Fecha_In }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Out:</strong>
                            {{ $carritoTour->Fecha_Out }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Adultos:</strong>
                            {{ $carritoTour->Cantidad_Adultos }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Menores:</strong>
                            {{ $carritoTour->Cantidad_Menores }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Adulto:</strong>
                            {{ $carritoTour->Precio_Adulto }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Menor:</strong>
                            {{ $carritoTour->Precio_Menor }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Total:</strong>
                            {{ $carritoTour->Precio_Total }}
                        </div>
                        <div class="form-group">
                            <strong>Id Tours:</strong>
                            {{ $carritoTour->id_tours }}
                        </div>
                        <div class="form-group">
                            <strong>Carrito Compras Items Id:</strong>
                            {{ $carritoTour->carrito_compras_items_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
