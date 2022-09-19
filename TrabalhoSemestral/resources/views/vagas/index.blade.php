@extends('templates.main', ['titulo' => "Vagas", 'rota' => "vagas.create", 'permission' => "App/Models/Vagas"])

@section('titulo') Vagas @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalistVaga
                :header="['BLOCO','NUMERO', 'OCUPADO', 'OPÇÕES']"
                :data="$dados"
                :hide="[true, false, false, false]"
            />
        </div>
    </div>
@endsection
