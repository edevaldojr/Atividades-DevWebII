<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use App\Models\Veterinario;
use Illuminate\Http\Request;

class VeterinarioController extends Controller
{
    public function index() {

        $dados[0] = Veterinario::all();
        $dados[1] = Especialidade::all();

        return view('veterinarios.index', compact('dados'));
    }

    public function create() {
        $dados = Especialidade::all();

        return view('veterinarios.create', compact('dados'));
    }

    public function store(Request $request) {

        $rules =[
            'name' => 'required|max:100|min:10',
            'crmv' => 'required|max:10|min:5|unique:veterinarios',
            'especialidade_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um veterinário cadastrado com esse [:attribute]!"
        ];
        $request->validate($rules, $msgs);

        Veterinario::create([
            'crmv'=>$request->crmv,
            'name' => mb_strtoupper($request->name, 'UTF-8'),
            'especialidade_id' => $request->especialidade_id,
        ]);


        return redirect()->route('veterinarios.index');
    }

    public function show($id) {

    }

    public function edit($id) {

        $dados = Veterinario::find($id);
        $esp = Especialidade::all();
        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('veterinarios.edit', compact('dados','esp'));
    }

    public function update(Request $request, $id) {

        $obj = Veterinario::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $rules =[
            'name' => 'required|max:100|min:10',
            'crmv' => 'required|max:10|min:5|unique:veterinarios',
            'especialidade_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um veterinário cadastrado com esse [:attribute]!"
        ];
        $request->validate($rules, $msgs);

        $obj->fill([
            'crmv' => $request->crmv,
            'name' => $request->name,
            'especialidade_id' => $request->especialidade_id,
        ]);

        $obj->save();

        return redirect()->route('veterinarios.index');
    }

    public function destroy($id) {

        Veterinario::destroy($id);

        return redirect()->route('veterinarios.index');
    }
}

