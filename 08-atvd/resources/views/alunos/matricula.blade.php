@extends('templates.main', ['titulo' => "Matricula"])
@section('titulo') Matricular Aluno @endsection
@section('conteudo')

    <div class="row">
        <div class="col">

            <x-datalistMatricula
                :header="['DISCIPLINA', 'MATRICULA']"
                :data="$dados"
                :hide="[false, false]"
            />

        </div>
    </div>
@endsection
