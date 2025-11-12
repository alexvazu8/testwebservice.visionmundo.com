<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Hotel_Id_Hotel') }}
            {{ Form::text('Hotel_Id_Hotel', $tipoHabitacionHotel->Hotel_Id_Hotel, ['class' => 'form-control' . ($errors->has('Hotel_Id_Hotel') ? ' is-invalid' : ''), 'placeholder' => 'Hotel Id Hotel']) }}
            {!! $errors->first('Hotel_Id_Hotel', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tipo_Habitacion_general_Id_tipo_Habitacion_general') }}
            {{ Form::text('Tipo_Habitacion_general_Id_tipo_Habitacion_general', $tipoHabitacionHotel->Tipo_Habitacion_general_Id_tipo_Habitacion_general, ['class' => 'form-control' . ($errors->has('Tipo_Habitacion_general_Id_tipo_Habitacion_general') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Habitacion General Id Tipo Habitacion General']) }}
            {!! $errors->first('Tipo_Habitacion_general_Id_tipo_Habitacion_general', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Nombre_Habitacion') }}
            {{ Form::text('Nombre_Habitacion', $tipoHabitacionHotel->Nombre_Habitacion, ['class' => 'form-control' . ($errors->has('Nombre_Habitacion') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Habitacion']) }}
            {!! $errors->first('Nombre_Habitacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Edad_menores_gratis') }}
            {{ Form::text('Edad_menores_gratis', $tipoHabitacionHotel->Edad_menores_gratis, ['class' => 'form-control' . ($errors->has('Edad_menores_gratis') ? ' is-invalid' : ''), 'placeholder' => 'Edad Menores Gratis']) }}
            {!! $errors->first('Edad_menores_gratis', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>