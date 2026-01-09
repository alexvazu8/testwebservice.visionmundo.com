<?php

namespace App\Http\Controllers;

use App\Models\CarritoComprasItem;
use App\Models\DetalleHotel;
use App\Models\DetalleReserva;
use App\Models\DetalleTour;
use App\Models\DetalleTraslado;
use App\Models\Hotel;
use App\Models\PreciosCupoRelease;
use App\Models\Reserva;
use App\Models\TipoHabitacionHotel;
use App\Models\Cliente;
use App\Models\ClienteDetalleReserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


/**
 * Class ReservaController
 * @package App\Http\Controllers
 */
class ReservaController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth:api', ['except' => ['login']]);
  }
  
  public function enviarCorreoSimple($to, $subject, $mensaje)
  {
        try {
            Mail::raw($mensaje, function ($message) use ($to, $subject) {
                $message->to($to)
                        ->subject($subject);
            });
        
            // Si llega acá, el correo se envió (al menos Laravel no detectó error)
              Log::info("Correo enviado correctamente a: {$to} con asunto: {$subject}");
            return 'Correo enviado correctamente.';
        } 
        catch (\Exception $e) {
            // Aquí capturás errores de envío
              Log::error("Error al enviar correo a: {$to}. Error: " . $e->getMessage());
            return 'Error al enviar correo: ' . $e->getMessage();
        }
      

  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = Reserva::paginate();

        return view('reserva.index', compact('reservas'))
            ->with('i', (request()->input('page', 1) - 1) * $reservas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reserva = new Reserva();
        return view('reserva.create', compact('reserva'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Reserva::$rules);

        $reserva = Reserva::create($request->all());

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reserva = Reserva::find($id);

        return view('reserva.show', compact('reserva'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reserva = Reserva::find($id);

        return view('reserva.edit', compact('reserva'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Reserva $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        request()->validate(Reserva::$rules);

        $reserva->update($request->all());

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva updated successfully');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $reserva = Reserva::find($id)->delete();

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva deleted successfully');
    }
    



    public function generarLocalizador()
    {
        $longitud = 6;
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
        }
        else{
          return $loc;
        }
    }

  public function localizadorExiste($loc)
  {
    $reserva = Reserva::where('Localizador', $loc)
      ->get();
    $res = NULL;
    foreach ($reserva as $res);
    if ($res !== NULL) { //existe el localizador
      return true;
    } else {
      //no existe el localizador
      return false;
    }
  }

  
/**
 * @OA\Post(
 *     path="/api/auth/confirmReserva",
 *     operationId="confirmReserva",
 *     tags={"Reservas"},
 *     summary="Confirmar reserva.",
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos de entrada en formato JSON",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 required={"Nombre_titular_reserva", "Apellido_titular_reserva", "Telefono_titular_reserva"},
 *                 @OA\Property(
 *                     property="Nombre_titular_reserva",
 *                     type="string",
 *                     example="Alejandro"
 *                 ),
 *                 @OA\Property(
 *                     property="Apellido_titular_reserva",
 *                     type="string",
 *                     example="Rodriguez"
 *                 ),
 *                 @OA\Property(
 *                     property="Telefono_titular_reserva",
 *                     type="string",
 *                     example="+591-69166655"
 *                 ),
 *                 @OA\Property(
 *                     property="Email_contacto_reserva",
 *                     type="string",
 *                     example="alexvazu@gmail.com"
 *                 ),
 *                 @OA\Property(
 *                     property="Comentarios",
 *                     type="string",
 *                     example="Ingreso, media noche"
 *                 ),
 *                 @OA\Property(
 *                     property="Clientes_por_servicio",
 *                     type="object",
 *                     description="Opcional. Mapa de servicios y sus clientes. Si se incluye, cada cliente debe tener los campos obligatorios.",
 *                     @OA\AdditionalProperties(
 *                         type="object",
 *                         @OA\AdditionalProperties(
 *                             type="object",
 *                             required={"Tipo", "Documento_Id_Cliente", "COD_IATA_PAIS", "Nombre_Cliente", "Apellido_Cliente"},
 *                             @OA\Property(property="Tipo", type="string", description="A = Adulto, M = Menor", maxLength=1),
 *                             @OA\Property(property="Documento_Id_Cliente", type="string", maxLength=20),
 *                             @OA\Property(property="COD_IATA_PAIS", type="string", maxLength=3),
 *                             @OA\Property(property="Nombre_Cliente", type="string"),
 *                             @OA\Property(property="Apellido_Cliente", type="string"),
 *                             @OA\Property(property="Telefono_emergencias_Cliente", type="string", nullable=true, description="Opcional"),
 *                             @OA\Property(property="Mail_emergencias_cliente", type="mail", nullable=true, description="Opcional"),
 *                             @OA\Property(property="edad", type="integer", nullable=true, description="Solo requerido si Tipo = M")
 *                         )
 *                     ),
 *                     example={
 *                         "18": {
 *                             "1": {
 *                                 "Tipo": "A",
 *                                 "Documento_Id_Cliente": "123456",
 *                                 "COD_IATA_PAIS": "BO",
 *                                 "Nombre_Cliente": "Juan",
 *                                 "Apellido_Cliente": "Perez",
 *                                 "Telefono_emergencias_Cliente": "+591-666111",
 *                                 "Mail_emergencias_cliente": "emergencia@mail.com"
 *                             }
 *                         },
 *                         "19": {
 *                              "1": {
 *                                 "Tipo": "A",
 *                                 "Documento_Id_Cliente": "999111",
 *                                 "COD_IATA_PAIS": "BO",
 *                                 "Nombre_Cliente": "Lucía",
 *                                 "Apellido_Cliente": "Armaniz",
 *                                 "edad": 30
 *                             },
 *                             "2": {
 *                                 "Tipo": "M",
 *                                 "Documento_Id_Cliente": "999111",
 *                                 "COD_IATA_PAIS": "BO",
 *                                 "Nombre_Cliente": "Lucía",
 *                                 "Apellido_Cliente": "Gómez",
 *                                 "edad": 10
 *                             }
 *                         }
 *                     },
 *                     @OA\AdditionalProperties(
 *                         type="object",
 *                         @OA\AdditionalProperties(
 *                             type="object",
 *                             required={
 *                                 "Tipo",
 *                                 "Documento_Id_Cliente",
 *                                 "COD_IATA_PAIS",
 *                                 "Nombre_Cliente",
 *                                 "Apellido_Cliente"
 *                             },
 *                             @OA\Property(
 *                                 property="Tipo",
 *                                 type="string",
 *                                 enum={"A", "M"},
 *                                 description="A=Adulto, M=Menor"
 *                             ),
 *                             @OA\Property(
 *                                 property="Documento_Id_Cliente",
 *                                 type="string"
 *                             ),
 *                             @OA\Property(
 *                                 property="COD_IATA_PAIS",
 *                                 type="string",
 *                                 maxLength=3
 *                             ),
 *                             @OA\Property(
 *                                 property="Nombre_Cliente",
 *                                 type="string"
 *                             ),
 *                             @OA\Property(
 *                                 property="Apellido_Cliente",
 *                                 type="string"
 *                             ),
 *                             @OA\Property(
 *                                 property="Telefono_emergencias_Cliente",
 *                                 type="string",
 *                                 nullable=true,
 *                                 description="Opcional"
 *                             ),
 *                             @OA\Property(
 *                                 property="Mail_emergencias_cliente",
 *                                 type="mail",
 *                                 nullable=true,
 *                                 description="Opcional"
 *                             ),
 *                             @OA\Property(
 *                                 property="edad",
 *                                 type="integer",
 *                                 nullable=true,
 *                                 description="Solo requerido si Tipo = M (menor)"
 *                             )
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Reserva confirmada exitosamente"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Error en la autenticación"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Solicitud inválida o parámetros faltantes"
 *     )
 * )
 */




 public function confirmReserva(Request $request)
 {  
   
   
       try {
         $rules = [
        
           'Nombre_titular_reserva' => 'required|max:50',
           'Apellido_titular_reserva' => 'required|max:50',
           'Telefono_titular_reserva' => 'required|max:30|regex:/^[\+\-\d\s]+$/',
           'Email_contacto_reserva' => 'required|email|max:250',
           'Comentarios' => 'max:250',
           
           'Clientes_por_servicio' => 'nullable|array',
            'Clientes_por_servicio.*' => 'array',
             // Para cada servicio (nivel de servicio)
            //'Clientes_por_servicio.*.Hotel_recojo' => 'nullable|string|max:100',
    
            // Para cada cliente dentro del servicio
            'Clientes_por_servicio.*.*.Tipo' => 'required|string|in:A,M',
            'Clientes_por_servicio.*.*.Documento_Id_Cliente' => 'required|string|max:20',
            'Clientes_por_servicio.*.*.COD_IATA_PAIS' => 'required|string|size:2',
            'Clientes_por_servicio.*.*.Nombre_Cliente' => 'required|string|max:50',
            'Clientes_por_servicio.*.*.Apellido_Cliente' => 'required|string|max:50',
            'Clientes_por_servicio.*.*.Telefono_emergencias_Cliente' => 'nullable|string|max:20',
            'Clientes_por_servicio.*.*.Mail_emergencias_cliente' => 'nullable|email',
            'Clientes_por_servicio.*.*.edad' => 'nullable|integer|max:99',
          

         ];

       $validatedData = $request->validate($rules);

       } 
       catch (ValidationException $e) {
         return response()->json([
           'error' => $e->getMessage(),
           'validation_errors' => $e->errors(),
         ], 422);
       }

       $usuario = response()->json(auth()->user());
       $user = $usuario->getData(true);

       $token = str_replace('Bearer ', '', $request->header('Authorization'));
       

       $mk = $user['markup'];
       $UserId = $user['id'];
       $request['Usuario_id'] = $UserId;

       $items = CarritoComprasItem::where('Usuario_id', $request['Usuario_id'])
       ->where('token', $token)
       ->selectRaw("sum(Precio_Total) as Precio_Total")
       ->get();

       $request['Importe_Reserva']=$items[0]['Precio_Total'];
       
       $request['Nombre_Cliente']= $request['Nombre_titular_reserva'];
       $request['Apellido_Cliente']= $request['Apellido_titular_reserva'];
       $request['Telefono_Cliente']= $request['Telefono_titular_reserva'];
       
      
       $request['Localizador'] = $this->generarLocalizador();
       //ahora insertar en la tabla Reservas
     


      
       try {
         DB::beginTransaction();
          

           $items_general = CarritoComprasItem::where('Usuario_id', $request['Usuario_id'])
           ->where('token', $token)
           ->get();
           if(isset($items_general[0]['Precio_Total']))
           { 
            //print_r($request->all());
             $request['Usuario_id']=$items_general[0]['Usuario_id'];

             $reserva = Reserva::create($request->all());
             $request['Reserva_Id_reserva'] = $reserva->id;
           } else {   return response()->json(['error' => 'Error, carrito vacio.'], 401);  } 

           //ahora insertar el detalle reservas
           $i=0;
           foreach ($items_general as $item) {
             //print_r($item); echo "  </br></br></br></br>";
             $detalleReserva = new DetalleReserva;
             /*
             $detalleReserva->Precio_Servicio = $item->Precio_Total;
             $detalleReserva->Reserva_Id_reserva = $request['Reserva_Id_reserva'];
             $detalleReserva->Usuario_id = $item->Usuario_id;*/
               if($item->Tipo_servicio=='TOU') 
               {// tour
                    // $resp_disponibilidad = $this->verificardisponibilidadtour($mk, $item->Fecha_In, $request['Edad_menores'], $item->Id_contrato, $item->id_servicio, $item->Numero_adultos, $item->Numero_menores);
                    $array = $item->toArray();
                    $array['Precio_Servicio']=$item->Precio_Total;
                    $array['Usuario_id']=$request['Usuario_id'];
                    $array['Reserva_Id_reserva']=$reserva->id;
                    $array['Tipo_servicio']=$item->Tipo_servicio;
                    $array['Costo_servicio']=$item->Costo_Total;
                    $array['Email_encargado_reserva']=$item->Email_encargado_reserva;
                    $array['Fecha_In']=$item->carritoTours->Fecha_In;
                    $array['Fecha_Out']=$item->carritoTours->Fecha_Out;
                    $array['Id_tours']=$item->carritoTours->id_tours;
                    $array['Precio_Adulto']=$item->carritoTours->Precio_Adulto;
                    $array['Precio_Menor']=$item->carritoTours->Precio_Menor;
                    $array['Precio_Total']=$item->carritoTours->Precio_Total;
                    $array['Cantidad_Adultos']=$item->carritoTours->Cantidad_Adultos;
                    $array['Cantidad_Menores']=$item->carritoTours->Cantidad_Menores;
                    // print_r($array); 
                       
                    $detalle_res1= DetalleReserva::create($array);
                    $array['detalle_reserva_id']=$detalle_res1->id;
                     $detalleTour= DetalleTour::create($array);
                     
                        // if() deben hacer un if si hay informacion de los datos del cliente, eso es opcional si los campos son Nulos, no entra a este if.
                        if (!empty($request['Clientes_por_servicio'][$item->id])) {
                              $contador_clientes=1;
                              $total_clientes=($array['Cantidad_Adultos']+$array['Cantidad_Menores']);
                                foreach ($request['Clientes_por_servicio'][$item->id] as $clienteData) {
                                    if($contador_clientes<=$total_clientes) // es para que no inserte un nuevo cliente si se pasa de la candidad requerida del Tour
                                    {  $contador_clientes++;
                                        $cliente = Cliente::updateOrCreate(
                                            [
                                                'Documento_Id_Cliente' => $clienteData['Documento_Id_Cliente'],
                                                'COD_IATA_PAIS' => $clienteData['COD_IATA_PAIS'],
                                            ],
                                            [
                                                'Tipo' => $clienteData['Tipo'],
                                                'Nombre_Cliente' => $clienteData['Nombre_Cliente'],
                                                'Apellido_Cliente' => $clienteData['Apellido_Cliente'],
                                                'Telefono_emergencias_Cliente' => $clienteData['Telefono_emergencias_Cliente'] ?? null,
                                                'Mail_emergencias_cliente' => $clienteData['Mail_emergencias_cliente'] ?? null,
                                                'edad' => $clienteData['edad'] ?? null,
                                            ]
                                        );
                                        
                                        $ClienteDetalleReserva= ClienteDetalleReserva::Create(
                                            [
                                                'Detalle_reserva_Id_detalle_Reserva' => $detalle_res1->id,
                                                'Cliente_Id_Cliente' => $cliente->id,
                                            ]
                                            );
                                        
                                    }//fin del si, que es para que no inserte un nuevo cliente si se pasa de la candidad requerida.
                                }
                            
                        }
                     

                
               }
               if($item->Tipo_servicio=='T') 
               {// traslado

                $array = $item->toArray();
                $array['Precio_Servicio']=$item->Precio_Total;
                $array['Usuario_id']=$request['Usuario_id'];
                $array['Reserva_Id_reserva']=$reserva->id;
                $array['Tipo_servicio']=$item->Tipo_servicio;
                $array['Costo_servicio']=$item->Costo_Total;
                $array['Email_encargado_reserva']=$item->Email_encargado_reserva;
                $array['fecha_servicio']=$item->carritoTraslados->fecha_servicio;
                
                $array['Empresa_traslados_tipo_movilidades_id']=$item->carritoTraslados->Empresa_traslados_tipo_movilidades_id;
                $array['Precio_Adulto']=$item->carritoTraslados->Precio_Adulto;
                $array['Precio_Menor']=$item->carritoTraslados->Precio_Menor;
                $array['Precio_Total']=$item->carritoTraslados->Precio_Total;
                $array['Cantidad_Adultos']=$item->carritoTraslados->Cantidad_Adultos;
                $array['Cantidad_Menores']=$item->carritoTraslados->Cantidad_Menores;
                $array['hora_servicio']=$item->carritoTraslados->hora_servicio;
                $array['servicio_traslados_id']=$item->carritoTraslados->servicio_traslados_id;
                $array['Lugar_Origen']=$item->carritoTraslados->Lugar_Origen;
                $array['Lugar_Destino']=$item->carritoTraslados->Lugar_Destino;
                                 
                $detalle_res1= DetalleReserva::create($array);
                $array['detalle_reserva_id']=$detalle_res1->id;
                 $detalleTraslado= DetalleTraslado::create($array);   
                 
                    
                 
                    // if() deben hacer un if si hay informacion de los datos del cliente, eso es opcional si los campos son Nulos, no entra a este if.
                    if (!empty($request['Clientes_por_servicio'][$item->id])){
                          $contador_clientes=1;
                          $total_clientes=($array['Cantidad_Adultos']+$array['Cantidad_Menores']);
                            foreach ($request['Clientes_por_servicio'][$item->id] as $clienteData) {
                                if($contador_clientes<=$total_clientes) // es para que no inserte un nuevo cliente si se pasa de la candidad requerida en el traslado.
                                {  $contador_clientes++;
                                    $cliente = Cliente::updateOrCreate(
                                        [
                                            'Documento_Id_Cliente' => $clienteData['Documento_Id_Cliente'],
                                            'COD_IATA_PAIS' => $clienteData['COD_IATA_PAIS'],
                                        ],
                                        [
                                            'Tipo' => $clienteData['Tipo'],
                                            'Nombre_Cliente' => $clienteData['Nombre_Cliente'],
                                            'Apellido_Cliente' => $clienteData['Apellido_Cliente'],
                                            'Telefono_emergencias_Cliente' => $clienteData['Telefono_emergencias_Cliente'] ?? null,
                                            'Mail_emergencias_cliente' => $clienteData['Mail_emergencias_cliente'] ?? null,
                                            'edad' => $clienteData['edad'] ?? null,
                                        ]
                                    );
                                    
                                    $ClienteDetalleReserva= ClienteDetalleReserva::Create(
                                            [
                                                'Detalle_reserva_Id_detalle_Reserva' => $detalle_res1->id,
                                                'Cliente_Id_Cliente' => $cliente->id,
                                            ]
                                    );
                                }//fin del si, que es para que no inserte un nuevo cliente si se pasa de la candidad requerida.
                            }
                        
                    }
                           
              
               }
               if($item->Tipo_servicio=='H') 
               {// hotel

                //print_r($item);
                $array = $item->toArray();
                $array['Precio_Servicio']=$item->Precio_Total;
                $array['Reserva_Id_reserva']=$reserva->id;
                $array['Cantidad_Adultos']=$item->carritoHotels->Cantidad_Adultos;
                $array['Cantidad_Menores']=$item->carritoHotels->Cantidad_Menores;
                $array['Cantidad_Noches']=$item->carritoHotels->Cantidad_Noches;
                $array['Id_regimen']=$item->carritoHotels->Id_regimen;
                $array['politica_id']=$item->carritoHotels->politica_id;
                $array['Id_tipo_habitacion_hotels']=$item->carritoHotels->Id_tipo_habitacion_hotels;
                $array['Nombre_Habitacion']=$item->carritoHotels->Nombre_Habitacion;
                $array['Nombre_Regimen']=$item->carritoHotels->Nombre_Regimen; 
                $array['Precio_promedio_por_noche']=$item->carritoHotels->Precio_promedio_por_noche;               
                $array['Precio_total_habitacion']=$item->carritoHotels->Precio_total_habitacion;
                $array['Costo_servicio']=$item->Costo_Total;
                $array['Cantidad_habitaciones']=$item->carritoHotels->Cantidad_habitaciones;
                $array['Fecha_In']=$item->carritoHotels->Fecha_In;
                $array['Fecha_Out']=$item->carritoHotels->Fecha_Out;
                $array['Email_encargado_reserva']=$item->Email_encargado_reserva;
                //print_r($array);
                 
                  $detalle_res1= DetalleReserva::create($array);//crea el Detalle de cada item de la reserva o de cada servicio.
                  
                  $array['detalle_reserva_id']=$detalle_res1->id;
                   $detalleHotel= DetalleHotel::create($array);// esta creando del detalle hotel, en este caso de cada hotel.
                   
                   //luego de tener todo puedo añadir los nombres de los clientes, apellido, telefono_emergencias_cliente, email_emergencias_cliente, no es obligatorio.
                   $detalle_res1->id;//este es el id del detalle_reservas y es la foreing key en detallehotel
                   
                  // if() deben hacer un if si hay informacion de los datos del cliente, eso es opcional si los campos son Nulos, no entra a este if.
                  if (!empty($request['Clientes_por_servicio'][$item->id])) {
                      $contador_clientes=1;
                      $total_clientes=$array['Cantidad_habitaciones']*($array['Cantidad_Adultos']+$array['Cantidad_Menores']);
                        foreach ($request['Clientes_por_servicio'][$item->id] as $clienteData) {
                            if($contador_clientes<=$total_clientes) // es para que no inserte un nuevo cliente si se pasa de la candidad requerida en la habitación.
                            {  $contador_clientes++;
                                $cliente = Cliente::updateOrCreate(
                                    [
                                        'Documento_Id_Cliente' => $clienteData['Documento_Id_Cliente'],
                                        'COD_IATA_PAIS' => $clienteData['COD_IATA_PAIS'],
                                    ],
                                    [
                                        'Tipo' => $clienteData['Tipo'],
                                        'Nombre_Cliente' => $clienteData['Nombre_Cliente'],
                                        'Apellido_Cliente' => $clienteData['Apellido_Cliente'],
                                        'Telefono_emergencias_Cliente' => $clienteData['Telefono_emergencias_Cliente'] ?? null,
                                        'Mail_emergencias_cliente' => $clienteData['Mail_emergencias_cliente'] ?? null,
                                        'edad' => $clienteData['edad'] ?? null,
                                    ]
                                );
                               // echo " Cliente Id ";echo $cliente->id;
                               // echo " Detalle Id ";echo $detalle_res1->id;
                                $ClienteDetalleReserva= ClienteDetalleReserva::Create(
                                    [
                                        'Detalle_reserva_Id_detalle_Reserva' => $detalle_res1->id,
                                        'Cliente_Id_Cliente' => $cliente->id,
                                    ]
                                );
                            }//fin del si, que es para que no inserte un nuevo cliente si se pasa de la candidad requerida en la habitación.
                        }
                    
                  }

                   
                   
                             

               }//fin si es hotel
               
           
          $i++;
         }//fin del foreach

                
         DB::commit();
       } catch (Exception $e) {
         DB::rollBack();
         // Maneja el error aquí
         return response()->json(['error' => 'Error al ingresar la reserva $e'], 401);
       }

      
       if(isset($reserva))
       {    
                       
            foreach ($reserva->detalleReservas as $detalle) {
                $mensaje = 'Tu reserva fue confirmada con éxito: ' . $reserva->Localizador ."-" . $detalle->id . "\n\n";
            
                if ($detalle->Tipo_servicio === "H" && $detalle->detalleHotel) {
                    $hotel = $detalle->detalleHotel;
            
                    $mensaje .= "DETALLES DEL HOTEL:\n";
                    $mensaje .= "Titular de la Reserva: " . "\n";
                    $mensaje .= "Nombres: " . $reserva->Nombre_Cliente . " "."\n";
                    $mensaje .= "Apellidos: " . $reserva->Apellido_Cliente . " "."\n";
                    $mensaje .= "Hotel: " . $hotel->tipoHabitacionHotel->hotel->Nombre_Hotel . "\n";
                    $mensaje .= "Habitación: " . $hotel->Nombre_Habitacion . "\n";
                    $mensaje .= "Régimen: " . $hotel->regimen->nombre_regimen . "\n";
                    $mensaje .= "Cantidad de habitaciones: " . $hotel->Cantidad_habitaciones . "\n";
                    $mensaje .= "Cantidad de adultos: " . $hotel->Cantidad_Adultos . "\n";
                    $mensaje .= "Cantidad de menores: " . $hotel->Cantidad_Menores . "\n";
                    $mensaje .= "Cantidad de noches: " . $hotel->Cantidad_Noches . "\n";
                    $mensaje .= "Check-in: " . $hotel->Fecha_In . "\n";
                    $mensaje .= "Check-out: " . $hotel->Fecha_Out . "\n";
                    $mensaje .= "Costo del servicio: " .$detalle->Costo_servicio . "$\n";
                    $mensaje .= "Comentarios: ".$reserva->Comentarios."\n";
                    $mensaje .= "**Favor de responder con el codigo de confirmacion al email de este correo**\n";
                   // $mensaje .= "Precio por noche: $" . number_format($hotel->Precio_promedio_por_noche, 2) . "\n";
                   // $mensaje .= "Precio total por habitación: $" . number_format($hotel->Precio_total_habitacion, 2) . "\n";
                   // $mensaje .= "Precio total del servicio: $" . number_format($detalle->Precio_Servicio, 2) . "\n";
                }
                
                // Aquí podrías hacer lo mismo para tours o traslados más adelante
                if ($detalle->Tipo_servicio === "T" && $detalle->detalleTraslado) {
                    $traslado = $detalle->detalleTraslado;
            
                    $mensaje .= "DETALLES DEL TRASLADO:\n";
                    $mensaje .= "Titular de la Reserva: " . "\n";
                    $mensaje .= "Nombres: " . $reserva->Nombre_Cliente . " "."\n";
                    $mensaje .= "Apellidos: " . $reserva->Apellido_Cliente . " "."\n";
                    $mensaje .= "Servicio: " . $traslado->servicioTraslado->Nombre_Servicio . "\n";
                    $mensaje .= "Detalle de Servicio: " . $traslado->servicioTraslado->Detalle_servicio . "\n";
                    $mensaje .= "Lugar de Origen: " . $traslado->Lugar_Origen . "\n";
                    $mensaje .= "Lugar de Destino: " . $traslado->Lugar_Destino . "\n";
                    $mensaje .= "Fecha de Servicio: " . $traslado->fecha_servicio . "\n";
                    $mensaje .= "Cantidad de adultos: " . $traslado->Cantidad_Adultos . "\n";
                    $mensaje .= "Cantidad de menores: " . $traslado->Cantidad_Menores . "\n";
                    $mensaje .= "Costo del servicio: " .$detalle->Costo_servicio . "$\n";
                    $mensaje .= "Comentarios: ".$reserva->Comentarios."\n";
                    $mensaje .= "**Favor de responder con el codigo de confirmacion al email de este correo**\n";
                   // $mensaje .= "Precio por Adulto: $" . number_format($traslado->Precio_Adulto, 2) . "\n";
                   // $mensaje .= "Precio por Menor: $" . number_format($traslado->Precio_Menor, 2) . "\n";
                   // $mensaje .= "Precio total : $" . number_format($traslado->Precio_Total, 2) . "\n";
                }       
                // Aquí podrías hacer lo mismo para tours o traslados más adelante
                if ($detalle->Tipo_servicio === "TOU" && $detalle->detalleTour) {
                    $tour = $detalle->detalleTour;
            
                    $mensaje .= "DETALLES DEL TOUR:\n";
                    $mensaje .= "Titular de la Reserva: " . "\n";
                    $mensaje .= "Nombres: " . $reserva->Nombre_Cliente . " "."\n";
                    $mensaje .= "Apellidos: " . $reserva->Apellido_Cliente . " "."\n";
                    $mensaje .= "Nombre Tour: " . $tour->tour->Nombre_tour . "\n";
                    $mensaje .= "Detalle Tour: " . $tour->tour->Detalle_tour . "\n";
                    $mensaje .= "Cantidad de adultos: " . $tour->Cantidad_Adultos . "\n";
                    $mensaje .= "Cantidad de menores: " . $tour->Cantidad_Menores . "\n";
                    $mensaje .= "Recojo del Hotel: " . $tour->tour->Recojo_hotel . "\n";
                    $mensaje .= "Punto de encuentro: " . $tour->tour->Punto_encuentro . "\n";
                    $mensaje .= "Cantidad de dias: " . $tour->tour->cantidad_dias_tour . "\n";
                    $mensaje .= "Cantidad de noches: " . $tour->tour->cantidad_noches_tour . "\n";
                    $mensaje .= "Entrega de Agua: " . $tour->tour->Entrega_agua . "\n";
                    $mensaje .= "Para Discapacitados: " . $tour->tour->Para_discapacitados . "\n";
                    $mensaje .= "Con Baños: " . $tour->tour->Con_bano . "\n";
                    $mensaje .= "Pais: " . $tour->tour->pais->Nombre_Pais . "\n";
                    $mensaje .= "Ciudad: " . $tour->tour->ciudad->Nombre_Ciudad . "\n";
                    $mensaje .= "Ciudad: " . $tour->tour->zona->Nombre_Zona . "\n";
                    $mensaje .= "Fecha In: " . $tour->Fecha_In . "\n";
                    $mensaje .= "Horario Inicio: " . $tour->tour->Horario_inicio . "\n";
                    $mensaje .= "Fecha Out: " . $tour->Fecha_Out . "\n";     
                    $mensaje .= "Horario Final: " . $tour->tour->Hora_fin . "\n";
                    $mensaje .= "Costo del servicio: " .$detalle->Costo_servicio . "$\n";
                    $mensaje .= "Comentarios: ".$reserva->Comentarios."\n";
                    $mensaje .= "**Favor de responder con el codigo de confirmacion al email de este correo**\n";
                    //$mensaje .= "Precio por Adulto: $" . number_format($tour->Precio_Adulto, 2) . "\n";
                    //$mensaje .= "Precio por Menor: $" . number_format($tour->Precio_Menor, 2) . "\n";
                    //$mensaje .= "Precio total : $" . number_format($tour->Precio_Total, 2) . "\n";
                }                   
            
                $this->enviarCorreoSimple(
                    $detalle->Email_encargado_reserva ?? 'finanzas@visionmundo.com', // Si tiene email personalizado, úsalo
                    'Confirmación de reserva ' . $reserva->Localizador."-".$detalle->id,
                    $mensaje
                );
                $mensaje="";//Luego de enviar un servicio el mensaje se pone vacio o en blanco.
            }
   
          
 

       /* $destinatario = $reserva->Email_contacto_reserva . ',alexvazu@gmail.com';
        $asunto = 'Correo de Reserva ' . $reserva->Localizador;
        $mensaje = 'Se realizo una reserva, este es un mensaje de correo de reservas, del Licalizador: ' . $reserva->Localizador . ' </br>' . $reserva->Comentarios;
        $emailhead['from'] = 'extranet@visionmundo.com';
        mail($destinatario, $asunto, $mensaje, $emailhead);*/
        
        // Generar nuevo token
           $newToken = auth()->refresh();
        //despues de enviar el mail se elimina los items del carrito.
         CarritoComprasItem::where('Usuario_id', $request['Usuario_id'])->delete();
         
         // Preparar la respuesta
        return response()->json([
            $reserva,
            $items_general,
            'new_token' => $newToken,
            'expires_in' => auth()->factory()->getTTL() * 60  // Tiempo en segundos
        ], 200);
        // return response()->json([$reserva,$items_general], 200);
       } 
       else 
       {   
         
         return response()->json(['error' => 'Error al ingresar la reserva, revise el carrito.'], 401); 
       } 
      



 }

  /**
 * @OA\Get(
 *     path="/api/auth/getReservaByLocalizador",
 *     tags={"Reservas"},
 *     summary="Obtiene una lista de reservas por Localizador",
 *     security={{"bearerAuth":{}}},
 *     description="Busca reservas por Localizador",
 *     operationId="getListaReservasByLocalizador",
 *     @OA\Parameter(
 *         name="Localizador",
 *         in="query",
 *         description="Localizador a buscar",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *    @OA\Response(
 *         response=200,
 *         description="Operación exitosa"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Error en la autenticación"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Solicitud inválida o parámetros faltantes"
 *     ),
 * )
 */

   function getReservaByLocalizador(Request $request)
  {
    $usuario = response()->json(auth()->user());
    $user = $usuario->getData(true);
    if (isset($user['id'])) {
    $reserva = Reserva::where('Localizador', $request['Localizador'])
        ->with([
            'detalleReservas' => function ($query) {
                $query->select([
                    'id', 'Precio_Servicio', 'Reserva_Id_reserva', 'Usuario_id', 'Tipo_servicio', 'Email_encargado_reserva',
                     DB::raw("
                        CASE 
                            WHEN estado = 'X' THEN 'Cancelado'
                            WHEN estado = 'C' THEN 'Confirmado'
                            WHEN estado = 'M' THEN 'Modificado'
                            ELSE estado
                        END as estado
                    ")                    
                ])->with([
                    'detalleHotel' => function ($query) {
                        $query->with([
                            'tipoHabitacionHotel' => function ($query) {
                                $query->with([
                                'hotel' => function ($query) {
                                    $query->with(['estrellas','pais', 'ciudad', 'zona']);
                                    }
                                ]);
                            },
                            'regimen',
                            'politica.penalidads'
                        ]);
                    },
                    'detalleTour' => function ($query) {
                        $query->with([
                            'tour' => function ($query) {
                                $query->with(['pais', 'ciudad', 'zona']);
                            }
                        ]);
                    },
                    'detalleTraslado' => function ($query) {
                        $query->with(['empresaTrasladoTipoMovilidade','servicioTraslado']);
                    }
                ]);
            }
        ])
        ->get();
        
        $photoDomain = config('app.photo_domain');
        
        // Modificar el campo Foto_tours después de obtener los datos
        $reserva->each(function ($reserva) use ($photoDomain) {
            $reserva->detalleReservas->each(function ($detalle) use ($photoDomain) {
                if ($detalle->detalleTour && $detalle->detalleTour->tour) {
                    $detalle->detalleTour->tour->Foto_tours = $photoDomain . '/' . base64_decode($detalle->detalleTour->tour->Foto_tours);
                }
                // Agregar formato a las penalidades de hoteles
                if ($detalle->detalleHotel && $detalle->detalleHotel->politica) {
                    $detalle->detalleHotel->politica->penalidads = $detalle->detalleHotel->politica->penalidads->map(function ($penalidad) {
                        $penalidad->porcentaje_penalidad_por_noche = ($penalidad->porcentaje_penalidad_por_noche * 100) . '%';
                        return $penalidad;
                    });
                }
            });
        });


      $res = NULL;
      foreach ($reserva as $res);
      if ($res !== NULL) {
        return response()->json($reserva, 200);
      } else {
        return response()->json(['error' => 'No corresponde a ninguna reserva.'], 401);
      }
    } else {
      // no esta logeado o no tiene el token
      return response()->json(['error' => 'Sin el token'], 401);
    }
  }

  /**
 * @OA\Get(
 *     path="/api/auth/getListaReservasByDate",
 *     tags={"Reservas"},
 *     summary="Obtiene una lista de reservas por fecha",
 *     security={{"bearerAuth":{}}},
 *     description="Busca reservas por fecha",
 *     operationId="getListaReservasByDate",
 *     @OA\Parameter(
 *         name="fecha_de",
 *         in="query",
 *         description="fecha de creacion",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="fecha_hasta",
 *         in="query",
 *         description="fecha rango hasta de creacion",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *    @OA\Response(
 *         response=200,
 *         description="Reserva Encontrada"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Error en la autenticación"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Solicitud inválida o parámetros faltantes"
 *     ),
 * )
 */

  
  function getListaReservasByDate(Request $request)
  {

    $usuario = response()->json(auth()->user());
    $user = $usuario->getData(true);
    if (isset($user['id'])) {
      $reserva = Reserva::whereBetween('Created_at', [$request['fecha_de'], $request['fecha_hasta']])
        ->get();
        foreach ($reserva as $res) {
          //print_r($res); 
          unset($res->Numero_Adultos);
          unset($res->Numero_menores);
         }
      return response()->json($reserva, 200);
    } else {
      // no esta logeado o no tiene el token
      return response()->json(['error' => 'No esta con login, sin el token'], 401);
    }
  }

  

 /**
 * @OA\Get(
 *     path="/api/auth/getListaReservasByName",
 *     tags={"Reservas"},
 *     security={{"bearerAuth":{}}},
 *     summary="Obtiene reservas por nombre y/o apellido",
 *     description="Busca reservas por nombre, apellido o ambos campos del cliente",
 *     operationId="getListaReservasByName",
 *     @OA\Parameter(
 *         name="Nombre_Cliente",
 *         in="query",
 *         description="Nombre del cliente a buscar",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="Apellido_Cliente",
 *         in="query",
 *         description="Apellido del cliente a buscar",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Reservas encontradas"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Error en la autenticación"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Debe proporcionar al menos nombre o apellido"
 *     )
 * )
 */

    function getListaReservasByName(Request $request)
    {
        $usuario = auth()->user();
        
        if (!$usuario) {
            return response()->json(['error' => 'Sin el token'], 401);
        }
    
        $query = Reserva::query();
    
        // Obtener parámetros de búsqueda
        //print_r($request->all());
        $nombre = $request['Nombre_Cliente'];
        $apellido = $request->input('Apellido_Cliente');
    
        // Construir la consulta dinámicamente según los parámetros proporcionados
        if ($nombre && $apellido) {
            // Buscar por nombre Y apellido
            $query->where(function($q) use ($nombre, $apellido) {
                $q->where('Nombre_Cliente', 'like', '%' . $nombre . '%')
                  ->where('Apellido_Cliente', 'like', '%' . $apellido . '%');
            });
        } elseif ($nombre) {
            // Buscar solo por nombre
            $query->where('Nombre_Cliente', 'like', '%' . $nombre . '%');
        } elseif ($apellido) {
            // Buscar solo por apellido
            $query->where('Apellido_Cliente', 'like', '%' . $apellido . '%');
        } else {
            // No se proporcionó ningún criterio de búsqueda
            return response()->json(['error' => 'Debe proporcionar al menos un criterio de búsqueda'], 400);
        }
    
        // Obtener resultados y eliminar campos no deseados
        $reservas = $query->get()->map(function($reserva) {
            unset($reserva->Numero_Adultos);
            unset($reserva->Numero_menores);
            return $reserva;
        });
    
        return response()->json($reservas, 200);
    }



  function getDetailReserva(Request $request)
  {
    $usuario = response()->json(auth()->user());
    $user = $usuario->getData(true);

    $detalle_reserva = DetalleReserva::where('Reserva_Id_reserva', $request['Reserva_Id_reserva'])->get();
    if(isset($detalle_reserva[0]['Reserva_Id_reserva']))
    { $i=0;
      foreach($detalle_reserva as $key)
      {
        
           if($key->Tipo_servicio=='H') {
            unset($key->Costo_servicio);
            $detalle_reserva[$i]['id_detalle_hotel']=$key->detalleHotel->id;
            $key->detalleHotel->Id_tipo_habitacion_hotels;
            $tipo_hab_hotel= TipoHabitacionHotel::find($key->detalleHotel->Id_tipo_habitacion_hotels)->get();
            $detalle_reserva[$i]['Nombre_Hotel']= $tipo_hab_hotel[0]->hotel->Nombre_Hotel; 
            $detalle_reserva[$i]['Pais_Id_Pais']= $tipo_hab_hotel[0]->hotel->Pais_Id_Pais; 
            $detalle_reserva[$i]['Nombre_Pais']= $tipo_hab_hotel[0]->hotel->pais->Nombre_Pais; 
            $detalle_reserva[$i]['Ciudad_Id_Ciudad']= $tipo_hab_hotel[0]->hotel->ciudad_Id_ciudad; 
            $detalle_reserva[$i]['Nombre_Ciudad']= $tipo_hab_hotel[0]->hotel->ciudad->Nombre_Ciudad; 
            $detalle_reserva[$i]['Zona_Id_Zona']= $tipo_hab_hotel[0]->hotel->Zona_Id_Zona; 
            $detalle_reserva[$i]['Nombre_Zona']= $tipo_hab_hotel[0]->hotel->zona->Nombre_Zona; 
            $detalle_reserva[$i]['Direccion_Hotel']= $tipo_hab_hotel[0]->hotel->Direccion_Hotel;
            $detalle_reserva[$i]['Estrellas']= $tipo_hab_hotel[0]->hotel->estrellas->estrellas;
            $detalle_reserva[$i]['Tipo_Categoria_Estrella']= $tipo_hab_hotel[0]->hotel->estrellas->tipo_categoria;        

           }
           if($key->Tipo_servicio=='T') {
            unset($key->Costo_servicio);
            $detalle_reserva[$i]['id_detalle_traslado']=$key->detalleTraslado->id;
           
           }
           if($key->Tipo_servicio=='Tou') {
            unset($key->Costo_servicio);
            $detalle_reserva[$i]['id_detalle_tour']=$key->detalleTour->id;
           
           }
       $i++;
      }

      return response()->json($detalle_reserva, 200);
    }
    else {
      return response()->json(['error' => 'No corresponde a ninguna reserva.'], 401);
    }

  }

  public function costohabitacionhotel($Fecha_In,$Fecha_Out,$Id_tipo_habitacion_hotel,$Cantidad_adultos,$Cantidad_menores)
    {
                     
        $Precio_cupo_release = PreciosCupoRelease::selectRaw("hotels.Id_Hotel as Id_hotel,tipo_habitacion_hotels.id as Id_tipo_habitacion_hotels,Nombre_Habitacion,Cupo_habitacion,Cierre,precios_cupo_releases.id as Id_Contrato,Fecha_precio_cupo_release_noche,Costo_habitacion")
        ->join("tipo_habitacion_hotels", "precios_cupo_releases.Tipo_habitacion_hotel_id_tipo_habitacion_hotel", "=", "tipo_habitacion_hotels.id")
        ->join("tipo_habitacion_generals", "tipo_habitacion_generals.id", "=", "tipo_habitacion_hotels.Tipo_Habitacion_general_Id_tipo_Habitacion_general")
        ->join("hotels", "hotels.Id_Hotel", "=", "tipo_habitacion_hotels.Hotel_Id_Hotel")
        ->where('Fecha_precio_cupo_release_noche', '>=', $Fecha_In)
        ->where('Fecha_precio_cupo_release_noche', '<', $Fecha_Out)
        ->where('tipo_habitacion_hotels.id', '=', $Id_tipo_habitacion_hotel)
        ->where('Cantidad_Adultos', '=', $Cantidad_adultos)
        ->where('Cantidad_Menores', '=', $Cantidad_menores)->distinct();
   
        $Precio_cupo_release = $Precio_cupo_release->get();
           // si da resultado, hay que eliminar un Cupo_habitacion de la tabla  precios_cupo_releases
           if(isset($Precio_cupo_release[0]['Id_Contrato'])) 
           { 
            //print_r($Precio_cupo_release);
            $Costo_total_habitacion=0;
            
             $res= [];
              foreach ($Precio_cupo_release as $resultado) 
              {
                
                $Costo_total_habitacion=$Costo_total_habitacion+$resultado['Costo_habitacion'];
                
              }
             
              
              
            return $Costo_total_habitacion;
           }
           else
           { 
            return false;
           }
  
   
      
  
    }
/**
 * @OA\Get(
 *     path="/api/auth/voucher",
 *     summary="Obtener detalles de un voucher de reserva",
 *     description="Retorna los detalles de un voucher de reserva por ID de detalle de reserva. Si los campos `detalleTour`, `detalleTraslado` o `detalleHotel` están vacíos, serán ocultados de la respuesta.",
 *     tags={"Reservas"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="query",
 *         description="ID del servicio, detalle de la reserva",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             example=230
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalle del voucher obtenido exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=230),
 *             @OA\Property(property="Precio_Servicio", type="number", example=33.3),
 *             @OA\Property(property="Reserva_Id_reserva", type="integer", example=193),
 *             @OA\Property(property="Usuario_id", type="integer", example=35),
 *             @OA\Property(property="Tipo_servicio", type="string", example="H"),
 *             @OA\Property(property="Email_encargado_reserva", type="string", example="reservas@caminoreal.com"),
 *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-07T13:57:13.000000Z"),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-07T13:57:13.000000Z"),
 *             @OA\Property(property="cliente_detalle_reservas", type="array", @OA\Items(type="object")),
 *             @OA\Property(property="reserva", type="object",
 *                 @OA\Property(property="id", type="integer", example=193),
 *                 @OA\Property(property="Localizador", type="string", example="XKHXR"),
 *                 @OA\Property(property="Importe_Reserva", type="number", example=33.3),
 *                 @OA\Property(property="Nombre_Cliente", type="string", example="Katherina"),
 *                 @OA\Property(property="Apellido_Cliente", type="string", example="Zenteno"),
 *                 @OA\Property(property="Telefono_Cliente", type="string", example="6451215151"),
 *                 @OA\Property(property="Usuario_id", type="integer", example=35),
 *                 @OA\Property(property="Email_contacto_reserva", type="string", example="alexvazu@gmail.com"),
 *                 @OA\Property(property="Comentarios", type="string", nullable=true)
 *             ),
 *             @OA\Property(property="detalle_hotel", type="object", nullable=true,
 *                 @OA\Property(property="id", type="integer", example=46),
 *                 @OA\Property(property="Cantidad_Adultos", type="integer", example=1),
 *                 @OA\Property(property="Cantidad_Menores", type="integer", example=0),
 *                 @OA\Property(property="Cantidad_Noches", type="integer", example=1),
 *                 @OA\Property(property="Fecha_In", type="string", format="date-time", example="2025-05-22 00:00:00"),
 *                 @OA\Property(property="Fecha_Out", type="string", format="date-time", example="2025-05-23 00:00:00"),
 *                 @OA\Property(property="Nombre_Habitacion", type="string", example="Simple Junior"),
 *                 @OA\Property(property="Precio_Total", type="number", example=33.3)
 *             ),
 *             @OA\Property(property="detalle_tour", type="object", nullable=true,
 *                 @OA\Property(property="id", type="integer", example=12),
 *                 @OA\Property(property="Nombre_Tour", type="string", example="Tour por la ciudad"),
 *                 @OA\Property(property="Fecha_In", type="string", format="date-time", example="2025-06-15T09:00:00"),
 *                 @OA\Property(property="Fecha_Out", type="string", format="date-time", example="2025-06-15T17:00:00"),
 *                 @OA\Property(property="Cantidad_Adultos", type="integer", example=2),
 *                 @OA\Property(property="Cantidad_Menores", type="integer", example=1),
 *                 @OA\Property(property="Precio_Adulto", type="number", example=20.0),
 *                 @OA\Property(property="Precio_Menor", type="number", example=10.0),
 *                 @OA\Property(property="Precio_Total", type="number", example=50.0)
 *             ),
 *             @OA\Property(property="detalle_traslado", type="object", nullable=true,
 *                 @OA\Property(property="id", type="integer", example=38),
 *                 @OA\Property(property="Cantidad_Adultos", type="integer", example=1),
 *                 @OA\Property(property="Cantidad_Menores", type="integer", example=2),
 *                 @OA\Property(property="detalle_reserva_id", type="integer", example=227),
 *                 @OA\Property(property="Empresa_traslados_tipo_movilidades_id", type="integer", example=1),
 *                 @OA\Property(property="servicio_traslados_id", type="integer", example=1),
 *                 @OA\Property(property="Lugar_Origen", type="string", example="Trompillo"),
 *                 @OA\Property(property="Lugar_Destino", type="string", example="Camino Real"),
 *                 @OA\Property(property="fecha_servicio", type="string", format="date", example="2025-04-30"),
 *                 @OA\Property(property="hora_servicio", type="string", format="time", example="10:10:00"),
 *                 @OA\Property(property="Precio_Adulto", type="number", example=22.2),
 *                 @OA\Property(property="Precio_Menor", type="number", example=11.1),
 *                 @OA\Property(property="Precio_Total", type="number", example=44.4)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Error de autenticación o ID inválido",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="error", type="string", example="Sin el token o No corresponde a ningun Voucher.")
 *         )
 *     )
 * )
 */





    
    public function voucher(Request $request)
    { 
        
        $usuario = auth()->user();
        
        if (!$usuario) {
            return response()->json(['error' => 'Sin el token'], 401);
        }
        //ahora buscar por el id de detalle de la reserva
       
       // $detalle_reserva = DetalleReserva::find($request['id']);
        // Buscar con relaciones opcionales
        $detalle_reserva = DetalleReserva::with([
            'clienteDetalleReservas',
            'reserva',
            'detalleHotel.politica.penalidads',
            'detalleHotel.tipoHabitacionHotel.hotel', // Relación añadida
            'detalleTour.tour',
            'detalleTour.tour.pais',
            'detalleTour.tour.ciudad',
            'detalleTour.tour.zona',
            'detalleTour.tour.fotosTours',
            'detalleTraslado.servicioTraslado.zona',
            'detalleTraslado.servicioTraslado.zona_destino',
            'detalleTraslado.servicioTraslado.empresaTrasladoTipoMovilidade.tipoMovilidad'
        ])->find($request['id']);
        
        if($detalle_reserva->estado=="X")
        {
             return response()->json([
                        'error' => 'Ya esta cancelado el servicio'    
                    ], 400);
        }        
        
        // Verificar y ocultar campos nulos
        if (is_null($detalle_reserva->detalleTour)) {
            $detalle_reserva->makeHidden(['detalleTour']);
        }
        // Verificar y ocultar campos nulos
        if (is_null($detalle_reserva->detalleTraslado)) {
            $detalle_reserva->makeHidden(['detalleTraslado']);
        }
        // Verificar y ocultar campos nulos
        if (is_null($detalle_reserva->detalleHotel)) {
            $detalle_reserva->makeHidden(['detalleHotel']);
        }
        if(isset($detalle_reserva['id']))
        { 
             $detalle_reserva->makeHidden(['Costo_servicio']); // <- oculta el campo antes de retornar
            // Formatear el porcentaje como texto
            // Verificar si existen las penalidades antes de aplicar el mapeo
            if ($detalle_reserva->detalleHotel && $detalle_reserva->detalleHotel->politica) {
                $detalle_reserva->detalleHotel->politica->penalidads = $detalle_reserva->detalleHotel->politica->penalidads->map(function ($penalidad) {
                    $penalidad->porcentaje_penalidad_por_noche = ($penalidad->porcentaje_penalidad_por_noche * 100) . '%';
                    return $penalidad;
                });
            }

         
         return response()->json($detalle_reserva, 200); 
        }
        else
         { 
          return response()->json(['error' => 'No corresponde a ningun Voucher.'], 401);
        }
        
         
        
    }


}
