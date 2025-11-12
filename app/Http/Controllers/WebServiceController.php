<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\ValidationException;
use App\Models\ToursContratoCupo;
use App\Models\Tour;
use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\ClienteDetalleReserva;
use App\Models\DetalleReserva;
use App\Models\TrasladosContratoCupo;
use App\Models\PreciosCupoRelease;
use App\Models\CarritoComprasItem;
use App\Models\Ciudade;
use App\Models\Paise;
use App\Models\Zona;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\TextPart;
use Illuminate\Contracts\Mail\Mailable;



class WebServiceController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['login']]);
  }

  public function generarLocalizador()
  {
    $longitud = 5;
    $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $caracteres .= "1234567890";
    $loc = "";


    $index = 0;

    $tmp = "";
    for ($i = 0; $i < $longitud; $i++) {
      $loc .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    // verificamos si ese localizador existe en las reservas
    if ($this->localizadorExiste($loc)) {
      return $this->generarLocalizador();
    } else {
      return $loc;
    }
  }

  
  public function getFotoPrincipalTour(Request $request)
  {
    $tours = Tour::where('id', '=', $request['Id_Tour'])
      ->selectRaw("Foto_tours")
      ->get();

    $to = NULL;
    foreach ($tours as $to);
    if ($to !== NULL) {


      return response()->json($to->Foto_tours, 200);
    } else {
      return response()->json(['error' => 'No hay foto para ese id.'], 401);
    }
  }
  public function getCiudadTour()
  {
  }


  public function getPaisTour()
  {
  }

  public function getZonaTour()
  {
  }

  public function CreateCliente(Request $request)
  {
    $usuario = response()->json(auth()->user());
    $user = $usuario->getData(true);
    if (isset($user['id'])) {
      //$request->validate(Cliente::$rules);

      $cliente = Cliente::create($request->all());

      return response()->json($cliente, 200);
    } else { // no esta logeado o no tiene el token
      return response()->json(['error' => 'Sin el token'], 401);
    }
  }

  public function SelectCliente(Request $request)
  {
    $usuario = response()->json(auth()->user());
    $user = $usuario->getData(true);
    if (isset($user['id'])) {
      // se debe seleccionar por Nombre_Cliente y Apellido_Cliente, solo 2 campos son del Request
      if ($request['Apellido_Cliente'] == NULL && $request['Nombre_Cliente'] == NULL) {
        return response()->json(['error' => 'No Ingreso ningun nombre ni apellido para la busqueda'], 401);
      }

      $cliente = Cliente::where('Nombre_Cliente', 'like', '%' . $request['Nombre_Cliente'] . '%')
        ->where('Apellido_Cliente', 'like', '%' . $request['Apellido_Cliente'] . '%')
        ->get();

      return response()->json($cliente, 200);
    } else { // no esta logeado o no tiene el token
      return response()->json(['error' => 'Sin el token'], 401);
    }
  }

  public function verificardisponibilidadtour($mk, $Fecha_disponible, $Edad_menores, $Id_contrato, $Tour_id, $Cantidad_adultos, $Cantidad_menores)
  {
    //$Edad_menores es un texto con edades separadas por comas (,)
    $dia_de_hoy = date('Y-m-d');



    $diff = abs(strtotime($Fecha_disponible) - strtotime($dia_de_hoy));
    $diff2 = strtotime($Fecha_disponible) - strtotime($dia_de_hoy);
    if ($diff2 < 0) {
      $signo = -1;
    } else {
      $signo = 1;
    }


    $years = floor($diff / (365 * 60 * 60 * 24));
    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

    // printf("%d years, %d months, %d days\n", $years, $months, $days);

    $days = $days * $signo;


    // meter a una matriz todas las edades de menores.
    $matriz_edades = explode(',', $Edad_menores); //Todas las edades separadas por coma (,)

    $cupo = $Cantidad_adultos + $Cantidad_menores;

    if ($cupo > 10) {
      return response()->json(['error' => 'Por el numero debes cotizar grupo al mail grupos@visionmundo.com'], 401);
    }
    // luego solo colocar la edad del mayor

    $tourcontrato = ToursContratoCupo::join("tours", "tours.id", "=", "Tours_id")
      ->selectRaw("tours.id as Id_Tour,Nombre_tour,tours_contrato_cupos.id as Id_contrato,Costo_adulto*$mk as Precio_adulto,Costo_menor*$mk as Precio_menor,((Costo_adulto*Cantidad_adultos)+(Costo_menor*Cantidad_menores)) as Costo_Total,((Costo_adulto*Cantidad_adultos)+(Costo_menor*Cantidad_menores))*$mk as Precio_Total,Cantidad_adultos,Cantidad_menores,cantidad_dias_tour,Email_contacto_tour")
      ->where('tours_contrato_cupos.id', $Id_contrato)
      ->where('tours.id', $Tour_id)
      ->where('Cantidad_adultos', $Cantidad_adultos)
      ->where('Cantidad_menores', $Cantidad_menores)
      ->where('cupo', '>=', $cupo)
      ->where('Fecha_disponible', '=', $Fecha_disponible)
      ->where('Release', '<=', $days);
    foreach ($matriz_edades as $edad) {
      $tourcontrato->Where(function ($query) use ($edad) {
        $query->where('Edad_menor', '>=', $edad);
      });
    }



    return $tourcontrato = $tourcontrato->get();
  }

  public function verificardisponibilidadtraslados($mk,$Fecha_disponible,$Edad_menores,$Id_contrato,$Servicio_traslados_Id,$Cantidad_adultos,$Cantidad_menores)
  {
              //$Edad_menores es un texto con edades separadas por comas (,)
          $dia_de_hoy=date('Y-m-d');

 

          $diff = abs(strtotime($Fecha_disponible) - strtotime( $dia_de_hoy));
          $diff2 = strtotime($Fecha_disponible) - strtotime( $dia_de_hoy);
          if ($diff2 < 0) {
              $signo = -1;
          }
            else{
              $signo = 1;
              }
          

          $years = floor($diff / (365*60*60*24));
          $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
          $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        // printf("%d years, %d months, %d days\n", $years, $months, $days);

          $days = $days * $signo;


          // meter a una matriz todas las edades de menores.
          $matriz_edades= explode(',',$Edad_menores);//Todas las edades separadas por coma (,)

      $cupo= $Cantidad_adultos+ $Cantidad_menores;

        if ($cupo > 10) 
        {  
            return response()->json(['error' => 'Por el numero debes cotizar grupo al mail grupos@visionmundo.com'], 401);
        }
        // luego solo colocar la edad del mayor

        $trasladoscontrato=TrasladosContratoCupo::join("servicio_traslados","servicio_traslados.id","=","Servicio_traslado_Id")
      ->selectRaw("servicio_traslados.id as Servicio_traslados_Id,Nombre_Servicio,traslados_contrato_cupos.id as Id_contrato,Costo_adulto*$mk as Precio_adulto,Costo_menor*$mk as Precio_menor,((Costo_adulto*Cantidad_adultos)+(Costo_menor*Cantidad_menores)) as Costo_Total,((Costo_adulto*Cantidad_adultos)+(Costo_menor*Cantidad_menores))*$mk as Precio_Total,Cantidad_adultos,Cantidad_menores,Tipo_servicio_tansfer,Zona_Origen_id,Zona_Destino_id,Email_contacto_traslado")
      ->where('traslados_contrato_cupos.id',$Id_contrato) 
      ->where('servicio_traslados.id', $Servicio_traslados_Id)
      ->where('Cantidad_adultos',$Cantidad_adultos)
      ->where('Cantidad_menores', $Cantidad_menores)
      ->where('cupo','>=', $cupo)
      ->where('Fecha_disponible','=', $Fecha_disponible)
      ->where('Release','<=', $days);
      foreach ($matriz_edades as $edad) {
        $trasladoscontrato->Where(function ($query) use ($edad) {
          $query->where('Edad_menor', '>=', $edad);
        });

      }


 
     return $trasladoscontrato = $trasladoscontrato->get();

  }

  public function verificardisponibilidadhotel($mk,$Fecha_In,$Fecha_Out,$Id_tipo_habitacion_hotel,$Precio_total,$Cantidad_adultos,$Cantidad_menores)
  {
              //$Edad_menores es un texto con edades separadas por comas (,)
          $dia_de_hoy=date('Y-m-d');

 

          $diff = abs(strtotime($Fecha_In) - strtotime( $dia_de_hoy));
          $diff2 = strtotime($Fecha_In) - strtotime( $dia_de_hoy);
          if ($diff2 < 0) {
              $signo = -1;
          }
            else{
              $signo = 1;
              }
          

          $years = floor($diff / (365*60*60*24));
          $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
          $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        // printf("%d years, %d months, %d days\n", $years, $months, $days);

          $days = $days * $signo;


     

      $Precio_cupo_release = PreciosCupoRelease::selectRaw("hotels.Id_Hotel as Id_hotel,tipo_habitacion_hotels.id as Id_tipo_habitacion_hotels,Nombre_Habitacion,Cupo_habitacion,Cierre,precios_cupo_releases.id as Id_Contrato,Fecha_precio_cupo_release_noche,Costo_habitacion")
      ->join("tipo_habitacion_hotels", "precios_cupo_releases.Tipo_habitacion_hotel_id_tipo_habitacion_hotel", "=", "tipo_habitacion_hotels.id")
      ->join("tipo_habitacion_generals", "tipo_habitacion_generals.id", "=", "tipo_habitacion_hotels.Tipo_Habitacion_general_Id_tipo_Habitacion_general")
      ->join("hotels", "hotels.Id_Hotel", "=", "tipo_habitacion_hotels.Hotel_Id_Hotel")
      ->where('Fecha_precio_cupo_release_noche', '>=', $Fecha_In)
      ->where('Fecha_precio_cupo_release_noche', '<', $Fecha_Out)
      ->where('tipo_habitacion_hotels.id', '=', $Id_tipo_habitacion_hotel)
      ->where('Cupo_habitacion', '>', 0)
      ->where('Release_habitacion', '<=', $days)
      ->where('Cierre', '=', 0)
      ->where('Cantidad_Adultos', '=', $Cantidad_adultos)
      ->where('Cantidad_Menores', '=', $Cantidad_menores)->distinct();
 
      $Precio_cupo_release = $Precio_cupo_release->get();
         // si da resultado, hay que eliminar un Cupo_habitacion de la tabla  precios_cupo_releases
         if(isset($Precio_cupo_release[0]['Id_Contrato'])) 
         { 
          //print_r($Precio_cupo_release);
          $Costo_total_habitacion=0;
          $Precio_total_habitacion=0;
           $res= [];
            foreach ($Precio_cupo_release as $resultado) 
            {
              $idContrato = $resultado['Id_Contrato'];
              $cupoHabitacion = $resultado['Cupo_habitacion'];
              $Costo_total_habitacion=$Costo_total_habitacion+$resultado['Costo_habitacion'];
              
      
              // Restar 1 al campo Cupo_habitacion
              $nuevoCupo = $cupoHabitacion - 1;
      
              // Actualizar el campo Cupo_habitacion en la base de datos
              PreciosCupoRelease::where('id', $idContrato)
                  ->update(['Cupo_habitacion' => $nuevoCupo]);
            }
            $Precio_total_habitacion=$mk*$Costo_total_habitacion;
            $res['Costo_total_habitacion']=$Costo_total_habitacion;
            $res['Precio_total_habitacion']=$Precio_total_habitacion;
          return $res;
         }
         else
         { 
          return false;
         }

 
    

  }
  
  public function getDispoTour(Request $request)
  {
    try {
      $validatedData = $request->validate([
        'Ciudad_Id_Ciudad' => 'required|numeric|max:10000000',
        'Fecha_disponible' => 'required|date',
        'Cantidad_adultos' => 'required|numeric|max:9',
        'Cantidad_menores' => 'required|numeric|max:9',
        'Edad_menores' => 'required|max:23',
      ]);
    } catch (ValidationException $e) {
      return response()->json([
        'error' => $e->getMessage(),
        'validation_errors' => $e->errors(),
      ], 422);
    }

    $usuario = response()->json(auth()->user());
    $user = $usuario->getData(true);

    $mk = $user['markup'];


    $dia_de_hoy = date('Y-m-d');
    $fechadispo = $request['Fecha_disponible'];


    $diff = abs(strtotime($fechadispo) - strtotime($dia_de_hoy));
    $diff2 = strtotime($fechadispo) - strtotime($dia_de_hoy);
    if ($diff2 < 0) {
      $signo = -1;
    } else {
      $signo = 1;
    }


    $years = floor($diff / (365 * 60 * 60 * 24));
    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

    // printf("%d years, %d months, %d days\n", $years, $months, $days);

    //Dias antes que estoy del tour.
    $days = $days * $signo;


    // meter a una matriz todas las edades de menores.
    $matriz_edades = explode(',', $request['Edad_menores']); //Todas las edades separadas por coma (,)



    $idc = (int) $request['Ciudad_Id_Ciudad'];
    $cupo = $request['Cantidad_adultos'] + $request['Cantidad_menores'];

    if ($cupo > 10) {
      return response()->json(['error' => 'Por el numero debes cotizar grupo al mail grupos@visionmundo.com'], 401);
    }
    // luego solo colocar la edad


    $tourcontrato = ToursContratoCupo::join("tours", "tours.id", "=", "Tours_id")
      ->selectRaw("Fecha_disponible,DATE_ADD(Fecha_disponible, INTERVAL cantidad_noches_tour DAY) AS Fecha_out,cantidad_dias_tour,cantidad_noches_tour,tours.id as Id_Tour,Nombre_tour,tours_contrato_cupos.id as Id_contrato,Costo_adulto*$mk as Precio_adulto,Costo_menor*$mk as Precio_menor,((Costo_adulto*Cantidad_adultos)+(Costo_menor*Cantidad_menores))*$mk as Precio_Total,Cantidad_adultos,Cantidad_menores")
      ->where('Cantidad_adultos', $request['Cantidad_adultos'])
      ->where('Cantidad_menores', $request['Cantidad_menores'])
      ->where('Ciudad_Id_Ciudad', '=', $idc)
      ->where('cupo', '>=', $cupo)
      ->where('Fecha_disponible', '=', $request['Fecha_disponible'])
      ->where('Release', '<=', $days);
    foreach ($matriz_edades as $edad) {
      $tourcontrato->Where(function ($query) use ($edad) {
        $query->where('Edad_menor', '>=', $edad);
      });
    }

    $tourcontrato = $tourcontrato->get();

    if (isset($tourcontrato[0]['Id_Tour'])) {
      return response()->json($tourcontrato, 200);
    } else {
      return response()->json(['error' => 'No hay respuesta tu solicitud, intenta cambiar los datos'], 401);
    }
  }

  public function putReservaTour(Request $request)
  {
    try {
      $validatedData = $request->validate([
        'tipo_reserva' => 'required|max:4',
        'Fecha_in' => 'required|date',
        'Cantidad_adultos' => 'required|numeric|max:9',
        'Cantidad_menores' => 'required|numeric|max:9',
        'Tour_id' => 'required|numeric|max:1000000000',
        'Id_Clientes' => 'required|max:1000000000',
        'Id_contrato' => 'required|max:1000000000',
        'Edad_menores' => 'required|max:27',
        'Nombre_Cliente' => 'required|max:250',
      ]);
    } catch (ValidationException $e) {
      return response()->json([
        'error' => $e->getMessage(),
        'validation_errors' => $e->errors(),
      ], 422);
    }



    $usuario = response()->json(auth()->user());

    $user = $usuario->getData(true);

    $mk = $user['markup'];

    $resp_disponibilidad = $this->verificardisponibilidadtour($mk, $request['Fecha_in'], $request['Edad_menores'], $request['Id_contrato'], $request['Tour_id'], $request['Cantidad_adultos'], $request['Cantidad_menores']);
    if (isset($resp_disponibilidad[0]['Id_Tour'])) {
      // aqui sacaremos los datos necesarios para la disponibilidad.
      //Importe_Reserva
      $request['Importe_Reserva'] = $resp_disponibilidad[0]['Precio_Total'];
      //Usuario_id
      $request['Usuario_id'] = $user['id'];
      // Localizador
      $request['Localizador'] = $this->generarLocalizador();
      // Fecha_out, esto es en el detalle
      $dias = $resp_disponibilidad[0]['cantidad_dias_tour'];
      $request['Fecha_out'] = date("Y-m-d", strtotime($request['Fecha_in'] . " + " . $dias . " days"));

      // Precio_Servicio, esto es en el detalle
      $request['Precio_Servicio'] = $resp_disponibilidad[0]['Precio_Total'];
      // Costo_servicio, esto va en el detalle
      $request['Costo_servicio'] = $resp_disponibilidad[0]['Costo_Total'];
      $request['Tour_Id_tour'] = $resp_disponibilidad[0]['Id_Tour'];

      $request['Numero_Adultos'] = $request['Cantidad_adultos'];
      $request['Numero_menores'] = $request['Cantidad_menores'];
      $request['Email_contacto_reserva'] = $resp_disponibilidad[0]['Email_contacto_tour'];
    } else {
      return response()->json(['error' => 'No hay respuesta tu solicitud, intenta cambiar los datos'], 401);
    }

    try {
      DB::beginTransaction();
      $reserva = Reserva::create($request->all());
      $request['Reserva_Id_reserva'] = $reserva->id;
      $detalleReserva = DetalleReserva::create($request->all());
      $request['Detalle_reserva_Id_detalle_Reserva'] = $detalleReserva->id;

      $matriz_Id_clientes = explode(',', $request['Id_Clientes']); //Todos los ids de clientes separados por coma (,)

      foreach ($matriz_Id_clientes as $idcliente) {
        //ingresar el idcliente
        $request['Cliente_Id_Cliente'] = $idcliente;
        $clienteDetalleReserva = ClienteDetalleReserva::create($request->all());
      }
      //deberia bajar el numero de cupos en ese dia.

      DB::commit();
    } catch (Exception $e) {
      DB::rollBack();
      // Maneja el error aquí
      return response()->json(['error' => 'Error al ingresar la reserva $e'], 401);
    }



    //aqui envia el resultado de la reserva. Mostrando que se ingreso correctamente.
    if ($reserva->id !== NULL) {



      $destinatario = $reserva->Email_contacto_reserva . ',alexvazu@gmail.com';
      $asunto = 'Correo de Reserva ' . $reserva->Localizador;
      $mensaje = 'Se realizo una reserva este es un mensaje de correo de Reservas, del Licalizador: ' . $reserva->Localizador . ' </br>' . $reserva->Comentarios;

      $emailhead['from'] = 'extranet@visionmundo.com';


      mail($destinatario, $asunto, $mensaje, $emailhead);

      return response()->json($reserva, 200);
    }
  }



  
  







}