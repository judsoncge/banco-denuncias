<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/controller/Controller.php';
require_once $_SESSION['PATH_VIEW'].'HomeView.php';


class HomeController extends Controller{
	
	function __construct(){
		
		$tipoView = $_SESSION['TYPE_VIEW'];
		$tipoView .= 'HomeView';
		$this->homeView = new $tipoView();
		$this->denunciasModel = new DenunciasModel();
		
	}

	public function carregarHome(){
				
		$_REQUEST['TRIAGENS_EXPIRADAS'] = $this->denunciasModel->getTriagensPrazoExpirado();
		
		$this->homeView->setTitulo("<center>Bem vindo(a) ao Banco de Denúncias, <br>" . $_SESSION['NOME'] . "</center>");

		$this->homeView->setConteudo('home');
		
		$this->homeView->carregar();
		
	}

}

?>