@extends('layouts.app')

@section('template_title')
    Create Cliente Detalle Reserva
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Cliente Detalle Reserva</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cliente-detalle-reservas.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('cliente-detalle-reserva.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
