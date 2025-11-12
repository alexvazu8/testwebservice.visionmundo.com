@extends('layouts.app')

@section('template_title')
    Carrito Hotel
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Carrito Hotel') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('carrito-hotels.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Fecha In</th>
										<th>Fecha Out</th>
										<th>Id Tipo Habitacion Hotels</th>
										<th>Id Regimen</th>
										<th>Cantidad Adultos</th>
										<th>Cantidad Menores</th>
										<th>Cantidad Noches</th>
										<th>Precio Promedio Por Noche</th>
										<th>Precio Total Habitacion</th>
										<th>Cantidad Habitaciones</th>
										<th>Precio Total</th>
										<th>Nombre Habitacion</th>
										<th>Nombre Regimen</th>
										<th>Carrito Compras Items Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carritoHotels as $carritoHotel)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $carritoHotel->Fecha_In }}</td>
											<td>{{ $carritoHotel->Fecha_Out }}</td>
											<td>{{ $carritoHotel->Id_tipo_habitacion_hotels }}</td>
											<td>{{ $carritoHotel->Id_regimen }}</td>
											<td>{{ $carritoHotel->Cantidad_Adultos }}</td>
											<td>{{ $carritoHotel->Cantidad_Menores }}</td>
											<td>{{ $carritoHotel->Cantidad_Noches }}</td>
											<td>{{ $carritoHotel->Precio_promedio_por_noche }}</td>
											<td>{{ $carritoHotel->Precio_total_habitacion }}</td>
											<td>{{ $carritoHotel->Cantidad_habitaciones }}</td>
											<td>{{ $carritoHotel->Precio_Total }}</td>
											<td>{{ $carritoHotel->Nombre_Habitacion }}</td>
											<td>{{ $carritoHotel->Nombre_Regimen }}</td>
											<td>{{ $carritoHotel->carrito_compras_items_id }}</td>

                                            <td>
                                                <form action="{{ route('carrito-hotels.destroy',$carritoHotel->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('carrito-hotels.show',$carritoHotel->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('carrito-hotels.edit',$carritoHotel->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $carritoHotels->links() !!}
            </div>
        </div>
    </div>
@endsection
