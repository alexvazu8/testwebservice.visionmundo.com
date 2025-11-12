<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use App\Models\CarritoComprasItem;
use App\Models\CarritoHotel;
use App\Models\CarritoTour;
use App\Models\CarritoTraslado;
use App\Models\PreciosCupoRelease;
use App\Models\ToursContratoCupo;
use App\Models\TrasladosContratoCupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

/**
 * Class CarritoComprasItemController
 * @package App\Http\Controllers
 */
class CarritoComprasItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','destroy_si_paso_el_tiempo']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function vaciaCarritoVencido()
    {
        $now = Carbon::now()->timestamp; // Obtén el timestamp actual
        // Filtrar los ítems donde el expiration_token sea menor al timestamp actual
        $itemsVencidos = CarritoComprasItem::where('expiration_token', '<', $now)->distinct()->get();
        //print_r($itemsVencidos);
        foreach ($itemsVencidos as $item) {
             //print($item->id);
            if ($item->Tipo_servicio == 'H') {
               
                
                //ahora retornamos (incrementamos) la disponibilidad de las habitaciones a la tabla PrecioCupoRelease de la habitacion de hotel. 
                $pcr = PreciosCupoRelease::where('Fecha_precio_cupo_release_noche', '>=', $item->carritoHotels->Fecha_In)
                    ->where('Fecha_precio_cupo_release_noche', '<', $item->carritoHotels->Fecha_Out)
                    ->where('Tipo_habitacion_hotel_id_tipo_habitacion_hotel', $item->carritoHotels->Id_tipo_habitacion_hotels)
                    ->where('regimen_id', $item->carritoHotels->Id_regimen)
                    ->increment('Cupo_habitacion', $item->carritoHotels->Cantidad_habitaciones);
                // ahora eliminamos el Carrito de Hotel
                $carritoHotel = CarritoHotel::where('carrito_compras_items_id', '=', $item->id)->delete();

            }
            if ($item->Tipo_servicio == 'Tou') {
                $carritoTour = CarritoTour::where('carrito_compras_items_id', '=', $item->id)->delete();
            }
            if ($item->Tipo_servicio == 'T') {
                $carritoTraslado = CarritoTraslado::where('carrito_compras_items_id', '=', $item->id)->delete();
            }
        }
        //Eliminar el CarritoComprasItem de todos los expirados
        return $itemsVencidos2 = CarritoComprasItem::where('expiration_token', '<', $now)->delete();
       
    }
    public function index()
    {
        $carritoComprasItems = CarritoComprasItem::paginate();

        return view('carrito-compras-item.index', compact('carritoComprasItems'))
            ->with('i', (request()->input('page', 1) - 1) * $carritoComprasItems->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carritoComprasItem = new CarritoComprasItem();
        return view('carrito-compras-item.create', compact('carritoComprasItem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(CarritoComprasItem::$rules);

        $carritoComprasItem = CarritoComprasItem::create($request->all());

        return redirect()->route('carrito-compras-items.index')
            ->with('success', 'CarritoComprasItem created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carritoComprasItem = CarritoComprasItem::find($id);

        return view('carrito-compras-item.show', compact('carritoComprasItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carritoComprasItem = CarritoComprasItem::find($id);

        return view('carrito-compras-item.edit', compact('carritoComprasItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  CarritoComprasItem $carritoComprasItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarritoComprasItem $carritoComprasItem)
    {
        request()->validate(CarritoComprasItem::$rules);

        $carritoComprasItem->update($request->all());

        return redirect()->route('carrito-compras-items.index')
            ->with('success', 'CarritoComprasItem updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $carritoComprasItem = CarritoComprasItem::find($id)->delete();

        return redirect()->route('carrito-compras-items.index')
            ->with('success', 'CarritoComprasItem deleted successfully');
    }
    public function destroy_si_paso_el_tiempo()
    {     
        
        // Obtener la fecha y hora actual
        $currentTimestamp = time();


        $carrito1= CarritoComprasItem::where('expiration_token','<',$currentTimestamp)->get();
        foreach($carrito1 as $car)
        { 
            $pcr=PreciosCupoRelease::where('Fecha_precio_cupo_release_noche', '>=', $car->carritoHotels->Fecha_In)
            ->where('Fecha_precio_cupo_release_noche', '<', $car->carritoHotels->Fecha_Out)
            ->where('Tipo_habitacion_hotel_id_tipo_habitacion_hotel',$car->carritoHotels->Id_tipo_habitacion_hotels)
            ->where('regimen_id',$car->carritoHotels->Id_regimen)
            ->increment('Cupo_habitacion', $car->carritoHotels->Cantidad_habitaciones);
            
        } 
        $carrito= CarritoComprasItem::where('expiration_token','<',$currentTimestamp)->delete();
        if(isset($carrito) && ($carrito!==0))
        {
            return response()->json(['message' => 'Registro/s eliminado/s con éxito'], 200);
        }else
        {
            return response()->json(['message' => 'No hay carritos con token expirado'], 400);
        }

        
    }

/**
 * @OA\Post(
 *     path="/api/auth/addCarrito",
 *     tags={"Carritos"},
 *     summary="Añadir servicio al Carrito.",
 *     operationId="addCarrito",
 *     security={{"bearerAuth":{}}},
 *     @OA\SecurityScheme(
 *         securityScheme="bearerAuth",
 *         type="http",
 *         scheme="bearer",
 *         bearerFormat="JWT",
 *         description="Token de autenticación JWT"
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos de entrada en formato JSON para diferentes tipos de servicios",
 *         @OA\JsonContent(
 *             oneOf={
 *                 @OA\Schema( 
 *                     title="Habitaciones de Hotel",
 *                     required={"Fecha_in", "Fecha_out", "Tipo_servicio", "Numero_Habitaciones", "habitaciones"},
 *                     @OA\Property(property="Fecha_in", type="string", format="date", example="2023-12-09"),
 *                     @OA\Property(property="Fecha_out", type="string", format="date", example="2023-12-10"),
 *                     @OA\Property(property="Tipo_servicio", type="string", example="H"),
 *                     @OA\Property(property="Numero_Habitaciones", type="integer", example=3),
 *                     @OA\Property(
 *                         property="habitaciones",
 *                         type="object",
 *                         @OA\Property(
 *                             property="0",
 *                             type="object",
 *                             @OA\Property(property="Id_tipo_habitacion_hotels", type="integer", example=8),
 *                             @OA\Property(property="Id_regimen", type="integer", example=2),
 *                             @OA\Property(property="Nombre_Habitacion", type="string", example="JUNIOR SUITE DOBLE + MENOR"),
 *                             @OA\Property(property="Id_Hotel", type="integer", example=1),
 *                             @OA\Property(property="Cantidad_habitaciones", type="integer", example=2),
 *                             @OA\Property(property="Cantidad_Adultos", type="integer", example=2),
 *                             @OA\Property(property="Cantidad_Menores", type="integer", example=1),
 *                             @OA\Property(property="Edad_menores_gratis", type="integer", example=10),
 *                             @OA\Property(property="Noches", type="integer", example=1),
 *                         ),
 *                         @OA\Property(
 *                            property="1",
 *                            type="object",
 *                             @OA\Property(property="Id_tipo_habitacion_hotels", type="integer", example=9),
 *                             @OA\Property(property="Id_regimen", type="integer", example=2),
 *                             @OA\Property(property="Nombre_Habitacion", type="string", example="JUNIOR SUITE TRIPLE"),
 *                             @OA\Property(property="Id_Hotel", type="integer", example=1),
 *                             @OA\Property(property="Cantidad_habitaciones", type="integer", example=1),
 *                             @OA\Property(property="Cantidad_Adultos", type="integer", example=3),
 *                             @OA\Property(property="Cantidad_Menores", type="integer", example=0),
 *                             @OA\Property(property="Noches", type="integer", example=1),
 *                          )
 *                     )
 *                 ),
 *                 @OA\Schema( 
 *                     title="Traslado",
 *                     required={"Fecha_disponible", "Tipo_servicio", "Tipo_servicio_transfer", "Id_servicio_traslado", "hora_servicio", "Lugar_Origen", "Lugar_Destino", "Traslados_contrato_id", "Numero_adultos"},
 *                     @OA\Property(property="Fecha_disponible", type="string", format="date", example="2025-04-30"),
 *                     @OA\Property(property="Tipo_servicio", type="string", example="T"),
 *                     @OA\Property(property="Tipo_servicio_transfer", type="string", example="IN"),
 *                     @OA\Property(property="Id_servicio_traslado", type="integer", example=1),
 *                     @OA\Property(property="hora_servicio", type="string", example="08:00"),
 *                     @OA\Property(property="Lugar_Origen", type="string", example="Aeropuerto Viru Viru (VVI)"),
 *                     @OA\Property(property="Lugar_Destino", type="string", example="Hotel Camino Real"),
 *                     @OA\Property(property="Traslados_contrato_id", type="integer", example=2549),
 *                     @OA\Property(property="Numero_adultos", type="integer", example=1),
 *                     @OA\Property(property="Numero_menores", type="integer", example=2),
 *                     @OA\Property(
 *                         property="Edad_menores",
 *                         type="object",
 *                         @OA\Property(property="1", type="integer", example=8),
 *                         @OA\Property(property="2", type="integer", example=3)
 *                     )
 *                 ),
 *                 @OA\Schema(
 *                     title="Tour",
 *                     required={"Fecha_disponible", "Tipo_servicio", "Id_contrato_tours", "Numero_adultos"},
 *                     @OA\Property(property="Fecha_disponible", type="string", format="date", example="2025-05-29"),
 *                     @OA\Property(property="Tipo_servicio", type="string", example="TOU"),
 *                     @OA\Property(property="Id_contrato_tours", type="integer", example=2943),
 *                     @OA\Property(property="Numero_adultos", type="integer", example=1),
 *                     @OA\Property(property="Numero_menores", type="integer", example=2),
 *                     @OA\Property(
 *                         property="Edad_menores",
 *                         type="object",
 *                         @OA\Property(property="1", type="integer", example=8),
 *                         @OA\Property(property="2", type="integer", example=3)
 *                     )
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Header(
 *         header="Authorization",
 *         description="Encabezado de autenticación Bearer",
 *         @OA\Schema(
 *             type="string",
 *             format="Bearer {token}"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Servicio añadido correctamente al carrito"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="No autorizado o error de disponibilidad"
 *     )
 * )
 */


    public function AddCarrito(Request $request)
    {     
    //print_r($request->all());
    
        try {
            $rules = [
        
        
            'Numero_adultos' => 'required_if:Tipo_servicio,TOU|required_if:Tipo_servicio,T|numeric|max:9',
            'Numero_menores' => 'required_if:Tipo_servicio,TOU|required_if:Tipo_servicio,T|numeric|max:9',
            'Edad_menores' => 'sometimes|required|array',  // Usamos 'sometimes' para hacer la validación condicional
            'Edad_menores.*' => 'numeric|min:0|max:17',  // Validamos que cada edad dentro del array esté entre 0 y 17
            'Tipo_servicio' => 'required|in:T,H,TOU|max:3',
            'Traslados_contrato_id' => 'required_if:Tipo_servicio,T|max:9',  
            'Tipo_servicio_transfer' => 'required_if:Tipo_servicio,T|max:9',  
            'Id_servicio_traslado' => 'required_if:Tipo_servicio,T|max:9',  
            'Lugar_Origen' => 'required_if:Tipo_servicio,T|max:35',  
            'Lugar_Destino' => 'required_if:Tipo_servicio,T|max:35',  
            'Fecha_disponible' => 'required_if:Tipo_servicio,T|required_if:Tipo_servicio,Tou',
            'hora_servicio' => 'required_if:Tipo_servicio,T|date_format:H:i',  
           // 'Id_contrato' => 'required_if:Tipo_servicio,Tou|required_if:Tipo_servicio,T|numeric',
            'Id_contrato_tours' => 'required_if:Tipo_servicio,TOU|max:9',  
            'Fecha_in' => 'required_if:Tipo_servicio,H|date', 
            'Fecha_out' => 'required_if:Tipo_servicio,H|date',  
            'habitaciones.*.Cantidad_Adultos' => 'required_if:Tipo_servicio,H|numeric|max:9',
            'habitaciones.*.Cantidad_Menores' => 'required_if:Tipo_servicio,H|numeric|max:2',
            'habitaciones.*.Cantidad_habitaciones' => 'required_if:Tipo_servicio,H|numeric|max:3',
            'habitaciones.*.Id_tipo_habitacion_hotels' => 'required_if:Tipo_servicio,H|numeric|max:1000000',
            'habitaciones.*.Id_regimen' => 'required_if:Tipo_servicio,H|numeric|max:1000000',
            

            ];

          // Condicional para hacer que Edad_menores sea obligatorio solo si Tipo_servicio es TOU y Numero_menores > 0
            if ($request->input('Tipo_servicio') === 'TOU' && $request->input('Numero_menores') > 0) {
                $rules['Edad_menores'] = 'required|array';  // Solo cuando se cumplen ambas condiciones
            }

        
        //$validatedData = $request->validate($rules);
            // Valida los datos manualmente
        $validator = Validator::make($request->all(), $rules);
         if ($validator->fails()) {
            return response()->json([
                'error' => 'Errores de validación',
                'validation_errors' => $validator->errors(),
            ], 400);
         }

        // Si la validación pasa, continua con tu lógica
        $validatedData = $validator->validated();

        } 
        catch (ValidationException $e) {
            return response()->json([
            'error' => $e->getMessage(),
            'validation_errors' => $e->errors(),
            ], 400);
        }

        $usuario = response()->json(auth()->user());
        $user = $usuario->getData(true);

        $mk = $user['markup'];
        $UserId = $user['id'];
        $request['Usuario_id'] = $UserId;
        //obtener el token del encabezado.
        $request['token']=$token = str_replace('Bearer ', '', $request->header('Authorization'));
       
        $token2 = JWTAuth::getToken();
        $payload = JWTAuth::getPayload($token2);
        // Obtener el valor de 'exp' (fecha de expiración) del payload
        $expirationTimestamp = $payload->get('exp');
        $arreglo_carrito['expiration_token']=$expirationTimestamp;
        $request['expiration_token']=$arreglo_carrito['expiration_token'];

       
        if($request['Tipo_servicio']=='T') 
        {
            
            //es traslado
                $request['servicio_traslados_id']=$request['Id_servicio_traslado']; 
            
                $request['Tipo_servicio_transfer'];//IN/OUT/HTH

                $res_traslado=$this->verificar_disponibilidad_trasnfers($request['Traslados_contrato_id'],$request['Numero_adultos'],$request['Numero_menores'],$request['Edad_menores']);
                $res_traslado=$res_traslado->get();
                //print_r($res_traslado[0]);
                $request['Precio_Adulto']=$res_traslado[0]['Costo_adulto']*$mk;
                $request['Precio_Menor']=$res_traslado[0]['Costo_menor']*$mk;
                $request['Cantidad_Adultos']=$res_traslado[0]['Cantidad_adultos'];
                $request['Cantidad_Menores']=$res_traslado[0]['Cantidad_menores'];
                $request['Costo_Total']=$res_traslado[0]['Costo_Total'];
                $request['Precio_Total']=$res_traslado[0]['Costo_Total']*$mk;
                $request['Empresa_traslados_tipo_movilidades_id']=$res_traslado[0]['Empresa_traslado_tipo_movilidades_id'];
                $request['servicio_traslados_id']=$res_traslado[0]['Servicio_traslado_Id'];
                $request['Email_encargado_reserva']=$res_traslado[0]['servicioTraslado']['Email_contacto_traslado'];

                
                
            //si es IN metemos Fecha_In
            if($request['Tipo_servicio_transfer']=='IN') { $request['fecha_servicio']=$request['Fecha_In']=$request['Fecha_disponible']; }

            //si es OUT metemos Fecha_In
            if($request['Tipo_servicio_transfer']=='OUT') { $request['fecha_servicio']=$request['Fecha_Out']=$request['Fecha_disponible']; }
            
            // si es de Hotel a Hotel
            if($request['Tipo_servicio_transfer']=='HTH') {  $request['fecha_servicio']=$request['Fecha_In']=$request['Fecha_disponible'];}
      
        }
        if($request['Tipo_servicio']=='TOU') 
        {
            //es un tour
            
            $request['Fecha_In']=$request['Fecha_disponible']; 
           
            $request['id_servicio']=$request['Id_Tour']; 
            $res_tours=$this->verificar_disponibilidad_tours($request['Id_contrato_tours'],$request['Numero_adultos'],$request['Numero_menores'],$request['Edad_menores']);
            //print_r($res_tours);
            $request['fecha_servicio']=$res_tours[0]['fecha_disponible'];
            $request['Fecha_Out']=$res_tours[0]['Fecha_out']; 
            $request['hora_servicio']=$res_tours[0]['Hora_inicio'];
            //$request['hora_fin_servicio']=$res_tours[0]['Hora_fin']; 
            $request['Cantidad_Adultos']=$res_tours[0]['Cantidad_adultos']; 
            $request['Cantidad_Menores']=$res_tours[0]['Cantidad_menores']; 
            $request['Costo_Total']=$res_tours[0]['Costo_Total']; 
            $request['Precio_Adulto']=$res_tours[0]['Costo_adulto']*$mk;
            $request['Precio_Menor']=$res_tours[0]['Costo_menor']*$mk;
            $request['Precio_Total']=$res_tours[0]['Costo_Total']*$mk;
            $request['id_tours']=$res_tours[0]['Tours_id'];
            $request['Email_encargado_reserva']=$res_tours[0]['Email_contacto_tour']; 

        }
        
        if($request['Tipo_servicio']=='H') 
        {

            
                try 
                {

                //es un Hotel
                
                //DB::transaction(function () use ($request, $UserId, $token,$mk) {
                /// aqui hay que meter las habitaciones, si son varias hay que validar eso. y hacer un for o while.
                    foreach($request['habitaciones'] as $res)
                    {   
                        $respuestahotel= $this->verificardisponibilidadhotel($mk,$request['Fecha_in'],$request['Fecha_out'],$res['Id_tipo_habitacion_hotels'],$res['Id_regimen'],$res['Cantidad_habitaciones'],$res['Cantidad_Adultos'],$res['Cantidad_Menores']);
                        
                        if($respuestahotel)
                        {
                            // Obtener las fechas del request
                            $fechaIn = Carbon::parse($request['Fecha_in']);
                            $fechaOut = Carbon::parse($request['Fecha_out']);
                            
                            // Calcular la diferencia en días (noches)
                            $cantidadNoches = $fechaIn->diffInDays($fechaOut);
                            
                            //print_r($respuestahotel);
                            $arreglo_carrito['Usuario_id']=$UserId;
                            $arreglo_carrito['Tipo_servicio']=$request['Tipo_servicio'];
                            $arreglo_carrito['Fecha_In'] =$request['Fecha_in']; 
                            $arreglo_carrito['Fecha_Out'] =$request['Fecha_out']; 
                            //$arreglo_carrito['id_servicio']=$respuestahotel['Id_tipo_habitacion_hotels']; 
                            $arreglo_carrito['Numero_adultos']=$res['Cantidad_Adultos'];
                            $arreglo_carrito['Numero_menores']=$res['Cantidad_Menores'];
                            $arreglo_carrito['Precio_total']=$respuestahotel['Precio_total_habitacion'];//divide el precio entre la cantidad de habitaciones.
                            $arreglo_carrito['token']=$token;
                            $arreglo_carrito['Id_tipo_habitacion_hotels']=$respuestahotel['Id_tipo_habitacion_hotels'];
                            $arreglo_carrito['Id_regimen']=$respuestahotel['Id_regimen'];
                            $arreglo_carrito['Email_encargado_reserva']=$respuestahotel['email_reservas_hotel'];
                            $arreglo_carrito['Cantidad_Adultos']=$res['Cantidad_Adultos'];
                            $arreglo_carrito['Cantidad_Menores']=$res['Cantidad_Menores'];
                            $arreglo_carrito['Cantidad_Noches']=$cantidadNoches;//$res['Cantidad_Noches'];
                            $arreglo_carrito['Cantidad_habitaciones']=$respuestahotel['Cantidad_habitaciones'];
                            $arreglo_carrito['Precio_promedio_por_noche']=$respuestahotel['Precio_total_habitacion']/$cantidadNoches;//$res['Cantidad_Noches'];
                            $arreglo_carrito['Precio_total_habitacion']=$respuestahotel['Precio_total_habitacion'];
                            $arreglo_carrito['Precio_Total']=$respuestahotel['Precio_total_habitacion']*$res['Cantidad_habitaciones'];
                            $arreglo_carrito['Costo_Total']=$respuestahotel['Costo_total_habitacion']*$res['Cantidad_habitaciones'];
                            $arreglo_carrito['Nombre_Habitacion']=$respuestahotel['Nombre_Habitacion'];
                            $arreglo_carrito['Nombre_Regimen']=$respuestahotel['Nombre_Regimen'];
                            
                            $politicaId = PreciosCupoRelease::where('Tipo_habitacion_hotel_id_tipo_habitacion_hotel', $arreglo_carrito['Id_tipo_habitacion_hotels'])
                            ->where('regimen_id', $arreglo_carrito['Id_regimen'])
                            ->whereBetween('Fecha_precio_cupo_release_noche', [
                                Carbon::parse($request['Fecha_in'])->format('Y-m-d'),
                                Carbon::parse($request['Fecha_out'])->subDay()->format('Y-m-d') // Resta 1 día porque la última noche no se cuenta
                            ])
                            ->value('politica_id'); // Obtiene directamente el valor de politica_id
                            
                           $arreglo_carrito['politica_id']=$politicaId;
                            
                            
                            $carrito = CarritoComprasItem::create($arreglo_carrito);
                            $arreglo_carrito['carrito_compras_items_id'] = $carrito->id;
                            $carrito=CarritoHotel::create($arreglo_carrito);
                           
                           
                           
                            unset($respuestahotel);
                            }
                            else 
                            { return response()->json(['error' => 'Error de disponibilidad en el hotel'], 401);}

                       
                    }
                
                    
                    //});
                    $carrito = new CarritoComprasItem;
                    $carrito->Estado = "Éxito";
                    $carrito->Mensaje = "Se ingresó tu petición de Habitación/es de Hotel al Carrito.";
                
                    return response()->json([$carrito],200);
                } 
                catch (QueryException $e) {
                    $carrito = new CarritoComprasItem;
                    $carrito->Estado = "Error";
                    $carrito->Mensaje = "No se pudo ingresar tu petición de Habitación/es de Hotel al Carrito. Error: " . $e->getMessage();
                
                    return response()->json(['mensaje' => $carrito->Mensaje],401);
                }  

        } 
          
            
           
        if($request['Tipo_servicio']!=='H') 
        {  //ingresa si no es Acomodacion de hotel, es decir para Trasfers y tours.
            try {
                DB::beginTransaction();
                $carrito = CarritoComprasItem::create($request->all());
                $request['carrito_compras_items_id'] = $carrito->id;
                if($request['Tipo_servicio']=='T') {
                $carrito=CarritoTraslado::create($request->all());
                 } 
                 if($request['Tipo_servicio']=='TOU') {
                    $carrito=CarritoTour::create($request->all());
                 } 
                 
                //deberia bajar el numero de cupos en ese dia.
                
               
                
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                // Maneja el error aquí
                return response()->json(['error' => 'Error al ingresar la reserva $e'], 500);
            }//fin try

        }
       
        return response()->json(["Estado" => "Éxito","Mensaje" => "Se ingresó tu petición al Carrito."], 200);
        
      

     
     

    }

    /**
    * @OA\Get(
    *      path="/api/auth/showCarrito",
    *      operationId="showCarrito",
    *      tags={"Carritos"},
    *      summary="Obtiene los elementos del carrito",
    *      description="Obtiene los elementos del carrito de compras del usuario autenticado.",
    *      security={{"bearerAuth":{}}},
    *      @OA\Parameter(
    *          name="Authorization",
    *          in="header",
    *          required=true,
    *          description="Token JWT de autenticación",
    *          @OA\Schema(type="string", format="Bearer {token}")
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Elementos del carrito obtenidos correctamente.",
    *          @OA\JsonContent(
    *              @OA\Property(property="Precio_total_carrito", type="number", description="Precio total del carrito")
    *              
    *          )
    *      ),
    *      @OA\Response(
    *          response=401,
    *          description="Error Carrito Vacío."
    *      ),
    * )
    */
    public function showCarrito()
    { 
    $usuario = response()->json(auth()->user());
        $user = $usuario->getData(true);
        $token = str_replace('Bearer ', '', request()->header('Authorization'));

    
        //echo $token = str_replace('Bearer ', '', $request->header('Authorization'));

        $UserId = $user['id'];
        $items_general = CarritoComprasItem::where('Usuario_id', $UserId)
        ->where('token', $token)
        ->get();
        if(isset($items_general[0]['Precio_Total']))
        { $precio_total_carrito=0;
            $i=0;
            foreach($items_general as $item) 
            { 
                if($item['Tipo_servicio']=="H") 
                { 
                    $items_hotel = CarritoHotel::with(['politica.penalidads'])
                        ->where('carrito_compras_items_id', $item['id'])
                        ->get()
                        ->map(function ($hotelItem) {
                            // Eliminar el id si es necesario
                            unset($hotelItem['id']);
                            
                            // Si necesitas formatear el porcentaje de penalidad
                            if ($hotelItem->politica && $hotelItem->politica->penalidads) {
                                $hotelItem->politica->penalidads->transform(function ($penalidad) {
                                    $penalidad->porcentaje_penalidad_por_noche = ($penalidad->porcentaje_penalidad_por_noche * 100) . '%';
                                    return $penalidad;
                                });
                            }
                            
                            return $hotelItem;
                    });
                   // print_r($items_hotel);
                    unset($items_hotel[0]['id']); 
                    $items_general[$i]['detalle']=$items_hotel;
                    
                } 
                if($item['Tipo_servicio']=="TOU") 
                { //tours
                    $items_tour = CarritoTour::where('carrito_compras_items_id', $item['id'])
                    ->with(['tour' => function($query) {
                        $query->select('id', 'Nombre_tour', 'Recojo_hotel', 'cantidad_dias_tour', 
                                       'cantidad_noches_tour', 'Horario_inicio', 'Hora_fin', 
                                       'Pais_Id_Pais', 'Ciudad_Id_Ciudad', 'Zona_Id_Zona')
                              ->with(['pais', 'ciudad', 'zona']);
                        }])
                    ->get(); 
                    unset($items_tour[0]['id']);
                    $items_general[$i]['detalle']=$items_tour;
                    
                } 
                if($item['Tipo_servicio']=="T") 
                { //traslados
                  
                    $items_traslado = CarritoTraslado::where('carrito_compras_items_id', $item['id'])
                    ->with([
                    'servicioTraslado' => function ($query) {
                        $query->select('id', 'Nombre_Servicio', 'Detalle_servicio', 'Tipo_servicio_transfer', 'empresa_traslado_tipo_movilidades_Id', 'Zona_Origen_id', 'Zona_Destino_id');
                    },
                    'empresaTrasladoTipoMovilidade' => function ($query) {
                        $query->select('id', 'Empresa_traslado_Id_Empresa_traslado', 'Tipo_movilidad_Id_tipo_movilidad', 'Marca_modelo', 'Maletas_maximo');
                    }
                    ])
                    ->get(); 
                    unset($items_traslado[0]['id']);
                    $items_general[$i]['detalle']=$items_traslado;
                   
                } 
                unset($items_general[$i]['Costo_Total']);
                unset($items_general[$i]['token']);
            $precio_total_carrito=$precio_total_carrito+$item['Precio_Total'];
            $i++;
            } 
            $items_general['Precio_total_carrito']=$precio_total_carrito;
            return response()->json($items_general, 200);
        } 
        else
        { 
            return response()->json(['error' => 'Error Carrito Vacio.'], 401);
        } 

    
    } 

    /**
    * @OA\Delete(
    *     path="/api/auth/vaciarCarrito",
    *     operationId="vaciarCarrito",
    *     tags={"Carritos"},
    *     summary="Vaciar servicio/s del Carrito.",
    *     security={{"bearerAuth":{}}},
    *     @OA\Parameter(
    *          name="Authorization",
    *          in="header",
    *          required=true,
    *          description="Token JWT de autenticación",
    *          @OA\Schema(type="string", format="Bearer {token}")
    *       ),
    *     @OA\RequestBody(
    *         required=true,
    *         description="Datos de entrada en formato JSON",
    *         @OA\MediaType(
    *             mediaType="application/json"
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Carrito Vacío"
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Error al vaciar el Carrito o está Vacío"
    *     )
    * )
    */


    public function vaciarCarrito()
    { 
    $usuario = response()->json(auth()->user());
        $user = $usuario->getData(true);

        $token = str_replace('Bearer ', '', request()->header('Authorization'));

        
        $UserId = $user['id'];
        $carrito1= CarritoComprasItem::where('Usuario_id', $UserId)
        ->where('token', $token)->get();
       
      //aumentamos la cantidad de habitaciones para que regrese a la normalidad.
        foreach($carrito1 as $car)
        { 
            
            if ($car->Tipo_servicio == 'H') {
               
                
                //ahora retornamos (incrementamos) la disponibilidad de las habitaciones a la tabla PrecioCupoRelease de la habitacion de hotel. 
                    $pcr=PreciosCupoRelease::where('Fecha_precio_cupo_release_noche', '>=', $car->carritoHotels->Fecha_In)
                    ->where('Fecha_precio_cupo_release_noche', '<', $car->carritoHotels->Fecha_Out)
                    ->where('Tipo_habitacion_hotel_id_tipo_habitacion_hotel',$car->carritoHotels->Id_tipo_habitacion_hotels)
                    ->where('regimen_id',$car->carritoHotels->Id_regimen)
                    ->increment('Cupo_habitacion', $car->carritoHotels->Cantidad_habitaciones);
                // ahora eliminamos el Carrito de Hotel
                $carritoHotel = CarritoHotel::where('carrito_compras_items_id', '=', $car->id)->delete();

            }
            if ($car->Tipo_servicio == 'Tou') {
                $carritoTour = CarritoTour::where('carrito_compras_items_id', '=', $car->id)->delete();
            }
            if ($car->Tipo_servicio == 'T') {
                $carritoTraslado = CarritoTraslado::where('carrito_compras_items_id', '=', $car->id)->delete();
            }
            

            
        } 
         $carrito= CarritoComprasItem::where('Usuario_id', $UserId)
        ->where('token', $token)->delete();
        
        if(isset($carrito) && ($carrito!==0))
        {  
          // Generar nuevo token
           $newToken = auth()->refresh();
           return response()->json([
            'Estado' => 'Éxito',
            'Mensaje' => 'Carrito Vacio.',
            'new_token' => $newToken,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
             ], 200);
          
           /* $carrito = new CarritoComprasItem;
            $carrito->Estado = "Éxito";
            $carrito->Mensaje = "Carrito Vacio.";
            return response()->json($carrito, 200);*/
            
        } else {   return response()->json(['Error' => 'Error al vaciar el Carrito o esta Vacio.','Estado'=>'Error'], 401); } 

    
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
  
    public function verificardisponibilidadhotel($mk,$Fecha_In,$Fecha_Out,$Id_tipo_habitacion_hotel,$Id_regimen,$Cantidad_habitaciones,$Cantidad_adultos,$Cantidad_menores)
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
  
  
       
  
        $Precio_cupo_release = PreciosCupoRelease::selectRaw("hotels.email_reservas_hotel as email_reservas_hotel,hotels.Id_Hotel as Id_hotel,tipo_habitacion_hotels.id as Id_tipo_habitacion_hotels,r.id as Id_regimen,precios_cupo_releases.id as Id_precio_cupo_release,tipo_habitacion_hotels.Nombre_Habitacion as Nombre_Habitacion,r.nombre_regimen as Nombre_Regimen,Cupo_habitacion,Cierre,Fecha_precio_cupo_release_noche,Costo_habitacion")
        ->join("tipo_habitacion_hotels", "precios_cupo_releases.Tipo_habitacion_hotel_id_tipo_habitacion_hotel", "=", "tipo_habitacion_hotels.id")
        ->join("tipo_habitacion_generals", "tipo_habitacion_generals.id", "=", "tipo_habitacion_hotels.Tipo_Habitacion_general_Id_tipo_Habitacion_general")
        ->join('regimens AS r', 'precios_cupo_releases.regimen_id', '=', 'r.id')
        ->join("hotels", "hotels.Id_Hotel", "=", "tipo_habitacion_hotels.Hotel_Id_Hotel")
        ->where('Fecha_precio_cupo_release_noche', '>=', $Fecha_In)
        ->where('Fecha_precio_cupo_release_noche', '<', $Fecha_Out)
        ->where('tipo_habitacion_hotels.id', '=', $Id_tipo_habitacion_hotel)
        ->where('Cupo_habitacion', '>=', $Cantidad_habitaciones)
        ->where('Release_habitacion', '<=', $days)
        ->where('r.id', '=', $Id_regimen)
        ->where('Cierre', '=', 0)
        ->where('Cantidad_Adultos', '>=', $Cantidad_adultos)
        ->where('Cantidad_Menores', '>=', $Cantidad_menores)->distinct();
        
        /*  $sql = $Precio_cupo_release->toSql();
            $bindings = $Precio_cupo_release->getBindings();
    
            // Sustituir los marcadores de posición con los valores reales
            foreach ($bindings as $binding) {
                $sql = preg_replace('/\?/', "'" . $binding . "'", $sql, 1);
            }
    
            print_r($sql);*/
        $Precio_cupo_release = $Precio_cupo_release->get();
           // si da resultado, hay que eliminar un Cupo_habitacion de la tabla  precios_cupo_releases
           if(isset($Precio_cupo_release[0]['Id_precio_cupo_release'])) 
           { 
            //print_r($Precio_cupo_release);
            $Costo_total_habitacion=0;
            $Precio_total_habitacion=0;
             $res= [];$noches=0;
             //print_r($Precio_cupo_release);
              foreach ($Precio_cupo_release as $resultado) 
              {
                $idContrato = $resultado['Id_precio_cupo_release'];
                $cupoHabitacion = $resultado['Cupo_habitacion'];
                $Costo_total_habitacion=$Costo_total_habitacion+$resultado['Costo_habitacion'];
                
        
                // Restar las habitaciones al campo Cupo_habitacion
                $nuevoCupo = $cupoHabitacion - $Cantidad_habitaciones;
        
                // Actualizar el campo Cupo_habitacion en la base de datos
                PreciosCupoRelease::where('id', $idContrato)
                    ->update(['Cupo_habitacion' => $nuevoCupo]);
              }
              $Precio_total_habitacion=$mk*$Costo_total_habitacion;
              $res['Costo_total_habitacion']=$Costo_total_habitacion;
              $res['Precio_total_habitacion']=$Precio_total_habitacion;
              $res['Id_regimen']=$resultado['Id_regimen'];
              $res['Cantidad_habitaciones']=$Cantidad_habitaciones;
              $res['Nombre_Habitacion']=$resultado['Nombre_Habitacion'];
              $res['Nombre_Regimen']=$resultado['Nombre_Regimen'];
              $res['Id_tipo_habitacion_hotels']=$resultado['Id_tipo_habitacion_hotels'];
              $res['email_reservas_hotel']=$resultado['email_reservas_hotel'];
              
              $noches++;
            $res['Cantidad_Noches']=$noches;
            return $res;
           }
           else
           { 
            return false;
           }
  
   
      
  
    }
    public function verificar_disponibilidad_trasnfers($Traslados_contrato_id,$Cantidad_Adultos,$Cantidad_Menores,$matriz_edades)
    {   $cantidad=$Cantidad_Adultos+$Cantidad_Menores;
        $trasladosprecio= TrasladosContratoCupo::with('servicioTraslado')
        ->where('id',$Traslados_contrato_id)
        ->where('Cupo','>=',$cantidad)
        ->selectRaw("Costo_adulto,Costo_menor,(Cantidad_adultos*Costo_adulto+Cantidad_menores*Costo_menor) as Costo_Total,Cantidad_adultos,Cantidad_menores,Empresa_traslado_tipo_movilidades_id,Servicio_traslado_Id");
        if($Cantidad_Menores>0){

            foreach ($matriz_edades as $edad) {
                $trasladosprecio->where('Edad_menor', '>=', $edad);
            }
        }
        $trasladosprecio->first();
                    if($trasladosprecio)
                    { return $trasladosprecio;}
                    else{ return false;}
                    
    }

    public function verificar_disponibilidad_tours($Tour_contrato_id,$Cantidad_Adultos,$Cantidad_Menores,$matriz_edades)
    {   $cantidad=$Cantidad_Adultos+$Cantidad_Menores;
        $toursprecio= ToursContratoCupo::join("tours", "tours.id","Tours_id")
        ->where('tours_contrato_cupos.id','=',$Tour_contrato_id)
        ->where('Cupo','>=',$cantidad)
        ->where('Cantidad_adultos','>=',$Cantidad_Adultos)
        ->where('Cantidad_menores','>=',$Cantidad_Menores)
        ->selectRaw("tours.Email_contacto_tour,Costo_adulto,Costo_menor,(Cantidad_adultos*Costo_adulto+Cantidad_menores*Costo_menor) as Costo_Total,Cantidad_adultos,Cantidad_menores,Tours_id,fecha_disponible,DATE_ADD(Fecha_disponible, INTERVAL cantidad_noches_tour DAY) AS Fecha_out,Horario_inicio,Hora_fin");
        if($Cantidad_Menores >0 && isset($Cantidad_Menores))
        { 
            foreach ($matriz_edades as $edad) {
                $toursprecio->where('Edad_menor', '>=', $edad);
            }
        }
        $toursprecio->first();
      /*  $sql = $toursprecio->toSql();
            $bindings = $toursprecio->getBindings();
    
            // Sustituir los marcadores de posición con los valores reales
            foreach ($bindings as $binding) {
                $sql = preg_replace('/\?/', "'" . $binding . "'", $sql, 1);
            }
      
            print_r($sql);*/
                    if($toursprecio){ return $toursprecio->get();}
                    else{ return false;}
    }


}