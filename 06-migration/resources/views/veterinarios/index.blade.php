<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Veterinarios", 'rota' => "veterinarios.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Veterinarios @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">

            <x-datalistVet
                :header="['ID', 'CRMV', 'NOME', 'ESPECIALIDADE', 'AÇÕES']"
                :data="$dados"
                :hide="[false, true, true, false, true]"
            />

        </div>
    </div>
@endsection
