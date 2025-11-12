@extends('layouts.app')

@section('template_title')
    {{ $zona->name ?? 'Show Zona' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Zona</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('zonas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Zona:</strong>
                            {{ $zona->Id_Zona }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Zona:</strong>
                            {{ $zona->Nombre_Zona }}
                        </div>
                        <div class="form-group">
                            <strong>Ciudad Id Ciudad:</strong>
                            {{ $zona->Ciudad_Id_Ciudad }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
