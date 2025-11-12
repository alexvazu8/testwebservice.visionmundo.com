<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Fecha_In') }}
            {{ Form::text('Fecha_In', $carritoHotel->Fecha_In, ['class' => 'form-control' . ($errors->has('Fecha_In') ? ' is-invalid' : ''), 'placeholder' => 'Fecha In']) }}
            {!! $errors->first('Fecha_In', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Fecha_Out') }}
            {{ Form::text('Fecha_Out', $carritoHotel->Fecha_Out, ['class' => 'form-control' . ($errors->has('Fecha_Out') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Out']) }}
            {!! $errors->first('Fecha_Out', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Id_tipo_habitacion_hotels') }}
            {{ Form::text('Id_tipo_habitacion_hotels', $carritoHotel->Id_tipo_habitacion_hotels, ['class' => 'form-control' . ($errors->has('Id_tipo_habitacion_hotels') ? ' is-invalid' : ''), 'placeholder' => 'Id Tipo Habitacion Hotels']) }}
            {!! $errors->first('Id_tipo_habitacion_hotels', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Id_regimen') }}
            {{ Form::text('Id_regimen', $carritoHotel->Id_regimen, ['class' => 'form-control' . ($errors->has('Id_regimen') ? ' is-invalid' : ''), 'placeholder' => 'Id Regimen']) }}
            {!! $errors->first('Id_regimen', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cantidad_Adultos') }}
            {{ Form::text('Cantidad_Adultos', $carritoHotel->Cantidad_Adultos, ['class' => 'form-control' . ($errors->has('Cantidad_Adultos') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Adultos']) }}
            {!! $errors->first('Cantidad_Adultos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cantidad_Menores') }}
            {{ Form::text('Cantidad_Menores', $carritoHotel->Cantidad_Menores, ['class' => 'form-control' . ($errors->has('Cantidad_Menores') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Menores']) }}
            {!! $errors->first('Cantidad_Menores', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cantidad_Noches') }}
            {{ Form::text('Cantidad_Noches', $carritoHotel->Cantidad_Noches, ['class' => 'form-control' . ($errors->has('Cantidad_Noches') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Noches']) }}
            {!! $errors->first('Cantidad_Noches', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Precio_promedio_por_noche') }}
            {{ Form::text('Precio_promedio_por_noche', $carritoHotel->Precio_promedio_por_noche, ['class' => 'form-control' . ($errors->has('Precio_promedio_por_noche') ? ' is-invalid' : ''), 'placeholder' => 'Precio Promedio Por Noche']) }}
            {!! $errors->first('Precio_promedio_por_noche', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Precio_total_habitacion') }}
            {{ Form::text('Precio_total_habitacion', $carritoHotel->Precio_total_habitacion, ['class' => 'form-control' . ($errors->has('Precio_total_habitacion') ? ' is-invalid' : ''), 'placeholder' => 'Precio Total Habitacion']) }}
            {!! $errors->first('Precio_total_habitacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cantidad_habitaciones') }}
            {{ Form::text('Cantidad_habitaciones', $carritoHotel->Cantidad_habitaciones, ['class' => 'form-control' . ($errors->has('Cantidad_habitaciones') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Habitaciones']) }}
            {!! $errors->first('Cantidad_habitaciones', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Precio_Total') }}
            {{ Form::text('Precio_Total', $carritoHotel->Precio_Total, ['class' => 'form-control' . ($errors->has('Precio_Total') ? ' is-invalid' : ''), 'placeholder' => 'Precio Total']) }}
            {!! $errors->first('Precio_Total', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Nombre_Habitacion') }}
            {{ Form::text('Nombre_Habitacion', $carritoHotel->Nombre_Habitacion, ['class' => 'form-control' . ($errors->has('Nombre_Habitacion') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Habitacion']) }}
            {!! $errors->first('Nombre_Habitacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Nombre_Regimen') }}
            {{ Form::text('Nombre_Regimen', $carritoHotel->Nombre_Regimen, ['class' => 'form-control' . ($errors->has('Nombre_Regimen') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Regimen']) }}
            {!! $errors->first('Nombre_Regimen', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('carrito_compras_items_id') }}
            {{ Form::text('carrito_compras_items_id', $carritoHotel->carrito_compras_items_id, ['class' => 'form-control' . ($errors->has('carrito_compras_items_id') ? ' is-invalid' : ''), 'placeholder' => 'Carrito Compras Items Id']) }}
            {!! $errors->first('carrito_compras_items_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>