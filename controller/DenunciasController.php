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
		
		
		if(!$_GET['filtro']){
		
			$_REQUEST['LISTA_DENUNCIAS'] = $this->denunciasModel->getDenuncias();
			$_REQUEST['LISTA_SERVIDORES'] = $this->servidoresModel->getServidores();
			$_REQUEST['LISTA_ORGAOS'] = $this->orgaosModel->getOrgaos();
			$_REQUEST['LISTA_MUNICIPIOS'] = $this->municipiosModel->getMunicipios();
			$_REQUEST['LISTA_ASSUNTOS'] = $this->assuntosModel->getAssuntos();
			
			$this->denunciasView->setTitulo('DENÚNCIAS');
			
			$this->denunciasView->setConteudo('listar');
			
			$this->denunciasView->carregar();
		
		}else{
			
			$filtroServidor = isset($_POST['filtroservidor']) ? $_POST['filtroservidor'] : '%';

			$filtroTipo = isset($_POST['filtrotipo']) ? $_POST['filtrotipo'] : '%';

			$filtroOrgao = isset($_POST['filtroorgao']) ? $_POST['filtroorgao'] : '%';

			$filtroMunicipio = isset($_POST['filtromunicipio']) ? $_POST['filtromunicipio'] : '%';
			
			$filtroAssunto = isset($_POST['filtroassunto']) ? $_POST['filtroassunto'] : '%';
			
			$this->denunciasModel->setServidor($filtroServidor);
			
			$this->denunciasModel->setTipo($filtroTipo);
			
			$this->denunciasModel->setOrgao($filtroOrgao);
			
			$this->denunciasModel->setMunicipio($filtroMunicipio);
			
			$this->denunciasModel->setAssunto($filtroAssunto);
			
			$_REQUEST['LISTA_DENUNCIAS'] = $this->denunciasModel->getDenunciasComFiltro();
		
			$this->denunciasView->listar();

		}
		
	}
	
	public function carregarCadastro(){
		
		$_REQUEST['LISTA_ORGAOS'] = $this->orgaosModel->getOrgaos();
		
		$_REQUEST['LISTA_MUNICIPIOS'] = $this->municipiosModel->getMunicipios();
		
		$_REQUEST['LISTA_ASSUNTOS'] = $this->assuntosModel->getAssuntos();
		
		$this->denunciasView->setTitulo('DENÚNCIAS > CADASTRAR');
		
		$this->denunciasView->setConteudo('cadastrar');
		
		$this->denunciasView->carregar();
	}
	
	public function carregarEdicao(){
		
		$this->denunciasModel->setID($_GET['id']);
		
		$_REQUEST['LISTA_ORGAOS'] = $this->orgaosModel->getOrgaos();
		
		$_REQUEST['LISTA_MUNICIPIOS'] = $this->municipiosModel->getMunicipios();
		
		$_REQUEST['LISTA_ASSUNTOS'] = $this->assuntosModel->getAssuntos();
		
		$listaDados = $_REQUEST['DADOS_DENUNCIA'] = $this->denunciasModel->getDadosID();
		
		$this->denunciasView->setTitulo('DENÚNCIAS > '.$listaDados['DS_NUMERO_PROCESSO_SEI'] . ' - ' . $listaDados['NOME_MACRO_ASSUNTO'] .' > EDITAR');
		
		$this->denunciasView->setConteudo('editar');
		
		$this->denunciasView->carregar();
	}
	
	public function carregarTriagem(){
		
		$this->denunciasModel->setID($_GET['id']);
		
		$_REQUEST['LISTA_SERVIDORES'] = $this->servidoresModel->getServidores();
		
		$_REQUEST['LISTA_UNIDADES_APURACAO'] = $this->orgaosModel->getUnidadesApuracao();
		
		$listaDados = $_REQUEST['DADOS_DENUNCIA'] = $this->denunciasModel->getDadosID();
		
		$this->denunciasView->setTitulo('DENÚNCIAS > '.$listaDados['DS_NUMERO_PROCESSO_SEI'] . ' - ' . $listaDados['NOME_MACRO_ASSUNTO'] .' > TRIAGEM');
		
		$this->denunciasView->setConteudo('triagem');
		
		$this->denunciasView->carregar();
	}
	
	public function triagem(){
		
		$id = $_GET['id'];

		$restrito = $_POST['restrito'];
		$responsavel = $_POST['responsavel'];
		$relevancia = $_POST['relevancia'];
		$termino = $_POST['termino'];
		$resultado = $_POST['resultado'];
		$unidadeApuracao = $_POST['unidadeApuracao'];
		
		$anexos = (isset($_FILES['anexos'])) ? $_FILES['anexos'] : NULL;
		$tipos = (isset($_POST['tipos'])) ? $_POST['tipos'] : NULL;
		$comentarios = (isset($_POST['comentarios'])) ? $_POST['comentarios'] : NULL;
		$datas = (isset($_POST['datas'])) ? $_POST['datas'] : NULL;
		
		$palavras = (isset($_POST['palavras'])) ? $_POST['palavras'] : NULL;
		
		$this->denunciasModel->setRestrito($restrito);
		$this->denunciasModel->setResponsavel($responsavel);
		$this->denunciasModel->setRelevancia($relevancia);
		$this->denunciasModel->setTermino($termino);
		$this->denunciasModel->setResultado($resultado);
		$this->denunciasModel->setUnidadeApuracao($unidadeApuracao);
		
		$this->denunciasModel->setAnexos($anexos);
		$this->denunciasModel->setTipos($tipos);
		$this->denunciasModel->setComentarios($comentarios);
		$this->denunciasModel->setDatas($datas);
		
		$this->denunciasModel->setPalavras($palavras);
		
		$this->denunciasModel->setID($id);
		
		$_SESSION['RESULTADO_OPERACAO'] = $this->denunciasModel->triagem();
		
		$_SESSION['MENSAGEM'] = $this->denunciasModel->getMensagemResposta();
		
		if($_SESSION['RESULTADO_OPERACAO']){
			Header('Location: /denuncias/listar/0');
		}else{
			Header("Location: /denuncias/triagem/$id");
		}
	
	}
	
	
	public function cadastrar(){
		
		$tipo         =  $_POST['tipo'];
		$nome         =  $_POST['nome'];
		$CPF          =  $_POST['CPF'];
		$email        =  $_POST['email'];
		$telefone     =  $_POST['telefone'];
		$assunto      =  $_POST['assunto'];
		$descricao    =  $_POST['descricao'];
		$municipio    =  $_POST['municipio'];
		$orgao        =  $_POST['orgao'];
		$envolvidos   =  $_POST['envolvidos'];
		$dataRegistro =  $_POST['dataRegistro'];
		$processo     =  $_POST['processo'];
		
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
			Header('Location: /denuncias/listar/0');
		}else{
			Header('Location: /denuncias/cadastrar/');
		}
		
	}	
	
	public function editar(){
		
		$id = $_GET['id'];
		
		$this->denunciasModel->setID($id);
		
		$operacao = $_GET['operacao'];
		
		switch($operacao){
			
			case 'info':
				
				$tipo         =  $_POST['tipo'];
				$nome         =  (isset($_POST['nome'])) ? $_POST['nome'] : '';
				$CPF          =  (isset($_POST['CPF'])) ? $_POST['CPF'] : '';
				$email        =  (isset($_POST['email'])) ? $_POST['email'] : '';
				$telefone     =  (isset($_POST['telefone'])) ? $_POST['telefone'] : '';
				$assunto      =  $_POST['assunto'];
				$descricao    =  $_POST['descricao'];
				$municipio    =  $_POST['municipio'];
				$orgao        =  $_POST['orgao'];
				$envolvidos   =  $_POST['envolvidos'];
				$dataRegistro =  $_POST['dataRegistro'];
				$processo     =  $_POST['processo'];
				
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
				
				$_SESSION['RESULTADO_OPERACAO'] = $this->denunciasModel->editar();
						
				break;
				
			case 'concluir':
			
				$_SESSION['RESULTADO_OPERACAO'] = $this->denunciasModel->concluirTriagem();
						
				break;
					
		}
				
		$_SESSION['MENSAGEM'] = $this->denunciasModel->getMensagemResposta();

		Header('Location: /denuncias/listar/0');
		
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