<?php

    include_once '../global.php';

    class RouteController {

        public static function index() {
            echo "<script>window.location='views/viewMain.php'</script>";
        }

        public static function rotas() {

            // echo "<script>alert('cadastrar')</script>";
		$dados = explode("/", $_POST['acao']);

		if(strcmp($dados[0], "cadastrar") == 0) {
			PessoaController::create();
		}
		else if(strcmp($dados[0], "alterar") == 0) {
			PessoaController::edit($dados[1]);
		}
		else if(strcmp($dados[0], "remover") == 0) {
			PessoaController::destroy($dados[1]);
		}
    }
}
?>
