@extends('layouts.app')

@section('template_title')
    Fotos Tour
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Fotos Tour') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('fotos-tours.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Nombre Foto Tour</th>
										<th>Url Foto Tour</th>
										<th>Tour Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fotosTours as $fotosTour)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $fotosTour->nombre_foto_tour }}</td>
											<td>{{ $fotosTour->url_foto_tour }}</td>
											<td>{{ $fotosTour->tour_id }}</td>

                                            <td>
                                                <form action="{{ route('fotos-tours.destroy',$fotosTour->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('fotos-tours.show',$fotosTour->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('fotos-tours.edit',$fotosTour->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $fotosTours->links() !!}
            </div>
        </div>
    </div>
@endsection
