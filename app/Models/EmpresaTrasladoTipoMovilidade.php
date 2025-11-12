<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaTrasladoTipoMovilidade extends Model
{
    use HasFactory;
    
     /**
     * Get the tipoMovilidad that owns the EmpresaTrasladoTipoMovilidade
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoMovilidad()
    {
        return $this->belongsTo('App\Models\TipoMovilidade', 'Tipo_movilidad_Id_tipo_movilidad', 'id');
    }
}
