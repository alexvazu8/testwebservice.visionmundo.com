@extends('layouts.app')

@section('template_title')
    Hotel
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Hotel') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('hotels.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Id Hotel</th>
										<th>Nombre Hotel</th>
										<th>Numero Identificacion Tributaria</th>
										<th>Direccion Hotel</th>
										<th>Telefono Reservas Hotel</th>
										<th>Cel Reservas Hotel</th>
										<th>Email Reservas Hotel</th>
										<th>Email Comercial Hotel</th>
										<th>Pais Id Pais</th>
										<th>Zona Id Zona</th>
										<th>Ciudad Id Ciudad</th>
										<th>Descripcion Hotel</th>
										<th>Latitud</th>
										<th>Longitud</th>
										<th>Foto Principal Hotel</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hotels as $hotel)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $hotel->Id_Hotel }}</td>
											<td>{{ $hotel->Nombre_Hotel }}</td>
											<td>{{ $hotel->Numero_identificacion_tributaria }}</td>
											<td>{{ $hotel->Direccion_Hotel }}</td>
											<td>{{ $hotel->Telefono_reservas_hotel }}</td>
											<td>{{ $hotel->Cel_reservas_hotel }}</td>
											<td>{{ $hotel->email_reservas_hotel }}</td>
											<td>{{ $hotel->email_comercial_hotel }}</td>
											<td>{{ $hotel->Pais_Id_Pais }}</td>
											<td>{{ $hotel->Zona_Id_Zona }}</td>
											<td>{{ $hotel->ciudad_Id_ciudad }}</td>
											<td>{{ $hotel->Descripcion_Hotel }}</td>
											<td>{{ $hotel->Latitud }}</td>
											<td>{{ $hotel->Longitud }}</td>
											<td>{{ $hotel->Foto_Principal_Hotel }}</td>

                                            <td>
                                                <form action="{{ route('hotels.destroy',$hotel->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('hotels.show',$hotel->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('hotels.edit',$hotel->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $hotels->links() !!}
            </div>
        </div>
    </div>
@endsection
