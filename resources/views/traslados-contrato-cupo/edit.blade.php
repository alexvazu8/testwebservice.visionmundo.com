@extends('layouts.app')

@section('template_title')
    Update Traslados Contrato Cupo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Traslados Contrato Cupo</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('traslados-contrato-cupos.update', $trasladosContratoCupo->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('traslados-contrato-cupo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
