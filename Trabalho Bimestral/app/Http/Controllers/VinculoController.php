<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\Professor;
use App\Models\Vinculo;
use Illuminate\Http\Request;

class VinculoController extends Controller
{
    public function index() {

        $dados[0] = Disciplina::all();
        $dados[1] = Professor::where('ativo', '=', '1')->get();
        $dados[2] = Vinculo::all();

        return view('vinculos.index', compact('dados'));
    }

   public function store(Request $request) {

        $professores = $request->professores;

        foreach($professores as $ids){
            $arr = explode("_", $ids);
            Vinculo::where('disciplina_id', $arr[0])->forceDelete();

            Vinculo::create([
                'disciplina_id' => $arr[0],
                'professor_id' =>  $arr[1],
             ]);
        }

        return redirect()->route('vinculos.index');
    }

}
