@extends('layouts.app')

@section('template_title')
    {{ $clienteDetalleReserva->name ?? 'Show Cliente Detalle Reserva' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Cliente Detalle Reserva</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('cliente-detalle-reservas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Detalle Reserva Id Detalle Reserva:</strong>
                            {{ $clienteDetalleReserva->Detalle_reserva_Id_detalle_Reserva }}
                        </div>
                        <div class="form-group">
                            <strong>Cliente Id Cliente:</strong>
                            {{ $clienteDetalleReserva->Cliente_Id_Cliente }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
