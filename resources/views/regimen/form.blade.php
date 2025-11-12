<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre_regimen') }}
            {{ Form::text('nombre_regimen', $regimen->nombre_regimen, ['class' => 'form-control' . ($errors->has('nombre_regimen') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Regimen']) }}
            {!! $errors->first('nombre_regimen', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('codigo_regimen') }}
            {{ Form::text('codigo_regimen', $regimen->codigo_regimen, ['class' => 'form-control' . ($errors->has('codigo_regimen') ? ' is-invalid' : ''), 'placeholder' => 'Codigo Regimen']) }}
            {!! $errors->first('codigo_regimen', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>