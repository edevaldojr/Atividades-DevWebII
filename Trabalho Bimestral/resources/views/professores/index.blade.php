<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Professores", 'rota' => "professores.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Professores @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">

            <!-- Utiliza o componente "datalist" criado -->
            <x-datalistProfessor
                :header="['ID', 'NOME', 'EMAIL', 'SIAPE', 'EIXO', 'STATUS','AÇÕES']"
                :data="$dados"
                :hide="[true, false, true, false, true, false, true]"
            />

        </div>
    </div>
@endsection
