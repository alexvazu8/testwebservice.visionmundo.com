<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Id_Zona') }}
            {{ Form::text('Id_Zona', $zona->Id_Zona, ['class' => 'form-control' . ($errors->has('Id_Zona') ? ' is-invalid' : ''), 'placeholder' => 'Id Zona']) }}
            {!! $errors->first('Id_Zona', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Nombre_Zona') }}
            {{ Form::text('Nombre_Zona', $zona->Nombre_Zona, ['class' => 'form-control' . ($errors->has('Nombre_Zona') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Zona']) }}
            {!! $errors->first('Nombre_Zona', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Ciudad_Id_Ciudad') }}
            {{ Form::text('Ciudad_Id_Ciudad', $zona->Ciudad_Id_Ciudad, ['class' => 'form-control' . ($errors->has('Ciudad_Id_Ciudad') ? ' is-invalid' : ''), 'placeholder' => 'Ciudad Id Ciudad']) }}
            {!! $errors->first('Ciudad_Id_Ciudad', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>