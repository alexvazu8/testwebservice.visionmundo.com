@extends('layouts.app')

@section('template_title')
    Carrito Compras Item
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Carrito Compras Item') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('carrito-compras-items.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Usuario Id</th>
										<th>Tipo Servicio</th>
										<th>Costo Total</th>
										<th>Precio Total</th>
										<th>Token</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carritoComprasItems as $carritoComprasItem)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $carritoComprasItem->Usuario_id }}</td>
											<td>{{ $carritoComprasItem->Tipo_servicio }}</td>
											<td>{{ $carritoComprasItem->Costo_Total }}</td>
											<td>{{ $carritoComprasItem->Precio_Total }}</td>
											<td>{{ $carritoComprasItem->token }}</td>

                                            <td>
                                                <form action="{{ route('carrito-compras-items.destroy',$carritoComprasItem->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('carrito-compras-items.show',$carritoComprasItem->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('carrito-compras-items.edit',$carritoComprasItem->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $carritoComprasItems->links() !!}
            </div>
        </div>
    </div>
@endsection
