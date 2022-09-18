<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\Estacionar;
use App\Models\Vagas;
use Illuminate\Http\Request;

class EstacionarController extends Controller
{
    public function index() {
        $this->authorize('viewAny', Estacionar::class);

        $dados[0] = Estacionar::all();
        $dados[1] = Carro::all();
        $dados[2] = Vagas::all();
        return view('estacionar.index', compact('dados'));
    }

    public function store(Request $request) {
        $this->authorize('create', Estacionar::class);

        $carros = $request->carros;

        foreach($carros as $ids){
            $arr = explode("_", $ids);
            $estacionados = Estacionar::all();
            $obj_vaga = Vagas::find($arr[0]);
            foreach ($estacionados as $estac) {
                if($estac->vaga_id == $arr[0]){
                    $obj_carro1 = Carro::find($estac->carro_id);
                }
            }

            Estacionar::where('vaga_id', $arr[0])->forceDelete();

            if($arr[1] == "empty"){
                if(!isset($obj_vaga)) {
                    return "<h1>ID: $obj_vaga->id id não encontrado!";
                }
                $obj_vaga->ocupado = false;
                if(isset($obj_carro1)){
                    $obj_carro1->estacionado = false;
                    $obj_carro1->save();
                }
                $obj_vaga->save();
            } else {
                $obj_carro = Carro::find($arr[1]);

                if(!isset($obj_carro) || !isset($obj_vaga)) {
                    return "<h1>ID: id não encontrado!";
                }

                $obj_vaga->ocupado = true;
                $obj_carro->estacionado = true;
                $obj = new Estacionar();
                $obj->Vaga()->associate($obj_vaga);
                $obj->Carro()->associate($obj_carro);
                $obj_vaga->save();
                $obj_carro->save();
                $obj->save();
            }

        }

        return redirect()->route('estacionar.index');
    }
}
