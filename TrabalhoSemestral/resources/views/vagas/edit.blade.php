@extends('templates.main', ['titulo' => "Alterar Vagas"])

@section('titulo') Vagas @endsection

@section('conteudo')

    <form action="{{ route('vagas.update', $dados['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control {{ $errors->has('bloco') ? 'is-invalid' : '' }}"
                        name="bloco"
                        placeholder="bloco"
                        value="{{$dados['bloco']}}"
                    />
                    @if($errors->has('bloco'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('bloco') }}
                        </div>
                    @endif
                    <label for="bloco">Bloco</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}"
                        name="numero"
                        placeholder="Número"
                        value="{{$dados['numero']}}"
                    />
                    @if($errors->has('numero'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('numero') }}
                        </div>
                    @endif
                    <label for="numero">Número</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <a href="{{route('vagas.index')}}" class="btn btn-outline-danger btn-block align-content-center">
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
