<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Aluno;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index() {

        $dados[0] = Aluno::all();
        $dados[1] = Disciplina::all();

        return view('alunos.matricula', compact('dados'));
    }

   public function store(Request $request) {

        $matriculas = $request->matriculas;

        foreach($matriculas as $ids){
            $arr = explode("_", $ids);
            Matricula::where('aluno_id', $arr[0])->forceDelete();
            $obj_aluno = Aluno::find($arr[0]);
            $obj_disciplina = Disciplina::find($arr[1]);

            if(!isset($obj_aluno) || !isset($obj_disciplina)) { return "<h1>ID: id não encontrado!"; }

            $obj = new Matricula();
            $obj->aluno()->associate($obj_aluno);
            $obj->disciplina()->associate($obj_disciplina);

            $obj->save();
        }

        return redirect()->route('alunos.index');
    }

}
