<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Matricula;

class AlunoController extends Controller
{
    public function index() {
        $dados = Aluno::with(['curso'])->get();
        return view('alunos.index', compact('dados'));
    }

    public function create() {
        $dados = Curso::all();

        return view('alunos.create', compact('dados'));
    }


    public function store(Request $request) {

        $rules = [
            'nome' => 'required|max:100|min:10',
            'curso_id' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        $request->validate($rules, $msgs);

        $objCurso = Curso::find($request->curso_id);
        if(!isset($obj_curso)) {
            $obj = new Aluno;
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->curso()->associate($objCurso);
            $obj->save();
        }

        return redirect()->route('alunos.index');
    }

    public function edit($id) {

        $dados = Aluno::find($id);
        $cursos = Curso::all();

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('alunos.edit', compact('dados', 'cursos'));
    }

    public function update(Request $request, $id) {

        $obj = Aluno::find($id);
        $obj_curso = Curso::find($request->curso_id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $rules = [
            'nome' => 'required|max:100|min:10',
            'curso_id' => 'required',
            'carga' => 'required|max:12|min:1'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        $request->validate($rules, $msgs);

        $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
        $obj->curso()->associate($obj_curso);
        $obj->save();

        return redirect()->route('alunos.index');
    }

    public function destroy($id) {

        Aluno::destroy($id);

        return redirect()->route('alunos.index');
    }

    public function matricula($id) {

        $dados[0] = Disciplina::all();
        $dados[1] = Aluno::find($id);
        $dados[2] = Matricula::where('aluno_id', $dados[1]->id)->get();

        return view('alunos.matricula', compact('dados'));
    }

   public function matricular(Request $request, $id) {

        $matriculas = $request->matriculas;
        $obj_aluno = Aluno::find($id);

        if(!isset($obj_aluno)) { return "<h1>ID: id não encontrado!"; }

        foreach($matriculas as $ids){
            Matricula::where('name', $obj_aluno->nome)->forceDelete();

            $obj_disciplina = Disciplina::find($ids);

            if(!isset($obj_disciplina)) { return "<h1>ID: id não encontrado!"; }

            $obj = new Matricula();
            $obj->aluno()->associate($obj_aluno);
            $obj->disciplina()->associate($obj_disciplina);

            $obj->save();
        }

        return redirect()->route('alunos.index');
    }


}
