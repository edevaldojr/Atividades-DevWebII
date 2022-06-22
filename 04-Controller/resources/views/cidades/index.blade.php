<h2>Lista de Cidades</h2>
<a href="{{ route('cidades.create') }}"><h4  type="button" class="btn btn-success">Nova Cidades</h4></a>
<table class="table">
   <thead class="thead-dark">
       <tr>
           <th scope="col">ID</th>
           <th scope="col">NOME</th>
           <th scope="col">PORTE</th>
           <th scope="col">INFO</th>
           <th scope="col">EDITAR</th>
           <th scope="col">REMOVER</th>
       </tr>
   </thead>
   <tbody>
       @foreach ($cidades as $item)
           <tr scope="row">
               <td>{{ $item['id'] }}</td>
               <td>{{ $item['nome'] }}</td>
               <td>{{ $item['porte'] }}</td>
               <td><a type="button" class="btn btn-info" href="{{ route('cidades.show', $item['id']) }}">Info</a></td>
               <td><a type="button" class="btn btn-secondary" href="{{ route('cidades.edit', $item['id']) }}">Editar</a></td>
               <td>
                    <form action="{{ route('cidades.destroy', $item['id']) }}" method="POST">
                       @csrf
                       @method('DELETE')
                       <input type='submit' value='remover' class="btn btn-danger">
                   </form>
               </td>
           </tr>
       @endforeach
   </tbody>
</table>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">