<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Vincular"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Vinculo @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <form action="{{ route('vinculos.store') }}" method="POST">
        @csrf
        <table class="table align-middle caption-top table-striped">
        <tr>
            <th scope="col" class="d-none d-md-table-cell">Disciplina</th>
            <th scope="col">Professores</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
            @foreach ($dados[0] as $item)
                <tr>
                    <td><input
                        type="text"
                        class="form-control {{ $errors->has('disciplina_id') ? 'is-invalid' : ''}}"
                        name="disciplina_id"
                        placeholder="{{ $item['id'] }}"
                        value="{{ $item['id'] }} - {{ $item['nome'] }}"
                        readonly="readonly"
                        />
                    </td>
                    <td>
                        <div class="row">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01" >Professor</label>
                                    <select name="professor_id" class="form-control {{ $errors->has('professor_id') ? 'is-invalid' : ''}}">
                                    @foreach($dados[1] as $profs)
                                    @foreach($objVinculados as $obj)
                                        @if($obj['disciplina_id'] == $item['id']))
                                            <option value="{{ $profs->id}}"  selected="true">
                                                {{ $profs->nome }}
                                        @endif

                                    @endforeach
                                            <option value="{{ $profs->id}}">
                                                {{ $profs->nome }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="javascript:document.querySelector('form').submit();" class="btn btn-success btn-block align-content-center">
                            Vincular &nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                        </a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col">
                <a href="{{route('vinculos.index')}}" class="btn btn-secondary btn-block align-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                    &nbsp; Voltar
                </a>
            </div>
        </div>
    </form>


@endsection
