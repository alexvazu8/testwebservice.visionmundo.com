<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Cantidad_adultos') }}
            {{ Form::text('Cantidad_adultos', $toursContratoCupo->Cantidad_adultos, ['class' => 'form-control' . ($errors->has('Cantidad_adultos') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Adultos']) }}
            {!! $errors->first('Cantidad_adultos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cantidad_menores') }}
            {{ Form::text('Cantidad_menores', $toursContratoCupo->Cantidad_menores, ['class' => 'form-control' . ($errors->has('Cantidad_menores') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Menores']) }}
            {!! $errors->first('Cantidad_menores', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Costo_adulto') }}
            {{ Form::text('Costo_adulto', $toursContratoCupo->Costo_adulto, ['class' => 'form-control' . ($errors->has('Costo_adulto') ? ' is-invalid' : ''), 'placeholder' => 'Costo Adulto']) }}
            {!! $errors->first('Costo_adulto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Costo_menor') }}
            {{ Form::text('Costo_menor', $toursContratoCupo->Costo_menor, ['class' => 'form-control' . ($errors->has('Costo_menor') ? ' is-invalid' : ''), 'placeholder' => 'Costo Menor']) }}
            {!! $errors->first('Costo_menor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Edad_menor') }}
            {{ Form::text('Edad_menor', $toursContratoCupo->Edad_menor, ['class' => 'form-control' . ($errors->has('Edad_menor') ? ' is-invalid' : ''), 'placeholder' => 'Edad Menor']) }}
            {!! $errors->first('Edad_menor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Fecha_disponible') }}
            {{ Form::text('Fecha_disponible', $toursContratoCupo->Fecha_disponible, ['class' => 'form-control' . ($errors->has('Fecha_disponible') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Disponible']) }}
            {!! $errors->first('Fecha_disponible', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cupo') }}
            {{ Form::text('Cupo', $toursContratoCupo->Cupo, ['class' => 'form-control' . ($errors->has('Cupo') ? ' is-invalid' : ''), 'placeholder' => 'Cupo']) }}
            {!! $errors->first('Cupo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Release') }}
            {{ Form::text('Release', $toursContratoCupo->Release, ['class' => 'form-control' . ($errors->has('Release') ? ' is-invalid' : ''), 'placeholder' => 'Release']) }}
            {!! $errors->first('Release', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cierre') }}
            {{ Form::text('cierre', $toursContratoCupo->cierre, ['class' => 'form-control' . ($errors->has('cierre') ? ' is-invalid' : ''), 'placeholder' => 'Cierre']) }}
            {!! $errors->first('cierre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tours_id') }}
            {{ Form::text('Tours_id', $toursContratoCupo->Tours_id, ['class' => 'form-control' . ($errors->has('Tours_id') ? ' is-invalid' : ''), 'placeholder' => 'Tours Id']) }}
            {!! $errors->first('Tours_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>