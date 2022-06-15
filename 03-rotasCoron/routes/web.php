<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return "<h1>Rota Principal</h2>";
});

// Criando Novas Rotas
Route::get('/alunos', function() {

    $alunos = "<ul>
        <li>Edevaldo Junior</li>
        <li>Pedrin Zap</li>
        <li>Joãozinho Pleb</li>
        <li>Flavin Zika</li>
        <li>Gil Z</li>
        </ul>";

    return $alunos;

})->name('alunos');

// Parâmetros de Rotas - Obrigatórios
Route::get('/alunos/limite/{total}', function($total) {

    $dados = array(
        "1 - Edevaldo Junior",
        "2 - Jonathan Zap",
        "3 - Joãozinho Pleb",
        "4 - Flavin Zika",
        "5 - Gil Z"
    );

    $alunos = "<ul>";

    if($total <= count($dados)) {
        $cont = 0;
        foreach($dados as $nome) {
            $alunos .= "<li>$nome</li>";
            $cont++;
            if($cont >= $total) break;
        }
    }
    else if(is_numeric($total)) {
        $alunos = $alunos."<li>Tamanho Máximo = ".count($dados)."</li>";
    } else {
        return "<li>Parametro inválido, tente um número.</li>";
    }

    $alunos .= "</ul>";

    return $alunos;
})->name('alunos.limite');

// Parâmetros de Rotas - Obrigatórios
Route::get('/alunos/matricula/{matricula}', function($matricula) {

    $dados = array(
        1 => "Edevaldo Junior",
        2 => "Jonathan Zap",
        3 => "Joãozinho Pleb",
        4 => "Flavin Zika",
        5 => "Gil Z"
    );

    $aluno = "<ul>";
    if(count($dados)>=$matricula){
        if($dados[$matricula]){
            $aluno .= "<li>$dados[$matricula]</li>";
        }
    }else {
        if(is_numeric($matricula)) {
            $aluno = $aluno."<li>NÃO ENCONTRADO! Tamanho Máximo = ".count($dados)."</li>";
        }else{
            $aluno .= "<li>Parametro inválido, tente um número.</li>";
        }
    }
    

    $aluno .= "</ul>";

    return $aluno;
})->name('alunos.matricula');

// Parâmetros de Rotas - Obrigatórios
Route::get('/alunos/nome/{nome}', function($nome) {

    $dados = array(
        "Edevaldo" => "Edevaldo Junior",
        "Jonathan" => "Jonathan Zap",
        "Joaozinho" => "Joãozinho Pleb",
        "Flavin" => "Flavin Zika",
        "Gil" => "Gil Z"
    );

    $aluno = "<ul>";

    if(!is_numeric($nome)){
        if(array_key_exists($nome, $dados)){
            $aluno .= "<li>$dados[$nome]</li>";
        }else {
            $aluno .= "<li>NÃO ENCONTRADO!.</li>";
        }
    }else {
        $aluno .= "<li>Parametro inválido, tente um nome.</li>";
    }
    

    $aluno .= "</ul>";

    return $aluno;
})->name('alunos.nome');


Route::get('/nota', function() {

    $space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    $alunos = "<ul><table><br><tr><td>Matricula</td><td>Aluno</td><td>Nota</td></tr>";

    $dados = array(
        array("Matricula" => 1, "Aluno" => "Edevaldo Junior", "Nota" => 9),
        array("Matricula" => 2, "Aluno" => "Jonathan Zap", "Nota" => 2),
        array("Matricula" => 3, "Aluno" => "Joãozinho Pleb", "Nota" => 8),
        array("Matricula" => 4, "Aluno" => "Flavin Zika", "Nota" => 6),
        array("Matricula" => 5, "Aluno" => "Gil Zika", "Nota" => 4)
    );

    foreach($dados as $aluno){
        $alunos .= "<tr>";
        foreach ($aluno as $parametros => $param) {
            $alunos .= "<td>$param"."$space</td>";
        }
        $alunos .= "</tr>";
    }
    

    $alunos .= "</ul></table>";

    return $alunos;
})->name('nota');

Route::get('/nota/limite/{valor}', function($valor) {

    $space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    $alunos = "";
    $dados = array(
        array("Matricula" => 1, "Aluno" => "Edevaldo Junior", "Nota" => 9),
        array("Matricula" => 2, "Aluno" => "Jonathan Zap", "Nota" => 2),
        array("Matricula" => 3, "Aluno" => "Joãozinho Pleb", "Nota" => 8),
        array("Matricula" => 4, "Aluno" => "Flavin Zika", "Nota" => 6),
        array("Matricula" => 5, "Aluno" => "Gil Zika", "Nota" => 4)
    );

    if($valor <= count($dados) && is_numeric($valor)) {
        $alunos .= "<ul><table><br><tr><td>Matricula</td><td>Aluno</td><td>Nota</td></tr>";
        $count=0;
        foreach($dados as $aluno) {      
            $alunos .= "<tr>";
            foreach ($aluno as $parametros => $param) {
                $alunos .= "<td>$param"."$space</td>";  
            }  
            $alunos .= "</tr>";
            $count++;        
            if($count >= $valor) break;
        }
    }else{
        $alunos .= "<li>VALOR INVÁLIDO!</li>";
    }
    

    $alunos .= "</ul></table>";

    return $alunos;
})->name('nota.limite');

