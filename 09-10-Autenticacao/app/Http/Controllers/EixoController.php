<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixo;
use App\Facades\UserPermissions;

class EixoController extends Controller {

    public function index() {

        if(!UserPermissions::isAuthorized('eixos.index')) {
            abort(403);
        }

        $permissions = session('user_permissions');
        $dados = Eixo::all();
        return view('eixos.index', compact('dados', 'permissions'));
    }

    public function create() {
        if(!UserPermissions::isAuthorized('eixos.create')) {
            abort(403);
        }

        return view('eixos.create');
    }

    public function store(Request $request) {

        if(!UserPermissions::isAuthorized('eixos.store')) {
            abort(403);
        }

        $regras = [
            'nome' => 'required|min:10|max:50',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        $obj_eixo = new Eixo();
        $obj_eixo->nome = mb_strtoupper($request->nome, 'UTF-8');
        $obj_eixo->save();

        return redirect()->route('eixos.index');
    }

    public function show($id) {
        if(!UserPermissions::isAuthorized('eixos.show')) {
            abort(403);
        }

    }

    public function edit($id) {

        if(!UserPermissions::isAuthorized('eixos.edit')) {
            abort(403);
        }

        $dados = Eixo::find($id);

        if(!isset($dados)) {
            return "<h1> ID: $id não encontrado! </h1>";
        }

        return view('eixos.edit', compact('dados'));
    }

    public function update (Request $request, $id) {

        if(!UserPermissions::isAuthorized('eixos.update')) {
            abort(403);
        }

        $obj_eixo = Eixo::find($id);

        $regras = [
            'nome' => 'required|min:10|max:50',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório!",
            "min" => "O [:attribute] deve conter no mínimo [:min] caracteres!",
            "max" => "O [:attribute] deve conter no máximo [:max] caracteres!",
        ];

        $request->validate($regras, $msg);

        if(!isset($obj_eixo)) {
            return "<h1>ID: $id não encontrado! </h1>";
        }

        $obj_eixo->nome = mb_strtoupper($request->nome, 'UTF-8');
        $obj_eixo->save();

        return redirect()->route('eixos.index');
    }

    public function destroy($id) {

        if(!UserPermissions::isAuthorized('eixos.destroy')) {
            abort(403);
        }

        Eixo::destroy($id);

        return redirect()->route('eixos.index');
    }
}
