@extends('layouts.app')

@section('template_title')
    {{ $fotosTour->name ?? 'Show Fotos Tour' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Fotos Tour</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('fotos-tours.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre Foto Tour:</strong>
                            {{ $fotosTour->nombre_foto_tour }}
                        </div>
                        <div class="form-group">
                            <strong>Url Foto Tour:</strong>
                            {{ $fotosTour->url_foto_tour }}
                        </div>
                        <div class="form-group">
                            <strong>Tour Id:</strong>
                            {{ $fotosTour->tour_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
