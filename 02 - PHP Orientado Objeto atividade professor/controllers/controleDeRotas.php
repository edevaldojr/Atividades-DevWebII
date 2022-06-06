<?php

include_once '../global.php';

class RouteController {

    public static function rotas() {

        $dados = explode("/", $url);

        // CADASTRAR
        if (strcmp($dados[0], "cadastrar") == 0) {
            echo "<script> window.location='viewCadastrar.php' </script>";
        }
        // ALTERAR
        else if (strcmp($dados[0], "alterar") == 0) {
            // Obtem dados da pessoa escolhida para alteração
            $pessoa = select_where(trim($dados[1]));
    
            if ($pessoa == null) {
                echo "<script> alert('CPF NÃO ENCONTRADO!') </script>";
            } else {
                $url = "viewAlterar.php?cpf=" . trim($dados[1]) . "&nome=" . $pessoa[0] . "&endereco=" . $pessoa[1] . "&telefone=" . trim($pessoa[2]);
                echo "<script> window.location='" . $url . "' </script>";
            }
        }
        // REMOVER
        else if (strcmp($dados[0], "remover") == 0) {
            echo "<script> window.location='viewRemover.php?cpf=" . $dados[1] . "' </script>";
        }
        
    }
}
?>