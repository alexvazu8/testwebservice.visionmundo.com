@extends('layouts.app')

@section('template_title')
    {{ $ciudade->name ?? 'Show Ciudade' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Ciudade</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ciudades.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Ciudad:</strong>
                            {{ $ciudade->Id_Ciudad }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Ciudad:</strong>
                            {{ $ciudade->Nombre_Ciudad }}
                        </div>
                        <div class="form-group">
                            <strong>Pais Id Pais:</strong>
                            {{ $ciudade->Pais_Id_Pais }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
