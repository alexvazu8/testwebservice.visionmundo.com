@extends('layouts.app')

@section('template_title')
    Update Detalle Hotel
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Detalle Hotel</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('detalle-hotels.update', $detalleHotel->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('detalle-hotel.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
