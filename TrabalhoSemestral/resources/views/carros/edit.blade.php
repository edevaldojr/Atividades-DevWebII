@extends('templates.main', ['titulo' => "Alterar Carros"])

@section('titulo') Carros @endsection

@section('conteudo')

    <form action="{{ route('carros.update', $dados['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control {{ $errors->has('placa') ? 'is-invalid' : '' }}"
                        name="placa"
                        placeholder="placa"
                        value="{{$dados['placa']}}"
                    />
                    @if($errors->has('placa'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('placa') }}
                        </div>
                    @endif
                    <label for="placa">Placa do Carro</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control {{ $errors->has('modelo') ? 'is-invalid' : '' }}"
                        name="modelo"
                        placeholder="modelo"
                        value="{{$dados['modelo']}}"
                    />
                    @if($errors->has('modelo'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('modelo') }}
                        </div>
                    @endif
                    <label for="modelo">Modelo do Carro</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control {{ $errors->has('marca') ? 'is-invalid' : '' }}"
                        name="marca"
                        placeholder="marca"
                        value="{{$dados['marca']}}"
                    />
                    @if($errors->has('marca'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('marca') }}
                        </div>
                    @endif
                    <label for="marca">Marca do Carro</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control {{ $errors->has('cor') ? 'is-invalid' : '' }}"
                        name="cor"
                        placeholder="cor"
                        value="{{$dados['cor']}}"
                    />
                    @if($errors->has('cor'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('cor') }}
                        </div>
                    @endif
                    <label for="cor">Cor do Carro</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{route('carros.index')}}" class="btn btn-outline-danger btn-block align-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                    &nbsp; Cancelar
                </a>
                <button type="submit" class="btn btn-success btn-block align-content-center">
                    Cadastrar &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                    </svg>
                </button>
            </div>
        </div>
    </form>

@endsection
