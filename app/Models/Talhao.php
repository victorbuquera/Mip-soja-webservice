<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talhao extends Model
{
    protected $fillable = [
        'nome',
        'area',
        'localizacao',
        'coordenadas',
    ];

    public function fazenda()
    {
        return $this->belongsTo(Fazenda::class);
    }
}
