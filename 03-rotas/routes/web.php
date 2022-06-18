<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Http\Request;

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
            $count = 0;
            foreach ($aluno as $parametros => $param) {
                $alunos .= "<td>";
                $count++;
                if($count == 3 && $alterarNota == true){
                    $alunos .= "$nota"."$space";
                    $alterarNota = false;
                    $count = 0;
                }
                else if($matricula==$param && $nome == null){
                    $alterarNota = true;
                    $alunos .= "$param"."$space"; 
                }else if($nome==$param){ 
                    $alterarNota = true;
                    $alunos .= "$param"."$space"; 
                }else {
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
})->name('nota.lancar');


Route::get('/nota/conceito/{A}/{B}/{C}/', function($minA, $minB, $minC) {

    $space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    $alunos = "";
    $dados = array(
        array("Matricula" => 1, "Aluno" => "Edevaldo Junior", "Nota" => 9),
        array("Matricula" => 2, "Aluno" => "Jonathan Zap", "Nota" => 2),
        array("Matricula" => 3, "Aluno" => "Joãozinho Pleb", "Nota" => 8),
        array("Matricula" => 4, "Aluno" => "Flavin Zika", "Nota" => 6),
        array("Matricula" => 5, "Aluno" => "Gil Zika", "Nota" => 4)
    );

    if(is_numeric($minA) && is_numeric($minB) && is_numeric($minC)) {
        $alunos .= "<ul><table><br><tr><td>Matricula</td><td>Aluno</td><td>Nota</td></tr>";
        $alterarNota = false;
        
        foreach($dados as $aluno) {      
            $alunos .= "<tr>";
            $count = 0;
            foreach ($aluno as $parametros => $param) {
                $alunos .= "<td>";
                $count++;
                    if($count == 3 ){

                        if ($minA <= $param) {
                            $alunos .= "A"."$space";
                        }else if ($minB <= $param) {
                            $alunos .= "B"."$space";
                        }else if ($minC <= $param) {
                            $alunos .= "C"."$space";
                        }else { 
                            $alunos .= "D"."$space";
                        } 

                    }else {
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
})->name('nota.conceito');

Route::post('/nota/conceito', function(Request $request) {

    $minA = $request -> A;
    $minB = $request -> B;
    $minC = $request -> C;

    $space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    $alunos = "";
    $dados = array(
        array("Matricula" => 1, "Aluno" => "Edevaldo Junior", "Nota" => 9),
        array("Matricula" => 2, "Aluno" => "Jonathan Zap", "Nota" => 2),
        array("Matricula" => 3, "Aluno" => "Joãozinho Pleb", "Nota" => 8),
        array("Matricula" => 4, "Aluno" => "Flavin Zika", "Nota" => 6),
        array("Matricula" => 5, "Aluno" => "Gil Zika", "Nota" => 4)
    );

    if(is_numeric($minA) && is_numeric($minB) && is_numeric($minC)) {
        $alunos .= "<ul><table><br><tr><td>Matricula</td><td>Aluno</td><td>Nota</td></tr>";
        $alterarNota = false;
        
        foreach($dados as $aluno) {      
            $alunos .= "<tr>";
            $count = 0;
            foreach ($aluno as $parametros => $param) {
                $alunos .= "<td>";
                $count++;
                    if($count == 3 ){

                        if ($minA <= $param) {
                            $alunos .= "A"."$space";
                        }else if ($minB <= $param) {
                            $alunos .= "B"."$space";
                        }else if ($minC <= $param) {
                            $alunos .= "C"."$space";
                        }else { 
                            $alunos .= "D"."$space";
                        } 

                    }else {
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
})->name('nota.conceito');
