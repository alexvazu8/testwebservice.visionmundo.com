<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre_tour') }}
            {{ Form::text('Nombre_tour', $tour->Nombre_tour, ['class' => 'form-control' . ($errors->has('Nombre_tour') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Tour']) }}
            {!! $errors->first('Nombre_tour', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Email_contacto_tour') }}
            {{ Form::text('Email_contacto_tour', $tour->Email_contacto_tour, ['class' => 'form-control' . ($errors->has('Email_contacto_tour') ? ' is-invalid' : ''), 'placeholder' => 'Email Contacto Tour']) }}
            {!! $errors->first('Email_contacto_tour', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Foto_tours') }}
            {{ Form::text('Foto_tours', $tour->Foto_tours, ['class' => 'form-control' . ($errors->has('Foto_tours') ? ' is-invalid' : ''), 'placeholder' => 'Foto Tours']) }}
            {!! $errors->first('Foto_tours', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Detalle_tour') }}
            {{ Form::text('Detalle_tour', $tour->Detalle_tour, ['class' => 'form-control' . ($errors->has('Detalle_tour') ? ' is-invalid' : ''), 'placeholder' => 'Detalle Tour']) }}
            {!! $errors->first('Detalle_tour', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Recojo_hotel') }}
            {{ Form::text('Recojo_hotel', $tour->Recojo_hotel, ['class' => 'form-control' . ($errors->has('Recojo_hotel') ? ' is-invalid' : ''), 'placeholder' => 'Recojo Hotel']) }}
            {!! $errors->first('Recojo_hotel', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Punto_encuentro') }}
            {{ Form::text('Punto_encuentro', $tour->Punto_encuentro, ['class' => 'form-control' . ($errors->has('Punto_encuentro') ? ' is-invalid' : ''), 'placeholder' => 'Punto Encuentro']) }}
            {!! $errors->first('Punto_encuentro', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad_dias_tour') }}
            {{ Form::text('cantidad_dias_tour', $tour->cantidad_dias_tour, ['class' => 'form-control' . ($errors->has('cantidad_dias_tour') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Dias Tour']) }}
            {!! $errors->first('cantidad_dias_tour', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad_noches_tour') }}
            {{ Form::text('cantidad_noches_tour', $tour->cantidad_noches_tour, ['class' => 'form-control' . ($errors->has('cantidad_noches_tour') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Noches Tour']) }}
            {!! $errors->first('cantidad_noches_tour', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Horario_inicio') }}
            {{ Form::text('Horario_inicio', $tour->Horario_inicio, ['class' => 'form-control' . ($errors->has('Horario_inicio') ? ' is-invalid' : ''), 'placeholder' => 'Horario Inicio']) }}
            {!! $errors->first('Horario_inicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Hora_fin') }}
            {{ Form::text('Hora_fin', $tour->Hora_fin, ['class' => 'form-control' . ($errors->has('Hora_fin') ? ' is-invalid' : ''), 'placeholder' => 'Hora Fin']) }}
            {!! $errors->first('Hora_fin', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Entregan_agua') }}
            {{ Form::text('Entregan_agua', $tour->Entregan_agua, ['class' => 'form-control' . ($errors->has('Entregan_agua') ? ' is-invalid' : ''), 'placeholder' => 'Entregan Agua']) }}
            {!! $errors->first('Entregan_agua', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Para_discapacitados') }}
            {{ Form::text('Para_discapacitados', $tour->Para_discapacitados, ['class' => 'form-control' . ($errors->has('Para_discapacitados') ? ' is-invalid' : ''), 'placeholder' => 'Para Discapacitados']) }}
            {!! $errors->first('Para_discapacitados', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Con_bano') }}
            {{ Form::text('Con_bano', $tour->Con_bano, ['class' => 'form-control' . ($errors->has('Con_bano') ? ' is-invalid' : ''), 'placeholder' => 'Con Bano']) }}
            {!! $errors->first('Con_bano', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Pais_Id_Pais') }}
            {{ Form::text('Pais_Id_Pais', $tour->Pais_Id_Pais, ['class' => 'form-control' . ($errors->has('Pais_Id_Pais') ? ' is-invalid' : ''), 'placeholder' => 'Pais Id Pais']) }}
            {!! $errors->first('Pais_Id_Pais', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Ciudad_Id_Ciudad') }}
            {{ Form::text('Ciudad_Id_Ciudad', $tour->Ciudad_Id_Ciudad, ['class' => 'form-control' . ($errors->has('Ciudad_Id_Ciudad') ? ' is-invalid' : ''), 'placeholder' => 'Ciudad Id Ciudad']) }}
            {!! $errors->first('Ciudad_Id_Ciudad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Zona_Id_Zona') }}
            {{ Form::text('Zona_Id_Zona', $tour->Zona_Id_Zona, ['class' => 'form-control' . ($errors->has('Zona_Id_Zona') ? ' is-invalid' : ''), 'placeholder' => 'Zona Id Zona']) }}
            {!! $errors->first('Zona_Id_Zona', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>