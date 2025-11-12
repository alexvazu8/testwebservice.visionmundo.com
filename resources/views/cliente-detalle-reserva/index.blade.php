@extends('layouts.app')

@section('template_title')
    Cliente Detalle Reserva
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Cliente Detalle Reserva') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('cliente-detalle-reservas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Detalle Reserva Id Detalle Reserva</th>
										<th>Cliente Id Cliente</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clienteDetalleReservas as $clienteDetalleReserva)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $clienteDetalleReserva->Detalle_reserva_Id_detalle_Reserva }}</td>
											<td>{{ $clienteDetalleReserva->Cliente_Id_Cliente }}</td>

                                            <td>
                                                <form action="{{ route('cliente-detalle-reservas.destroy',$clienteDetalleReserva->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('cliente-detalle-reservas.show',$clienteDetalleReserva->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('cliente-detalle-reservas.edit',$clienteDetalleReserva->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $clienteDetalleReservas->links() !!}
            </div>
        </div>
    </div>
@endsection
