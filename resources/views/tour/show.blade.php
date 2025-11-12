@extends('layouts.app')

@section('template_title')
    {{ $tour->name ?? 'Show Tour' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Tour</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tours.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre Tour:</strong>
                            {{ $tour->Nombre_tour }}
                        </div>
                        <div class="form-group">
                            <strong>Email Contacto Tour:</strong>
                            {{ $tour->Email_contacto_tour }}
                        </div>
                        <div class="form-group">
                            <strong>Foto Tours:</strong>
                            {{ $tour->Foto_tours }}
                        </div>
                        <div class="form-group">
                            <strong>Detalle Tour:</strong>
                            {{ $tour->Detalle_tour }}
                        </div>
                        <div class="form-group">
                            <strong>Recojo Hotel:</strong>
                            {{ $tour->Recojo_hotel }}
                        </div>
                        <div class="form-group">
                            <strong>Punto Encuentro:</strong>
                            {{ $tour->Punto_encuentro }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Dias Tour:</strong>
                            {{ $tour->cantidad_dias_tour }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Noches Tour:</strong>
                            {{ $tour->cantidad_noches_tour }}
                        </div>
                        <div class="form-group">
                            <strong>Horario Inicio:</strong>
                            {{ $tour->Horario_inicio }}
                        </div>
                        <div class="form-group">
                            <strong>Hora Fin:</strong>
                            {{ $tour->Hora_fin }}
                        </div>
                        <div class="form-group">
                            <strong>Entregan Agua:</strong>
                            {{ $tour->Entregan_agua }}
                        </div>
                        <div class="form-group">
                            <strong>Para Discapacitados:</strong>
                            {{ $tour->Para_discapacitados }}
                        </div>
                        <div class="form-group">
                            <strong>Con Bano:</strong>
                            {{ $tour->Con_bano }}
                        </div>
                        <div class="form-group">
                            <strong>Pais Id Pais:</strong>
                            {{ $tour->Pais_Id_Pais }}
                        </div>
                        <div class="form-group">
                            <strong>Ciudad Id Ciudad:</strong>
                            {{ $tour->Ciudad_Id_Ciudad }}
                        </div>
                        <div class="form-group">
                            <strong>Zona Id Zona:</strong>
                            {{ $tour->Zona_Id_Zona }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
