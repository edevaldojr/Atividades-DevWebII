<?php

namespace App\Http\Controllers;

use App\Models\Vagas;
use Illuminate\Http\Request;

class VagasController extends Controller
{
    public function index() {
        $this->authorize('viewAny', Vagas::class);

        $dados = Vagas::all();
        return view('vagas.index', compact('dados'));
    }

    public function create() {
        $this->authorize('create', Vagas::class);

        return view('vagas.create');
    }

    public function store(Request $request) {
        $this->authorize('create', Vagas::class);

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
        $this->authorize('update', $vaga);

        $dados = Vagas::find($vaga->id);

        if(!isset($dados)) {
            return "<h1> ID: $vaga não encontrado! </h1>";
        }

        return view('vagas.edit', compact('dados'));
    }

    public function update (Request $request, Vagas $vaga) {
        $this->authorize('update', $vaga);

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
        $this->authorize('delete', $vaga);

        Vagas::destroy($vaga->id);

        return redirect()->route('vagas.index');
    }
}
