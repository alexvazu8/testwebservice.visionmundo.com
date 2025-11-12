@extends('layouts.app')

@section('template_title')
    Detalle Reserva
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalle Reserva') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detalle-reservas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Precio Servicio</th>
										<th>Reserva Id Reserva</th>
										<th>Usuario Id</th>
										<th>Tipo Habitacion Id Tipo Habitacion Hotel</th>
										<th>Tour Id Tour</th>
										<th>Empresa Traslados Tipo Movilidades Id</th>
										<th>Costo Servicio</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalleReservas as $detalleReserva)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detalleReserva->Fecha_in }}</td>
											<td>{{ $detalleReserva->Fecha_out }}</td>
											<td>{{ $detalleReserva->Precio_Servicio }}</td>
											<td>{{ $detalleReserva->Reserva_Id_reserva }}</td>
											<td>{{ $detalleReserva->Usuario_id }}</td>
											<td>{{ $detalleReserva->Tipo_Habitacion_Id_tipo_habitacion_hotel }}</td>
											<td>{{ $detalleReserva->Tour_Id_tour }}</td>
											<td>{{ $detalleReserva->Empresa_traslados_tipo_movilidades_Id }}</td>
											<td>{{ $detalleReserva->Costo_servicio }}</td>

                                            <td>
                                                <form action="{{ route('detalle-reservas.destroy',$detalleReserva->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('detalle-reservas.show',$detalleReserva->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('detalle-reservas.edit',$detalleReserva->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $detalleReservas->links() !!}
            </div>
        </div>
    </div>
@endsection
