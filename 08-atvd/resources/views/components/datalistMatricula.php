<div>

    <table class="table align-middle caption-top table-striped">
        <caption>Tabela de <b>Matricula</b></caption>
        <thead>
        <tr>
            @php $cont=0; @endphp
            @foreach ($header as $item)

                @if($hide[$cont])
                    <th scope="col" class="d-none d-md-table-cell">{{ $item }}</th>
                @else
                    <th scope="col">{{ $item }}</th>
                @endif
                @php $cont++; @endphp

            @endforeach
        </tr>
        </thead>
        <tbody>
            <caption>Aluno: <b>{{$data[1]->nome}}</b></caption>
            <form action="{{ route('alunos.matricular', $dados['id']) }}" method="POST">
            @csrf
                <tr>
                    @foreach ($data[0] as $disciplina)
                    <td>
                        {{ $disciplina['nome'] }}
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="matricula[]" id="inlineCheckbox1" value="{{$disciplina['id']}}">
                            <label class="form-check-label" for="matricula"></label>
                        </div>
                    </td>
                    @endforeach
                </tr>

            </form>
            <tfoot>
                <td>
                <a href="{{route('alunos.index')}}" class="btn btn-secondary btn-block align-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                    &nbsp; Voltar
                </a>
                <a href="javascript:document.querySelector('form').submit();" class="btn btn-success btn-block align-content-center">
                    Confirmar &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                </a>
                </td>
            </tfoot>
        </tbody>
    </table>

</div>
