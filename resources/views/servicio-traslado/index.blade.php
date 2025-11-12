@extends('layouts.app')

@section('template_title')
    Servicio Traslado
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Servicio Traslado') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('servicio-traslados.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Nombre Servicio</th>
										<th>Detalle Servicio</th>
										<th>Tipo Servicio Tansfer</th>
										<th>Empresa Traslado Tipo Movilidades Id</th>
										<th>Zona Origen Id</th>
										<th>Zona Destino Id</th>
										<th>Email Contacto Traslado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicioTraslados as $servicioTraslado)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $servicioTraslado->Nombre_Servicio }}</td>
											<td>{{ $servicioTraslado->Detalle_servicio }}</td>
											<td>{{ $servicioTraslado->Tipo_servicio_tansfer }}</td>
											<td>{{ $servicioTraslado->empresa_traslado_tipo_movilidades_Id }}</td>
											<td>{{ $servicioTraslado->Zona_Origen_id }}</td>
											<td>{{ $servicioTraslado->Zona_Destino_id }}</td>
											<td>{{ $servicioTraslado->Email_contacto_traslado }}</td>

                                            <td>
                                                <form action="{{ route('servicio-traslados.destroy',$servicioTraslado->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('servicio-traslados.show',$servicioTraslado->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('servicio-traslados.edit',$servicioTraslado->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $servicioTraslados->links() !!}
            </div>
        </div>
    </div>
@endsection
