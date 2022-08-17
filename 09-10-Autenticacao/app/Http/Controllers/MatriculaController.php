<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Matricula;
use App\Models\Disciplina;

class MatriculaController extends Controller {

    public function store(Request $request) {

        $matriculas = $request->matriculas;
        $obj_aluno = Aluno::find($request->aluno);
        Matricula::where('aluno_id', $obj_aluno->id)->forceDelete();
        if($matriculas != null){
            foreach($matriculas as $mat){

                $obj_disciplina = Disciplina::find($mat);

                if(!isset($obj_aluno) || !isset($obj_disciplina)) { 
                    return "<h1>mat: id não encontrado!"; 
                }

                $obj = new Matricula();
                $obj->aluno()->associate($obj_aluno);
                $obj->disciplina()->associate($obj_disciplina);
                $obj->save();
            }
            return redirect()->route('alunos.index');
        }else {
            return redirect()->route('alunos.index');
        }
    }
    
}