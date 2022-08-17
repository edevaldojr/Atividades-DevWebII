<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Eixo;
use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Matricula;
use App\Facades\UserPermissions;

class AlunoController extends Controller {

    public function index() {

        if(!UserPermissions::isAuthorized('alunos.index')) {
            abort(403);
        }

        $permissions = session('user_permissions');
        $dados = Aluno::with(['curso'])->get();
        return view('alunos.index', compact('dados', 'permissions'));
    }

    public function create() {

        if(!UserPermissions::isAuthorized('alunos.create')) {
            abort(403);
        }

        $dados = Curso::all();
        return view('alunos.create', compact('dados'));
    }

    public function store(Request $request) {

        if(!UserPermissions::isAuthorized('alunos.store')) {
            abort(403);
        }

        $regras = [
            'nome' => 'required|min:10|max:50',
            'curso_id' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        $obj_curso = Curso::find($request->curso_id);

        if(isset($obj_curso)) {

            $obj_aluno = new Aluno();
            $obj_aluno->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_aluno->curso()->associate($obj_curso);
            $obj_aluno->save();

            return redirect()->route('alunos.index');
        }
    }

    public function show($id) {

        if(!UserPermissions::isAuthorized('alunos.show')) {
            abort(403);
        }

        $dados[0] = Aluno::find($id);

        $dados[1]= Disciplina::where('curso_id', $dados[0]->curso_id)->get();

        $dados[2] = Matricula::where('aluno_id', $id)->get();

        return view('matriculas.index', compact('dados'));
    }

    public function edit($id) {

        if(!UserPermissions::isAuthorized('alunos.edit')) {
            abort(403);
        }

        $dados = Aluno::find($id);
        $cursos = Curso::all();

        if(!isset($dados)) {
            return "<h1> ID: $id não encontrado! </h1>";
        }

        return view('alunos.edit', compact('dados', 'cursos'));
    }

    public function update (Request $request, $id) {

        if(!UserPermissions::isAuthorized('alunos.update')) {
            abort(403);
        }

        $obj_aluno = Aluno::find($id);


        $regras = [
            'nome' => 'required|min:10|max:50',
            'curso_id' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        if(!isset($obj_aluno)) {
            return "<h1>ID: $id não encontrado! </h1>";
        }

        $obj_curso = Curso::find($request->curso_id);

        if(isset($obj_curso)) {
            $obj_aluno->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_aluno->curso()->associate($obj_curso);
            $obj_aluno->save();

            return redirect()->route('alunos.index');
        }

        return redirect()->route('alunos.index');
    }

    public function destroy($id) {

        if(!UserPermissions::isAuthorized('alunos.destroy')) {
            abort(403);
        }

        Aluno::destroy($id);

        return redirect()->route('alunos.index');
    }

}
