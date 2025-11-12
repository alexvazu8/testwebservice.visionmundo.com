@extends('layouts.app')

@section('template_title')
    Traslados Contrato Cupo
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Traslados Contrato Cupo') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('traslados-contrato-cupos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Costo Adulto</th>
										<th>Costo Menor</th>
										<th>Edad Menor</th>
										<th>Fecha Disponible</th>
										<th>Cupo</th>
										<th>Release</th>
										<th>Cierre</th>
										<th>Hora Inicio Atencion</th>
										<th>Hora Final Atencion</th>
										<th>Empresa Traslado Tipo Movilidades Id</th>
										<th>Servicio Traslado Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trasladosContratoCupos as $trasladosContratoCupo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $trasladosContratoCupo->Cantidad_adultos }}</td>
											<td>{{ $trasladosContratoCupo->Cantidad_menores }}</td>
											<td>{{ $trasladosContratoCupo->Costo_adulto }}</td>
											<td>{{ $trasladosContratoCupo->Costo_menor }}</td>
											<td>{{ $trasladosContratoCupo->Edad_menor }}</td>
											<td>{{ $trasladosContratoCupo->Fecha_disponible }}</td>
											<td>{{ $trasladosContratoCupo->Cupo }}</td>
											<td>{{ $trasladosContratoCupo->Release }}</td>
											<td>{{ $trasladosContratoCupo->cierre }}</td>
											<td>{{ $trasladosContratoCupo->hora_inicio_atencion }}</td>
											<td>{{ $trasladosContratoCupo->hora_final_atencion }}</td>
											<td>{{ $trasladosContratoCupo->Empresa_traslado_tipo_movilidades_id }}</td>
											<td>{{ $trasladosContratoCupo->Servicio_traslado_Id }}</td>

                                            <td>
                                                <form action="{{ route('traslados-contrato-cupos.destroy',$trasladosContratoCupo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('traslados-contrato-cupos.show',$trasladosContratoCupo->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('traslados-contrato-cupos.edit',$trasladosContratoCupo->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $trasladosContratoCupos->links() !!}
            </div>
        </div>
    </div>
@endsection
