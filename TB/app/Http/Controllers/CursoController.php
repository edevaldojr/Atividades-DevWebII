<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Eixo;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index() {

        $dados[0] = Curso::all();
        $dados[1] = Eixo::all();

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

        Curso::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'sigla' => $request->sigla,
            'tempo' => $request->tempo,
            'eixo_id' => $request->eixo_id
        ]);


        return redirect()->route('cursos.index');
    }

    public function show($id) {

    }

    public function edit($id) {

        $dados = Curso::find($id);
        $eixos = Eixo::all();

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('cursos.edit', compact('dados', 'eixos'));
    }

    public function update(Request $request, $id) {

        $obj = Curso::find($id);

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

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'email' => $request->sigla,
            'tempo' => $request->tempo,
            'eixo_id' => $request->eixo_id
        ]);

        $obj->save();

        return redirect()->route('cursos.index');
    }

    public function destroy($id) {

        Curso::destroy($id);

        return redirect()->route('cursos.index');
    }
}
