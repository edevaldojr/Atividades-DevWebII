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
        $dados[1] = Professor::all();

        return view('vinculos.index', compact('dados'));
    }

    public function create() {
        $dados[0] = Disciplina::all();
        $dados[1] = Professor::where('ativo', '=', '1')->get();
        $vinculos = Vinculo::all();
        $objVinculados = [];
        foreach ($vinculos as $vinc) {
            $professor = Professor::find($vinc['professor_id']);
            $disciplinas = Disciplina::find($vinc['disciplina_id']);

            $objVinculados[] =[
                'professor' => $professor,
                'disciplina_id' => $vinc['disciplina_id']
            ];

        }
        $this->console_log($objVinculados);

        return view('vinculos.create', compact('dados', 'vinculos', 'objVinculados'));
    }

    public function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
      }

    function function_alert($message) {

        echo "<script>alert('$message');</script>";
    }

   public function store(Request $request) {
        $this->console_log($request);

        $rules = [
            'disciplina_id' => 'required',
            'professor_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
        ];
        $request->validate($rules, $msgs);

        $disciplina = preg_replace("/[^0-9]/", "", $request->disciplina_id );
        //Vinculo::create([
        //    'disciplina_id' => $disciplina,
        //   'professor_id' => $request->professor_id,
        //]);
        $this->console_log($request->professor_id);
        $this->console_log($disciplina);
        //return redirect()->route('vinculos.create');
    }

    public function edit($id) {

        $dados = Disciplina::find($id);
        $profs = Professor::all();

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('vinculos.edit', compact('dados', 'profs'));
    }

    public function update(Request $request, $id) {

        $obj = Disciplina::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $rules = [
            'nome' => 'required|max:100|min:10',
            'curso_id' => 'required',
            'carga' => 'required|max:12|min:1'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        $request->validate($rules, $msgs);

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'curso_id' => $request->curso_id,
            'carga' => $request->carga
        ]);

        $obj->save();

        return redirect()->route('vinculos.index');
    }

    public function destroy($id) {

        Disciplina::destroy($id);

        return redirect()->route('vinculos.index');
    }
}
