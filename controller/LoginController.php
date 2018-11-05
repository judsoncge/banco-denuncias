<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/controller/Controller.php';

class LoginController extends Controller{
	
	function __construct(){
		
		$this->servidoresModel = new servidoresModel();
	
	}
	
	public function login(){
		
		$CPF = (isset($_POST['CPF'])) ? $_POST['CPF'] : NULL;
		
		$senha = (isset($_POST['senha'])) ? $_POST['senha'] : NULL;
		
		$this->servidoresModel->setCPF($CPF);
		
		$this->servidoresModel->setSenha($senha);
		
		$dadosUsuario = $this->servidoresModel->login();
		
		if($dadosUsuario != NULL){
			
			$_SESSION['ID'] = $dadosUsuario[0]['ID'];
			$_SESSION['NOME'] = $dadosUsuario[0]['DS_NOME'];
			$_SESSION['UNIDADE'] = $dadosUsuario[0]['ID_UNIDADE_APURACAO'];			
			$_SESSION['FOTO'] = $dadosUsuario[0]['DS_FOTO'];
			$_SESSION['TIPO'] = $dadosUsuario[0]['DS_TIPO'];
			
			
			
			switch($_SESSION['TIPO']){
				
				case 'OUVIDORIA':
					$pasta = 'ouvidoria';
					$_SESSION['TYPE_VIEW'] = 'Ouv';
					break;
				
				case 'UNIDADE DE APURAÇÃO':
					$pasta = 'unidade-de-apuracao';
					$_SESSION['TYPE_VIEW'] = 'Uap';
					break;
					
				case 'ADMINISTRADOR':
					$pasta = 'administrador';
					$_SESSION['TYPE_VIEW'] = 'Adm';
					break;
				
			}
			
			$_SESSION['PATH_VIEW'] = $_SERVER['DOCUMENT_ROOT']."/view/$pasta/".$_SESSION['TYPE_VIEW']."";
				
			Header('Location: /home');
		
		}else{
			
			header('Location: /index.php');
			
		}
		
	}

	public function logoff(){
		
		session_destroy();

		header('Location: /index.php');

	}
	
	
}

?>