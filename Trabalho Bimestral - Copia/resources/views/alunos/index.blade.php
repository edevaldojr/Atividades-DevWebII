@extends('templates.main', ['titulo' => "Vinculos"])
@section('titulo') Vinculos @endsection
@section('conteudo')

    <div class="row">
        <div class="col">

            <x-datalistVinculo
                :header="['DISCIPLINA', 'PROFESSORES']"
                :data="$dados"
                :hide="[true, false]"
            />

        </div>
    </div>
@endsection
