<h2>Alterar Cidades</h2>
<form action="{{ route('cidades.update', $dados['id']) }}" method="POST">
   @csrf
   @method('PUT')
   <a href="{{route('cidades.index')}}"><h4 class="btn btn-primary">voltar</h4></a>

   <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Nome</span>
        </div>
        <input type="text" class="form-control" aria-describedby="inputGroup-sizing-default" name='nome' value='{{$dados['nome']}}'>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Porte</label>
        </div>
            <select class="custom-select" name='porte'>
                <option value="Grande">Grande</option>
                <option value="Médio">Médio</option>
                <option value="Pequeno">Pequeno</option>
            </select>
    </div>
   <input class="btn btn-success" type="submit" value="Salvar">
</form>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">