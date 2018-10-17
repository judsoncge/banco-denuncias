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
		$_REQUEST['LISTA_ASSUNTOS'] = $this->assuntosModel->getAssuntos();
		
		$_REQUEST['FRASE'] = 'Todas as denúncias (ordenadas pela data de registro no e-OUV)';
		
		$this->denunciasView->setTitulo('DENÚNCIAS');
		
		$this->denunciasView->setConteudo('listar');
		
		$this->denunciasView->carregar();
		
	}
	
	public function carregarCadastro(){
		
		$_REQUEST['LISTA_ORGAOS'] = $this->orgaosModel->getOrgaos();
		
		$_REQUEST['LISTA_MUNICIPIOS'] = $this->municipiosModel->getMunicipios();
		
		$_REQUEST['LISTA_ASSUNTOS'] = $this->assuntosModel->getAssuntos();
		
		$this->denunciasView->setTitulo('DENÚNCIAS > CADASTRAR');
		
		$this->denunciasView->setConteudo('cadastrar');
		
		$this->denunciasView->carregar();
	}
	
	public function cadastrar(){
		
		$tipo         =  isset($_POST['tipo'])         ? $_POST['tipo']          : NULL;
		$nome         =  isset($_POST['nome'])         ? $_POST['nome']          : NULL;
		$CPF          =  isset($_POST['CPF'])          ? $_POST['CPF']           : NULL;
		$email        =  isset($_POST['email'])        ? $_POST['email']         : NULL;
		$telefone     =  isset($_POST['telefone'])     ? $_POST['telefone']      : NULL;
		$assunto      =  isset($_POST['assunto'])      ? $_POST['assunto']       : NULL;
		$descricao    =  isset($_POST['descricao'])    ? $_POST['descricao']     : NULL;
		$municipio    =  isset($_POST['municipio'])    ? $_POST['municipio']     : NULL;
		$orgao        =  isset($_POST['orgao'])        ? $_POST['orgao']         : NULL;
		$envolvidos   =  isset($_POST['envolvidos'])   ? $_POST['envolvidos']    : NULL;
		$dataRegistro =  isset($_POST['dataRegistro']) ? $_POST['dataRegistro']  : NULL;
		$processo     =  isset($_POST['processo'])     ? $_POST['processo']      : NULL;
		
		$this->denunciasModel->setTipo($tipo);
		$this->denunciasModel->setNome($nome);
		$this->denunciasModel->setCPF($CPF);
		$this->denunciasModel->setEmail($email);
		$this->denunciasModel->setTelefone($telefone);
		$this->denunciasModel->setAssunto($assunto);
		$this->denunciasModel->setDescricao($descricao);
		$this->denunciasModel->setMunicipio($municipio);
		$this->denunciasModel->setOrgao($orgao);
		$this->denunciasModel->setEnvolvidos($envolvidos);
		$this->denunciasModel->setDataRegistro($dataRegistro);
		$this->denunciasModel->setProcesso($processo);
		
		
		$_SESSION['RESULTADO_OPERACAO'] = $this->denunciasModel->cadastrar();
		
		$_SESSION['MENSAGEM'] = $this->denunciasModel->getMensagemResposta();
		
		if($_SESSION['RESULTADO_OPERACAO']){
			Header('Location: /denuncias/listar/');
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