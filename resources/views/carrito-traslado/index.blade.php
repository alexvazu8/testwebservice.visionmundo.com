@extends('layouts.app')

@section('template_title')
    Carrito Traslado
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Carrito Traslado') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('carrito-traslados.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Fecha Servicio</th>
										<th>Hora Servicio</th>
										<th>Cantidad Adultos</th>
										<th>Cantidad Menores</th>
										<th>Precio Adulto</th>
										<th>Precio Menor</th>
										<th>Precio Total</th>
										<th>Empresa Traslados Tipo Movilidades Id</th>
										<th>Carrito Compras Items Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carritoTraslados as $carritoTraslado)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $carritoTraslado->fecha_servicio }}</td>
											<td>{{ $carritoTraslado->hora_servicio }}</td>
											<td>{{ $carritoTraslado->Cantidad_Adultos }}</td>
											<td>{{ $carritoTraslado->Cantidad_Menores }}</td>
											<td>{{ $carritoTraslado->Precio_Adulto }}</td>
											<td>{{ $carritoTraslado->Precio_Menor }}</td>
											<td>{{ $carritoTraslado->Precio_Total }}</td>
											<td>{{ $carritoTraslado->Empresa_traslados_tipo_movilidades_id }}</td>
											<td>{{ $carritoTraslado->carrito_compras_items_id }}</td>

                                            <td>
                                                <form action="{{ route('carrito-traslados.destroy',$carritoTraslado->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('carrito-traslados.show',$carritoTraslado->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('carrito-traslados.edit',$carritoTraslado->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $carritoTraslados->links() !!}
            </div>
        </div>
    </div>
@endsection
