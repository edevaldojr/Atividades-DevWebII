<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Eixo;
use App\Facades\UserPermissions;


class CursoController extends Controller {

    public function index() {

        if(!UserPermissions::isAuthorized('cursos.index')) {
            abort(403);
        }


        $permissions = session('user_permissions');

        $dados = Curso::with(['eixo'])->get();
        return view('cursos.index', compact('dados', 'permissions'));
    }

    public function create() {

        if(!UserPermissions::isAuthorized('cursos.create')) {
            abort(403);
        }

        $dados = Eixo::all();

        return view('cursos.create', compact('dados'));
    }

    public function store(Request $request) {

        if(!UserPermissions::isAuthorized('cursos.store')) {

            abort(403);
        }

        $regras = [
            'nome' => 'required|min:10|max:50',
            'sigla' => 'required|min:2|max:8',
            'tempo' => 'required|min:1|max:2',
            'eixo_id' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        $obj_eixo = Eixo::find($request->eixo_id);

        if(isset($obj_eixo)) {

            $obj_curso = new curso();
            $obj_curso->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_curso->sigla = mb_strtoupper($request->sigla, 'UTF-8');
            $obj_curso->tempo = mb_strtoupper($request->tempo, 'UTF-8');
            $obj_curso->eixo()->associate($obj_eixo);
            $obj_curso->save();

            return redirect()->route('cursos.index');
        }
    }

    public function show($id) {
        if(!UserPermissions::isAuthorized('cursos.show')) {

            abort(403);
        }

    }

    public function edit($id) {

        if(!UserPermissions::isAuthorized('cursos.edit')) {

            abort(403);
        }

        $dados = Curso::find($id);
        $eixos = Eixo::all();

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('cursos.edit', compact('dados', 'eixos'));
    }

    public function update (Request $request, $id) {

        if(!UserPermissions::isAuthorized('cursos.update')) {

            abort(403);
        }

        $obj_curso = Curso::find($id);

        $regras = [
            'nome' => 'required|min:10|max:50',
            'sigla' => 'required|min:2|max:8',
            'tempo' => 'required|min:1|max:2',
            'eixo_id' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        if(!isset($obj_curso)) {

            return "<h1>ID: $id não encontrado! </h1>";
        }

        $obj_eixo = Eixo::find($request->eixo_id);

        if(isset($obj_curso)) {

            $obj_curso->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_curso->sigla = mb_strtoupper($request->sigla, 'UTF-8');
            $obj_curso->tempo = mb_strtoupper($request->tempo, 'UTF-8');
            $obj_curso->eixo()->associate($obj_eixo);
            $obj_curso->save();
            return redirect()->route('cursos.index');
        }
    }

    public function destroy($id) {

        if(!UserPermissions::isAuthorized('cursos.destroy')) {

            abort(403);
        }

        Curso::destroy($id);

        return redirect()->route('cursos.index');
    }
}
