<?php

namespace App\Http\Controllers;

use App\Models\ToursContratoCupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class ToursContratoCupoController
 * @package App\Http\Controllers
 */
class ToursContratoCupoController extends Controller
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
        $toursContratoCupos = ToursContratoCupo::paginate();

        return view('tours-contrato-cupo.index', compact('toursContratoCupos'))
            ->with('i', (request()->input('page', 1) - 1) * $toursContratoCupos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $toursContratoCupo = new ToursContratoCupo();
        return view('tours-contrato-cupo.create', compact('toursContratoCupo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ToursContratoCupo::$rules);

        $toursContratoCupo = ToursContratoCupo::create($request->all());

        return redirect()->route('tours-contrato-cupos.index')
            ->with('success', 'ToursContratoCupo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toursContratoCupo = ToursContratoCupo::find($id);

        return view('tours-contrato-cupo.show', compact('toursContratoCupo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toursContratoCupo = ToursContratoCupo::find($id);

        return view('tours-contrato-cupo.edit', compact('toursContratoCupo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ToursContratoCupo $toursContratoCupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToursContratoCupo $toursContratoCupo)
    {
        request()->validate(ToursContratoCupo::$rules);

        $toursContratoCupo->update($request->all());

        return redirect()->route('tours-contrato-cupos.index')
            ->with('success', 'ToursContratoCupo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $toursContratoCupo = ToursContratoCupo::find($id)->delete();

        return redirect()->route('tours-contrato-cupos.index')
            ->with('success', 'ToursContratoCupo deleted successfully');
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

  /**
 * @OA\Post(
 *     path="/api/auth/getDispoTours",
 *     summary="Obtener disponibilidad de tours",
 *     description="Obtiene la disponibilidad de tours según los parámetros especificados.",
 *     tags={"Tours"},
 *     security={{"bearerAuth": {}}},    
 *     operationId="getDispoTours",
 *     @OA\Parameter(
 *         name="Tipo_servicio",
 *         in="query",
 *         description="Tipo de servicio (TOU, etc.)",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="Fecha_disponible",
 *         in="query",
 *         description="Fecha disponible en formato YYYY-MM-DD",
 *         required=true,
 *         @OA\Schema(type="string", format="date")
 *     ),
 *     @OA\Parameter(
 *         name="Ciudad_Id_Ciudad",
 *         in="query",
 *         description="ID de la ciudad",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="Cantidad_adultos",
 *         in="query",
 *         description="Cantidad de adultos",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="Cantidad_menores",
 *         in="query",
 *         description="Cantidad de menores (opcional). Si es mayor que 0, debe incluir las edades en el parámetro Edad_menores.",
 *         required=false,
 *         @OA\Schema(type="integer", nullable=true)
 *     ),
 *     @OA\RequestBody(
 *         required=false,
 *         description="Edades de los menores (opcional). Solo se requiere si `Cantidad_menores` es mayor que 0.",
 *         @OA\JsonContent(
 *             type="object",
 *             nullable=true,
 *             @OA\Property(
 *                 property="Edad_menores",
 *                 type="object",
 *                 @OA\Property(property="1", type="integer", description="Edad del primer menor"),
 *                 @OA\Property(property="2", type="integer", description="Edad del segundo menor")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Disponibilidad de tours obtenida correctamente"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="No autorizado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="error", type="string", example="No autorizado. Token inválido o no proporcionado."),
 *             @OA\Property(property="code", type="integer", example=401)
 *         )
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="No hay respuesta a tu solicitud"
 *     )
 * )
 */
  public function getDispoTour(Request $request)
  { 
    try {
     $rules = [
        'Ciudad_Id_Ciudad' => 'required|numeric|max:10000000',
        'Fecha_disponible' => 'required|date',
        'Cantidad_adultos' => 'required|numeric|max:9',
        'Cantidad_menores' => 'nullable|numeric|max:9',
        // Solo se valida si Cantidad_menores > 0
        'Edad_menores'      => 'exclude_if:Cantidad_menores,0|required|array',
        'Edad_menores.*'    => 'exclude_if:Cantidad_menores,0|required|numeric|min:1|max:23',
       // 'Edad_menores' => 'required_if:Cantidad_menores,>,0|array', // Obligatorio si hay menores.
       // 'Edad_menores.*' => 'required_if:Cantidad_menores,>,0|numeric|min:1|max:23', // Validar cada edad.
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
    } catch (ValidationException $e) {
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
    $matriz_edades = $request['Edad_menores']; //Todas las edades



    $idc = (int) $request['Ciudad_Id_Ciudad'];
    $cupo = $request['Cantidad_adultos'] + $request['Cantidad_menores'];

    if ($cupo > 10) {
      return response()->json(['error' => 'Por el numero debes cotizar grupo al mail grupos@visionmundo.com'], 400);
    }
    // luego solo colocar la edad


    $tourcontrato = ToursContratoCupo::join("tours", "tours.id", "=", "Tours_id")
      ->selectRaw("Fecha_disponible,DATE_ADD(Fecha_disponible, INTERVAL cantidad_noches_tour DAY) AS Fecha_out,cantidad_dias_tour,cantidad_noches_tour,tours.id as Id_Tour,Nombre_tour,tours_contrato_cupos.id as Id_contrato_tours,Costo_adulto*$mk as Precio_adulto,Costo_menor*$mk as Precio_menor,((Costo_adulto*Cantidad_adultos)+(Costo_menor*Cantidad_menores))*$mk as Precio_Total,Cantidad_adultos,Cantidad_menores,tours.Foto_tours")
      ->where('Cantidad_adultos', $request['Cantidad_adultos'])
      ->where('Cantidad_menores', $request['Cantidad_menores'])
      ->where('Ciudad_Id_Ciudad', '=', $idc)
      ->where('cupo', '>=', $cupo)
      ->where('Fecha_disponible', '=', $request['Fecha_disponible'])
      ->where('Release', '<=', $days);
     // print_r($request['Cantidad_menores']);
    if($request['Cantidad_menores']>0 && isset($request['Cantidad_menores']))
    {
        foreach ($matriz_edades as $edad) {
          $tourcontrato->Where(function ($query) use ($edad) {
            $query->where('Edad_menor', '>=', $edad);
          });
        }
    }

    $tourcontrato = $tourcontrato->get();
    $photoDomain = config('app.photo_domain');

    if (isset($tourcontrato[0]['Id_Tour'])) {
        foreach($tourcontrato as $tour)
        {
            $tour->Foto_tours=$photoDomain.'/'.$tour->Foto_tours;
             if($request['Cantidad_menores']>0||isset($request['Cantidad_menores']))
             {
                 $tour->Edad_menores=$matriz_edades;
             }
        }

      return response()->json($tourcontrato, 200);
    } else {
      
      return response()->json(['error' => 'No hay respuesta a tu solicitud, intenta cambiar los datos'], 404);
    }
  }

}
