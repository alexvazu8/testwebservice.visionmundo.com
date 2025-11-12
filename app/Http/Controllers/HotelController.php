<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

/**
 * Class HotelController
 * @package App\Http\Controllers
 */
class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::paginate();

        return view('hotel.index', compact('hotels'))
            ->with('i', (request()->input('page', 1) - 1) * $hotels->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotel = new Hotel();
        return view('hotel.create', compact('hotel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Hotel::$rules);

        $hotel = Hotel::create($request->all());

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
     
     /**
 * @OA\Get(
 *     path="/api/auth/getHotelInfo/{id}",
 *     summary="Obtiene los detalles de un hotel por su ID",
 *     description="Devuelve los detalles de un hotel junto con sus relaciones como estrellas, fotos, facilidades, usuarios, tipo de habitación, país, ciudad y zona.",
 *     tags={"Hoteles"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del hotel",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalles del hotel encontrados",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="Id_Hotel", type="integer", description="ID del hotel"),
 *             @OA\Property(property="Nombre_Hotel", type="string", description="Nombre del hotel"),
 *             @OA\Property(property="Numero_identificacion_tributaria", type="string", description="Número de identificación tributaria del hotel"),
 *             @OA\Property(property="Direccion_Hotel", type="string", description="Dirección del hotel"),
 *             @OA\Property(property="Telefono_reservas_hotel", type="string", description="Teléfono de reservas del hotel"),
 *             @OA\Property(property="Cel_reservas_hotel", type="string", description="Celular de reservas del hotel"),
 *             @OA\Property(property="email_reservas_hotel", type="string", description="Correo electrónico para reservas del hotel"),
 *             @OA\Property(property="email_comercial_hotel", type="string", description="Correo electrónico comercial del hotel"),
 *             @OA\Property(property="Pais_Id_Pais", type="integer", description="ID del país del hotel"),
 *             @OA\Property(property="Zona_Id_Zona", type="integer", description="ID de la zona del hotel"),
 *             @OA\Property(property="ciudad_Id_ciudad", type="integer", description="ID de la ciudad del hotel"),
 *             @OA\Property(property="Descripcion_Hotel", type="string", description="Descripción del hotel"),
 *             @OA\Property(property="Foto_Principal_Hotel", type="string", description="URL de la foto principal del hotel"),
 *             @OA\Property(
 *                 property="fotosHotels",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="Foto_Hotel", type="string", description="URL de la foto del hotel")
 *                 )
 *             ),
 *             @OA\Property(property="estrellas", type="object", description="Estrellas del hotel"),
 *             @OA\Property(property="hotelFacilidadesYServicios", type="object", description="Facilidades y servicios del hotel"),
 *             @OA\Property(property="hotelUsers", type="object", description="Usuarios asociados al hotel"),
 *             @OA\Property(property="tipoHabitacionHotels", type="object", description="Tipos de habitación del hotel"),
 *             @OA\Property(property="pais", type="object", description="País del hotel"),
 *             @OA\Property(property="ciudad", type="object", description="Ciudad del hotel"),
 *             @OA\Property(property="zona", type="object", description="Zona del hotel"),
 *             @OA\Property(property="Latitud", type="number", format="float", description="Latitud del hotel"),
 *             @OA\Property(property="Longitud", type="number", format="float", description="Longitud del hotel")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Hotel no encontrado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Hotel no encontrado")
 *         )
 *     )
 * )
 */
    public function show($id)
    {
        // Encuentra el hotel por su ID y carga sus relaciones
        $hotel = Hotel::with([
            'estrellas',
            'fotosHotels',
            'hotelFacilidadesYServicios',
            'hotelUsers',
            'tipoHabitacionHotels',
            'pais',
            'ciudad',
            'zona',
        ])->where('Id_Hotel',$id)->get();

        // Verifica si el hotel existe
        if (!$hotel) {
            return response()->json([
                'message' => 'Hotel no encontrado'
            ], 404);
        }
        $hotel=$hotel[0];
       $photoDomain = config('app.photo_domain');
       
        // Agregar el prefijo al campo `Foto_Principal_Hotel`
        if (!empty($hotel->Foto_Principal_Hotel)) {
         $hotel->Foto_Principal_Hotel = $photoDomain. '/'.$hotel->Foto_Principal_Hotel;
         }
        
        // Iterar sobre las fotos y agregar el URL completo
            $hotel->fotosHotels->each(function ($foto) use ($photoDomain) {
                $foto->Foto_Hotel = $photoDomain . '/' . $foto->Foto_Hotel;
            });

        // Retorna el hotel con sus relaciones en formato JSON
        return response()->json($hotel, 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel = Hotel::find($id);

        return view('hotel.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Hotel $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        request()->validate(Hotel::$rules);

        $hotel->update($request->all());

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $hotel = Hotel::find($id)->delete();

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel deleted successfully');
    }

}
