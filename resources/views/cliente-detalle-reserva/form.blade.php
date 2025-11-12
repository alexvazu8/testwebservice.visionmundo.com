<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Detalle_reserva_Id_detalle_Reserva') }}
            {{ Form::text('Detalle_reserva_Id_detalle_Reserva', $clienteDetalleReserva->Detalle_reserva_Id_detalle_Reserva, ['class' => 'form-control' . ($errors->has('Detalle_reserva_Id_detalle_Reserva') ? ' is-invalid' : ''), 'placeholder' => 'Detalle Reserva Id Detalle Reserva']) }}
            {!! $errors->first('Detalle_reserva_Id_detalle_Reserva', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cliente_Id_Cliente') }}
            {{ Form::text('Cliente_Id_Cliente', $clienteDetalleReserva->Cliente_Id_Cliente, ['class' => 'form-control' . ($errors->has('Cliente_Id_Cliente') ? ' is-invalid' : ''), 'placeholder' => 'Cliente Id Cliente']) }}
            {!! $errors->first('Cliente_Id_Cliente', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>