@extends('layouts.app')

@section('template_title')
    {{ $hotel->name ?? 'Show Hotel' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Hotel</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('hotels.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Hotel:</strong>
                            {{ $hotel->Id_Hotel }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Hotel:</strong>
                            {{ $hotel->Nombre_Hotel }}
                        </div>
                        <div class="form-group">
                            <strong>Numero Identificacion Tributaria:</strong>
                            {{ $hotel->Numero_identificacion_tributaria }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion Hotel:</strong>
                            {{ $hotel->Direccion_Hotel }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono Reservas Hotel:</strong>
                            {{ $hotel->Telefono_reservas_hotel }}
                        </div>
                        <div class="form-group">
                            <strong>Cel Reservas Hotel:</strong>
                            {{ $hotel->Cel_reservas_hotel }}
                        </div>
                        <div class="form-group">
                            <strong>Email Reservas Hotel:</strong>
                            {{ $hotel->email_reservas_hotel }}
                        </div>
                        <div class="form-group">
                            <strong>Email Comercial Hotel:</strong>
                            {{ $hotel->email_comercial_hotel }}
                        </div>
                        <div class="form-group">
                            <strong>Pais Id Pais:</strong>
                            {{ $hotel->Pais_Id_Pais }}
                        </div>
                        <div class="form-group">
                            <strong>Zona Id Zona:</strong>
                            {{ $hotel->Zona_Id_Zona }}
                        </div>
                        <div class="form-group">
                            <strong>Ciudad Id Ciudad:</strong>
                            {{ $hotel->ciudad_Id_ciudad }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion Hotel:</strong>
                            {{ $hotel->Descripcion_Hotel }}
                        </div>
                        <div class="form-group">
                            <strong>Latitud:</strong>
                            {{ $hotel->Latitud }}
                        </div>
                        <div class="form-group">
                            <strong>Longitud:</strong>
                            {{ $hotel->Longitud }}
                        </div>
                        <div class="form-group">
                            <strong>Foto Principal Hotel:</strong>
                            {{ $hotel->Foto_Principal_Hotel }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
