<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Id_Pais') }}
            {{ Form::text('Id_Pais', $paise->Id_Pais, ['class' => 'form-control' . ($errors->has('Id_Pais') ? ' is-invalid' : ''), 'placeholder' => 'Id Pais']) }}
            {!! $errors->first('Id_Pais', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Nombre_Pais') }}
            {{ Form::text('Nombre_Pais', $paise->Nombre_Pais, ['class' => 'form-control' . ($errors->has('Nombre_Pais') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Pais']) }}
            {!! $errors->first('Nombre_Pais', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>