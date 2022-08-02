<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Disciplina;

class MatriculaController extends Controller
{

    public function matricula($id) {
        $dados[0] = Disciplina::all();
        $dados[1] = aluno::find($id);

        return view('alunos.matricula', compact('dados'));
    }

   public function matricular(Request $request) {

        $rules = [
            'aluno_id' => 'required',
            'curso_id' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        $request->validate($rules, $msgs);
        while ($request) {
            Aluno::create([
                'aluno_id' => mb_strtoupper($request->aluno_id, 'UTF-8'),
                'disciplina_id' => $request->curso_id
            ]);
        }



        return redirect()->route('alunos.index');
    }
}
