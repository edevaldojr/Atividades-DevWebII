<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;
use App\Models\Vagas;

class CarroController extends Controller
{
    public function index() {
        $this->authorize('viewAny', Carro::class);

        $dados = Carro::all();
        return view('carros.index', compact('dados'));
    }

    public function create() {
        $this->authorize('create', Carro::class);

        return view('carros.create');
    }

    public function store(Request $request) {
        $this->authorize('create', Carro::class);

        $regras = [
            'placa' => 'required|min:5|max:8',
            'modelo' => 'required|min:1|max:25',
            'marca' =>'required|min:1|max:25',
            'cor' => 'required|min:1|max:25',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        $obj_Carro = new Carro();
        $obj_Carro->placa = mb_strtoupper($request->placa, 'UTF-8');
        $obj_Carro->modelo = mb_strtoupper($request->modelo, 'UTF-8');
        $obj_Carro->marca = mb_strtoupper($request->marca, 'UTF-8');
        $obj_Carro->cor = mb_strtoupper($request->cor, 'UTF-8');
        $obj_Carro->save();

        return redirect()->route('carros.index');

    }

    public function show(Carro $carro) {
        $this->authorize('view', $carro);

        $dados[0] = Carro::find($carro->id);

        $dados[2] = Vagas::where('vaga_id', $carro->id)->get();

        return view('carros.index', compact('dados'));
    }

    public function edit(Carro $Carro) {
        $this->authorize('update', Carro::class);

        $dados = Carro::find($Carro->id);

        if(!isset($dados)) {
            return "<h1> ID: $Carro não encontrado! </h1>";
        }

        return view('carros.edit', compact('dados'));
    }

    public function update (Request $request, Carro $carro) {
        $this->authorize('update', $carro);

        $obj_Carro = Carro::find($carro->id);

        $regras = [
            'placa' => 'required|min:5|max:8',
            'modelo' => 'required|min:1|max:25',
            'marca' =>'required|min:1|max:25',
            'cor' => 'required|min:1|max:25',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        if(!isset($obj_Carro)) {
            return "<h1>ID: $carro não encontrado! </h1>";
        }

        if(isset($obj_Carro)) {
            $obj_Carro->placa = mb_strtoupper($request->placa, 'UTF-8');
            $obj_Carro->modelo = mb_strtoupper($request->modelo, 'UTF-8');
            $obj_Carro->marca = mb_strtoupper($request->marca, 'UTF-8');
            $obj_Carro->cor = mb_strtoupper($request->cor, 'UTF-8');
            $obj_Carro->save();

            return redirect()->route('carros.index');
        }

        return redirect()->route('carros.index');
    }

    public function destroy(Carro $carro) {
        $this->authorize('delete', $carro);

        Carro::destroy($carro->id);

        return redirect()->route('carros.index');
    }
}
