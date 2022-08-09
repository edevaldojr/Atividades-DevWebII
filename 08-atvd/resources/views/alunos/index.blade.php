@extends('templates.main', ['titulo' => "Alunos", 'rota' => "alunos.create"])
@section('titulo') Alunos @endsection
@section('conteudo')

    <div class="row">
        <div class="col">

            <x-datalistAluno
                :header="['ID', 'NOME', 'CURSO', 'AÇAO']"
                :data="$dados"
                :hide="[true,true, false, false]"
            />

        </div>
    </div>
@endsection
