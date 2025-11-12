@extends('layouts.app')

@section('template_title')
    Zona
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Zona') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('zonas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Id Zona</th>
										<th>Nombre Zona</th>
										<th>Ciudad Id Ciudad</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($zonas as $zona)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $zona->Id_Zona }}</td>
											<td>{{ $zona->Nombre_Zona }}</td>
											<td>{{ $zona->Ciudad_Id_Ciudad }}</td>

                                            <td>
                                                <form action="{{ route('zonas.destroy',$zona->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('zonas.show',$zona->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('zonas.edit',$zona->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $zonas->links() !!}
            </div>
        </div>
    </div>
@endsection
