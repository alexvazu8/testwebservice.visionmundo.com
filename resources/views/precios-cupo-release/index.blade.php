@extends('layouts.app')

@section('template_title')
    Precios Cupo Release
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Precios Cupo Release') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('precios-cupo-releases.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Costo Habitacion</th>
										<th>Release Habitacion</th>
										<th>Cupo Habitacion</th>
										<th>Tipo Habitacion Hotel Id Tipo Habitacion Hotel</th>
										<th>Fecha Precio Cupo Release Noche</th>
										<th>Cierre</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($preciosCupoReleases as $preciosCupoRelease)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $preciosCupoRelease->Costo_habitacion }}</td>
											<td>{{ $preciosCupoRelease->Release_habitacion }}</td>
											<td>{{ $preciosCupoRelease->Cupo_habitacion }}</td>
											<td>{{ $preciosCupoRelease->Tipo_habitacion_hotel_id_tipo_habitacion_hotel }}</td>
											<td>{{ $preciosCupoRelease->Fecha_precio_cupo_release_noche }}</td>
											<td>{{ $preciosCupoRelease->Cierre }}</td>

                                            <td>
                                                <form action="{{ route('precios-cupo-releases.destroy',$preciosCupoRelease->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('precios-cupo-releases.show',$preciosCupoRelease->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('precios-cupo-releases.edit',$preciosCupoRelease->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $preciosCupoReleases->links() !!}
            </div>
        </div>
    </div>
@endsection
