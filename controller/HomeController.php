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
		
		$_REQUEST['QTD_TOTAL_DENUNCIAS'] = $this->denunciasModel->getQuantidadeTotalDenuncias();
		
		$_REQUEST['QTD_DENUNCIAS_IDENTIFICADAS'] = $this->denunciasModel->getQuantidadeDenunciasTipo('IDENTIFICADA');
		
		$_REQUEST['QTD_DENUNCIAS_NAO_IDENTIFICADAS'] = $this->denunciasModel->getQuantidadeDenunciasTipo('NÃO IDENTIFICADA');
		
		$_REQUEST['QTD_DENUNCIAS_MUNICIPIO'] = $this->denunciasModel->getQuantidadeDenunciasMunicipio();
		
		$_REQUEST['QTD_DENUNCIAS_ORGAO'] = $this->denunciasModel->getQuantidadeDenunciasOrgao();
		
		$_REQUEST['QTD_DENUNCIAS_UNIDADE_APURACAO'] = $this->denunciasModel->getQuantidadeDenunciasUnidade();
		
		$_REQUEST['QTD_TRIAGENS_DENTRO_PRAZO'] = $this->denunciasModel->getQuantidadeTriagensDentroPrazo();
		
		$_REQUEST['QTD_TRIAGENS_ATRASADAS'] = $this->denunciasModel->getQuantidadeTriagensAtrasadas();
		
		$_REQUEST['QTD_DENUNCIAS_ASSUNTO'] = $this->denunciasModel->getQuantidadeDenunciasAssunto();
		
		$this->homeView->setTitulo("<center>Bem vindo(a) ao Banco de Denúncias, <br>" . $_SESSION['NOME'] . "</center>");

		$this->homeView->setConteudo('home');
		
		$this->homeView->carregar();
		
	}

}

?>