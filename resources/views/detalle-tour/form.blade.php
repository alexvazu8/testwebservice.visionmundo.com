<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Cantidad_Adultos') }}
            {{ Form::text('Cantidad_Adultos', $detalleTour->Cantidad_Adultos, ['class' => 'form-control' . ($errors->has('Cantidad_Adultos') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Adultos']) }}
            {!! $errors->first('Cantidad_Adultos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cantidad_Menores') }}
            {{ Form::text('Cantidad_Menores', $detalleTour->Cantidad_Menores, ['class' => 'form-control' . ($errors->has('Cantidad_Menores') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Menores']) }}
            {!! $errors->first('Cantidad_Menores', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('detalle_reservas_id') }}
            {{ Form::text('detalle_reservas_id', $detalleTour->detalle_reservas_id, ['class' => 'form-control' . ($errors->has('detalle_reservas_id') ? ' is-invalid' : ''), 'placeholder' => 'Detalle Reservas Id']) }}
            {!! $errors->first('detalle_reservas_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Fecha_In') }}
            {{ Form::text('Fecha_In', $detalleTour->Fecha_In, ['class' => 'form-control' . ($errors->has('Fecha_In') ? ' is-invalid' : ''), 'placeholder' => 'Fecha In']) }}
            {!! $errors->first('Fecha_In', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Fecha_Out') }}
            {{ Form::text('Fecha_Out', $detalleTour->Fecha_Out, ['class' => 'form-control' . ($errors->has('Fecha_Out') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Out']) }}
            {!! $errors->first('Fecha_Out', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Id_tours') }}
            {{ Form::text('Id_tours', $detalleTour->Id_tours, ['class' => 'form-control' . ($errors->has('Id_tours') ? ' is-invalid' : ''), 'placeholder' => 'Id Tours']) }}
            {!! $errors->first('Id_tours', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Precio_Adulto') }}
            {{ Form::text('Precio_Adulto', $detalleTour->Precio_Adulto, ['class' => 'form-control' . ($errors->has('Precio_Adulto') ? ' is-invalid' : ''), 'placeholder' => 'Precio Adulto']) }}
            {!! $errors->first('Precio_Adulto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Precio_Menor') }}
            {{ Form::text('Precio_Menor', $detalleTour->Precio_Menor, ['class' => 'form-control' . ($errors->has('Precio_Menor') ? ' is-invalid' : ''), 'placeholder' => 'Precio Menor']) }}
            {!! $errors->first('Precio_Menor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Precio_Total') }}
            {{ Form::text('Precio_Total', $detalleTour->Precio_Total, ['class' => 'form-control' . ($errors->has('Precio_Total') ? ' is-invalid' : ''), 'placeholder' => 'Precio Total']) }}
            {!! $errors->first('Precio_Total', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>