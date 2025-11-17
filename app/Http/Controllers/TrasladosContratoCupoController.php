<?php

namespace App\Http\Controllers;


use App\Models\TrasladosContratoCupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class TrasladosContratoCupoController
 * @package App\Http\Controllers
 */
class TrasladosContratoCupoController extends Controller
{

    public function __construct()
    {
       // $this->middleware('auth:api', ['except' => ['login']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trasladosContratoCupos = TrasladosContratoCupo::paginate();

        return view('traslados-contrato-cupo.index', compact('trasladosContratoCupos'))
            ->with('i', (request()->input('page', 1) - 1) * $trasladosContratoCupos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trasladosContratoCupo = new TrasladosContratoCupo();
        return view('traslados-contrato-cupo.create', compact('trasladosContratoCupo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TrasladosContratoCupo::$rules);

        $trasladosContratoCupo = TrasladosContratoCupo::create($request->all());

        return redirect()->route('traslados-contrato-cupos.index')
            ->with('success', 'TrasladosContratoCupo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trasladosContratoCupo = TrasladosContratoCupo::find($id);

        return view('traslados-contrato-cupo.show', compact('trasladosContratoCupo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trasladosContratoCupo = TrasladosContratoCupo::find($id);

        return view('traslados-contrato-cupo.edit', compact('trasladosContratoCupo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TrasladosContratoCupo $trasladosContratoCupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrasladosContratoCupo $trasladosContratoCupo)
    {
        request()->validate(TrasladosContratoCupo::$rules);

        $trasladosContratoCupo->update($request->all());

        return redirect()->route('traslados-contrato-cupos.index')
            ->with('success', 'TrasladosContratoCupo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $trasladosContratoCupo = TrasladosContratoCupo::find($id)->delete();

        return redirect()->route('traslados-contrato-cupos.index')
            ->with('success', 'TrasladosContratoCupo deleted successfully');
    }

/**
 * @OA\Post(
 *     path="/api/auth/getDispoTraslados",
 *     summary="Obtener disponibilidad de traslados",
 *     description="Obtiene la disponibilidad de traslados según los parámetros proporcionados.",
 *     tags={"Traslados"},
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos de la solicitud",
 *         @OA\JsonContent(
 *             required={"Tipo_servicio_transfer", "Fecha_disponible", "Ciudad_Id_Ciudad", "Zona_Origen_id", "Zona_Destino_id", "hora_servicio", "Cantidad_adultos", "Cantidad_menores", "Edad_menores"},
 *             @OA\Property(property="Tipo_servicio_transfer", type="string", example="IN", description="Tipo de servicio de traslado"),
 *             @OA\Property(property="Fecha_disponible", type="string", format="date", example="2024-03-29", description="Fecha disponible para el traslado"),
 *             @OA\Property(property="Ciudad_Id_Ciudad", type="integer", example=1, description="ID de la ciudad para la que se solicita el traslado"),
 *             @OA\Property(property="Zona_Origen_id", type="string", example="7", description="ID de la zona de origen"),
 *             @OA\Property(property="Zona_Destino_id", type="string", example="1", description="ID de la zona de destino"),
 *             @OA\Property(property="hora_servicio", type="string", example="08:00", description="Hora del servicio en formato 'H:i'"),
 *             @OA\Property(property="Cantidad_adultos", type="integer", example=1, description="Cantidad de adultos"),
 *             @OA\Property(property="Cantidad_menores", type="integer", example=2, description="Cantidad de menores"),
 *             @OA\Property(property="Edad_menores", type="object", description="Edades de los menores",
 *                 @OA\Property(property="1", type="integer", example=8, description="Edad del primer menor"),
 *                 @OA\Property(property="2", type="integer", example=3, description="Edad del segundo menor")
 *                
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Operación exitosa"
 *         
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontraron traslados disponibles con los parámetros proporcionados",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="error", type="string", example="No hay respuesta a tu solicitud, intenta cambiar los datos")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error de validación de datos",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="error", type="string", example="Los datos proporcionados no son válidos"),
 *             @OA\Property(property="validation_errors", type="object", example={"Ciudad_Id_Ciudad": "El campo Ciudad_Id_Ciudad es obligatorio."})
 *         )
 *     )
 * )
 */

    public function getDispoTraslados(Request $request)
    {
        try {

        if(isset($request['Cantidad_menores']))
        { 
            if((integer)($request['Cantidad_menores'])==1){ $request['banderamenores1']=true;}
            if((integer)($request['Cantidad_menores'])==2){ $request['banderamenores1']=true;$request['banderamenores2']=true;}
            if((integer)($request['Cantidad_menores'])==3){ $request['banderamenores1']=true;$request['banderamenores2']=true;$request['banderamenores3']=true;}
            if((integer)($request['Cantidad_menores'])==4){ $request['banderamenores1']=true;$request['banderamenores2']=true;$request['banderamenores3']=true;$request['banderamenores4']=true;}
            if((integer)($request['Cantidad_menores'])==5){ $request['banderamenores1']=true;$request['banderamenores2']=true;$request['banderamenores3']=true;$request['banderamenores4']=true;$request['banderamenores5']=true;}
        }
        
        $rules = [
            'Ciudad_Id_Ciudad' => 'required|numeric|max:10000000',
            'Fecha_disponible' => 'required|date',
            'Cantidad_adultos' => 'required|numeric|max:9',
            'Cantidad_menores' => 'required|numeric|max:9',
          
            'Edad_menores.1' => 'required_if:banderamenores1,true|numeric|max:12',
            'Edad_menores.2' => 'required_if:banderamenores2,true|numeric|max:12',
            'Edad_menores.3' => 'required_if:banderamenores3,true|numeric|max:12',
            'Edad_menores.4' => 'required_if:banderamenores4,true|numeric|max:12',
            'Edad_menores.5' => 'required_if:banderamenores5,true|numeric|max:12',
            'hora_servicio'=> 'required|date_format:H:i',
            'Zona_Origen_id'=> 'required|numeric',
            'Zona_Destino_id'=> 'required|numeric',
            'Tipo_servicio_transfer'=> 'required|max:3',
        ];
        
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
        $matriz_edades = $request['Edad_menores']; //Todas las edades en matriz



        //$idc = (int) $request['Ciudad_Id_Ciudad'];
        $cupo = $request['Cantidad_adultos'] + $request['Cantidad_menores'];

        if ($cupo > 10) {
        return response()->json(['error' => 'Por el numero debes cotizar grupo al mail grupos@visionmundo.com'], 404);
        }
        $trasladocontrato = TrasladosContratoCupo::join("servicio_traslados", "servicio_traslados.id", "=", "Servicio_traslado_Id")
        ->join("empresa_traslado_tipo_movilidades", "empresa_traslado_tipo_movilidades.id", "=", "servicio_traslados.empresa_traslado_tipo_movilidades_Id")
        ->join("tipo_movilidades", "tipo_movilidades.id", "=", "empresa_traslado_tipo_movilidades.Tipo_movilidad_Id_tipo_movilidad")
        ->selectRaw("traslados_contrato_cupos.id as Traslados_contrato_id,tipo_movilidades.id as Tipo_movilidad_id,servicio_traslados.id as Id_servicio_traslado,Nombre_Servicio,Detalle_servicio,Tipo_servicio_transfer as Tipo_servicio_transfer,Zona_Origen_id,Zona_Destino_id,traslados_contrato_cupos.id as Id_contrato,Moneda,Costo_adulto*$mk as Precio_adulto,Costo_menor*$mk as Precio_menor,((Costo_adulto*Cantidad_adultos)+(Costo_menor*Cantidad_menores))*$mk as Precio_Total,Cantidad_adultos,Cantidad_menores,Fecha_disponible,tipo_movilidades.Foto_tipo_movilidad")
        ->where('Cantidad_adultos', $request['Cantidad_adultos'])
        ->where('Cantidad_menores', $request['Cantidad_menores'])
        ->where('Zona_Origen_id', '=', $request['Zona_Origen_id'])
        ->where('Zona_Destino_id', '=', $request['Zona_Destino_id'])
        ->whereTime('hora_inicio_atencion','<=',$request['hora_servicio'])
        ->whereTime('hora_final_atencion','>=',$request['hora_servicio'])
        ->where('cupo', '>=', $cupo)
        ->where('cierre', '=', 0)
        ->where('Fecha_disponible', '=', $request['Fecha_disponible'])
        ->where('Release', '<=', $days);
        if(isset($matriz_edades)){
            foreach ($matriz_edades as $edad) {
            $trasladocontrato->where('Edad_menor', '>=', $edad);
            }
            
        }
    /* $sql=$trasladocontrato->toSql();
        $bindings = $trasladocontrato->getBindings();
        foreach ($bindings as $binding) {
            $sql = preg_replace('/\?/', "'$binding'", $sql, 1);
        }
        print_r($sql);*/

        $trasladocontrato = $trasladocontrato->get();
        $photoDomain = config('app.photo_domain');

        if (isset($trasladocontrato[0]['Id_servicio_traslado'])) {
            foreach($trasladocontrato as $res_traslado){
                $res_traslado->hora_servicio=$request['hora_servicio'];
                $res_traslado->Edad_menores=$matriz_edades;
                $res_traslado->Foto_tipo_movilidad=$photoDomain.'/'.$res_traslado->Foto_tipo_movilidad;
                $res_traslado->Tipo_servicio='T';//traslado
            }
        return response()->json($trasladocontrato, 200);
        } else {
        return response()->json(['error' => 'No hay respuesta a tu solicitud, intenta cambiar los datos'], 404);
        }

    }
    
}
