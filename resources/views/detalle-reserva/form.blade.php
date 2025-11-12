<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Fecha_in') }}
            {{ Form::text('Fecha_in', $detalleReserva->Fecha_in, ['class' => 'form-control' . ($errors->has('Fecha_in') ? ' is-invalid' : ''), 'placeholder' => 'Fecha In']) }}
            {!! $errors->first('Fecha_in', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Fecha_out') }}
            {{ Form::text('Fecha_out', $detalleReserva->Fecha_out, ['class' => 'form-control' . ($errors->has('Fecha_out') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Out']) }}
            {!! $errors->first('Fecha_out', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Precio_Servicio') }}
            {{ Form::text('Precio_Servicio', $detalleReserva->Precio_Servicio, ['class' => 'form-control' . ($errors->has('Precio_Servicio') ? ' is-invalid' : ''), 'placeholder' => 'Precio Servicio']) }}
            {!! $errors->first('Precio_Servicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Reserva_Id_reserva') }}
            {{ Form::text('Reserva_Id_reserva', $detalleReserva->Reserva_Id_reserva, ['class' => 'form-control' . ($errors->has('Reserva_Id_reserva') ? ' is-invalid' : ''), 'placeholder' => 'Reserva Id Reserva']) }}
            {!! $errors->first('Reserva_Id_reserva', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Usuario_id') }}
            {{ Form::text('Usuario_id', $detalleReserva->Usuario_id, ['class' => 'form-control' . ($errors->has('Usuario_id') ? ' is-invalid' : ''), 'placeholder' => 'Usuario Id']) }}
            {!! $errors->first('Usuario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tipo_Habitacion_Id_tipo_habitacion_hotel') }}
            {{ Form::text('Tipo_Habitacion_Id_tipo_habitacion_hotel', $detalleReserva->Tipo_Habitacion_Id_tipo_habitacion_hotel, ['class' => 'form-control' . ($errors->has('Tipo_Habitacion_Id_tipo_habitacion_hotel') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Habitacion Id Tipo Habitacion Hotel']) }}
            {!! $errors->first('Tipo_Habitacion_Id_tipo_habitacion_hotel', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tour_Id_tour') }}
            {{ Form::text('Tour_Id_tour', $detalleReserva->Tour_Id_tour, ['class' => 'form-control' . ($errors->has('Tour_Id_tour') ? ' is-invalid' : ''), 'placeholder' => 'Tour Id Tour']) }}
            {!! $errors->first('Tour_Id_tour', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Empresa_traslados_tipo_movilidades_Id') }}
            {{ Form::text('Empresa_traslados_tipo_movilidades_Id', $detalleReserva->Empresa_traslados_tipo_movilidades_Id, ['class' => 'form-control' . ($errors->has('Empresa_traslados_tipo_movilidades_Id') ? ' is-invalid' : ''), 'placeholder' => 'Empresa Traslados Tipo Movilidades Id']) }}
            {!! $errors->first('Empresa_traslados_tipo_movilidades_Id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Costo_servicio') }}
            {{ Form::text('Costo_servicio', $detalleReserva->Costo_servicio, ['class' => 'form-control' . ($errors->has('Costo_servicio') ? ' is-invalid' : ''), 'placeholder' => 'Costo Servicio']) }}
            {!! $errors->first('Costo_servicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>