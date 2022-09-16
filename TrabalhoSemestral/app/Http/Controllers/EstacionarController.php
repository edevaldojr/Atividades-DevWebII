<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\Estacionar;
use App\Models\Vagas;
use Illuminate\Http\Request;

class EstacionarController extends Controller
{
    public function index() {

        $dados[0] = Estacionar::all();
        $dados[1] = Carro::all();
        $dados[2] = Vagas::all();
        return view('estacionar.index', compact('dados'));
    }

    public function store(Request $request) {

        $carros = $request->carros;

        foreach($carros as $ids){
            $arr = explode("_", $ids);
            $obj_estacionado = Estacionar::find($arr[0]);
            Estacionar::where('vaga_id', $arr[0])->forceDelete();
            $obj_vaga = Vagas::find($arr[0]);

            if($arr[1] == "empty"){
                if(!isset($obj_vaga)) {
                    return "<h1>ID: $obj_vaga->id id não encontrado!";
                }
                $obj_carro = Carro::find($obj_estacionado);
                $obj_vaga->ocupado = false;
                $obj_vaga->save();
                $obj_carro->save();
            } else {
                $obj_carro = Carro::find($arr[1]);

                if(!isset($obj_carro) || !isset($obj_vaga)) {
                    return "<h1>ID: id não encontrado!";
                }

                $obj_vaga->ocupado = true;
                $obj_carro->estacionado = true;
                $obj = new Estacionar();
                $obj->Vagas()->associate($obj_vaga);
                $obj->Carro()->associate($obj_carro);

                $obj->save();
            }

        }

        return redirect()->route('estacionar.index');
    }
}
