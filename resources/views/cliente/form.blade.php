<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Documento_Id_Cliente') }}
            {{ Form::text('Documento_Id_Cliente', $cliente->Documento_Id_Cliente, ['class' => 'form-control' . ($errors->has('Documento_Id_Cliente') ? ' is-invalid' : ''), 'placeholder' => 'Documento Id Cliente']) }}
            {!! $errors->first('Documento_Id_Cliente', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Nombre_Cliente') }}
            {{ Form::text('Nombre_Cliente', $cliente->Nombre_Cliente, ['class' => 'form-control' . ($errors->has('Nombre_Cliente') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Cliente']) }}
            {!! $errors->first('Nombre_Cliente', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Apellido_Cliente') }}
            {{ Form::text('Apellido_Cliente', $cliente->Apellido_Cliente, ['class' => 'form-control' . ($errors->has('Apellido_Cliente') ? ' is-invalid' : ''), 'placeholder' => 'Apellido Cliente']) }}
            {!! $errors->first('Apellido_Cliente', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Telefono_emergencias_Cliente') }}
            {{ Form::text('Telefono_emergencias_Cliente', $cliente->Telefono_emergencias_Cliente, ['class' => 'form-control' . ($errors->has('Telefono_emergencias_Cliente') ? ' is-invalid' : ''), 'placeholder' => 'Telefono Emergencias Cliente']) }}
            {!! $errors->first('Telefono_emergencias_Cliente', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Mail_emergencias_cliente') }}
            {{ Form::text('Mail_emergencias_cliente', $cliente->Mail_emergencias_cliente, ['class' => 'form-control' . ($errors->has('Mail_emergencias_cliente') ? ' is-invalid' : ''), 'placeholder' => 'Mail Emergencias Cliente']) }}
            {!! $errors->first('Mail_emergencias_cliente', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>