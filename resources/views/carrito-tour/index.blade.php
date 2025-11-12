@extends('layouts.app')

@section('template_title')
    Carrito Tour
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Carrito Tour') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('carrito-tours.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Cantidad Adultos</th>
										<th>Cantidad Menores</th>
										<th>Precio Adulto</th>
										<th>Precio Menor</th>
										<th>Precio Total</th>
										<th>Id Tours</th>
										<th>Carrito Compras Items Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carritoTours as $carritoTour)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $carritoTour->Fecha_In }}</td>
											<td>{{ $carritoTour->Fecha_Out }}</td>
											<td>{{ $carritoTour->Cantidad_Adultos }}</td>
											<td>{{ $carritoTour->Cantidad_Menores }}</td>
											<td>{{ $carritoTour->Precio_Adulto }}</td>
											<td>{{ $carritoTour->Precio_Menor }}</td>
											<td>{{ $carritoTour->Precio_Total }}</td>
											<td>{{ $carritoTour->id_tours }}</td>
											<td>{{ $carritoTour->carrito_compras_items_id }}</td>

                                            <td>
                                                <form action="{{ route('carrito-tours.destroy',$carritoTour->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('carrito-tours.show',$carritoTour->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('carrito-tours.edit',$carritoTour->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $carritoTours->links() !!}
            </div>
        </div>
    </div>
@endsection
