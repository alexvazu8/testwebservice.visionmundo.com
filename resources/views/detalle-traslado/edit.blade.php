@extends('layouts.app')

@section('template_title')
    Update Detalle Traslado
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Detalle Traslado</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('detalle-traslados.update', $detalleTraslado->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('detalle-traslado.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
