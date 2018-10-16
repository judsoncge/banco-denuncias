<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/controller/Controller.php';
require_once $_SESSION['PATH_VIEW'].'DenunciasView.php';

class DenunciasController extends Controller{
	
	function __construct(){
		
		$this->denunciasModel   = new DenunciasModel();
		$this->servidoresModel = new ServidoresModel();
		$this->orgaosModel = new OrgaosModel();
		$this->municipiosModel = new MunicipiosModel();
		$this->assuntosModel = new AssuntosModel();
		$this->denunciasModel->setTabela('tb_denuncias');
		
		$tipoView = $_SESSION['TYPE_VIEW'];
		$tipoView .= 'DenunciasView';
		$this->denunciasView = new $tipoView();
		
	}
	
	public function listar(){
		
		$_REQUEST['LISTA_DENUNCIAS'] = $this->denunciasModel->getDenuncias();
		$_REQUEST['LISTA_SERVIDORES'] = $this->servidoresModel->getServidores();
		$_REQUEST['LISTA_ORGAOS'] = $this->orgaosModel->getOrgaos();
		$_REQUEST['LISTA_MUNICIPIOS'] = $this->municipiosModel->getMunicipios();
		$_REQUEST['LISTA_ASSUNTOS_MACRO'] = $this->assuntosModel->getAssuntosMacro();
		$_REQUEST['LISTA_ASSUNTOS_MICRO'] = $this->assuntosModel->getAssuntosMicro();
		
		$_REQUEST['FRASE'] = 'Todas as denúncias (ordenadas pela data de registro no eOuv)';
		
		$this->denunciasView->setTitulo('DENÚNCIAS');
		
		$this->denunciasView->setConteudo('listar');
		
		$this->denunciasView->carregar();
		
	}
	
	public function carregarCadastro(){
		
		$this->servidoresModel->setStatus('ATIVO');
		
		$_REQUEST['LISTA_SERVIDORES'] = $this->servidoresModel->getListaServidoresStatus();
		
		$this->denunciasView->setTitulo('ARQUIVOS > CADASTRAR');
		
		$this->denunciasView->setConteudo('cadastrar');
		
		$this->denunciasView->carregar();
	}
	
	public function cadastrar(){
		
		$tipo = $_POST['tipo'];
		
		$servidorDestino = $_POST['servidor'];
		
		$anexo = $_FILES['arquivoAnexo'];
		
		$this->denunciasModel->setTipo($tipo);
		
		$this->denunciasModel->setServidorDestino($servidorDestino);
		
		$this->denunciasModel->setAnexo($anexo);
		
		$_SESSION['RESULTADO_OPERACAO'] = $this->denunciasModel->cadastrar();
		
		$_SESSION['MENSAGEM'] = $this->denunciasModel->getMensagemResposta();
		
		if($_SESSION['RESULTADO_OPERACAO']){
			Header('Location: /denuncias/ativos/');
		}else{
			Header('Location: /denuncias/cadastrar/');
		}
		
	}	
	
	public function editar(){
		
		$id = $_GET['id'];
		
		$this->denunciasModel->setID($id);
		
		$operacao = $_GET['operacao'];
		
		switch($operacao){
			
			case 'status':
				
				$status = $_GET['status'];
				
				$this->denunciasModel->setStatus($status);
				
				$_SESSION['RESULTADO_OPERACAO'] = $this->denunciasModel->editarStatus();
				
				break;
			
		}
		
		$_SESSION['MENSAGEM'] = $this->denunciasModel->getMensagemResposta();

		Header('Location: /denuncias/ativos/');
		
	}

	public function excluir(){
		
		$this->denunciasModel->setID($_GET['id']);
		
		$this->denunciasModel->setAnexo($_GET['anexo']);
		
		$_SESSION['RESULTADO_OPERACAO'] = $this->denunciasModel->excluir();
		
		$_SESSION['MENSAGEM'] = $this->denunciasModel->getMensagemResposta();
		
		Header('Location: /denuncias/ativos/');
	
	}
	
}

?>