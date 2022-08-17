<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Eixo;
use App\Facades\UserPermissions;

class ProfessorController extends Controller {

    public function index() {

        if(!UserPermissions::isAuthorized('professores.index')) {
            abort(403);
        }

        $permissions = session('user_permissions');

        $dados = Professor::with(['eixo'])->get();
        return view('professores.index', compact('dados', 'permissions'));
    }

    public function create() {

        if(!UserPermissions::isAuthorized('professores.create')) {
            abort(403);
        }

        $dados = Eixo::all();
        return view('professores.create', compact('dados'));
    }

    public function store(Request $request) {

        if(!UserPermissions::isAuthorized('professores.store')) {
            abort(403);
        }

        $regras = [
            'ativo' => 'required',
            'nome' => 'required|min:10|max:100',
            'email' => 'required|min:15|max:250',
            'siape' => 'required|min:7|max:9',
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

            $obj_professor = new Professor();
            $obj_professor->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_professor->email = mb_strtoupper($request->email, 'UTF-8');
            $obj_professor->siape = mb_strtoupper($request->siape, 'UTF-8');
            $obj_professor->ativo = $request->ativo;
            $obj_professor->eixo()->associate($obj_eixo);
            $obj_professor->save();

            return redirect()->route('professores.index');
        }
    }

    public function show($id) {

        if(!UserPermissions::isAuthorized('professores.show')) {
            abort(403);
        }

    }

    public function edit($id) {

        if(!UserPermissions::isAuthorized('professores.edit')) {
            abort(403);
        }

        $dados = Professor::find($id);
        $eixo = Eixo::all();

        if(!isset($dados)) {
            return "<h1> ID: $id não encontrado! </h1>";
        }

        return view('professores.edit', compact('dados', 'eixo'));
    }

    public function update (Request $request, $id) {

        if(!UserPermissions::isAuthorized('professores.update')) {
            abort(403);
        }

        $obj_professor = Professor::find($id);


        $regras = [
            'ativo' => 'required',
            'nome' => 'required|min:10|max:100',
            'email' => 'required|min:15|max:250',
            'siape' => 'required|min:7|max:9',
            'eixo_id' => 'required',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        if(!isset($obj_professor)) {
            return "<h1>ID: $id não encontrado! </h1>";
        }

        $obj_eixo = Eixo::find($request->eixo_id);

        if(isset($obj_professor)) {

            $obj_professor->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_professor->email = mb_strtoupper($request->email, 'UTF-8');
            $obj_professor->siape = mb_strtoupper($request->siape, 'UTF-8');
            $obj_professor->ativo = $request->ativo;
            $obj_professor->eixo()->associate($obj_eixo);
            $obj_professor->save();

            return redirect()->route('professores.index');
        }
    }

    public function destroy($id) {

        if(!UserPermissions::isAuthorized('professores.destroy')) {
            abort(403);
        }

        Professor::destroy($id);

        return redirect()->route('professores.index');
    }
}
