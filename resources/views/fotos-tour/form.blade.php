<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre_foto_tour') }}
            {{ Form::text('nombre_foto_tour', $fotosTour->nombre_foto_tour, ['class' => 'form-control' . ($errors->has('nombre_foto_tour') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Foto Tour']) }}
            {!! $errors->first('nombre_foto_tour', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('url_foto_tour') }}
            {{ Form::text('url_foto_tour', $fotosTour->url_foto_tour, ['class' => 'form-control' . ($errors->has('url_foto_tour') ? ' is-invalid' : ''), 'placeholder' => 'Url Foto Tour']) }}
            {!! $errors->first('url_foto_tour', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tour_id') }}
            {{ Form::text('tour_id', $fotosTour->tour_id, ['class' => 'form-control' . ($errors->has('tour_id') ? ' is-invalid' : ''), 'placeholder' => 'Tour Id']) }}
            {!! $errors->first('tour_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>