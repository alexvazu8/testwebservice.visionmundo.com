@extends('layouts.app')

@section('template_title')
    {{ $trasladosContratoCupo->name ?? 'Show Traslados Contrato Cupo' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Traslados Contrato Cupo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('traslados-contrato-cupos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Cantidad Adultos:</strong>
                            {{ $trasladosContratoCupo->Cantidad_adultos }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Menores:</strong>
                            {{ $trasladosContratoCupo->Cantidad_menores }}
                        </div>
                        <div class="form-group">
                            <strong>Costo Adulto:</strong>
                            {{ $trasladosContratoCupo->Costo_adulto }}
                        </div>
                        <div class="form-group">
                            <strong>Costo Menor:</strong>
                            {{ $trasladosContratoCupo->Costo_menor }}
                        </div>
                        <div class="form-group">
                            <strong>Edad Menor:</strong>
                            {{ $trasladosContratoCupo->Edad_menor }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Disponible:</strong>
                            {{ $trasladosContratoCupo->Fecha_disponible }}
                        </div>
                        <div class="form-group">
                            <strong>Cupo:</strong>
                            {{ $trasladosContratoCupo->Cupo }}
                        </div>
                        <div class="form-group">
                            <strong>Release:</strong>
                            {{ $trasladosContratoCupo->Release }}
                        </div>
                        <div class="form-group">
                            <strong>Cierre:</strong>
                            {{ $trasladosContratoCupo->cierre }}
                        </div>
                        <div class="form-group">
                            <strong>Hora Inicio Atencion:</strong>
                            {{ $trasladosContratoCupo->hora_inicio_atencion }}
                        </div>
                        <div class="form-group">
                            <strong>Hora Final Atencion:</strong>
                            {{ $trasladosContratoCupo->hora_final_atencion }}
                        </div>
                        <div class="form-group">
                            <strong>Empresa Traslado Tipo Movilidades Id:</strong>
                            {{ $trasladosContratoCupo->Empresa_traslado_tipo_movilidades_id }}
                        </div>
                        <div class="form-group">
                            <strong>Servicio Traslado Id:</strong>
                            {{ $trasladosContratoCupo->Servicio_traslado_Id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
