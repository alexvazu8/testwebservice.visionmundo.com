<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Costo_habitacion') }}
            {{ Form::text('Costo_habitacion', $preciosCupoRelease->Costo_habitacion, ['class' => 'form-control' . ($errors->has('Costo_habitacion') ? ' is-invalid' : ''), 'placeholder' => 'Costo Habitacion']) }}
            {!! $errors->first('Costo_habitacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Release_habitacion') }}
            {{ Form::text('Release_habitacion', $preciosCupoRelease->Release_habitacion, ['class' => 'form-control' . ($errors->has('Release_habitacion') ? ' is-invalid' : ''), 'placeholder' => 'Release Habitacion']) }}
            {!! $errors->first('Release_habitacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cupo_habitacion') }}
            {{ Form::text('Cupo_habitacion', $preciosCupoRelease->Cupo_habitacion, ['class' => 'form-control' . ($errors->has('Cupo_habitacion') ? ' is-invalid' : ''), 'placeholder' => 'Cupo Habitacion']) }}
            {!! $errors->first('Cupo_habitacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tipo_habitacion_hotel_id_tipo_habitacion_hotel') }}
            {{ Form::text('Tipo_habitacion_hotel_id_tipo_habitacion_hotel', $preciosCupoRelease->Tipo_habitacion_hotel_id_tipo_habitacion_hotel, ['class' => 'form-control' . ($errors->has('Tipo_habitacion_hotel_id_tipo_habitacion_hotel') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Habitacion Hotel Id Tipo Habitacion Hotel']) }}
            {!! $errors->first('Tipo_habitacion_hotel_id_tipo_habitacion_hotel', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Fecha_precio_cupo_release_noche') }}
            {{ Form::text('Fecha_precio_cupo_release_noche', $preciosCupoRelease->Fecha_precio_cupo_release_noche, ['class' => 'form-control' . ($errors->has('Fecha_precio_cupo_release_noche') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Precio Cupo Release Noche']) }}
            {!! $errors->first('Fecha_precio_cupo_release_noche', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cierre') }}
            {{ Form::text('Cierre', $preciosCupoRelease->Cierre, ['class' => 'form-control' . ($errors->has('Cierre') ? ' is-invalid' : ''), 'placeholder' => 'Cierre']) }}
            {!! $errors->first('Cierre', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>