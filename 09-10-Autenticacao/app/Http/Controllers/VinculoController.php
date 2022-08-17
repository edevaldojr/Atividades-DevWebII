<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\Vinculo;

class VinculoController extends Controller {

    public function index() {

        $dados[0] = Vinculo::all();
        $dados[1] = Professor::where('ativo', '=', true)->get();
        $dados[2] = Disciplina::all();
        return view('vinculos.index', compact('dados'));
    }

    public function create() {

        $dados[0] = Vinculo::all();
        $dados[1] = Professor::where('ativo', '=', true)->get();
        $dados[2] = Disciplina::all();
        return view('vinculos.create', compact('dados'));
    }

    public function store(Request $request) {

        $profs = $request->profs;

        foreach($profs as $ids){
            $arr = explode("_", $ids);
            Vinculo::where('disciplina_id', $arr[0])->forceDelete();
            $obj_disciplina = Disciplina::find($arr[0]);
            $obj_professor = Professor::find($arr[1]);

            if(!isset($obj_disciplina) || !isset($obj_professor)) {
                return "<h1>ID: id não encontrado!";
            }

            $obj = new Vinculo();
            $obj->professor()->associate($obj_professor);
            $obj->disciplina()->associate($obj_disciplina);

            $obj->save();
        }

        return redirect()->route('vinculos.index');
    }

    public function show($id) {

    }

    public function edit($id) {

    }

    public function update (Request $request, $id) {

    }

    public function destroy($id) {

    }
}
