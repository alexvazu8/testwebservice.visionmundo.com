<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre_Servicio') }}
            {{ Form::text('Nombre_Servicio', $servicioTraslado->Nombre_Servicio, ['class' => 'form-control' . ($errors->has('Nombre_Servicio') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Servicio']) }}
            {!! $errors->first('Nombre_Servicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Detalle_servicio') }}
            {{ Form::text('Detalle_servicio', $servicioTraslado->Detalle_servicio, ['class' => 'form-control' . ($errors->has('Detalle_servicio') ? ' is-invalid' : ''), 'placeholder' => 'Detalle Servicio']) }}
            {!! $errors->first('Detalle_servicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tipo_servicio_tansfer') }}
            {{ Form::text('Tipo_servicio_tansfer', $servicioTraslado->Tipo_servicio_tansfer, ['class' => 'form-control' . ($errors->has('Tipo_servicio_tansfer') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Servicio Tansfer']) }}
            {!! $errors->first('Tipo_servicio_tansfer', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('empresa_traslado_tipo_movilidades_Id') }}
            {{ Form::text('empresa_traslado_tipo_movilidades_Id', $servicioTraslado->empresa_traslado_tipo_movilidades_Id, ['class' => 'form-control' . ($errors->has('empresa_traslado_tipo_movilidades_Id') ? ' is-invalid' : ''), 'placeholder' => 'Empresa Traslado Tipo Movilidades Id']) }}
            {!! $errors->first('empresa_traslado_tipo_movilidades_Id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Zona_Origen_id') }}
            {{ Form::text('Zona_Origen_id', $servicioTraslado->Zona_Origen_id, ['class' => 'form-control' . ($errors->has('Zona_Origen_id') ? ' is-invalid' : ''), 'placeholder' => 'Zona Origen Id']) }}
            {!! $errors->first('Zona_Origen_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Zona_Destino_id') }}
            {{ Form::text('Zona_Destino_id', $servicioTraslado->Zona_Destino_id, ['class' => 'form-control' . ($errors->has('Zona_Destino_id') ? ' is-invalid' : ''), 'placeholder' => 'Zona Destino Id']) }}
            {!! $errors->first('Zona_Destino_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Email_contacto_traslado') }}
            {{ Form::text('Email_contacto_traslado', $servicioTraslado->Email_contacto_traslado, ['class' => 'form-control' . ($errors->has('Email_contacto_traslado') ? ' is-invalid' : ''), 'placeholder' => 'Email Contacto Traslado']) }}
            {!! $errors->first('Email_contacto_traslado', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>