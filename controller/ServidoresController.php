<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/controller/Controller.php';
require_once $_SESSION['PATH_VIEW'].'ServidoresView.php';

class ServidoresController extends Controller{
	
	function __construct(){

		$this->servidoresModel = new ServidoresModel();		
		$this->orgaosModel = new OrgaosModel();
		$this->servidoresModel->setTabela('tb_servidores');
		
		$tipoView = $_SESSION['TYPE_VIEW'];
		$tipoView .= 'ServidoresView';
		$this->servidoresView = new $tipoView();
		
	}
	
	public function carregarCadastro(){
		
		$_REQUEST['LISTA_ORGAOS'] = $this->orgaosModel->getOrgaos();
	
		$this->servidoresView->setTitulo('SERVIDORES > CADASTRAR');
		
		$this->servidoresView->setConteudo('cadastrar');
	
		$this->servidoresView->carregar();
		
	}

	public function listar(){
		
		$listaServidores = $this->servidoresModel->getServidores();
		
		$this->servidoresView->setTitulo('SERVIDORES > LISTAR');
		
		$this->servidoresView->setConteudo('listar');
		
		$_REQUEST['LISTA_SERVIDORES'] = $listaServidores;
		
		$this->servidoresView->carregar();
		
	}
	
	public function cadastrar(){
		
		$nome = $_POST['nome'];
		
		$matricula = $_POST['matricula'];
		
		$cpf = $_POST['CPF'];
		
		$telefone = $_POST['telefone'];
		
		$email = $_POST['email'];
		
		$orgao = $_POST['orgao'];
		
		$tipo = $_POST['tipo'];
		
		$this->servidoresModel->setNome($nome);
		
		$this->servidoresModel->setMatricula($matricula);
		
		$this->servidoresModel->setCPF($cpf);
		
		$this->servidoresModel->setTelefone($telefone);
		
		$this->servidoresModel->setEmail($email);
		
		$this->servidoresModel->setOrgao($orgao);
		
		$this->servidoresModel->setTipo($tipo);
		
		$_SESSION['RESULTADO_OPERACAO'] = $this->servidoresModel->cadastrar();
		
		$_SESSION['MENSAGEM'] = $this->servidoresModel->getMensagemResposta();
		
		if($_SESSION['RESULTADO_OPERACAO']){
			Header('Location: /servidores/listar/');
		}else{
			Header('Location: /servidores/cadastrar/');
		}
		
	}	
	
	public function editar(){
		
		$id = (isset($_GET['id'])) ? $_GET['id'] : NULL;
		
		$this->servidoresModel->setID($id);
		
		switch($_GET['operacao']){
			
			case 'info':
				
				$nome = $_POST['nome'];
		
				$matricula = $_POST['matricula'];
				
				$cpf = $_POST['CPF'];
				
				$telefone = $_POST['telefone'];
				
				$email = $_POST['email'];
				
				$orgao = $_POST['orgao'];
				
				$tipo = $_POST['tipo'];
				
				$this->servidoresModel->setNome($nome);
				
				$this->servidoresModel->setMatricula($matricula);
				
				$this->servidoresModel->setCPF($cpf);
				
				$this->servidoresModel->setTelefone($telefone);
				
				$this->servidoresModel->setEmail($email);
				
				$this->servidoresModel->setOrgao($orgao);
				
				$this->servidoresModel->setTipo($tipo);
				
				$_SESSION['RESULTADO_OPERACAO'] = $this->servidoresModel->editar();
				
				$_SESSION['MENSAGEM'] = $this->servidoresModel->getMensagemResposta();
				
				if($_SESSION['RESULTADO_OPERACAO']){
					Header('Location: /servidores/listar/');
				}else{
					Header('Location: /servidores/editar/'.$id);
				}
				
				break;
			
			case 'senha':
							
				$senha = (isset($_POST['senha'])) ? $_POST['senha'] : NULL;
		
				$confirmaSenha = (isset($_POST['confirmaSenha'])) ? $_POST['confirmaSenha'] : NULL;
				
				$this->servidoresModel->setSenha($senha);
		
				$this->servidoresModel->setConfirmaSenha($confirmaSenha);
				
				$_SESSION['RESULTADO_OPERACAO'] = $this->servidoresModel->editarSenha();
				
				$_SESSION['MENSAGEM'] = $this->servidoresModel->getMensagemResposta();
		
				Header('Location: /servidores/senha/');
				
				break;
			
			case 'foto': 
			
				$foto = (isset($_FILES['arquivoFoto'])) ? $_FILES['arquivoFoto'] : NULL;
				
				$this->servidoresModel->setFoto($foto);
				
				$_SESSION['RESULTADO_OPERACAO'] = $this->servidoresModel->editarFoto();
				
				$_SESSION['MENSAGEM'] = $this->servidoresModel->getMensagemResposta();
				
				$_SESSION['FOTO'] = $this->servidoresModel->getFoto();
				
				Header('Location: /servidores/foto/');
			
				break;

		}

	}

	public function carregarEdicao(){
		
		switch($_GET['tipo']){
			
			case 'info':			
		
				$this->servidoresModel->setID($_GET['id']);
		
				$_REQUEST['DADOS_SERVIDOR'] = $listaDados = $this->servidoresModel->getDadosID();
				
				if(!$_REQUEST['DADOS_SERVIDOR']){
					
					$_SESSION['RESULTADO_OPERACAO'] = 0;
					
					$_SESSION['MENSAGEM'] = 'Servidor não encontrado';
					
					Header('Location: /servidores/ativos/');
					
					die();
				
				}else{
					
					$_REQUEST['LISTA_ORGAOS'] = $this->orgaosModel->getOrgaos();
				
					$this->servidoresView->setTitulo("SERVIDORES > ".strtoupper($listaDados['DS_NOME'])." > EDITAR");
					
					break;
				}
			
			case 'senha':
				$this->servidoresView->setTitulo('EDITAR SENHA');
				break;
			
			case 'foto':
				$this->servidoresView->setTitulo('EDITAR FOTO');
				break;
			
			
		}
		
		$this->servidoresView->setConteudo('editar');
		
		$this->servidoresView->setTipoEdicao($_GET['tipo']);
		
		$this->servidoresView->carregar();
		
	}
	
	public function excluir(){
		
		$this->servidoresModel->setID($_GET['id']);
		
		$_SESSION['RESULTADO_OPERACAO'] = $this->servidoresModel->excluir();
		
		$_SESSION['MENSAGEM'] = $this->servidoresModel->getMensagemResposta();
		
		Header('Location: /servidores/ativos/');
		
	}
	
}

?>