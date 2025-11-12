<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\PreciosCupoRelease;
use App\Models\Penalidad;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Validator;

/**
 * Class PreciosCupoReleaseController
 * @package App\Http\Controllers
 */
class PreciosCupoReleaseController extends Controller
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
        $preciosCupoReleases = PreciosCupoRelease::paginate();

        return view('precios-cupo-release.index', compact('preciosCupoReleases'))
            ->with('i', (request()->input('page', 1) - 1) * $preciosCupoReleases->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $preciosCupoRelease = new PreciosCupoRelease();
        return view('precios-cupo-release.create', compact('preciosCupoRelease'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(PreciosCupoRelease::$rules);

        $preciosCupoRelease = PreciosCupoRelease::create($request->all());

        return redirect()->route('precios-cupo-releases.index')
            ->with('success', 'PreciosCupoRelease created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $preciosCupoRelease = PreciosCupoRelease::find($id);

        return view('precios-cupo-release.show', compact('preciosCupoRelease'));
    }
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $preciosCupoRelease = PreciosCupoRelease::find($id);

        return view('precios-cupo-release.edit', compact('preciosCupoRelease'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PreciosCupoRelease $preciosCupoRelease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PreciosCupoRelease $preciosCupoRelease)
    {
        request()->validate(PreciosCupoRelease::$rules);

        $preciosCupoRelease->update($request->all());

        return redirect()->route('precios-cupo-releases.index')
            ->with('success', 'PreciosCupoRelease updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $preciosCupoRelease = PreciosCupoRelease::find($id)->delete();

        return redirect()->route('precios-cupo-releases.index')
            ->with('success', 'PreciosCupoRelease deleted successfully');
    }



 
  public function getDispoHotels3(Request $request)
  {  //print_r($request->all());
    try {
      if(isset($request['habitaciones'][1]['Cantidad_menores'])){ if((integer)($request['habitaciones'][1]['Cantidad_menores'])==1){ $request['banderamenores1']=true; }}
      if(isset($request['habitaciones'][2]['Cantidad_menores'])){ if((integer)($request['habitaciones'][2]['Cantidad_menores'])==1){ $request['banderamenores2']=true; }}
      if(isset($request['habitaciones'][3]['Cantidad_menores'])){ if((integer)($request['habitaciones'][3]['Cantidad_menores'])==1){ $request['banderamenores3']=true; }}
      if(isset($request['habitaciones'][1]['Cantidad_menores'])){ if((integer)($request['habitaciones'][1]['Cantidad_menores'])==2){ $request['banderamenores1']=true;$request['banderamenores12']=true; }}
      if(isset($request['habitaciones'][2]['Cantidad_menores'])){ if((integer)($request['habitaciones'][2]['Cantidad_menores'])==2){ $request['banderamenores2']=true;$request['banderamenores22']=true; }}
      if(isset($request['habitaciones'][3]['Cantidad_menores'])){ if((integer)($request['habitaciones'][3]['Cantidad_menores'])==2){ $request['banderamenores3']=true;$request['banderamenores32']=true; }}
      

      $rules =[
          'Fecha_desde' => 'required|date',
          'Fecha_hasta' => 'required|date|after:Fecha_desde',
          'Id_Ciudad_Hotel'=> 'nullable|required_without:Id_Zona_Hotel,Id_Pais_Hotel|numeric|max:11',
          'Numero_Habitaciones' => 'required|numeric|max:3',
          'habitaciones.*.Cantidad_adultos' => 'required|numeric|max:9',
          'habitaciones.*.Cantidad_menores' => 'required|numeric|max:2',
            'habitaciones.1.Edad_menores.1' => 'required_if:banderamenores1,true|numeric|max:12',
            'habitaciones.2.Edad_menores.1' => 'required_if:banderamenores2,true|numeric|max:12',
            'habitaciones.3.Edad_menores.1' => 'required_if:banderamenores3,true|numeric|max:12',
            'habitaciones.1.Edad_menores.2' => 'required_if:banderamenores12,true|numeric|max:12',
            'habitaciones.2.Edad_menores.2' => 'required_if:banderamenores22,true|numeric|max:12',
            'habitaciones.3.Edad_menores.2' => 'required_if:banderamenores32,true|numeric|max:12',
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
    //print_r($request['habitaciones']);
 


    $usuario = response()->json(auth()->user());
   
    $user = $usuario->getData(true);
   
    //obtener el token del encabezado.
    $token = str_replace('Bearer ', '', $request->header('Authorization'));
    

    $mk = $user['markup'];

    $dia_de_hoy = date('Y-m-d');
    $fechadispo = $request['Fecha_desde'];
    $fecha_in = $request['Fecha_desde'];
    $fecha_out = $request['Fecha_hasta'];


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

    //Dias antes que estoy de la noche de hotel.
    $days = $days * $signo;



    //ahora verificar disponibilidad habitacion x habitacion, sobre todo enfasis en la edad de los menores.
    // Caso no satisfaga alguna, debe volverse Adulto.
   

   // Verificar la disponibilidad según las edades de los menores

    // Crear subconsultas para cada tipo de habitación
    $subqueries = [];
    $id_tipo_habitacion_hotels_array = [];
    $arreglohab= [];
        
          
            foreach ($request['habitaciones'] as $habitacion) {
              
              $subquery = PreciosCupoRelease::selectRaw("hotels.Id_Hotel as Id_hotel,tipo_habitacion_hotels.id as Id_tipo_habitacion_hotels,Nombre_Habitacion,'1' as Cantidad_Habitacion,Cierre")
                  ->join("tipo_habitacion_hotels", "precios_cupo_releases.Tipo_habitacion_hotel_id_tipo_habitacion_hotel", "=", "tipo_habitacion_hotels.id")
                  ->join("tipo_habitacion_generals", "tipo_habitacion_generals.id", "=", "tipo_habitacion_hotels.Tipo_Habitacion_general_Id_tipo_Habitacion_general")
                  ->join("hotels", "hotels.Id_Hotel", "=", "tipo_habitacion_hotels.Hotel_Id_Hotel")
                  ->where('Fecha_precio_cupo_release_noche', '>=', $request['Fecha_desde'])
                  ->where('Fecha_precio_cupo_release_noche', '<', $request['Fecha_hasta'])
                  ->where('Cupo_habitacion', '>', 0)
                  ->where('Release_habitacion', '<=', $days)
                  ->where('Cierre', '=', 0)
                  ->where('Cantidad_Adultos', '=', $habitacion['Cantidad_adultos'])
                  ->where('Cantidad_Menores', '=', $habitacion['Cantidad_menores'])->distinct();
                  if(isset($habitacion['Edad_menores']))
                  {
                      foreach ($habitacion['Edad_menores'] as $edad) {
                          $subquery->where('Edad_menores_gratis', '>=', $edad);
                      }
                  }
            
                  $subqueries[] = $subquery;
                  $aux=$subquery->get();
                
                  if(!isset($aux[0]))
                  {   return response()->json(['error' => 'No hay respuesta a tu solicitud, intenta cambiar la info.'], 404);}
            
              
            }
       
            $precioCupo = $subqueries[0];
            for ($i = 1; $i < count($subqueries); $i++) {
              
             $precioCupo = $precioCupo->unionall($subqueries[$i]);
            }
            $id_tipo_habitacion_hotels_array =  $precioCupo->orderBy('Id_Hotel')->get()->toArray();

          
            // aqui coloca la cantidad por cada tipo de habitacion. si hay 2 aumenta la cantidad y asi.
           
            $id_tipo_habitacion_hotels_array= $this->actualizarHabitaciones($id_tipo_habitacion_hotels_array);

          
          $resultados_habitaciones=[];
          $resultados_hotel=[];
         foreach ($id_tipo_habitacion_hotels_array as $res_hab_hotel) {
           
              $cantidad_hab=$res_hab_hotel['Cantidad_Habitacion']; 
              $idhab=$res_hab_hotel['Id_tipo_habitacion_hotels']; 

            $precioCupo = PreciosCupoRelease::join("tipo_habitacion_hotels", "tipo_habitacion_hotels.id", "=", "Tipo_habitacion_hotel_id_tipo_habitacion_hotel")
              ->join("tipo_habitacion_generals", "tipo_habitacion_generals.id", "=", "Tipo_Habitacion_general_Id_tipo_Habitacion_general")
              ->join("hotels", "tipo_habitacion_hotels.Hotel_Id_Hotel", "=", "hotels.Id_Hotel")
              ->join("ciudades", "ciudades.Id_Ciudad", "=", "hotels.ciudad_Id_ciudad")
              //->join("regimen_tipo_habitacion_hotels",  "tipo_habitacion_hotels.id", "=", "id_tipo_habitacion_hotel")
              //->join("regimens",  "regimens.id", "=", "regimen_tipo_habitacion_hotels.id_regimen")
              ->selectRaw("tipo_habitacion_hotels.id as Id_tipo_habitacion_hotels,Fecha_precio_cupo_release_noche as Fecha_Noche,Nombre_Habitacion,Id_Hotel, $cantidad_hab as Cantidad_habitaciones,Cantidad_Adultos,Cantidad_Menores,Costo_habitacion*$mk as Precio_habitacion,(Costo_habitacion)*$mk*$cantidad_hab as Precio_Total_habitaciones,Cupo_habitacion,Release_habitacion,Cierre,Edad_menores_gratis")
              ->where('Fecha_precio_cupo_release_noche', '>=', $request['Fecha_desde'])
              ->where('Fecha_precio_cupo_release_noche', '<', $request['Fecha_hasta'])
              ->where('Cupo_habitacion', '>=', $cantidad_hab)
              ->where('Cierre', '=', 0)
              ->where('tipo_habitacion_hotels.id', $idhab)
              ->OrderBy('Id_Hotel');

              $precioCupo2 = PreciosCupoRelease::join("tipo_habitacion_hotels", "tipo_habitacion_hotels.id", "=", "Tipo_habitacion_hotel_id_tipo_habitacion_hotel")
              ->join("tipo_habitacion_generals", "tipo_habitacion_generals.id", "=", "Tipo_Habitacion_general_Id_tipo_Habitacion_general")
              ->join("hotels", "tipo_habitacion_hotels.Hotel_Id_Hotel", "=", "hotels.Id_Hotel")
              ->join("ciudades", "ciudades.Id_Ciudad", "=", "hotels.ciudad_Id_ciudad")
              ->where('Fecha_precio_cupo_release_noche', '>=', $request['Fecha_desde'])
              ->where('Fecha_precio_cupo_release_noche', '<', $request['Fecha_hasta'])
              ->where('Cupo_habitacion', '>=', $cantidad_hab)
              ->where('Cierre', '=', 0)
              ->where('tipo_habitacion_hotels.id', $idhab)->OrderBy('Id_Hotel')
              ->groupBy('Id_Hotel', 'tipo_habitacion_hotels.id','Fecha_precio_cupo_release_noche','precios_cupo_releases.id');
              
              $resultados_habitaciones[]=$precioCupo;
              $resultados_hotel[]=$precioCupo2->distinct();
             
            
         }
         if(!isset($resultados_habitaciones[0]))
         {  return response()->json(['error' => 'No hay respuesta a tu solicitud, intenta cambiar la info.'], 404);}
         
        
         $hotels=$resultados_hotel[0]->selectRaw("Id_Hotel,Nombre_Hotel,Nombre_Ciudad,'$fecha_in' as Fecha_in,'$fecha_out' as Fecha_out");
         for ($i = 1; $i < count($resultados_hotel); $i++) {
           
          
          $hotels= $hotels->union($resultados_hotel[$i]->selectRaw("Id_Hotel,Nombre_Hotel,Nombre_Ciudad,'$fecha_in' as Fecha_in,'$fecha_out' as Fecha_out"));

         }

         $habitaciones = $resultados_habitaciones[0];
         for ($i = 1; $i < count($resultados_habitaciones); $i++) {
           
          $habitaciones = $habitaciones->unionall($resultados_habitaciones[$i]);
             
         }
   
         $habitaciones=$habitaciones->get()
         ->groupBy('Id_Hotel');
        
         
          
         $availableRoomsByHotel = $habitaciones->map(function ($item) {
          return $item->toArray();
      })->toArray();
       //print_r($availableRoomsByHotel);
      
       $hotels=$hotels->get();

        $result = [];
       
         $noches_hotel=$this->cantidad_noches($request['Fecha_desde'], $request['Fecha_hasta']);
          foreach ($hotels as $hotel) {
            $aux_antes_Id_tipo_habitacion_hotels=null;
              $Rooms=$hotelRooms = $availableRoomsByHotel[$hotel->Id_Hotel] ?? [];
               
              $hotelRooms = $this->actualizarHabitacionesdif_fechas($hotelRooms);
             
              //print_r($hotelRooms['cantidad_hab_hotel']);
              if($hotelRooms['cantidad_hab_hotel']==($noches_hotel*$request['Numero_Habitaciones']))
              { // si el numero de habitaciones es igual al pedido puedo mostrar este hotel, caso contrario mostramos otros hoteles.
                    
                  $result[] = [
                      'hotel_id' => $hotel->Id_Hotel,
                      'hotel_name' => $hotel->Nombre_Hotel,
                      'hotel_ciudad' => $hotel->Nombre_Ciudad,
                      'Fecha_in' => $hotel->Fecha_in,
                      'Fecha_out' => $hotel->Fecha_out,
                      'Noches' => $noches_hotel,
                      'Cabecera_Habitaciones' => $hotelRooms,
                      'Detalle_Habitaciones' => $Rooms,
                  ];
                }

          }



      //$precioCupo = $precioCupo->get();
      //print_r($resultados);
      

    if (isset($result)) {
      //$result['token']=$token;
      return response()->json($result, 200);
    } else {
      return response()->json(['error' => 'No hay respuesta a tu solicitud, intenta cambiar la info.'], 404);
    }
   

  }

  private function actualizarHabitaciones($id_tipo_habitacion_hotels_array) {
    $habitaciones_actualizadas = array();
  // hacer una funcion para ordenar el arreglo.
  
  if(count($id_tipo_habitacion_hotels_array) <= 1) {
    return $id_tipo_habitacion_hotels_array;
  }

  
    $habitacion_anterior = $id_tipo_habitacion_hotels_array[0];
    $cantidad=1;
    
    $j=0;// posision de los repetidos
    for($i = 1; $i < count($id_tipo_habitacion_hotels_array); $i++) 
    {   //echo "Anterior "; print_r($habitacion_anterior);echo " ";
        $habitacion_actual=$id_tipo_habitacion_hotels_array[$i];
        //print_r($habitacion_actual);
    
        if ($habitacion_anterior && ($habitacion_anterior['Id_tipo_habitacion_hotels'] === $habitacion_actual['Id_tipo_habitacion_hotels'])) {
             $cantidad=$habitacion_anterior['Cantidad_Habitacion'] + $habitacion_actual['Cantidad_Habitacion'];
            $habitacion_anterior['Cantidad_Habitacion']=$cantidad;
             $habitaciones_actualizadas[$j] = $habitacion_anterior;
            
            //ahora eliminamos los registros dado que es repetido.
            $habitacion_actual['Cantidad_Habitacion']=NULL;
            $habitacion_actual=NULL;

            
            
        } else { // si no son iguales los keys
               $cantidad=1;
            if($i==1) { $habitaciones_actualizadas[$j]=$habitacion_anterior;$j++;$habitaciones_actualizadas[$j]=$habitacion_actual; $habitacion_anterior = $habitacion_actual; }
            else
            {
              $j++; 
              $habitacion_anterior = $habitacion_actual;
              
                        
              $habitaciones_actualizadas[$j] = $habitacion_actual;
            } 
            
            
            
        }
    }
    //print_r($habitaciones_actualizadas);
    return $habitaciones_actualizadas;
}

private function actualizarHabitacionesdif_fechas($id_tipo_habitacion_hotels_array) {
  $habitaciones_actualizadas = array();
// hacer una funcion para ordenar el arreglo.
 $cantidad_habitaciones_hotel=0;

if(count($id_tipo_habitacion_hotels_array) <= 1) {
 unset($id_tipo_habitacion_hotels_array[0]['Precio_habitacion']);
 unset($id_tipo_habitacion_hotels_array[0]['Fecha_Noche']);

    if(count($id_tipo_habitacion_hotels_array) == 1) {
    $id_tipo_habitacion_hotels_array['cantidad_hab_hotel']=1;
    }
    if(count($id_tipo_habitacion_hotels_array) == 0) {
      $id_tipo_habitacion_hotels_array['cantidad_hab_hotel']=0;
    }
  return $id_tipo_habitacion_hotels_array;
}


  $habitacion_anterior = $id_tipo_habitacion_hotels_array[0];
  unset($habitacion_anterior['Precio_habitacion']);
  unset($habitacion_anterior['Fecha_Noche']);
  $suma_precio_hab=0;
  $noches=1;
  
  $cantidad_habitaciones_hotel=$id_tipo_habitacion_hotels_array[0]['Cantidad_habitaciones'];
  
  $j=0;// posision de los repetidos
  for($i = 1; $i < count($id_tipo_habitacion_hotels_array); $i++) 
  {   //echo "Anterior "; print_r($habitacion_anterior);echo " ";
      $habitacion_actual=$id_tipo_habitacion_hotels_array[$i];
      $cantidad_habitaciones_hotel=$cantidad_habitaciones_hotel+$id_tipo_habitacion_hotels_array[$i]['Cantidad_habitaciones'];
  
      if ($habitacion_anterior && ($habitacion_anterior['Id_tipo_habitacion_hotels'] === $habitacion_actual['Id_tipo_habitacion_hotels'])) {
        $suma_precio_hab=$habitacion_anterior['Precio_Total_habitaciones'] + $habitacion_actual['Precio_Total_habitaciones'];
          $habitacion_anterior['Precio_Total_habitaciones']= $suma_precio_hab;
          $noches=$noches+1;
          $habitacion_anterior['Noches']= $noches;
         
           $habitaciones_actualizadas[$j] = $habitacion_anterior;
          
          //ahora eliminamos los registros dado que es repetido.
          $habitacion_actual['Precio_Total_habitaciones']=NULL;
          
          $habitacion_actual=NULL;

          
          
      } else { // si no son iguales los keys
            $suma_precio_hab=0;
            $noches=1;
             
               
          if($i==1) {  $habitacion_anterior['Noches']= $noches; unset($habitacion_anterior['Fecha_Noche']); $habitacion_actual['Noches']= $noches; unset($habitacion_actual['Fecha_Noche']); $habitaciones_actualizadas[$j]=$habitacion_anterior;$j++;$habitaciones_actualizadas[$j]=$habitacion_actual; $habitacion_anterior = $habitacion_actual;  }
          else
          {
            $j++; 
            unset($habitacion_actual['Precio_habitacion']);
            unset($habitacion_actual['Fecha_Noche']);
            $habitacion_actual['Noches']= $noches;
            $habitacion_anterior = $habitacion_actual;
            
                      
            $habitaciones_actualizadas[$j] = $habitacion_actual;
           
          } 
          
          
          
      }
  }
  //print_r($habitaciones_actualizadas);
  $habitaciones_actualizadas['cantidad_hab_hotel'] = $cantidad_habitaciones_hotel;
  return $habitaciones_actualizadas;
}

private function cantidad_noches($fecha_in, $fecha_out) {
  // Convertir las fechas en formato UNIX timestamp
  $fecha_in_unix = strtotime($fecha_in);
  $fecha_out_unix = strtotime($fecha_out);

  // Calcular la cantidad de segundos entre las dos fechas
  $segundos = $fecha_out_unix - $fecha_in_unix;

  // Convertir la cantidad de segundos en la cantidad de noches
  $noches = $segundos / 86400;

  // Redondear el resultado a un número entero
  $noches = round($noches);

  return $noches;
}


public function getDispoHotels2(Request $request)
  { 
    try {
      if(isset($request['habitaciones'][1]['Cantidad_menores'])){ if((integer)($request['habitaciones'][1]['Cantidad_menores'])==1){ $request['banderamenores1']=true; }}
      if(isset($request['habitaciones'][2]['Cantidad_menores'])){ if((integer)($request['habitaciones'][2]['Cantidad_menores'])==1){ $request['banderamenores2']=true; }}
      if(isset($request['habitaciones'][3]['Cantidad_menores'])){ if((integer)($request['habitaciones'][3]['Cantidad_menores'])==1){ $request['banderamenores3']=true; }}
      if(isset($request['habitaciones'][1]['Cantidad_menores'])){ if((integer)($request['habitaciones'][1]['Cantidad_menores'])==2){ $request['banderamenores1']=true;$request['banderamenores12']=true; }}
      if(isset($request['habitaciones'][2]['Cantidad_menores'])){ if((integer)($request['habitaciones'][2]['Cantidad_menores'])==2){ $request['banderamenores2']=true;$request['banderamenores22']=true; }}
      if(isset($request['habitaciones'][3]['Cantidad_menores'])){ if((integer)($request['habitaciones'][3]['Cantidad_menores'])==2){ $request['banderamenores3']=true;$request['banderamenores32']=true; }}
      
      $validatedData = $request->validate([
          'Fecha_desde' => 'required|date',
          'Fecha_hasta' => 'required|date|after:Fecha_desde',
          'Id_Ciudad_Hotel'=> 'nullable|required_without:Id_Zona_Hotel,Id_Pais_Hotel|numeric|max:11',
          'Numero_Habitaciones' => 'required|numeric|max:3',
          'habitaciones.*.Cantidad_adultos' => 'required|numeric|max:9',
          'habitaciones.*.Cantidad_menores' => 'required|numeric|max:2',
            'habitaciones.1.Edad_menores.1' => 'required_if:banderamenores1,true|numeric|max:12',
            'habitaciones.2.Edad_menores.1' => 'required_if:banderamenores2,true|numeric|max:12',
            'habitaciones.3.Edad_menores.1' => 'required_if:banderamenores3,true|numeric|max:12',
            'habitaciones.1.Edad_menores.2' => 'required_if:banderamenores12,true|numeric|max:12',
            'habitaciones.2.Edad_menores.2' => 'required_if:banderamenores22,true|numeric|max:12',
            'habitaciones.3.Edad_menores.2' => 'required_if:banderamenores32,true|numeric|max:12',
      ]);
  } catch (ValidationException $e) {
      return response()->json([
          'error' => $e->getMessage(),
          'validation_errors' => $e->error(),
      ], 400);
  }
    

    $usuario = auth()->user();
     $idUsuario = auth()->id();
     $nombreUsuario = $usuario->name;
     $emailUsuario = $usuario->email;

   // ok ahora debemos hacer la consulta, por fechas y tipo de habitaciones.
   

// Obtén los datos del JSON
//print_r($request['Fecha_desde']);
$jsonData = $request;
$fechaDesde = $request['Fecha_desde'];
$fechaHasta = $jsonData['Fecha_hasta'];
$idCiudadHotel = $jsonData['Id_Ciudad_Hotel'];
$numeroHabitaciones = $jsonData['Numero_Habitaciones'];
$habitaciones = $jsonData['habitaciones'];


echo $diasAntes=$this->diasantes($fechaDesde);
$repetidos_hab1=0;
for($i=1;$i<=$numeroHabitaciones;$i++)
{
  print_r($habitaciones[$i]); echo '</br>';
  if($habitaciones[$i]['Cantidad_adultos']==$habitaciones[$i+1]['Cantidad_adultos'])
  {

  }

}


// Realiza la consulta Eloquent

/*$hotelesDisponibles = Hotel::whereHas('habitaciones.precios', function ($query) use ($fechaDesde, $fechaHasta, $numeroHabitaciones,$diasAntes, $idCiudadHotel) {
  $query->where('Fecha_precio_cupo_release_noche', '>=', $fechaDesde)
      ->where('Fecha_precio_cupo_release_noche', '<=', $fechaHasta)
      ->where('Cupo_habitacion', '>=', $numeroHabitaciones)
      ->where('Release_habitacion', '<=', $diasAntes)
      ->whereHas('tipo_habitacion', function ($q) use ($idCiudadHotel) {
          $q->where('Hotel_Id_Hotel', $idCiudadHotel);
      });
})->get();*/
/*
$disponibilidad = PreciosCupoRelease::with(['tipoHabitacion','tipoHabitacion.hotel','tipoHabitacion.regimenTipoHabitacionHotels','regimen_tipo_habitacion_hotels','regimens.regimenTipoHabitacionHotels','politacaCancelacions.penalidads',])
    //->where('Fecha_precio_cupo_release_noche', '>=', $fechaDesde)
    //->where('Fecha_precio_cupo_release_noche', '<=', $fechaHasta)
    ->whereHas('tipoHabitacion.hotel', function ($query) use ($idCiudadHotel) {
        $query->where('ciudad_Id_ciudad', $idCiudadHotel);
    })
    ->where(function ($query) use ($habitaciones,$diasAntes) {
        foreach ($habitaciones as $habitacion) {
            $query->Where(function ($innerQuery) use ($habitacion,$diasAntes) {
                $innerQuery->where('Cupo_habitacion', '>', 0)
                ->where('Release_habitacion', '<=',$diasAntes)
                ->where('Cierre', '=', 0)
                ->where('Cantidad_Adultos', '=', $habitacion['Cantidad_adultos'])
                ->where('Cantidad_Menores', '=', $habitacion['Cantidad_menores'])->distinct();
            });
        }
    })
    ->get();
*/
// $disponibilidad ahora contiene los resultados de la consulta

//return response()->json($disponibilidad,402); 

  }
function diasantes($fechaString)
{

  $dia_de_hoy = date('Y-m-d');
    $fechadispo = $fechaString;

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

    //Dias antes que estoy de la noche de hotel.
    $days = $days * $signo;
   return $days;
}

    /**
 * Obtener disponibilidad de hoteles
 *
 * @OA\Post(
 *     path="/api/auth/getDispoHotels",
 *     tags={"Hoteles"},
 *     security={{"bearerAuth": {}}},
 *     summary="Obtener disponibilidad de hoteles",
 *     operationId="getDispoHotels",
 *     @OA\SecurityScheme(
 *         securityScheme="bearerAuth",
 *         type="http",
 *         scheme="bearer",
 *         bearerFormat="JWT",
 *         description="Token de autenticación JWT"
 *      ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos para verificar la disponibilidad de hoteles",
 *         @OA\JsonContent(
 *             required={"pagina","Fecha_desde", "Fecha_hasta", "Id_Ciudad_Hotel", "Numero_Habitaciones", "habitaciones"},
 *             @OA\Property(property="pagina", type="integer", example=1),
 *             @OA\Property(property="Fecha_desde", type="string", format="date", example="2024-02-23"),
 *             @OA\Property(property="Fecha_hasta", type="string", format="date", example="2024-02-24"),
 *             @OA\Property(property="Id_Ciudad_Hotel", type="integer", example=2),
 *             @OA\Property(property="Numero_Habitaciones", type="integer", example=3),
 *             @OA\Property(
 *                 property="habitaciones",
 *                 type="object",
 *                 description="Detalles de las habitaciones",
 *                 @OA\AdditionalProperties(
 *                     type="object",
 *                     
 *                     description="Detalles de una habitación",
 *                     @OA\Property(property="Cantidad_adultos", type="integer", example=2),
 *                     @OA\Property(property="Cantidad_menores", type="integer", example=1),
 *                     @OA\Property(
 *                         property="Edad_menores",
 *                         type="object",
 *                         description="Edades de los menores (solo si Cantidad_menores > 0)",
 *                         @OA\AdditionalProperties(
 *                             type="integer", 
 *                             example=9 
 *                         ),
 *                         example={"1": 9} 
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Disponibilidad de hoteles encontrada"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No autorizado"
 *     )
 * )
 */

public function getDispoHotels(Request $request)
  {  
    try {
      if(isset($request['habitaciones'][1]['Cantidad_menores'])){ if((integer)($request['habitaciones'][1]['Cantidad_menores'])==1){ $request['banderamenores1']=true; }}
      if(isset($request['habitaciones'][2]['Cantidad_menores'])){ if((integer)($request['habitaciones'][2]['Cantidad_menores'])==1){ $request['banderamenores2']=true; }}
      if(isset($request['habitaciones'][3]['Cantidad_menores'])){ if((integer)($request['habitaciones'][3]['Cantidad_menores'])==1){ $request['banderamenores3']=true; }}
      if(isset($request['habitaciones'][1]['Cantidad_menores'])){ if((integer)($request['habitaciones'][1]['Cantidad_menores'])==2){ $request['banderamenores1']=true;$request['banderamenores12']=true; }}
      if(isset($request['habitaciones'][2]['Cantidad_menores'])){ if((integer)($request['habitaciones'][2]['Cantidad_menores'])==2){ $request['banderamenores2']=true;$request['banderamenores22']=true; }}
      if(isset($request['habitaciones'][3]['Cantidad_menores'])){ if((integer)($request['habitaciones'][3]['Cantidad_menores'])==2){ $request['banderamenores3']=true;$request['banderamenores32']=true; }}
      
      $rules = [
          'Fecha_desde' => 'required|date',
          'Fecha_hasta' => 'required|date|after:Fecha_desde',
          'Id_Ciudad_Hotel'=> 'nullable|required_without:Id_Zona_Hotel,Id_Pais_Hotel|numeric|max:11',
          'Numero_Habitaciones' => 'required|numeric|max:3',
          'habitaciones.*.Cantidad_adultos' => 'required|numeric|max:9',
          'habitaciones.*.Cantidad_menores' => 'required|numeric|max:2',
            'habitaciones.1.Edad_menores.1' => 'required_if:banderamenores1,true|numeric|max:12',
            'habitaciones.2.Edad_menores.1' => 'required_if:banderamenores2,true|numeric|max:12',
            'habitaciones.3.Edad_menores.1' => 'required_if:banderamenores3,true|numeric|max:12',
            'habitaciones.1.Edad_menores.2' => 'required_if:banderamenores12,true|numeric|max:12',
            'habitaciones.2.Edad_menores.2' => 'required_if:banderamenores22,true|numeric|max:12',
            'habitaciones.3.Edad_menores.2' => 'required_if:banderamenores32,true|numeric|max:12',
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
          'validation_errors' => $e->error(),
      ], 400);
  }
  

    $usuario = auth()->user();
     $idUsuario = auth()->id();
     $nombreUsuario = $usuario->name;
     $emailUsuario = $usuario->email;
     $mk = $usuario['markup'];
   // ok ahora debemos hacer la consulta, por fechas y tipo de habitaciones.
   

      // Obtén los datos del JSON
      //print_r($request['Fecha_desde']);
      $jsonData = $request;
    
      $numeroHabitaciones = $jsonData['Numero_Habitaciones'];
      $habitaciones = $jsonData['habitaciones'];
        // Variables para fechas
        $fechaDesde = $request['Fecha_desde'];
        $fechaHasta = $request['Fecha_hasta'];


      $diasAntes=$this->diasantes($fechaDesde);

      //aqui la funcion que obtiene los hoteles disponibles.
      $ultimo_query=$this->hoteles_disponibles($request,$diasAntes,$numeroHabitaciones);


    
        // Obtener los resultados
        $resultados = $ultimo_query->paginate(15, ['*'], 'page', $request['pagina']);
       // print_r($resultados);
        $sql = $ultimo_query->toSql();
        $bindings = $ultimo_query->getBindings();

        // Sustituir los marcadores de posición con los valores reales
        foreach ($bindings as $binding) {
            $sql = preg_replace('/\?/', "'" . $binding . "'", $sql, 1);
        }

        //print_r($sql);

        $habitaciones_cantidad= $this->arreglo_habitaciones_cantidad($request['habitaciones']);  
       // print_r($habitaciones_cantidad);
      // Puedes acceder a los resultados como un conjunto de objetos
        $i=0;
         foreach ($resultados as $resultado) { // son los hoteles resultantes
              unset($disponiblidad);
              $photoDomain = config('app.photo_domain');
              $resultados[$i]->Foto_Principal_Hotel = $photoDomain.'/'.$resultado->Foto_Principal_Hotel;   
             // Acceder a las propiedades, por ejemplo $resultado->Nombre_Hotel
            // ahora buscamos la disponibilidad de habitaciones de este hotel.
            //debemos recorrer cada tipo de habitacion que queremos buscar
            foreach ($habitaciones_cantidad as $hab) { // son las habitaciones disponibles
              //aqui buscar dispo y cantidad de cada habitacion.  
             
              $disponiblidad[]=$this->habitacion_disponible($mk,$request,$diasAntes,$hab['Cantidad'],$resultado->Id_Hotel,$hab['Cantidad_adultos'],$hab['Cantidad_menores'],$hab);
              
             // print_r( $disponiblidad);
                // Modificar el porcentaje de penalidad (si existe)
                 // Verifica si hay datos y si penalidades está cargado (para modelos Eloquent)
    
              //  print_r($disponiblidad);
                
              $resultados[$i]->habitaciones = $disponiblidad;  
            } 
            
                

              $i++;
         }
         
       if(!isset($resultados[0]->Nombre_Hotel))
       { //return "dad";
        return response()->json(['error' => 'No hay respuesta a tu solicitud, intenta cambiar los datos'], 404);
      }
        return response()->json($resultados,200); 

        // Puedes acceder a los resultados como un conjunto de objetos
        // foreach ($resultados as $resultado) {
        //     // Acceder a las propiedades, por ejemplo $resultado->Nombre_Hotel
        // }

        // Si necesitas convertirlo a un arreglo, puedes usar $resultados->toArray()
        
  }

  function arreglo_habitaciones_cantidad($habitaciones)
  {
    // Crear un arreglo para almacenar la cantidad de cada habitación única
    $cantidad_por_habitacion = array();

    // Crear un arreglo para almacenar las habitaciones únicas
    $habitaciones_unicas = array();

    // Recorrer el arreglo de habitaciones
    foreach ($habitaciones as $habitacion) {
        // Crear una clave única para identificar la habitación
        $clave_habitacion = $habitacion['Cantidad_adultos'] . '_' . $habitacion['Cantidad_menores'];

        // Verificar si la habitación ya existe en el arreglo
        if (array_key_exists($clave_habitacion, $cantidad_por_habitacion)) {
            // Incrementar la cantidad si la habitación ya existe
            $cantidad_por_habitacion[$clave_habitacion]++;
        } else {
            // Agregar la habitación al arreglo con cantidad inicial 1
            $cantidad_por_habitacion[$clave_habitacion] = 1;
            $habitaciones_unicas[] = $habitacion;
        }
    }

    // Actualizar la cantidad en el arreglo de habitaciones únicas
    foreach ($habitaciones_unicas as &$habitacion) {
        $clave_habitacion = $habitacion['Cantidad_adultos'] . '_' . $habitacion['Cantidad_menores'];
        $habitacion['Cantidad'] = $cantidad_por_habitacion[$clave_habitacion];
    }

    return $habitaciones_unicas;

  }
  function hoteles_disponibles($request,$diasAntes,$numeroHabitaciones)
  {
     // Construir la condición para las habitaciones y edades
   $i=1;$ultimo_query="";
   foreach ($request['habitaciones'] as $habitacion) {
        // Construir la consulta
        $query = PreciosCupoRelease::join('tipo_habitacion_hotels AS thh', 'precios_cupo_releases.Tipo_habitacion_hotel_id_tipo_habitacion_hotel', '=', 'thh.id')
            ->join('hotels AS h', 'thh.Hotel_Id_Hotel', '=', 'h.Id_Hotel')
            ->join('ciudades AS c', 'h.ciudad_Id_ciudad', '=', 'c.Id_Ciudad')
            ->join('tipo_habitacion_generals AS thg', 'thh.Tipo_Habitacion_general_Id_tipo_Habitacion_general', '=', 'thg.id')
            ->join('regimens AS r', 'precios_cupo_releases.regimen_id', '=', 'r.id')
            ->where('c.Id_Ciudad', '=', $request['Id_Ciudad_Hotel'])
            ->where('Fecha_precio_cupo_release_noche', '>=', $request['Fecha_desde'])
            ->where('Fecha_precio_cupo_release_noche', '<', $request['Fecha_hasta'])
            ->where('precios_cupo_releases.Cierre', '=', 0) // Habitación no cerrada para reservas
            ->where('precios_cupo_releases.Release_habitacion', '<=', $diasAntes) // Habitación no cerrada para reservas
            ->whereNotNull('precios_cupo_releases.Costo_habitacion'); // Habitación con costo definido

    
            $cantidadAdultos = $habitacion['Cantidad_adultos'];
            $cantidadMenores = $habitacion['Cantidad_menores'];

            $query->where(function ($query) use ($cantidadAdultos, $cantidadMenores, $habitacion) {
                $query->where('precios_cupo_releases.Cupo_habitacion', '>=', 1)
                    ->where('thg.Cantidad_Adultos', '>=', $cantidadAdultos)
                    ->where('thg.Cantidad_Menores', '>=', $cantidadMenores);

                if (!empty($habitacion['Edad_menores'])) {
                    foreach ($habitacion['Edad_menores'] as $edad) {
                        $query->where('thh.Edad_menores_gratis', '>=', $edad);
                    }
                }
            });
      
     
        // Ordenar la consulta
        $query->distinct();
        if($numeroHabitaciones>1)
        {
          if($i==1)
          { $query->selectRaw('
            h.Id_Hotel,
            h.Nombre_Hotel,
            c.Id_Ciudad AS Id_Ciudad,
            c.Nombre_Ciudad
           ');
           $ultimo_query=$query;
           }
           else
           { // ya estoy en la siguiente consulta
            $query->selectRaw('h.Id_Hotel');
            $ultimo_query=$ultimo_query->whereIn('Id_Hotel',$query);
            }
            $i++;
        }else
        { // solo hay una consulta porque es una sola hab
          $ultimo_query=$query;
          }

      }
      

      $ultimo_query->orderBy('h.estrellas_id');
      $ultimo_query->selectRaw('
        h.Id_Hotel,
        h.Nombre_Hotel,
        h.estrellas_id,
        h.Direccion_Hotel,
        h.Telefono_reservas_hotel,
        h.Descripcion_Hotel,
        h.Foto_Principal_Hotel,
        c.Id_Ciudad AS Id_Ciudad,
        c.Nombre_Ciudad,
        ? AS Fecha_desde,
        ? AS Fecha_hasta
    ', [$request['Fecha_desde'], $request['Fecha_hasta']]);
      
     // print_r($ultimo_query->get());
      return $ultimo_query;


  }

  function habitacion_disponible($mk,$request,$diasAntes,$numeroHabitaciones,$Id_Hotel,$Cantidad_adultos,$Cantidad_menores,$habitacion)
  { 
     // Construir la condición para las habitaciones y edades
     

        $query = PreciosCupoRelease::join('tipo_habitacion_hotels AS thh', 'precios_cupo_releases.Tipo_habitacion_hotel_id_tipo_habitacion_hotel', '=', 'thh.id')
            ->join('hotels AS h', 'thh.Hotel_Id_Hotel', '=', 'h.Id_Hotel')
            ->join('tipo_habitacion_generals AS thg', 'thh.Tipo_Habitacion_general_Id_tipo_Habitacion_general', '=', 'thg.id')
            ->join('regimens AS r', 'precios_cupo_releases.regimen_id', '=', 'r.id')
            ->join('politica_cancelacions AS pc', 'precios_cupo_releases.politica_id', '=', 'pc.id')
            ->join('penalidads AS p', 'pc.id', '=', 'p.politica_id')
            ->where('h.Id_Hotel', '=', $Id_Hotel) // Habitación no cerrada para reservas
            ->where('Fecha_precio_cupo_release_noche', '>=', $request['Fecha_desde'])
            ->where('Fecha_precio_cupo_release_noche', '<', $request['Fecha_hasta'])
            ->where('precios_cupo_releases.Cierre', '=', 0) // Habitación no cerrada para reservas
            ->where('precios_cupo_releases.Release_habitacion', '<=', $diasAntes) // Habitación no cerrada para reservas
            ->whereNotNull('precios_cupo_releases.Costo_habitacion'); // Habitación con costo definido

    

            $query->where(function ($query) use ($numeroHabitaciones,$Cantidad_adultos, $Cantidad_menores, $habitacion) {
                $query->where('precios_cupo_releases.Cupo_habitacion', '>=', $numeroHabitaciones)
                    ->where('thg.Cantidad_Adultos', '>=', $Cantidad_adultos)
                    ->where('thg.Cantidad_Menores', '>=', $Cantidad_menores);

                if (!empty($habitacion['Edad_menores'])) {
                    foreach($habitacion['Edad_menores'] as $edad) {
                        $query->where('thh.Edad_menores_gratis', '>=', $edad);
                    }
                }
            });
      
            $fechaDesde = Carbon::parse($request['Fecha_desde']);
            $fechaHasta = Carbon::parse($request['Fecha_hasta']);
            
            // Calcula la diferencia en días
            $noches = $fechaDesde->diffInDays($fechaHasta);
            
         
            
            
      
            $query->selectRaw('
            thh.id AS Id_tipo_habitacion_hotels,
            thh.Nombre_Habitacion,
            r.nombre_regimen AS Nombre_Regimen,
            r.id As Id_regimen,
            h.Id_Hotel AS Id_Hotel,
            '.$Cantidad_adultos.' AS Cantidad_Adultos,
            '.$Cantidad_menores.' AS Cantidad_Menores,
            thh.Edad_menores_gratis,
            COUNT(thh.id) AS Cantidad_Noches,
            (SUM(precios_cupo_releases.Costo_habitacion) * '.$mk.') / COUNT(thh.id) AS Precio_promedio_por_noche,
            (SUM(precios_cupo_releases.Costo_habitacion) * '.$mk.')  AS Total_Habitacion,
            '.$numeroHabitaciones.' AS Cantidad_habitaciones,
            (SUM(precios_cupo_releases.Costo_habitacion) * '.$mk.' * '.$numeroHabitaciones.')  AS Total,
             pc.id AS politica_id,
             pc.Nombre_Politica AS Nombre_Politica
            ')
            ->groupBy(
                'thh.id',
                'thh.Nombre_Habitacion',
                'r.nombre_regimen',
                'r.id',
                'h.Id_Hotel',
                'thh.Edad_menores_gratis',
                'pc.id',
                'pc.Nombre_Politica'
            )
            ->havingRaw('COUNT(thh.id) = ?', [$noches]); // Condición para comparar noches;

          /*  $sql = $query->toSql();
            $bindings = $query->getBindings();
    
            // Sustituir los marcadores de posición con los valores reales
            foreach ($bindings as $binding) {
                $sql = preg_replace('/\?/', "'" . $binding . "'", $sql, 1);
            }
    
            print_r($sql);*/
           // print_r($query->get());
        
        $resultados = $query->get();
      // Obtener las penalidades relacionadas
        $politicasIds = $resultados->pluck('politica_id')->unique(); // Obtener los IDs de las políticas
        $penalidades = Penalidad::whereIn('politica_id', $politicasIds)->get(); // Obtener todas las penalidades relacionadas
        
            // Relacionar y formatear las penalidades
            $resultados->each(function ($item) use ($penalidades) {
                $item->penalidades = $penalidades->where('politica_id', $item->politica_id)
                ->map(function ($penalidad) {
                    // Crear una copia para no modificar el modelo original
                    $formattedPenalidad = clone $penalidad;
                    // Formatear el porcentaje
                    $formattedPenalidad->porcentaje_penalidad_por_noche = ($penalidad->porcentaje_penalidad_por_noche * 100) . '%';
                    return $formattedPenalidad;
                })->values();
            });
        
        return $resultados;


  }


}