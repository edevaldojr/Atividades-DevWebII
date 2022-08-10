<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Aluno;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{

   public function store(Request $request) {

        $matriculas = $request->matriculas;
        $obj_aluno = Aluno::find($request->aluno);
        Matricula::where('aluno_id', $obj_aluno->id)->forceDelete();
        foreach($matriculas as $id){

            $obj_disciplina = Disciplina::find($id);

            if(!isset($obj_aluno) || !isset($obj_disciplina)) { return "<h1>ID: id não encontrado!"; }

            $obj = new Matricula();
            $obj->aluno()->associate($obj_aluno);
            $obj->disciplina()->associate($obj_disciplina);

            $obj->save();
        }

        return redirect()->route('alunos.index');
    }

}
