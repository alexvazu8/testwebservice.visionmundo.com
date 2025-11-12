<?php

namespace App\Http\Controllers;

use App\Models\DetalleReserva;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

/**
 * Class DetalleReservaController
 * @package App\Http\Controllers
 */
class DetalleReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
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

    public function index()
    {
        $detalleReservas = DetalleReserva::paginate();

        return view('detalle-reserva.index', compact('detalleReservas'))
            ->with('i', (request()->input('page', 1) - 1) * $detalleReservas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detalleReserva = new DetalleReserva();
        return view('detalle-reserva.create', compact('detalleReserva'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(DetalleReserva::$rules);

        $detalleReserva = DetalleReserva::create($request->all());

        return redirect()->route('detalle-reservas.index')
            ->with('success', 'DetalleReserva created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalleReserva = DetalleReserva::find($id);

        return view('detalle-reserva.show', compact('detalleReserva'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalleReserva = DetalleReserva::find($id);

        return view('detalle-reserva.edit', compact('detalleReserva'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  DetalleReserva $detalleReserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleReserva $detalleReserva)
    {
        request()->validate(DetalleReserva::$rules);

        $detalleReserva->update($request->all());

        return redirect()->route('detalle-reservas.index')
            ->with('success', 'DetalleReserva updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detalleReserva = DetalleReserva::find($id)->delete();

        return redirect()->route('detalle-reservas.index')
            ->with('success', 'DetalleReserva deleted successfully');
    }
    
/**
 * @OA\Get(
 *     path="/api/auth/detalleReservaPenalidad/{id_detalle_reserva}",
 *     summary="Calcular penalidad por cancelación de un servicio",
 *     description="Calcula la penalidad según tipo de servicio.",
 *     operationId="calcularPenalidad",
 *     tags={"Reservas"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="id_detalle_reserva",
 *         in="path",
 *         description="ID del detalle de reserva",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Respuesta exitosa con diferentes estructuras posibles",
 *         @OA\JsonContent(
 *             oneOf={
 *                 @OA\Schema(
 *                     type="object",
 *                     @OA\Property(property="mensaje", type="string", example="Penalidad aplicada según política."),
 *                     @OA\Property(property="penalidad", type="string", example="50%"),
 *                     @OA\Property(property="precio_penalidad", type="string", example="120.00"),
 *                     @OA\Property(property="tipo_servicio", type="string", example="H"),
 *                     @OA\Property(property="datos_extra", type="object",
 *                          @OA\Property(
 *                             property="penalidad_aplicable",
 *                             type="object",
 *                             nullable=true,
 *                                 @OA\Property(property="id", type="integer", example=1),
 *                                 @OA\Property(property="porcentaje", type="string", example="100%"),
 *                                 @OA\Property(property="rango_dias", type="string", example="2 a 0 días antes")
 *                           ),
 *                           @OA\Property(
 *                               property="fechas",
 *                               type="object",
 *                                @OA\Property(property="fecha_in", type="string", format="date", example="2025-07-18"),
 *                                @OA\Property(property="fecha_actual", type="string", format="date", example="2025-07-16"),
 *                                @OA\Property(property="dias_restantes_para_ingresar", type="integer", example=1)
 *                           ),
 *                           @OA\Property(
 *                             property="calculos",
 *                             type="object",
 *                             @OA\Property(property="noches_afectadas", type="integer", example=1)
 *                          )
 *                     )
 *                 ),
 *                 @OA\Schema(
 *                     type="object",
 *                     @OA\Property(property="mensaje", type="string", example="Ya paso la fecha de Ingreso, no se puede cancelar"),
 *                     @OA\Property(property="penalidad", type="string", example="100%"),
 *                     @OA\Property(property="precio_penalidad", type="string", example="300.00"),
 *                     @OA\Property(property="tipo_servicio", type="string", example="T"),
 *                     @OA\Property(property="datos_extra", type="string", example="Los traslados no permiten cancelaciones.")
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Tipo de servicio no válido",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Tipo de servicio no válido")
 *         )
 *     )
 * )
 */

    
    public function calcularPenalidad($id_detalle_reserva)
    {
        $detalle = DetalleReserva::findOrFail($id_detalle_reserva);
        if($detalle->estado=="X")
        {
             return response()->json([
                        'error' => 'Ya esta cancelada la reserva'                
                    ], 400);
        }

        // Inicializar variables comunes
        $penalidad = 0;
        $mensaje = '';
        $dataExtra = []; // Para almacenar datos adicionales según el tipo

        switch ($detalle->Tipo_servicio) {
            case 'H': // Hotel
                $fechaInicio = Carbon::parse($detalle->detalleHotel->Fecha_In);
                $fechaActual = Carbon::now();
                $diasAntes = $fechaActual->diffInDays($fechaInicio, false);
                if($diasAntes<0)
                {
                    return response()->json([
                        'mensaje' => 'Ya paso la fecha de Ingreso, no se puede cancelar',
                        'penalidad' => "100%",
                        'precio_penalidad' => number_format($detalle->Precio_Servicio * (100/100), 2),
                        'tipo_servicio' => $detalle->Tipo_servicio,
                        'datos_extra' => "Reserva vigente, pasada o dentro de la fecha de uso",
                    
                    ]);

                }
                $penalidades = $detalle->detalleHotel->politica->penalidads;
                

                $penalidadAplicable = $penalidades->first(function ($penalidad) use ($diasAntes) {
                    //print_r($penalidad);
                        return $diasAntes <= $penalidad->desde_noches_antes && 
                        $diasAntes >= $penalidad->hasta_noches_antes;
                });
               // print_r($penalidadAplicable);

                if (!$penalidadAplicable) {
                    $penalidad = 0.0; // Por defecto 0%
                    $mensaje = 'Cancelación permitida con penalidad del 0%.';
                } else {
                    $penalidad = $penalidadAplicable->porcentaje_penalidad_por_noche * 100;
                    $mensaje = 'Penalidad aplicada según política.';
                }

                $nochesAfectadas = $detalle->detalleHotel->Cantidad_Noches ?? 1;

                // Datos adicionales para respuesta
                $dataExtra = [
                    'penalidad_aplicable' => $penalidadAplicable ? [
                        'id' => $penalidadAplicable->id,
                        'porcentaje' => ($penalidadAplicable->porcentaje_penalidad_por_noche*100)."%",
                        'rango_dias' => "{$penalidadAplicable->desde_noches_antes} a {$penalidadAplicable->hasta_noches_antes} días antes",
                    ] : null,
                    'fechas' => [
                        'fecha_in' => $fechaInicio->toDateString(),
                        'fecha_actual' => $fechaActual->toDateString(),
                        'dias_restantes_para_ingresar' => $diasAntes,
                    ],
                    'calculos' => [
                        'noches_afectadas' => $nochesAfectadas,
                    ]
                ];
                break;

            case 'T': // Traslados
                $penalidad = 100;
                $mensaje = 'Cancelación no permitida. Se aplicaría penalidad total.';
                $dataExtra ="Los traslados no permiten cancelaciones.";
                break;
            case 'TOU': // Tour
                $penalidad = 100;
                $mensaje = 'Cancelación no permitida. Se aplicaría penalidad total.';
                $dataExtra ="Los tours no permiten cancelaciones.";
                break;

            default:
                return response()->json(['error' => 'Tipo de servicio no válido'], 400);
        }

        return response()->json([
            'mensaje' => $mensaje,
            'penalidad' => $penalidad."%",
            'precio_penalidad' => number_format($detalle->Precio_Servicio * ($penalidad/100), 2),
            'tipo_servicio' => $detalle->Tipo_servicio,
            'datos_extra' => $dataExtra,
           
        ]);
    }
    
/**
 * @OA\Get(
 *     path="/api/auth/cancelarDetalleReserva/{id_detalle_reserva}",
 *     summary="Cancelar un detalle de reserva",
 *     description="Cancela un detalle de reserva y calcula la penalidad correspondiente. Aplica según el tipo de servicio: Hotel, Transporte, Tour.",
 *     operationId="cancelarDetalleReserva",
 *     tags={"Reservas"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="id_detalle_reserva",
 *         in="path",
 *         required=true,
 *         description="ID del detalle de reserva a cancelar",
 *         @OA\Schema(type="integer")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Cancelación procesada correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="mensaje", type="string", example="Cancelación permitida, sin penalidad."),
 *             @OA\Property(property="penalidad", type="string", example="0%"),
 *             @OA\Property(property="precio_penalidad", type="string", example="0.00"),
 *             @OA\Property(property="tipo_servicio", type="string", example="H"),
 *             @OA\Property(
 *                 property="datos_extra",
 *                 oneOf={
 *                     @OA\Schema(type="string", example="Los traslados no permiten cancelaciones."),
 *                     @OA\Schema(
 *                         type="object",
 *                         @OA\Property(
 *                             property="penalidad_aplicable",
 *                             type="object",
 *                             nullable=true,
 *                             @OA\Property(property="id", type="integer", example=1),
 *                             @OA\Property(property="porcentaje", type="string", example="100%"),
 *                             @OA\Property(property="rango_dias", type="string", example="2 a 0 días antes")
 *                         ),
 *                         @OA\Property(
 *                             property="fechas",
 *                             type="object",
 *                             @OA\Property(property="fecha_in", type="string", format="date", example="2025-07-18"),
 *                             @OA\Property(property="fecha_actual", type="string", format="date", example="2025-07-16"),
 *                             @OA\Property(property="dias_restantes_para_ingresar", type="integer", example=1)
 *                         ),
 *                         @OA\Property(
 *                             property="calculos",
 *                             type="object",
 *                             @OA\Property(property="noches_afectadas", type="integer", example=1)
 *                         )
 *                     )
 *                 }
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Error al cancelar reserva",
 *         @OA\JsonContent(
 *             oneOf={
 *                 @OA\Schema(
 *                     type="object",
 *                     @OA\Property(property="error", type="string", example="Tipo de servicio no válido")
 *                 ),
 *                 @OA\Schema(
 *                     type="object",
 *                     @OA\Property(property="mensaje", type="string", example="Ya pasó la fecha de Ingreso, no se puede cancelar"),
 *                     @OA\Property(property="penalidad", type="string", example="100%"),
 *                     @OA\Property(property="precio_penalidad", type="string", example="27.75"),
 *                     @OA\Property(property="tipo_servicio", type="string", example="H"),
 *                     @OA\Property(property="datos_extra", type="string", example="Reserva vigente, pasada o dentro de la fecha de uso")
 *                 ),
 *                 @OA\Schema(
 *                     type="object",
 *                     @OA\Property(property="error", type="string", example="Ya esta cancelada la reserva")
 *                 )
 *             }
 *         )
 *     )
 * )
 */
    
    
    public function cancelar($id_detalle_reserva)
    {
        $detalle = DetalleReserva::findOrFail($id_detalle_reserva);
        if($detalle->estado=="X")
        {
             return response()->json([
                        'error' => 'Ya esta cancelada la reserva'                
                    ], 400);
        }

        // Inicializar variables comunes
        $penalidad = 0;
        $mensaje = '';
        $dataExtra = []; // Para almacenar datos adicionales según el tipo

        switch ($detalle->Tipo_servicio) {
            case 'H': // Hotel
                $fechaInicio = Carbon::parse($detalle->detalleHotel->Fecha_In);
                $fechaActual = Carbon::now();
                $diasAntes = $fechaActual->diffInDays($fechaInicio, false);
                if($diasAntes<0)
                {
                    return response()->json([
                        'mensaje' => 'Ya paso la fecha de Ingreso, no se puede cancelar',
                        'penalidad' => "100%",
                        'precio_penalidad' => number_format($detalle->Precio_Servicio * (100/100), 2),
                        'tipo_servicio' => $detalle->Tipo_servicio,
                        'datos_extra' => "Reserva vigente, pasada o dentro de la fecha de uso",
                    
                    ],400);

                }
                
                
                $penalidades = $detalle->detalleHotel->politica->penalidads;
            
                $penalidadAplicable = $penalidades->first(function ($penalidad) use ($diasAntes) {
                //print_r($penalidad);
                // Ejemplo: desde 5 días antes (5) hasta 3 días antes (3)
                    return $diasAntes <= $penalidad->desde_noches_antes && 
                        $diasAntes >= $penalidad->hasta_noches_antes;
                });
                //print_r($penalidadAplicable);

                if (!$penalidadAplicable) {
                    $penalidad = 0.0; // Por defecto 0%
                    // penalidad 0 entonces colocar estado cancelado y penalidad 0,
                    // modificar el Importe_reserva menos el monto del servicio.

                    //ahora tenemos que modificar el importe de la reserva - $detalle->Precio_Servicio
                    $id_reserva=$detalle->reserva->id;
                    Reserva::where('id', $id_reserva)
                    ->update([
                        'Importe_Reserva' => $detalle->reserva->Importe_Reserva - $detalle->Precio_Servicio      
                    ]);
                    
                    $detalle->update([
                        'Precio_Servicio' => $detalle->Precio_Servicio*0,
                        'Costo_servicio'  => $detalle->Costo_servicio*0,
                        'estado' => 'X'
                    ]);
                    $mensaje = 'Cancelación permitida, sin penalidad.';
                    
                    $hotel = $detalle->detalleHotel;
                    $mensaje_mail = "Favor dar esta reserva por CANCELADA sin penalidad: ".$detalle->reserva->Localizador."-".$detalle->id."\n";
                    $mensaje_mail .= "DETALLES DEL HOTEL:\n";
                    $mensaje_mail .= "Titular de la Reserva: " . "\n";
                    $mensaje_mail .= "Nombres: " . $detalle->reserva->Nombre_Cliente . " "."\n";
                    $mensaje_mail .= "Apellidos: " . $detalle->reserva->Apellido_Cliente . " "."\n";
                    $mensaje_mail .= "Hotel: " . $hotel->tipoHabitacionHotel->hotel->Nombre_Hotel . "\n";
                    $mensaje_mail .= "Habitación: " . $hotel->Nombre_Habitacion . "\n";
                    $mensaje_mail .= "Régimen: " . $hotel->regimen->nombre_regimen . "\n";
                    $mensaje_mail .= "Cantidad de habitaciones: " . $hotel->Cantidad_habitaciones . "\n";
                    $mensaje_mail .= "Cantidad de adultos: " . $hotel->Cantidad_Adultos . "\n";
                    $mensaje_mail .= "Cantidad de menores: " . $hotel->Cantidad_Menores . "\n";
                    $mensaje_mail .= "Cantidad de noches: " . $hotel->Cantidad_Noches . "\n";
                    $mensaje_mail .= "Check-in: " . $hotel->Fecha_In . "\n";
                    $mensaje_mail .= "Check-out: " . $hotel->Fecha_Out . "\n";

                    
                } else {
                    $penalidad = $penalidadAplicable->porcentaje_penalidad_por_noche * 100;
                    $mensaje = 'Penalidad aplicada según política.';

                    //ahora tenemos que modificar el importe de la reserva - $detalle->Precio_Servicio
                    $id_reserva=$detalle->reserva->id;
                    Reserva::where('id', $id_reserva)
                    ->update([
                        'Importe_Reserva' => $detalle->reserva->Importe_Reserva - $detalle->Precio_Servicio + $detalle->Precio_Servicio*($penalidad/100)
                    ]);

                    $detalle->update([
                        'Precio_Servicio' => $detalle->Precio_Servicio*($penalidad/100),
                        'Costo_servicio'  => $detalle->Costo_servicio*($penalidad/100),
                        'estado' => 'X'
                    ]);
                    
                    $hotel = $detalle->detalleHotel;
                    $mensaje_mail = "Favor dar esta reserva por CANCELADA: ".$detalle->reserva->Localizador."-".$detalle->id."\n";
                    $mensaje_mail .= "DETALLES DEL HOTEL:\n";
                    $mensaje_mail .= "Titular de la Reserva: " . "\n";
                    $mensaje_mail .= "Nombres: " . $detalle->reserva->Nombre_Cliente . " "."\n";
                    $mensaje_mail .= "Apellidos: " . $detalle->reserva->Apellido_Cliente . " "."\n";
                    $mensaje_mail .= "Hotel: " . $hotel->tipoHabitacionHotel->hotel->Nombre_Hotel . "\n";
                    $mensaje_mail .= "Habitación: " . $hotel->Nombre_Habitacion . "\n";
                    $mensaje_mail .= "Régimen: " . $hotel->regimen->nombre_regimen . "\n";
                    $mensaje_mail .= "Cantidad de habitaciones: " . $hotel->Cantidad_habitaciones . "\n";
                    $mensaje_mail .= "Cantidad de adultos: " . $hotel->Cantidad_Adultos . "\n";
                    $mensaje_mail .= "Cantidad de menores: " . $hotel->Cantidad_Menores . "\n";
                    $mensaje_mail .= "Cantidad de noches: " . $hotel->Cantidad_Noches . "\n";
                    $mensaje_mail .= "Check-in: " . $hotel->Fecha_In . "\n";
                    $mensaje_mail .= "Check-out: " . $hotel->Fecha_Out . "\n";

                }

                $nochesAfectadas = $detalle->detalleHotel->Cantidad_Noches ?? 1;

                // Datos adicionales para respuesta
                $dataExtra = [
                    'penalidad_aplicable' => $penalidadAplicable ? [
                        'id' => $penalidadAplicable->id,
                        'porcentaje' => ($penalidadAplicable->porcentaje_penalidad_por_noche*100)."%",
                        'rango_dias' => "{$penalidadAplicable->desde_noches_antes} a {$penalidadAplicable->hasta_noches_antes} días antes",
                    ] : null,
                    'fechas' => [
                        'fecha_in' => $fechaInicio->toDateString(),
                        'fecha_actual' => $fechaActual->toDateString(),
                        'dias_restantes_para_ingresar' => $diasAntes,
                    ],
                    'calculos' => [
                        'noches_afectadas' => $nochesAfectadas,
                    ]
                ];
                //Enviar mail de cancelacion
                
                    $this->enviarCorreoSimple(
                        $detalle->Email_encargado_reserva ?? 'finanzas@visionmundo.com', // Si tiene email personalizado, úsalo
                        'Cancelar reserva ' . $detalle->reserva->Localizador."-".$detalle->id,
                        $mensaje_mail
                    );
                break;

            case 'T': // Transporte
                $penalidad = 100;
                $mensaje = 'Cancelación no permitida. Se aplicaría penalidad total.';
                $dataExtra ="Los traslados no permiten cancelaciones.";
                break;
            case 'TOU': // Tour
                $penalidad = 100;
                $mensaje = 'Cancelación no permitida. Se aplicaría penalidad total.';
                $dataExtra ="Los tours no permiten cancelaciones.";
            default:
                return response()->json(['error' => 'Tipo de servicio no válido'], 400);
        }

        return response()->json([
            'mensaje' => $mensaje,
            'penalidad' => $penalidad."%",
            'precio_penalidad' => number_format($detalle->Precio_Servicio * ($penalidad/100), 2),
            'tipo_servicio' => $detalle->Tipo_servicio,
            'datos_extra' => $dataExtra,
           
        ],200);
    }

}
