<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Eixo;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index() {
        $dados = Curso::with(['eixo'])->get();
        return view('cursos.index', compact('dados'));
    }

    public function create() {
        $dados = Eixo::all();

        return view('cursos.create', compact('dados'));
    }

   public function store(Request $request) {

        $rules = [
            'nome' => 'required|max:100|min:10',
            'sigla' => 'required|max:8|min:2',
            'tempo' => 'required|max:2|min:1',
            'eixo_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        $request->validate($rules, $msgs);

        $obj_eixo = Eixo::find($request->eixo_id);

        if(isset($obj_eixo)) {

            $obj_curso = new curso();
            $obj_curso->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_curso->sigla = mb_strtoupper($request->sigla, 'UTF-8');
            $obj_curso->tempo = mb_strtoupper($request->tempo, 'UTF-8');
            $obj_curso->eixo()->associate($obj_eixo);
            $obj_curso->save();

            return redirect()->route('cursos.index');
        }
    }

    public function edit($id) {

        $dados = Curso::find($id);
        $eixos = Eixo::all();

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('cursos.edit', compact('dados', 'eixos'));
    }

    public function update(Request $request, $id) {

        $obj = Curso::find($id);
        $obj_eixo = Eixo::find($request->eixo_id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $rules = [
            'nome' => 'required|max:100|min:10',
            'sigla' => 'required|max:8|min:2',
            'tempo' => 'required|max:2|min:1',
            'eixo_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        $request->validate($rules, $msgs);


        $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
        $obj->email = $request->email;
        $obj->tempo = $request->tempo;
        $obj->eixo()->associate($obj_eixo);
        $obj->save();

        return redirect()->route('cursos.index');
    }

    public function destroy($id) {

        Curso::destroy($id);

        return redirect()->route('cursos.index');
    }
}
