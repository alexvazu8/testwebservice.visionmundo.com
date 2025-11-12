@extends('layouts.app')

@section('template_title')
    {{ $detalleHotel->name ?? 'Show Detalle Hotel' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Detalle Hotel</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detalle-hotels.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Cantidad Adultos:</strong>
                            {{ $detalleHotel->Cantidad_Adultos }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Menores:</strong>
                            {{ $detalleHotel->Cantidad_Menores }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Noches:</strong>
                            {{ $detalleHotel->Cantidad_Noches }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha In:</strong>
                            {{ $detalleHotel->Fecha_In }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Out:</strong>
                            {{ $detalleHotel->Fecha_Out }}
                        </div>
                        <div class="form-group">
                            <strong>Id Regimen:</strong>
                            {{ $detalleHotel->Id_regimen }}
                        </div>
                        <div class="form-group">
                            <strong>Id Tipo Habitacion Hotels:</strong>
                            {{ $detalleHotel->Id_tipo_habitacion_hotels }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Habitacion:</strong>
                            {{ $detalleHotel->Nombre_Habitacion }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Regimen:</strong>
                            {{ $detalleHotel->Nombre_Regimen }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Promedio Por Noche:</strong>
                            {{ $detalleHotel->Precio_promedio_por_noche }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Total:</strong>
                            {{ $detalleHotel->Precio_Total }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Total Habitacion:</strong>
                            {{ $detalleHotel->Precio_total_habitacion }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Habitaciones:</strong>
                            {{ $detalleHotel->Cantidad_habitaciones }}
                        </div>
                        <div class="form-group">
                            <strong>Detalle Reserva Id:</strong>
                            {{ $detalleHotel->detalle_reserva_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
