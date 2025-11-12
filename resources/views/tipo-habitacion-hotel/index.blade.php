@extends('layouts.app')

@section('template_title')
    Tipo Habitacion Hotel
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tipo Habitacion Hotel') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tipo-habitacion-hotels.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Hotel Id Hotel</th>
										<th>Tipo Habitacion General Id Tipo Habitacion General</th>
										<th>Nombre Habitacion</th>
										<th>Edad Menores Gratis</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipoHabitacionHotels as $tipoHabitacionHotel)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $tipoHabitacionHotel->Hotel_Id_Hotel }}</td>
											<td>{{ $tipoHabitacionHotel->Tipo_Habitacion_general_Id_tipo_Habitacion_general }}</td>
											<td>{{ $tipoHabitacionHotel->Nombre_Habitacion }}</td>
											<td>{{ $tipoHabitacionHotel->Edad_menores_gratis }}</td>

                                            <td>
                                                <form action="{{ route('tipo-habitacion-hotels.destroy',$tipoHabitacionHotel->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('tipo-habitacion-hotels.show',$tipoHabitacionHotel->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('tipo-habitacion-hotels.edit',$tipoHabitacionHotel->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $tipoHabitacionHotels->links() !!}
            </div>
        </div>
    </div>
@endsection
