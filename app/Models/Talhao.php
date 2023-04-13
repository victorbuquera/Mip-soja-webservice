<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talhao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'area',
        'coordenadas',
        'fazenda_id',
    ];

    public function fazenda()
    {
        return $this->belongsTo(Fazenda::class);
    }
}
