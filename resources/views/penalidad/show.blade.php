@extends('layouts.app')

@section('template_title')
    {{ $penalidad->name ?? 'Show Penalidad' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Penalidad</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('penalidads.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Porcentaje Penalidad Por Noche:</strong>
                            {{ $penalidad->porcentaje_penalidad_por_noche }}
                        </div>
                        <div class="form-group">
                            <strong>Desde Noches Antes:</strong>
                            {{ $penalidad->desde_noches_antes }}
                        </div>
                        <div class="form-group">
                            <strong>Hasta Noches Antes:</strong>
                            {{ $penalidad->hasta_noches_antes }}
                        </div>
                        <div class="form-group">
                            <strong>Politica Id:</strong>
                            {{ $penalidad->politica_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
