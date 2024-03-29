@extends('templates.main', ['titulo' => "Estacionar", 'permission' => "App/Models/Estacionar"])

@section('titulo') Estacionar @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalistEstacionar
                :header="['VAGA', 'CARRO']"
                :data="$dados"
                :hide="[false, false]"
            />
        </div>
    </div>
@endsection
