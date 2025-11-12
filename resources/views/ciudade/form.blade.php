<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Id_Ciudad') }}
            {{ Form::text('Id_Ciudad', $ciudade->Id_Ciudad, ['class' => 'form-control' . ($errors->has('Id_Ciudad') ? ' is-invalid' : ''), 'placeholder' => 'Id Ciudad']) }}
            {!! $errors->first('Id_Ciudad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Nombre_Ciudad') }}
            {{ Form::text('Nombre_Ciudad', $ciudade->Nombre_Ciudad, ['class' => 'form-control' . ($errors->has('Nombre_Ciudad') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Ciudad']) }}
            {!! $errors->first('Nombre_Ciudad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Pais_Id_Pais') }}
            {{ Form::text('Pais_Id_Pais', $ciudade->Pais_Id_Pais, ['class' => 'form-control' . ($errors->has('Pais_Id_Pais') ? ' is-invalid' : ''), 'placeholder' => 'Pais Id Pais']) }}
            {!! $errors->first('Pais_Id_Pais', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>