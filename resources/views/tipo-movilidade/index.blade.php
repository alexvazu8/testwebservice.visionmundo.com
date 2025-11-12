@extends('layouts.app')

@section('template_title')
    Tipo Movilidade
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tipo Movilidade') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tipo-movilidades.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Nombre Tipo Movilidad</th>
										<th>Foto Tipo Movilidad</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipoMovilidades as $tipoMovilidade)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $tipoMovilidade->Nombre_tipo_movilidad }}</td>
											<td>{{ $tipoMovilidade->Foto_tipo_movilidad }}</td>

                                            <td>
                                                <form action="{{ route('tipo-movilidades.destroy',$tipoMovilidade->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('tipo-movilidades.show',$tipoMovilidade->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('tipo-movilidades.edit',$tipoMovilidade->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $tipoMovilidades->links() !!}
            </div>
        </div>
    </div>
@endsection
