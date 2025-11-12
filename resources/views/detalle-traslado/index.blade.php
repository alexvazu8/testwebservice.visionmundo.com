@extends('layouts.app')

@section('template_title')
    Detalle Traslado
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalle Traslado') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detalle-traslados.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Detalle Reservas Id</th>
										<th>Empresa Traslados Tipo Movilidades Id</th>
										<th>Fecha Servicio</th>
										<th>Hora Servicio</th>
										<th>Precio Adulto</th>
										<th>Precio Menor</th>
										<th>Precio Total</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalleTraslados as $detalleTraslado)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detalleTraslado->Cantidad_Adultos }}</td>
											<td>{{ $detalleTraslado->Cantidad_Menores }}</td>
											<td>{{ $detalleTraslado->detalle_reservas_id }}</td>
											<td>{{ $detalleTraslado->Empresa_traslados_tipo_movilidades_id }}</td>
											<td>{{ $detalleTraslado->fecha_servicio }}</td>
											<td>{{ $detalleTraslado->hora_servicio }}</td>
											<td>{{ $detalleTraslado->Precio_Adulto }}</td>
											<td>{{ $detalleTraslado->Precio_Menor }}</td>
											<td>{{ $detalleTraslado->Precio_Total }}</td>

                                            <td>
                                                <form action="{{ route('detalle-traslados.destroy',$detalleTraslado->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('detalle-traslados.show',$detalleTraslado->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('detalle-traslados.edit',$detalleTraslado->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $detalleTraslados->links() !!}
            </div>
        </div>
    </div>
@endsection
