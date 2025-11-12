@extends('layouts.app')

@section('template_title')
    {{ $cliente->name ?? 'Show Cliente' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Cliente</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('clientes.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Documento Id Cliente:</strong>
                            {{ $cliente->Documento_Id_Cliente }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Cliente:</strong>
                            {{ $cliente->Nombre_Cliente }}
                        </div>
                        <div class="form-group">
                            <strong>Apellido Cliente:</strong>
                            {{ $cliente->Apellido_Cliente }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono Emergencias Cliente:</strong>
                            {{ $cliente->Telefono_emergencias_Cliente }}
                        </div>
                        <div class="form-group">
                            <strong>Mail Emergencias Cliente:</strong>
                            {{ $cliente->Mail_emergencias_cliente }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
