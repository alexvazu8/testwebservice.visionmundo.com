<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

/**
 * Class TourController
 * @package App\Http\Controllers
 */
class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::paginate();

        return view('tour.index', compact('tours'))
            ->with('i', (request()->input('page', 1) - 1) * $tours->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tour = new Tour();
        return view('tour.create', compact('tour'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tour::$rules);

        $tour = Tour::create($request->all());

        return redirect()->route('tours.index')
            ->with('success', 'Tour created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
     
     /**
 * @OA\Get(
 *     path="/api/auth/getTourInfo/{id}",
 *     summary="Obtener un tour por su ID",
 *     description="Devuelve la información de un tour específico junto con sus relaciones (pais, ciudad, zona, fotos)",
 *     operationId="getTourById",
 *     tags={"Tours"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del tour",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             example=1
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Información del tour",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="nombre", type="string", example="Tour a las Cataratas"),
 *             @OA\Property(property="Foto_tours", type="string", example="https://example.com/images/tour1.jpg"),
 *             @OA\Property(property="pais", type="object", 
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="nombre", type="string", example="Argentina")
 *             ),
 *             @OA\Property(property="ciudad", type="object", 
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="nombre", type="string", example="Buenos Aires")
 *             ),
 *             @OA\Property(property="zona", type="object", 
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="nombre", type="string", example="Centro")
 *             ),
 *             @OA\Property(property="fotosTours", type="array", 
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="url_foto_tour", type="string", example="https://example.com/images/tour1_foto1.jpg"),
 *                     @OA\Property(property="nombre_foto_tour", type="string", example="Principal")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Tour no encontrado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Tour no encontrado")
 *         )
 *     )
 * )
 */
    public function show($id)
    {
      // Encuentra el tour por su ID y carga sus relaciones
            $tour = Tour::with([
                'pais',
                'ciudad',
                'zona',
                'fotosTours', // Relación de 1 a muchos con fotos_tours
            ])->find($id);
        
            // Verifica si el tour existe
            if (!$tour) {
                return response()->json([
                    'message' => 'Tour no encontrado'
                ], 404);
            }
        
           
          
            
            
             // Obtener el dominio de las fotos desde la configuración
            $photoDomain = config('app.photo_domain');
            // Agregar el prefijo al campo `Foto_Principal_Tour` (si existe)
            if (!empty($tour->Foto_tours)) {
                $tour->Foto_tours = $photoDomain . '/' . base64_decode($tour->Foto_tours);
            }
        
            // Iterar sobre las fotos y agregar el URL completo
            $tour->fotosTours->each(function ($foto) use ($photoDomain) {
                $foto->url_foto_tour = $photoDomain . '/' . $foto->url_foto_tour;
            });
            // Resultado
            
            // Retorna el tour con sus relaciones en formato JSON
            return response()->json($tour, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tour = Tour::find($id);

        return view('tour.edit', compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tour $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        request()->validate(Tour::$rules);

        $tour->update($request->all());

        return redirect()->route('tours.index')
            ->with('success', 'Tour updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tour = Tour::find($id)->delete();

        return redirect()->route('tours.index')
            ->with('success', 'Tour deleted successfully');
    }
    public function getFotoPrincipalTour(Request $request)
  {
    $tours = Tour::where('id', '=', $request['Id_Tour'])
      ->selectRaw("Foto_tours")
      ->get();

    $to = NULL;
    foreach ($tours as $to);
    if ($to !== NULL) {
        $base64Image = base64_encode($to->Foto_tours);
        return response()->json($base64Image, 200);

    } else {
      return response()->json(['error' => 'No hay foto para ese id.'], 401);
    }
  }
}
