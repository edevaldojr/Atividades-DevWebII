<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Curso;

class DisciplinaController extends Controller
{
    public function index() {
        $dados = Disciplina::with(['curso'])->get();
        return view('disciplinas.index', compact(['dados']));
    }

    public function create() {
        $dados = Curso::all();

        return view('disciplinas.create', compact('dados'));
    }

   public function store(Request $request) {

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

        $objCurso = Curso::find($request->curso_id);

        if(!isset($obj_curso)) {
            $obj = new Disciplina;
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->carga = $request->carga;
            $obj->curso()->associate($objCurso);
            $obj->save();
        }

        return redirect()->route('disciplinas.index');
    }

    public function show($id) {

    }

    public function edit($id) {

        $dados = Disciplina::find($id);
        $cursos = Curso::all();

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('disciplinas.edit', compact('dados', 'cursos'));
    }

    public function update(Request $request, $id) {

        $obj = Disciplina::find($id);
        $objCurso = Curso::find($request->curso_id);

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
        $obj->carga = $request->carga;
        $obj->eixo()->associate($objCurso);
        $obj->save();

        return redirect()->route('disciplinas.index');
    }

    public function destroy($id) {

        Disciplina::destroy($id);

        return redirect()->route('disciplinas.index');
    }
}
