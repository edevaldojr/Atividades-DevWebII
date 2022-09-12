<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estacionar extends Model
{
    use HasFactory;

    public function carro() {
        return $this->belongsTo('App\Models\Carro');
    }

    public function vaga() {
        return $this->belongsTo('App\Models\Vagas');
    }
}
