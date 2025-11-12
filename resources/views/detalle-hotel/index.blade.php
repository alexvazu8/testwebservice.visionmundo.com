@extends('layouts.app')

@section('template_title')
    Detalle Hotel
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalle Hotel') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detalle-hotels.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Cantidad Adultos</th>
										<th>Cantidad Menores</th>
										<th>Cantidad Noches</th>
										<th>Fecha In</th>
										<th>Fecha Out</th>
										<th>Id Regimen</th>
										<th>Id Tipo Habitacion Hotels</th>
										<th>Nombre Habitacion</th>
										<th>Nombre Regimen</th>
										<th>Precio Promedio Por Noche</th>
										<th>Precio Total</th>
										<th>Precio Total Habitacion</th>
										<th>Cantidad Habitaciones</th>
										<th>Detalle Reserva Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalleHotels as $detalleHotel)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detalleHotel->Cantidad_Adultos }}</td>
											<td>{{ $detalleHotel->Cantidad_Menores }}</td>
											<td>{{ $detalleHotel->Cantidad_Noches }}</td>
											<td>{{ $detalleHotel->Fecha_In }}</td>
											<td>{{ $detalleHotel->Fecha_Out }}</td>
											<td>{{ $detalleHotel->Id_regimen }}</td>
											<td>{{ $detalleHotel->Id_tipo_habitacion_hotels }}</td>
											<td>{{ $detalleHotel->Nombre_Habitacion }}</td>
											<td>{{ $detalleHotel->Nombre_Regimen }}</td>
											<td>{{ $detalleHotel->Precio_promedio_por_noche }}</td>
											<td>{{ $detalleHotel->Precio_Total }}</td>
											<td>{{ $detalleHotel->Precio_total_habitacion }}</td>
											<td>{{ $detalleHotel->Cantidad_habitaciones }}</td>
											<td>{{ $detalleHotel->detalle_reserva_id }}</td>

                                            <td>
                                                <form action="{{ route('detalle-hotels.destroy',$detalleHotel->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('detalle-hotels.show',$detalleHotel->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('detalle-hotels.edit',$detalleHotel->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $detalleHotels->links() !!}
            </div>
        </div>
    </div>
@endsection
