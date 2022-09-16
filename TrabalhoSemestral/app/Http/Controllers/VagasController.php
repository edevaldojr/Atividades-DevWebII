<?php

namespace App\Http\Controllers;

use App\Models\Vagas;
use Illuminate\Http\Request;

class VagasController extends Controller
{
    public function index() {

        $dados = Vagas::all();
        return view('vagas.index', compact('dados'));
    }

    public function create() {

        return view('vagas.create');
    }

    public function store(Request $request) {

        $regras = [
            'bloco' => 'required',
            'numero' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
        ];

        $request->validate($regras, $msg);


        $obj_Vagas = new Vagas();
        $obj_Vagas->bloco = mb_strtoupper($request->bloco, 'UTF-8');
        $obj_Vagas->numero = $request->numero;
        $obj_Vagas->save();

        return redirect()->route('vagas.index');
    }


    public function edit(Vagas $vaga) {

        $dados = Vagas::find($vaga->id);

        if(!isset($dados)) {
            return "<h1> ID: $vaga não encontrado! </h1>";
        }

        return view('vagas.edit', compact('dados'));
    }

    public function update (Request $request, Vagas $vaga) {

        $obj_Vagas = Vagas::find($vaga->id);


        $regras = [
            'bloco' => 'required',
            'numero' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
        ];

        $request->validate($regras, $msg);

        if(!isset($obj_Vagas)) {
            return "<h1>ID: $vaga->id não encontrado! </h1>";
        }


        $obj_Vagas->bloco = mb_strtoupper($request->bloco, 'UTF-8');
        $obj_Vagas->numero = $request->numero;
        $obj_Vagas->save();

        return redirect()->route('vagas.index');

    }

    public function destroy(Vagas $vaga) {

        Vagas::destroy($vaga->id);

        return redirect()->route('vagas.index');
    }
}
