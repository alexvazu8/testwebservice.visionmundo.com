<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Id_Hotel') }}
            {{ Form::text('Id_Hotel', $hotel->Id_Hotel, ['class' => 'form-control' . ($errors->has('Id_Hotel') ? ' is-invalid' : ''), 'placeholder' => 'Id Hotel']) }}
            {!! $errors->first('Id_Hotel', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Nombre_Hotel') }}
            {{ Form::text('Nombre_Hotel', $hotel->Nombre_Hotel, ['class' => 'form-control' . ($errors->has('Nombre_Hotel') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Hotel']) }}
            {!! $errors->first('Nombre_Hotel', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Numero_identificacion_tributaria') }}
            {{ Form::text('Numero_identificacion_tributaria', $hotel->Numero_identificacion_tributaria, ['class' => 'form-control' . ($errors->has('Numero_identificacion_tributaria') ? ' is-invalid' : ''), 'placeholder' => 'Numero Identificacion Tributaria']) }}
            {!! $errors->first('Numero_identificacion_tributaria', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Direccion_Hotel') }}
            {{ Form::text('Direccion_Hotel', $hotel->Direccion_Hotel, ['class' => 'form-control' . ($errors->has('Direccion_Hotel') ? ' is-invalid' : ''), 'placeholder' => 'Direccion Hotel']) }}
            {!! $errors->first('Direccion_Hotel', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Telefono_reservas_hotel') }}
            {{ Form::text('Telefono_reservas_hotel', $hotel->Telefono_reservas_hotel, ['class' => 'form-control' . ($errors->has('Telefono_reservas_hotel') ? ' is-invalid' : ''), 'placeholder' => 'Telefono Reservas Hotel']) }}
            {!! $errors->first('Telefono_reservas_hotel', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cel_reservas_hotel') }}
            {{ Form::text('Cel_reservas_hotel', $hotel->Cel_reservas_hotel, ['class' => 'form-control' . ($errors->has('Cel_reservas_hotel') ? ' is-invalid' : ''), 'placeholder' => 'Cel Reservas Hotel']) }}
            {!! $errors->first('Cel_reservas_hotel', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email_reservas_hotel') }}
            {{ Form::text('email_reservas_hotel', $hotel->email_reservas_hotel, ['class' => 'form-control' . ($errors->has('email_reservas_hotel') ? ' is-invalid' : ''), 'placeholder' => 'Email Reservas Hotel']) }}
            {!! $errors->first('email_reservas_hotel', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email_comercial_hotel') }}
            {{ Form::text('email_comercial_hotel', $hotel->email_comercial_hotel, ['class' => 'form-control' . ($errors->has('email_comercial_hotel') ? ' is-invalid' : ''), 'placeholder' => 'Email Comercial Hotel']) }}
            {!! $errors->first('email_comercial_hotel', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Pais_Id_Pais') }}
            {{ Form::text('Pais_Id_Pais', $hotel->Pais_Id_Pais, ['class' => 'form-control' . ($errors->has('Pais_Id_Pais') ? ' is-invalid' : ''), 'placeholder' => 'Pais Id Pais']) }}
            {!! $errors->first('Pais_Id_Pais', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Zona_Id_Zona') }}
            {{ Form::text('Zona_Id_Zona', $hotel->Zona_Id_Zona, ['class' => 'form-control' . ($errors->has('Zona_Id_Zona') ? ' is-invalid' : ''), 'placeholder' => 'Zona Id Zona']) }}
            {!! $errors->first('Zona_Id_Zona', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ciudad_Id_ciudad') }}
            {{ Form::text('ciudad_Id_ciudad', $hotel->ciudad_Id_ciudad, ['class' => 'form-control' . ($errors->has('ciudad_Id_ciudad') ? ' is-invalid' : ''), 'placeholder' => 'Ciudad Id Ciudad']) }}
            {!! $errors->first('ciudad_Id_ciudad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Descripcion_Hotel') }}
            {{ Form::text('Descripcion_Hotel', $hotel->Descripcion_Hotel, ['class' => 'form-control' . ($errors->has('Descripcion_Hotel') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion Hotel']) }}
            {!! $errors->first('Descripcion_Hotel', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Latitud') }}
            {{ Form::text('Latitud', $hotel->Latitud, ['class' => 'form-control' . ($errors->has('Latitud') ? ' is-invalid' : ''), 'placeholder' => 'Latitud']) }}
            {!! $errors->first('Latitud', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Longitud') }}
            {{ Form::text('Longitud', $hotel->Longitud, ['class' => 'form-control' . ($errors->has('Longitud') ? ' is-invalid' : ''), 'placeholder' => 'Longitud']) }}
            {!! $errors->first('Longitud', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Foto_Principal_Hotel') }}
            {{ Form::text('Foto_Principal_Hotel', $hotel->Foto_Principal_Hotel, ['class' => 'form-control' . ($errors->has('Foto_Principal_Hotel') ? ' is-invalid' : ''), 'placeholder' => 'Foto Principal Hotel']) }}
            {!! $errors->first('Foto_Principal_Hotel', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>