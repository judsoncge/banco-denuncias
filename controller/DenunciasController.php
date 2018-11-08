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
	
	public function visualizar(){
		
		$id = $_GET['id'];
		
		$this->denunciasModel->setID($id);
		
		$listaDados = $_REQUEST['DADOS_DENUNCIA'] = $this->denunciasModel->getDadosID();
		
		$_REQUEST['LISTA_ANEXOS'] = $this->denunciasModel->getAnexos();
		
		$_REQUEST['LISTA_TRILHAS'] = $this->denunciasModel->getTrilhas();
		
		$_REQUEST['HISTORICO'] = $this->denunciasModel->getHistorico();
		
		$this->denunciasView->setTitulo('DENÚNCIAS > '.$listaDados['DS_NUMERO'] . ' > VISUALIZAR');
		
		$this->denunciasView->setConteudo('visualizar');
		
		$this->denunciasView->carregar();
		
	}
	
	public function listar(){
		
		
		if(!$_GET['filtro']){
		
			$_REQUEST['LISTA_DENUNCIAS'] = $this->denunciasModel->getDenuncias();
			
			$_REQUEST['LISTA_SERVIDORES'] = $this->servidoresModel->getServidores();
			
			$_REQUEST['LISTA_UNIDADES_APURACAO'] = $this->orgaosModel->getUnidadesApuracao();
			
			$_REQUEST['LISTA_MUNICIPIOS'] = $this->municipiosModel->getMunicipios();
			
			$_REQUEST['LISTA_ASSUNTOS'] = $this->assuntosModel->getAssuntos();
			
			$this->denunciasView->setTitulo('DENÚNCIAS');
			
			$this->denunciasView->setConteudo('listar');
			
			$this->denunciasView->carregar();
		
		}else{
			
			$filtroNCD = isset($_POST['filtroncd']) ? $_POST['filtroncd'] : '%';
			
			$filtroSituacao = isset($_POST['filtrosituacao']) ? $_POST['filtrosituacao'] : '%';

			$filtroResponsavel = isset($_POST['filtroresponsavel']) ? $_POST['filtroresponsavel'] : '%';

			$filtroUnidade = isset($_POST['filtrounidade']) ? $_POST['filtrounidade'] : '%';
			
			$filtroAssunto = isset($_POST['filtroassunto']) ? $_POST['filtroassunto'] : '%';
			
			$filtroMunicipio = isset($_POST['filtromunicipio']) ? $_POST['filtromunicipio'] : '%';

			$filtroPeriodo = ($_POST['filtroperiodo'] != '') ? $_POST['filtroperiodo'] : '%';
			
			$filtroRestrito = isset($_POST['filtrorestrito']) ? $_POST['filtrorestrito'] : '%';
			
			$filtroAnalise = isset($_POST['filtroanalise']) ? $_POST['filtroanalise'] : '%';
			
			$filtroPalavraChave= isset($_POST['filtropalavrachave']) ? $_POST['filtropalavrachave'] : '%';

			$this->denunciasModel->setNumero($filtroNCD);
			
			$this->denunciasModel->setSituacao($filtroSituacao);
			
			$this->denunciasModel->setResponsavel($filtroResponsavel);
			
			$this->denunciasModel->setUnidadeApuracao($filtroUnidade);
			
			$this->denunciasModel->setAssunto($filtroAssunto);
			
			$this->denunciasModel->setMunicipio($filtroMunicipio);
			
			$this->denunciasModel->setDataRegistro($filtroPeriodo);
			
			$this->denunciasModel->setRestrito($filtroRestrito);
			
			$this->denunciasModel->setStatus($filtroAnalise);
			
			$this->denunciasModel->setIDPalavraChave($filtroPalavraChave);
		
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
		
		$this->denunciasModel->modificarParaEmTriagem();
		
		$_REQUEST['LISTA_SERVIDORES'] = $this->servidoresModel->getServidores();
		
		$_REQUEST['LISTA_UNIDADES_APURACAO'] = $this->orgaosModel->getUnidadesApuracao();
		
		$_REQUEST['LISTA_ANEXOS'] = $this->denunciasModel->getAnexos();
		
		$_REQUEST['LISTA_PALAVRAS_CHAVE'] = $this->denunciasModel->getPalavrasChave();
		
		$listaDados = $_REQUEST['DADOS_DENUNCIA'] = $this->denunciasModel->getDadosID();
		
		$this->denunciasView->setTitulo('DENÚNCIAS > '.$listaDados['DS_NUMERO_PROCESSO_SEI'] . ' - ' . $listaDados['NOME_MACRO_ASSUNTO'] .' > TRIAGEM');
		
		$this->denunciasView->setConteudo('triagem');
		
		$this->denunciasView->carregar();
	}
	
	public function carregarAndamento(){
		
		$this->denunciasModel->setID($_GET['id']);
		
		$_REQUEST['LISTA_UNIDADES_APURACAO'] = $this->orgaosModel->getUnidadesApuracao();
		
		$_REQUEST['DADOS_DENUNCIA'] = $listaDados = $this->denunciasModel->getDadosID();
		
		$this->denunciasView->setTitulo('DENÚNCIAS > '.$listaDados['DS_NUMERO_PROCESSO_SEI'] . ' - ' . $listaDados['NOME_MACRO_ASSUNTO'] .' > ANDAMENTO');
		
		$this->denunciasView->setConteudo('andamento');
		
		$this->denunciasView->carregar();
	}
	
	public function triagem(){
		
		$id = $_GET['id'];

		$restrito = $_POST['restrito'];
		$responsavel = $_POST['responsavel'];
		$relevancia = $_POST['relevancia'];
		$termino = $_POST['termino'];
		$andamento = $_POST['andamento'];
		$situacao = $_POST['situacao'];
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
		$this->denunciasModel->setAndamento($andamento);
		$this->denunciasModel->setSituacao($situacao);
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
	
	public function andamento(){
		
		$id = $_GET['id'];
		
		$status = $_POST['status'];
		$comentario = $_POST['comentario'];
		$anexo = $_FILES['anexo'];
		$nomesTrilha = (isset($_POST['nomes'])) ? $_POST['nomes'] : NULL;
		$gerarAlerta = (isset($_POST['gerarAlertas'])) ? $_POST['gerarAlertas'] : NULL;
		$unidadesTrilha = (isset($_POST['unidades'])) ? $_POST['unidades'] : NULL;
		$periodicidadesTrilha = (isset($_POST['periodicidades'])) ? $_POST['periodicidades'] : NULL;	
		$agrupadores = (isset($_POST['agrupadores'])) ? $_POST['agrupadores'] : NULL;	
		$tiposAlertas = (isset($_POST['tiposAlertas'])) ? $_POST['tiposAlertas'] : NULL;	
		$emailsAlertas = (isset($_POST['emails'])) ? $_POST['emails'] : NULL;	
		
		$this->denunciasModel->setStatus($status);
		$this->denunciasModel->setComentarios($comentario);
		$this->denunciasModel->setAnexos($anexo);
		$this->denunciasModel->setTipos('STATUS DA DENUNCIA');
		$this->denunciasModel->setDatas(NULL);
		$this->denunciasModel->setNomesTrilha($nomesTrilha);
		$this->denunciasModel->setGerarAlertas($gerarAlerta);
		$this->denunciasModel->setUnidadesTrilha($unidadesTrilha);
		$this->denunciasModel->setPeriodicidadesTrilha($periodicidadesTrilha);
		$this->denunciasModel->setAgrupadores($agrupadores);
		$this->denunciasModel->setTiposAlertas($tiposAlertas);
		$this->denunciasModel->setEmailsAlertas($emailsAlertas);
		
		$this->denunciasModel->setID($id);
		
		$_SESSION['RESULTADO_OPERACAO'] = $this->denunciasModel->andamento();
		
		$_SESSION['MENSAGEM'] = $this->denunciasModel->getMensagemResposta();
		
		if($_SESSION['RESULTADO_OPERACAO']){
			Header('Location: /denuncias/listar/0');
		}else{
			Header("Location: /denuncias/andamento/$id");
		}
		
	}
	
	
	public function cadastrar(){
		
		$tipo         =  $_POST['tipo'];
		$nome         =  empty($_POST['nome']) ? 'NULL' : $_POST['nome'];
		$CPF          =  empty($_POST['CPF']) ? 'NULL' : $_POST['CPF'];;
		$email        =  empty($_POST['email']) ? 'NULL' : $_POST['email'];
		$telefone     =  empty($_POST['telefone']) ? 'NULL' : $_POST['telefone'];;
		$assunto      =  $_POST['assunto'];
		$descricao    =  $_POST['descricao'];
		$orgao        =  empty($_POST['orgao']) ? 'NULL' : $_POST['orgao'];
		$municipio    =  empty($_POST['municipio']) ? 'NULL' : $_POST['municipio'];
		$envolvidos   =  empty($_POST['envolvidos']) ? 'NULL' : $_POST['envolvidos'];
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
		$this->denunciasModel->setDataRegistroEOUV($dataRegistro);
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
				$nome         =  empty($_POST['nome']) ? 'NULL' : $_POST['nome'];
				$CPF          =  empty($_POST['CPF']) ? 'NULL' : $_POST['CPF'];;
				$email        =  empty($_POST['email']) ? 'NULL' : $_POST['email'];
				$telefone     =  empty($_POST['telefone']) ? 'NULL' : $_POST['telefone'];;
				$assunto      =  $_POST['assunto'];
				$descricao    =  $_POST['descricao'];
				$orgao        =  empty($_POST['orgao']) ? 'NULL' : $_POST['orgao'];
				$municipio    =  empty($_POST['municipio']) ? 'NULL' : $_POST['municipio'];
				$envolvidos   =  empty($_POST['envolvidos']) ? 'NULL' : $_POST['envolvidos'];
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
				$this->denunciasModel->setDataRegistroEOUV($dataRegistro);
				$this->denunciasModel->setProcesso($processo);
				
				$_SESSION['RESULTADO_OPERACAO'] = $this->denunciasModel->editar();
						
				break;
				
			case 'concluir':
			
				$_SESSION['RESULTADO_OPERACAO'] = $this->denunciasModel->concluirTriagem();
						
				break;
				
			case 'remover-anexo':
			
				$idAnexo = $_GET['idAnexo'];
				
				$nomeAnexo = $_GET['nomeAnexo'];
				
				$this->denunciasModel->setIDAnexo($idAnexo);
				
				$this->denunciasModel->setNomeAnexo($nomeAnexo);				
			
				$_SESSION['RESULTADO_OPERACAO'] = $this->denunciasModel->removerAnexo();
				
				break;
				
			case 'remover-palavra-chave':
							
				$idPalavraChave = $_GET['idPalavra'];
				
				$this->denunciasModel->setIDPalavraChave($idPalavraChave);
			
				$_SESSION['RESULTADO_OPERACAO'] = $this->denunciasModel->removerPalavraChave();
				
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