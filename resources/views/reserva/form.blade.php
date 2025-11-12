<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('tipo_reserva') }}
            {{ Form::text('tipo_reserva', $reserva->tipo_reserva, ['class' => 'form-control' . ($errors->has('tipo_reserva') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Reserva']) }}
            {!! $errors->first('tipo_reserva', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Localizador') }}
            {{ Form::text('Localizador', $reserva->Localizador, ['class' => 'form-control' . ($errors->has('Localizador') ? ' is-invalid' : ''), 'placeholder' => 'Localizador']) }}
            {!! $errors->first('Localizador', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Importe_Reserva') }}
            {{ Form::text('Importe_Reserva', $reserva->Importe_Reserva, ['class' => 'form-control' . ($errors->has('Importe_Reserva') ? ' is-invalid' : ''), 'placeholder' => 'Importe Reserva']) }}
            {!! $errors->first('Importe_Reserva', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Nombre_Cliente') }}
            {{ Form::text('Nombre_Cliente', $reserva->Nombre_Cliente, ['class' => 'form-control' . ($errors->has('Nombre_Cliente') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Cliente']) }}
            {!! $errors->first('Nombre_Cliente', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Numero_Adultos') }}
            {{ Form::text('Numero_Adultos', $reserva->Numero_Adultos, ['class' => 'form-control' . ($errors->has('Numero_Adultos') ? ' is-invalid' : ''), 'placeholder' => 'Numero Adultos']) }}
            {!! $errors->first('Numero_Adultos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Numero_menores') }}
            {{ Form::text('Numero_menores', $reserva->Numero_menores, ['class' => 'form-control' . ($errors->has('Numero_menores') ? ' is-invalid' : ''), 'placeholder' => 'Numero Menores']) }}
            {!! $errors->first('Numero_menores', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>