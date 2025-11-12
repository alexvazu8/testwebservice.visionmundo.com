@extends('layouts.app')

@section('template_title')
    {{ $tipoMovilidade->name ?? 'Show Tipo Movilidade' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Tipo Movilidade</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tipo-movilidades.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre Tipo Movilidad:</strong>
                            {{ $tipoMovilidade->Nombre_tipo_movilidad }}
                        </div>
                        <div class="form-group">
                            <strong>Foto Tipo Movilidad:</strong>
                            {{ $tipoMovilidade->Foto_tipo_movilidad }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
