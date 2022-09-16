<div>

    <table class="table align-middle caption-top table-striped">
        <caption>Tabela de <b>Estacionamentos</b></caption>
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
            <form action="{{ route('estacionar.store') }}" method="POST">
            @csrf
                <tr>
                    @foreach ($data[2] as $item2)
                    <td>
                        {{ $item2->bloco }} - {{ $item2->numero }}
                    </td>
                    <td>
                        <select name="carros[]" class="form-control {{ $errors->has('carro_id') ? 'is-invalid' : '' }}">
                            <option value="{{$item2->id}}_empty">Vazio</option>
                            @foreach ($data[1] as $item)
                                @php $ip = 0 @endphp
                                @foreach ($data[0] as $estacionar)
                                    @if($estacionar->vaga_id == $item2->id)
                                        @php $ip = $estacionar->carro_id @endphp
                                    @endif
                                @endforeach
                                @if($ip == $item->id)
                                    <option selected="true" value="{{$item2->id}}_{{$item->id}}">
                                @else
                                    <option value="{{$item2->id}}_{{$item->id}}">
                                @endif

                                    {{ $item->placa }} - {{ $item->modelo }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endforeach
        </form>
            <tfoot>
                <td>
                    <a href="{{route('estacionar.index')}}" class="btn btn-outline-danger btn-block align-content-center">
                        &nbsp; Cancelar
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                        </svg>
                    </a>
                    <button type="submit" class="btn btn-success btn-block align-content-center">
                        Estacionar &nbsp;
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                        </svg>
                    </button>
                    </a>
                </td>
            </tfoot>
        </tbody>
    </table>
</div>
