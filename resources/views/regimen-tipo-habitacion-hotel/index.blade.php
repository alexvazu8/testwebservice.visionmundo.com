@extends('layouts.app')

@section('template_title')
    Regimen Tipo Habitacion Hotel
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Regimen Tipo Habitacion Hotel') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('regimen-tipo-habitacion-hotels.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Costo Regimen</th>
										<th>Id Tipo Habitacion Hotel</th>
										<th>Id Regimen</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($regimenTipoHabitacionHotels as $regimenTipoHabitacionHotel)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $regimenTipoHabitacionHotel->costo_regimen }}</td>
											<td>{{ $regimenTipoHabitacionHotel->id_tipo_habitacion_hotel }}</td>
											<td>{{ $regimenTipoHabitacionHotel->id_regimen }}</td>

                                            <td>
                                                <form action="{{ route('regimen-tipo-habitacion-hotels.destroy',$regimenTipoHabitacionHotel->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('regimen-tipo-habitacion-hotels.show',$regimenTipoHabitacionHotel->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('regimen-tipo-habitacion-hotels.edit',$regimenTipoHabitacionHotel->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $regimenTipoHabitacionHotels->links() !!}
            </div>
        </div>
    </div>
@endsection
