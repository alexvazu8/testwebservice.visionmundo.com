@extends('layouts.app')

@section('template_title')
    {{ $carritoHotel->name ?? 'Show Carrito Hotel' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Carrito Hotel</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('carrito-hotels.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fecha In:</strong>
                            {{ $carritoHotel->Fecha_In }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Out:</strong>
                            {{ $carritoHotel->Fecha_Out }}
                        </div>
                        <div class="form-group">
                            <strong>Id Tipo Habitacion Hotels:</strong>
                            {{ $carritoHotel->Id_tipo_habitacion_hotels }}
                        </div>
                        <div class="form-group">
                            <strong>Id Regimen:</strong>
                            {{ $carritoHotel->Id_regimen }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Adultos:</strong>
                            {{ $carritoHotel->Cantidad_Adultos }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Menores:</strong>
                            {{ $carritoHotel->Cantidad_Menores }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Noches:</strong>
                            {{ $carritoHotel->Cantidad_Noches }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Promedio Por Noche:</strong>
                            {{ $carritoHotel->Precio_promedio_por_noche }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Total Habitacion:</strong>
                            {{ $carritoHotel->Precio_total_habitacion }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Habitaciones:</strong>
                            {{ $carritoHotel->Cantidad_habitaciones }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Total:</strong>
                            {{ $carritoHotel->Precio_Total }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Habitacion:</strong>
                            {{ $carritoHotel->Nombre_Habitacion }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Regimen:</strong>
                            {{ $carritoHotel->Nombre_Regimen }}
                        </div>
                        <div class="form-group">
                            <strong>Carrito Compras Items Id:</strong>
                            {{ $carritoHotel->carrito_compras_items_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
