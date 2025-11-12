@extends('layouts.app')

@section('template_title')
    {{ $carritoComprasItem->name ?? 'Show Carrito Compras Item' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Carrito Compras Item</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('carrito-compras-items.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Usuario Id:</strong>
                            {{ $carritoComprasItem->Usuario_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo Servicio:</strong>
                            {{ $carritoComprasItem->Tipo_servicio }}
                        </div>
                        <div class="form-group">
                            <strong>Costo Total:</strong>
                            {{ $carritoComprasItem->Costo_Total }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Total:</strong>
                            {{ $carritoComprasItem->Precio_Total }}
                        </div>
                        <div class="form-group">
                            <strong>Token:</strong>
                            {{ $carritoComprasItem->token }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
