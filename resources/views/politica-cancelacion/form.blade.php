<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre_Politica') }}
            {{ Form::text('Nombre_Politica', $politicaCancelacion->Nombre_Politica, ['class' => 'form-control' . ($errors->has('Nombre_Politica') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Politica']) }}
            {!! $errors->first('Nombre_Politica', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>