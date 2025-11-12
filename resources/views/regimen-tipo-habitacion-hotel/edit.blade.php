@extends('layouts.app')

@section('template_title')
    Update Regimen Tipo Habitacion Hotel
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Regimen Tipo Habitacion Hotel</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('regimen-tipo-habitacion-hotels.update', $regimenTipoHabitacionHotel->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('regimen-tipo-habitacion-hotel.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