Route::get('/nota/lancar/{nota}/{matricula}/{nome?}/', function($nota, $matricula, $nome=null) {

    $space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    $alunos = "";
    $dados = array(
        array("Matricula" => 1, "Aluno" => "Edevaldo Junior", "Nota" => 9),
        array("Matricula" => 2, "Aluno" => "Jonathan Zap", "Nota" => 2),
        array("Matricula" => 3, "Aluno" => "Joãozinho Pleb", "Nota" => 8),
        array("Matricula" => 4, "Aluno" => "Flavin Zika", "Nota" => 6),
        array("Matricula" => 5, "Aluno" => "Gil Zika", "Nota" => 4)
    );

    if($matricula <= count($dados) && is_numeric($matricula)) {
        $alunos .= "<ul><table><br><tr><td>Matricula</td><td>Aluno</td><td>Nota</td></tr>";
        $alterarNota = false;
        
        foreach($dados as $aluno) {      
            $alunos .= "<tr>";
            foreach ($aluno as $parametros => $param) {
                $alunos .= "<td>";
                if($matricula==$param){

                    $aluno[$matricula]['Nota'] = $nota;
                    $alunos .= $aluno[$matricula]['Nota'];  

                }else if($nome==$param){ 

                    $aluno['Aluno']['Nota'] = $nota;
                    $alunos .= $aluno['Aluno']['Nota'];  

                }else{
                    $alunos .= "$param"."$space";  
                }
                
                $alunos .= "</td>";
            }  
            $alunos .= "</tr>";       

        }



    }else{
        $alunos .= "<li>VALOR INVÁLIDO!</li>";
    }
    

    $alunos .= "</ul></table>";

    return $alunos;
})->name('nota.limite');

Route::get('/nota/lancar/{nota}/{matricula}/{nome?}/', function($nota, $matricula, $nome=null) {

    $space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    $alunos = "";
    $dados = array(
        array("Matricula" => 1, "Aluno" => "Edevaldo Junior", "Nota" => 9),
        array("Matricula" => 2, "Aluno" => "Jonathan Zap", "Nota" => 2),
        array("Matricula" => 3, "Aluno" => "Joãozinho Pleb", "Nota" => 8),
        array("Matricula" => 4, "Aluno" => "Flavin Zika", "Nota" => 6),
        array("Matricula" => 5, "Aluno" => "Gil Zika", "Nota" => 4)
    );

    if($matricula <= count($dados) && is_numeric($matricula)) {
        $alunos .= "<ul><table><br><tr><td>Matricula</td><td>Aluno</td><td>Nota</td></tr>";
        $alterarNota = false;
        
        foreach($dados as $aluno) {      
            foreach ($aluno as $parametros => $param) {
                if($matricula==$param){
                    $aluno[$matricula]['Nota'] = $nota; 

                }else if($nome==$param){ 
                    $aluno['Aluno']['Nota'] = $nota;

                }
            }        
        }


        foreach($dados as $aluno) {      
            $alunos .= "<tr>";
            foreach ($aluno as $parametros => $param) {
                $alunos .= "<td>";
                $alunos .= "$param"."$space"; 
                $alunos .= "</td>";
            }  
            $alunos .= "</tr>";       

        }



    }else{
        $alunos .= "<li>VALOR INVÁLIDO!</li>";
    }
    

    $alunos .= "</ul></table>";

    return $alunos;
})->name('nota.lancar');







// Parâmetros de Rotas - Obrigatórios
Route::get('/alunos/{total}/{nome}', function($total, $nome) {

    $alunos = "<ul>";

    for($cont=0; $cont<$total; $cont++) {
        $alunos .= "<li>$nome</li>";
    }

    $alunos .= "</ul>";

    return $alunos;
});

// Parâmetros de Rotas - Opcionais
Route::get('/racas/{total}/{raca?}/', function($total, $raca=null) {

    $dados = array(
        "Bulldog Inglês",
        "Labrador",
        "Pastor Alemão",
        "Akita"
    );
    
    $pets = "<ul>";

    if($raca == null) {
        if($total <= count($dados)) {
            $cont = 0;
            foreach($dados as $item) {
                $pets .= "<li>$item</li>";
                $cont++;
                if($cont >= $total) break;
            }
        }
        else {
            $pets .= "<li>Tamanho Máximo = ".count($dados)."</li>";
        }
    }
    else {
        for($cont=0; $cont<$total; $cont++) {
            $pets .= "<li>$raca</li>";
        }
    }
    
    $pets .= "</ul>";

    return $pets;
});

// Parâmetros de Rotas - Com Regras
Route::get('/veterinarios/{total}/{nome}', function($total, $nome) {

    $vets = "<ul>";

    for($a=0; $a<$total; $a++) {
            $vets = $vets."<li>$nome</li>";
    }

    $vets = $vets."</ul>";

    return $vets;
    
})->where('total', '[0-9]+')->where('nome', '[A-Za-z]+');

// Agrupamento de Rotas / Retornando View
Route::prefix('/consultas')->group(function() {

    Route::get('/', function() {
        // return "<h1>Lista de Consultas Agendadas</h1>";
        return view('consultas');
    })->name('consultas');

    Route::get('/agendar', function() {
        // return "<h1>Agendar Consulta</h1>";
        return view('agendar');
    })->name('consultas.agendar');

    Route::get('/cancelar', function() {
        // return "<h1>Canclar Consulta</h1>";
        return view('cancelar');
    })->name('consultas.cancelar');
});

// Redirecionamento de rotas
Route::redirect('/', 'clientes', 301);

Route::get('/veterinarios', function() {
    return redirect()->route('clientes');
});

// Rota com Método POST
Route::post('veterinarios/add', function(Request $request) {
    
    return "<h1>Adicionar Veterinário (POST)</h1>";
});
