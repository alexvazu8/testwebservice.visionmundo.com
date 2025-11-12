<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('estrellas') }}
            {{ Form::text('estrellas', $estrella->estrellas, ['class' => 'form-control' . ($errors->has('estrellas') ? ' is-invalid' : ''), 'placeholder' => 'Estrellas']) }}
            {!! $errors->first('estrellas', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipo_categoria') }}
            {{ Form::text('tipo_categoria', $estrella->tipo_categoria, ['class' => 'form-control' . ($errors->has('tipo_categoria') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Categoria']) }}
            {!! $errors->first('tipo_categoria', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>