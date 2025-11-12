@extends('layouts.app')

@section('template_title')
    {{ $estrella->name ?? 'Show Estrella' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Estrella</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('estrellas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Estrellas:</strong>
                            {{ $estrella->estrellas }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo Categoria:</strong>
                            {{ $estrella->tipo_categoria }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
