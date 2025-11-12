@extends('layouts.app')

@section('template_title')
    Detalle Tour
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalle Tour') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detalle-tours.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Fecha In</th>
										<th>Fecha Out</th>
										<th>Id Tours</th>
										<th>Precio Adulto</th>
										<th>Precio Menor</th>
										<th>Precio Total</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalleTours as $detalleTour)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detalleTour->Cantidad_Adultos }}</td>
											<td>{{ $detalleTour->Cantidad_Menores }}</td>
											<td>{{ $detalleTour->detalle_reservas_id }}</td>
											<td>{{ $detalleTour->Fecha_In }}</td>
											<td>{{ $detalleTour->Fecha_Out }}</td>
											<td>{{ $detalleTour->Id_tours }}</td>
											<td>{{ $detalleTour->Precio_Adulto }}</td>
											<td>{{ $detalleTour->Precio_Menor }}</td>
											<td>{{ $detalleTour->Precio_Total }}</td>

                                            <td>
                                                <form action="{{ route('detalle-tours.destroy',$detalleTour->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('detalle-tours.show',$detalleTour->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('detalle-tours.edit',$detalleTour->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $detalleTours->links() !!}
            </div>
        </div>
    </div>
@endsection
