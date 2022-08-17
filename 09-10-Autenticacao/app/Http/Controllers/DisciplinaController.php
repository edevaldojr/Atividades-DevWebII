<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Curso;
use App\Facades\UserPermissions;

class DisciplinaController extends Controller {

    public function index() {

        if(!UserPermissions::isAuthorized('disciplinas.index')) {
            abort(403);
        }

        $permissions = session('user_permissions');

        $dados = Disciplina::with(['curso'])->get();
        return view('disciplinas.index', compact('dados', 'permissions'));
    }

    public function create() {

        if(!UserPermissions::isAuthorized('disciplinas.create')) {
            abort(403);
        }

        $dados = Curso::all();
        return view('disciplinas.create', compact('dados'));
    }

    public function store(Request $request) {

        if(!UserPermissions::isAuthorized('disciplinas.store')) {
            abort(403);
        }

        $regras = [
            'nome' => 'required|min:10|max:100',
            'curso_id' => 'required',
            'carga' => 'required|min:1|max:12',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        $obj_curso = Curso::find($request->curso_id);

        if(isset($obj_curso)) {

            $obj_disciplina = new Disciplina();
            $obj_disciplina->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_disciplina->carga = $request->carga;
            $obj_disciplina->curso()->associate($obj_curso);
            $obj_disciplina->save();

            return redirect()->route('disciplinas.index');
        }
    }

    public function show($id) {
        if(!UserPermissions::isAuthorized('disciplinas.show')) {
            abort(403);
        }

    }

    public function edit($id) {

        if(!UserPermissions::isAuthorized('disciplinas.edit')) {
            abort(403);
        }

        $dados = Disciplina::find($id);
        $curso = Curso::all();

        if(!isset($dados)) {
            return "<h1> ID: $id não encontrado! </h1>";
        }

        return view('disciplinas.edit', compact('dados', 'curso'));
    }

    public function update (Request $request, $id) {

        if(!UserPermissions::isAuthorized('disciplinas.update')) {
            abort(403);
        }

        $obj_disciplina = Disciplina::find($id);

        $regras = [
            'nome' => 'required|min:10|max:100',
            'curso_id' => 'required',
            'carga' => 'required|min:1|max:12',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        if(!isset($obj_disciplina)) {
            return "<h1>ID: $id não encontrado! </h1>";
        }

        $obj_curso = Curso::find($request->curso_id);

        if(isset($obj_disciplina)) {

            $obj_disciplina->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_disciplina->carga = mb_strtoupper($request->carga, 'UTF-8');
            $obj_disciplina->curso()->associate($obj_curso);
            $obj_disciplina->save();

            return redirect()->route('disciplinas.index');
        }
    }

    public function destroy($id) {

        if(!UserPermissions::isAuthorized('disciplinas.destroy')) {
            abort(403);
        }

        Disciplina::destroy($id);

        return redirect()->route('disciplinas.index');
    }
}
