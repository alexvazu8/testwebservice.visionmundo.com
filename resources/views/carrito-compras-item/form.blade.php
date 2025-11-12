<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Usuario_id') }}
            {{ Form::text('Usuario_id', $carritoComprasItem->Usuario_id, ['class' => 'form-control' . ($errors->has('Usuario_id') ? ' is-invalid' : ''), 'placeholder' => 'Usuario Id']) }}
            {!! $errors->first('Usuario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tipo_servicio') }}
            {{ Form::text('Tipo_servicio', $carritoComprasItem->Tipo_servicio, ['class' => 'form-control' . ($errors->has('Tipo_servicio') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Servicio']) }}
            {!! $errors->first('Tipo_servicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Costo_Total') }}
            {{ Form::text('Costo_Total', $carritoComprasItem->Costo_Total, ['class' => 'form-control' . ($errors->has('Costo_Total') ? ' is-invalid' : ''), 'placeholder' => 'Costo Total']) }}
            {!! $errors->first('Costo_Total', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Precio_Total') }}
            {{ Form::text('Precio_Total', $carritoComprasItem->Precio_Total, ['class' => 'form-control' . ($errors->has('Precio_Total') ? ' is-invalid' : ''), 'placeholder' => 'Precio Total']) }}
            {!! $errors->first('Precio_Total', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('token') }}
            {{ Form::text('token', $carritoComprasItem->token, ['class' => 'form-control' . ($errors->has('token') ? ' is-invalid' : ''), 'placeholder' => 'Token']) }}
            {!! $errors->first('token', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>