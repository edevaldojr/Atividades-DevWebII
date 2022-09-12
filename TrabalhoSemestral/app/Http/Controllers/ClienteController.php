<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Carro;
use App\Models\Estacionar;

class ClienteController extends Controller
{
    public function index() {

        $dados = Cliente::with(['carro'])->get();
        return view('clientes.index', compact('dados', 'permissions'));
    }

    public function create() {

        return view('carros.create');
    }

    public function store(Request $request) {

        $regras = [
            'nome' => 'required|min:10|max:50',
            'Carro_id' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        $obj_Carro = Carro::find($request->Carro_id);

        if(isset($obj_Carro)) {

            $obj_Cliente = new Cliente();
            $obj_Cliente->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_Cliente->Carro()->associate($obj_Carro);
            $obj_Cliente->save();

            return redirect()->route('carros.index');
        }
    }

    public function show(Cliente $Cliente) {

        $dados[0] = Cliente::find($Cliente->id);

        $dados[2] = Estacionar::where('cliente_id', $Cliente->id)->get();

        return view('carros.index', compact('dados'));
    }

    public function edit(Cliente $Cliente) {

        $dados = Cliente::find($Cliente->id);
        $Carro = Carro::all();

        if(!isset($dados)) {
            return "<h1> ID: $Cliente não encontrado! </h1>";
        }

        return view('carros.edit', compact('dados', 'Carro'));
    }

    public function update (Request $request, Cliente $Cliente) {

        $obj_Cliente = Cliente::find($Cliente->id);


        $regras = [
            'nome' => 'required|min:10|max:50',
            'Carro_id' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        if(!isset($obj_Cliente)) {
            return "<h1>ID: $Cliente não encontrado! </h1>";
        }

        $obj_Carro = Cliente::find($request->cliente_id);

        if(isset($obj_Cliente)) {
            $obj_Cliente->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_Cliente->Cliente()->associate($obj_Cliente);
            $obj_Cliente->save();

            return redirect()->route('clientes.index');
        }

        return redirect()->route('clientes.index');
    }

    public function destroy(Cliente $Cliente) {

        Cliente::destroy($Cliente->id);

        return redirect()->route('clientes.index');
    }
}
