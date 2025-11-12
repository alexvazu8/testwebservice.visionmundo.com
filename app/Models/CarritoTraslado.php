<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CarritoTraslado
 *
 * @property $id
 * @property $fecha_servicio
 * @property $hora_servicio
 * @property $Cantidad_Adultos
 * @property $Cantidad_Menores
 * @property $Precio_Adulto
 * @property $Precio_Menor
 * @property $Precio_Total
 * @property $Empresa_traslados_tipo_movilidades_id
 * @property $carrito_compras_items_id
 * @property $updated_at
 * @property $created_at
 *
 * @property CarritoComprasItem $carritoComprasItem
 * @property EmpresaTrasladoTipoMovilidade $empresaTrasladoTipoMovilidade
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CarritoTraslado extends Model
{
    
    static $rules = [
		'fecha_servicio' => 'required',
		'hora_servicio' => 'required',
		'Cantidad_Adultos' => 'required',
		'Cantidad_Menores' => 'required',
		'Precio_Adulto' => 'required',
		'Precio_Menor' => 'required',
		'Precio_Total' => 'required',
		'Empresa_traslados_tipo_movilidades_id' => 'required',
		'carrito_compras_items_id' => 'required',
		'servicio_traslados_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha_servicio','hora_servicio','Cantidad_Adultos','Cantidad_Menores','Precio_Adulto','Precio_Menor','Precio_Total','Empresa_traslados_tipo_movilidades_id','carrito_compras_items_id','servicio_traslados_id','Lugar_Origen','Lugar_Destino'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function carritoComprasItem()
    {
        return $this->hasOne('App\Models\CarritoComprasItem', 'id', 'carrito_compras_items_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empresaTrasladoTipoMovilidade()
    {
        return $this->hasOne('App\Models\EmpresaTrasladoTipoMovilidade', 'id', 'Empresa_traslados_tipo_movilidades_id');
    }
    
     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function servicioTraslado()
    {
        return $this->hasOne('App\Models\ServicioTraslado', 'id', 'servicio_traslados_id');
    }
    

}
