<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('porcentaje_penalidad_por_noche') }}
            {{ Form::text('porcentaje_penalidad_por_noche', $penalidad->porcentaje_penalidad_por_noche, ['class' => 'form-control' . ($errors->has('porcentaje_penalidad_por_noche') ? ' is-invalid' : ''), 'placeholder' => 'Porcentaje Penalidad Por Noche']) }}
            {!! $errors->first('porcentaje_penalidad_por_noche', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('desde_noches_antes') }}
            {{ Form::text('desde_noches_antes', $penalidad->desde_noches_antes, ['class' => 'form-control' . ($errors->has('desde_noches_antes') ? ' is-invalid' : ''), 'placeholder' => 'Desde Noches Antes']) }}
            {!! $errors->first('desde_noches_antes', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('hasta_noches_antes') }}
            {{ Form::text('hasta_noches_antes', $penalidad->hasta_noches_antes, ['class' => 'form-control' . ($errors->has('hasta_noches_antes') ? ' is-invalid' : ''), 'placeholder' => 'Hasta Noches Antes']) }}
            {!! $errors->first('hasta_noches_antes', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('politica_id') }}
            {{ Form::text('politica_id', $penalidad->politica_id, ['class' => 'form-control' . ($errors->has('politica_id') ? ' is-invalid' : ''), 'placeholder' => 'Politica Id']) }}
            {!! $errors->first('politica_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>