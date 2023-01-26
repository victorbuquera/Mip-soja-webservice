<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fazenda extends Model
{
    protected $fillable = [
        'nome',
        'cidade',
        'estado',
        'tamanho',
        'id_usuario'
        ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
