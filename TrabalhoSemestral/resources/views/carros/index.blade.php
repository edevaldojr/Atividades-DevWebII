@extends('templates.main', ['titulo' => "Carros", 'rota' => "carros.create", 'permission' => "App/Models/Carro"])

@section('titulo') Carros @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalistCarro
                :header="['PLACA', 'MODELO', 'MARCA', 'COR', 'ESTACIONADO', 'OPÇÕES']"
                :data="$dados"
                :hide="[false, false, false, false, false, false]"
            />
        </div>
    </div>
@endsection
