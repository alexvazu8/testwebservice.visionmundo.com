<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Cantidad_adultos') }}
            {{ Form::text('Cantidad_adultos', $trasladosContratoCupo->Cantidad_adultos, ['class' => 'form-control' . ($errors->has('Cantidad_adultos') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Adultos']) }}
            {!! $errors->first('Cantidad_adultos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cantidad_menores') }}
            {{ Form::text('Cantidad_menores', $trasladosContratoCupo->Cantidad_menores, ['class' => 'form-control' . ($errors->has('Cantidad_menores') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Menores']) }}
            {!! $errors->first('Cantidad_menores', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Costo_adulto') }}
            {{ Form::text('Costo_adulto', $trasladosContratoCupo->Costo_adulto, ['class' => 'form-control' . ($errors->has('Costo_adulto') ? ' is-invalid' : ''), 'placeholder' => 'Costo Adulto']) }}
            {!! $errors->first('Costo_adulto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Costo_menor') }}
            {{ Form::text('Costo_menor', $trasladosContratoCupo->Costo_menor, ['class' => 'form-control' . ($errors->has('Costo_menor') ? ' is-invalid' : ''), 'placeholder' => 'Costo Menor']) }}
            {!! $errors->first('Costo_menor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Edad_menor') }}
            {{ Form::text('Edad_menor', $trasladosContratoCupo->Edad_menor, ['class' => 'form-control' . ($errors->has('Edad_menor') ? ' is-invalid' : ''), 'placeholder' => 'Edad Menor']) }}
            {!! $errors->first('Edad_menor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Fecha_disponible') }}
            {{ Form::text('Fecha_disponible', $trasladosContratoCupo->Fecha_disponible, ['class' => 'form-control' . ($errors->has('Fecha_disponible') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Disponible']) }}
            {!! $errors->first('Fecha_disponible', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cupo') }}
            {{ Form::text('Cupo', $trasladosContratoCupo->Cupo, ['class' => 'form-control' . ($errors->has('Cupo') ? ' is-invalid' : ''), 'placeholder' => 'Cupo']) }}
            {!! $errors->first('Cupo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Release') }}
            {{ Form::text('Release', $trasladosContratoCupo->Release, ['class' => 'form-control' . ($errors->has('Release') ? ' is-invalid' : ''), 'placeholder' => 'Release']) }}
            {!! $errors->first('Release', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cierre') }}
            {{ Form::text('cierre', $trasladosContratoCupo->cierre, ['class' => 'form-control' . ($errors->has('cierre') ? ' is-invalid' : ''), 'placeholder' => 'Cierre']) }}
            {!! $errors->first('cierre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('hora_inicio_atencion') }}
            {{ Form::text('hora_inicio_atencion', $trasladosContratoCupo->hora_inicio_atencion, ['class' => 'form-control' . ($errors->has('hora_inicio_atencion') ? ' is-invalid' : ''), 'placeholder' => 'Hora Inicio Atencion']) }}
            {!! $errors->first('hora_inicio_atencion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('hora_final_atencion') }}
            {{ Form::text('hora_final_atencion', $trasladosContratoCupo->hora_final_atencion, ['class' => 'form-control' . ($errors->has('hora_final_atencion') ? ' is-invalid' : ''), 'placeholder' => 'Hora Final Atencion']) }}
            {!! $errors->first('hora_final_atencion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Empresa_traslado_tipo_movilidades_id') }}
            {{ Form::text('Empresa_traslado_tipo_movilidades_id', $trasladosContratoCupo->Empresa_traslado_tipo_movilidades_id, ['class' => 'form-control' . ($errors->has('Empresa_traslado_tipo_movilidades_id') ? ' is-invalid' : ''), 'placeholder' => 'Empresa Traslado Tipo Movilidades Id']) }}
            {!! $errors->first('Empresa_traslado_tipo_movilidades_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Servicio_traslado_Id') }}
            {{ Form::text('Servicio_traslado_Id', $trasladosContratoCupo->Servicio_traslado_Id, ['class' => 'form-control' . ($errors->has('Servicio_traslado_Id') ? ' is-invalid' : ''), 'placeholder' => 'Servicio Traslado Id']) }}
            {!! $errors->first('Servicio_traslado_Id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>