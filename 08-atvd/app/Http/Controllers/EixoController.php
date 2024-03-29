<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixo;

class EixoController extends Controller
{

    public function index() {

        $dados = Eixo::all();
        return view('eixos.index', compact('dados'));
    }

    public function create() {

        return view('eixos.create');
    }

    public function store(Request $request) {

        $regras = [
            'nome' => 'required|min:10|max:50',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        $obj_eixo = new Eixo();
        $obj_eixo->nome = mb_strtoupper($request->nome, 'UTF-8');
        $obj_eixo->save();

        return redirect()->route('eixos.index');
    }

    public function edit($id) {

        $dados = Eixo::find($id);

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('eixos.edit', compact('dados'));
    }

    public function update(Request $request, $id) {

        $obj = Eixo::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $rules = [
            'nome' => 'required|max:100|min:10',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        $request->validate($rules, $msgs);

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
        ]);

        $obj->save();

        return redirect()->route('eixos.index');
    }

    public function destroy($id) {

        Eixo::destroy($id);

        return redirect()->route('eixos.index');
    }
}
