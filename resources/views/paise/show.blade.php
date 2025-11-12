@extends('layouts.app')

@section('template_title')
    {{ $paise->name ?? 'Show Paise' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Paise</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('paises.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Pais:</strong>
                            {{ $paise->Id_Pais }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Pais:</strong>
                            {{ $paise->Nombre_Pais }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
