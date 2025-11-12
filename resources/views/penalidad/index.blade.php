@extends('layouts.app')

@section('template_title')
    Penalidad
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Penalidad') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('penalidads.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Porcentaje Penalidad Por Noche</th>
										<th>Desde Noches Antes</th>
										<th>Hasta Noches Antes</th>
										<th>Politica Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penalidads as $penalidad)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $penalidad->porcentaje_penalidad_por_noche }}</td>
											<td>{{ $penalidad->desde_noches_antes }}</td>
											<td>{{ $penalidad->hasta_noches_antes }}</td>
											<td>{{ $penalidad->politica_id }}</td>

                                            <td>
                                                <form action="{{ route('penalidads.destroy',$penalidad->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('penalidads.show',$penalidad->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('penalidads.edit',$penalidad->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $penalidads->links() !!}
            </div>
        </div>
    </div>
@endsection
