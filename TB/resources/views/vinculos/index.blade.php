<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Vinculos", 'rota' => "vinculos.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Vinculos @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">

            <!-- Utiliza o componente "datalist" criado -->
            <x-datalistVinculo
                :header="['DISCIPLINA', 'PROFESSORES', 'AÇÕES']"
                :data="$dados"
                :hide="[true, true, false]"
            />

        </div>
    </div>
@endsection
