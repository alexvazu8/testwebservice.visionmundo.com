<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Cantidad_Adultos') }}
            {{ Form::text('Cantidad_Adultos', $detalleTraslado->Cantidad_Adultos, ['class' => 'form-control' . ($errors->has('Cantidad_Adultos') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Adultos']) }}
            {!! $errors->first('Cantidad_Adultos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cantidad_Menores') }}
            {{ Form::text('Cantidad_Menores', $detalleTraslado->Cantidad_Menores, ['class' => 'form-control' . ($errors->has('Cantidad_Menores') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Menores']) }}
            {!! $errors->first('Cantidad_Menores', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('detalle_reservas_id') }}
            {{ Form::text('detalle_reservas_id', $detalleTraslado->detalle_reservas_id, ['class' => 'form-control' . ($errors->has('detalle_reservas_id') ? ' is-invalid' : ''), 'placeholder' => 'Detalle Reservas Id']) }}
            {!! $errors->first('detalle_reservas_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Empresa_traslados_tipo_movilidades_id') }}
            {{ Form::text('Empresa_traslados_tipo_movilidades_id', $detalleTraslado->Empresa_traslados_tipo_movilidades_id, ['class' => 'form-control' . ($errors->has('Empresa_traslados_tipo_movilidades_id') ? ' is-invalid' : ''), 'placeholder' => 'Empresa Traslados Tipo Movilidades Id']) }}
            {!! $errors->first('Empresa_traslados_tipo_movilidades_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha_servicio') }}
            {{ Form::text('fecha_servicio', $detalleTraslado->fecha_servicio, ['class' => 'form-control' . ($errors->has('fecha_servicio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Servicio']) }}
            {!! $errors->first('fecha_servicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('hora_servicio') }}
            {{ Form::text('hora_servicio', $detalleTraslado->hora_servicio, ['class' => 'form-control' . ($errors->has('hora_servicio') ? ' is-invalid' : ''), 'placeholder' => 'Hora Servicio']) }}
            {!! $errors->first('hora_servicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Precio_Adulto') }}
            {{ Form::text('Precio_Adulto', $detalleTraslado->Precio_Adulto, ['class' => 'form-control' . ($errors->has('Precio_Adulto') ? ' is-invalid' : ''), 'placeholder' => 'Precio Adulto']) }}
            {!! $errors->first('Precio_Adulto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Precio_Menor') }}
            {{ Form::text('Precio_Menor', $detalleTraslado->Precio_Menor, ['class' => 'form-control' . ($errors->has('Precio_Menor') ? ' is-invalid' : ''), 'placeholder' => 'Precio Menor']) }}
            {!! $errors->first('Precio_Menor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Precio_Total') }}
            {{ Form::text('Precio_Total', $detalleTraslado->Precio_Total, ['class' => 'form-control' . ($errors->has('Precio_Total') ? ' is-invalid' : ''), 'placeholder' => 'Precio Total']) }}
            {!! $errors->first('Precio_Total', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>