<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vinculo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['professor_id', 'disciplina_id'];

    public function professor() {
        return $this->belongsTo('App\Models\professor');
    }

    public function disciplina() {
        return $this->belongsTo('App\Models\Disciplina');
    }
}
