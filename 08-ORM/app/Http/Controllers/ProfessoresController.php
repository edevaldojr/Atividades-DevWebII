<?php

namespace App\Http\Controllers;

use App\Models\Eixo;
use Illuminate\Http\Request;
use App\Models\Professor;
class ProfessoresController extends Controller
{
    public function index() {

        $dados[0] = Professor::all();
        $dados[1] = Eixo::all();

        return view('professores.index', compact('dados'));
    }

    public function create() {
        $dados = Eixo::all();

        return view('professores.create', compact('dados'));
    }

   public function store(Request $request) {

        $rules = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:250|min:15',
            'siape' => 'required|max:10|min:8',
            'eixo_id' => 'required',
            'ativo' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        $request->validate($rules, $msgs);

        Professor::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'email' => $request->email,
            'siape' => $request->siape,
            'eixo_id' => $request->eixo_id,
            'ativo' => $request-> ativo
        ]);


        return redirect()->route('professores.index');
    }

    public function show($id) {

    }

    public function edit($id) {

        $dados = Professor::find($id);
        $eixos = Eixo::all();

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('professores.edit', compact('dados', 'eixos'));
    }

    public function update(Request $request, $id) {

        $obj = Professor::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $rules = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:250|min:15',
            'siape' => 'required|max:10|min:8',
            'eixo_id' => 'required',
            'ativo' => 'required'
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

        return redirect()->route('professores.index');
    }

    public function destroy($id) {

        Professor::destroy($id);

        return redirect()->route('professores.index');
    }
}
