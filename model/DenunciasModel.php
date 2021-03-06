<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/model/Model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/phpmailer/PHPMailer.php';

class DenunciasModel extends Model{

	private $servidor;
	private $tipo;
	private $nome;
	private $CPF;
	private $email;
	private $telefone;
	private $assunto;
	private $descricao;
	private $municipio;
	private $orgao;
	private $envolvidos;
	private $dataRegistro;
	private $dataRegistroInicio;
	private $dataRegistroFim;
	private $dataRegistroEOUV;
	private $processo;
	private $protocolo;
	private $numero;
	
	private $restrito;
	private $responsavel;
	private $relevancia;
	private $termino;
	private $situacao;
	private $andamento;
	private $unidadeApuracao;
	
	private $anexos;
	private $tipos;
	private $comentarios;
	private $datas;
	private $palavras;
	
	private $idAnexo;
	private $nomeAnexo;
	
	private $idPalavraChave;

	private $nomesTrilha;
	private $gerarAlertas;
	private $unidadesTrilha;
	private $periodicidadesTrilha;
	
	
	public function setProtocolo($protocolo){
		$this->protocolo = $protocolo;
		
	}
	
	public function setAndamento($andamento){
		$this->andamento = $andamento;
		
	}
	
	public function setTiposAlertas($tiposAlertas){
		$this->tiposAlertas = $tiposAlertas;
		
	}
	
	public function setEmailsAlertas($emailsAlertas){
		$this->emailsAlertas = $emailsAlertas;
		
	}
	
	public function setStatus($status){
		$this->status = $status;
		
	}
	
	public function setGerarAlertas($gerarAlertas){
		$this->gerarAlertas = $gerarAlertas;
		
	}
	
	public function setNomesTrilha($nomesTrilha){
		$this->nomesTrilha = $nomesTrilha;
		
	}
		
	public function setUnidadesTrilha($unidadesTrilha){
		$this->unidadesTrilha = $unidadesTrilha;
		
	}
	
	public function setPeriodicidadesTrilha($periodicidadesTrilha){
		$this->periodicidadesTrilha = $periodicidadesTrilha;
		
	}
	
	public function setIDPalavraChave($idPalavraChave){
		$this->idPalavraChave = $idPalavraChave;
		
	}
	
	public function setIDAnexo($idAnexo){
		$this->idAnexo = $idAnexo;
		
	}
	
	public function setNomeAnexo($nomeAnexo){
		$this->nomeAnexo = $nomeAnexo;
		
	}
	
	public function setUnidadeApuracao($unidadeApuracao){
		$this->unidadeApuracao = $unidadeApuracao;
		
	}
	
	public function setRestrito($restrito){
		$this->restrito = $restrito;
		
	}
	
	public function setResponsavel($responsavel){
		$this->responsavel = $responsavel;
		
	}
	
	public function setRelevancia($relevancia){
		$this->relevancia = $relevancia;
		
	}
	
	public function setTermino($termino){
		$this->termino = $termino;
		
	}
	
	public function setSituacao($situacao){
		$this->situacao = $situacao;
		
	}
	
	public function setAnexos($anexos){		
		$this->anexos = $anexos;
		
	}
	
	public function setTipos($tipos){
		$this->tipos = $tipos;
		
	}
	
	public function setComentarios($comentarios){
		$this->comentarios = $comentarios;
		
	}
	
	public function setDatas($datas){
		$this->datas = $datas;
		
	}
	
	public function setPalavras($palavras){
		$this->palavras = $palavras;
		
	}
	
	public function setServidor($servidor){
		$this->servidor = $servidor;
	}
	
	public function setTipo($tipo){
		$this->tipo = $tipo;
	}
	
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function setCPF($CPF){
		$this->CPF = $CPF;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}
	
	public function setAssunto($assunto){
		$this->assunto = $assunto;
	}
	
	public function setDescricao($descricao){
		$this->descricao = addslashes($descricao);
	}
	
	public function setMunicipio($municipio){
		$this->municipio = $municipio;
	}
	
	public function setOrgao($orgao){
		$this->orgao = $orgao;
	}
	
	public function setEnvolvidos($envolvidos){
		$this->envolvidos = $envolvidos;
	}
	
	public function setDataRegistro($dataRegistro){
		$this->dataRegistro = $dataRegistro;
	}
	
	public function setDataRegistroInicio($dataRegistroInicio){
		$this->dataRegistroInicio = $dataRegistroInicio;
	}
	
	public function setDataRegistroFim($dataRegistroFim){
		$this->dataRegistroFim = $dataRegistroFim;
	}
	
	public function setDataRegistroEOUV($dataRegistroEOUV){
		$this->dataRegistroEOUV = $dataRegistroEOUV;
	}
	
	public function setProcesso($processo){
		$this->processo = $processo;
	}
	
	public function setNumero($numero){
		$this->numero = $numero;
	}
	
	public function cadastrar(){
		
		$registro = date('Y-m-d');
		
		$query = "
		
		INSERT INTO tb_denuncias 
		
		(DS_TIPO, ID_SERVIDOR, ID_ASSUNTO, DS_NOME_DENUNCIANTE, DS_CPF_DENUNCIANTE, DS_EMAIL_DENUNCIANTE, DS_TELEFONE_DENUNCIANTE, TX_DESCRICAO_FATO, ID_ORGAO_DENUNCIADO, ID_MUNICIPIO_FATO, DS_ENVOLVIDOS, DT_REGISTRO_EOUV, DT_REGISTRO, DS_PROTOCOLO_EOUV, DS_NUMERO_PROCESSO_SEI) 
		
		
		VALUES 
		
		
		('$this->tipo', ".$_SESSION['ID'].", $this->assunto, NULLIF('$this->nome', 'NULL'), NULLIF('$this->CPF', 'NULL'), NULLIF('$this->email', 'NULL'), NULLIF('$this->telefone', 'NULL'), '$this->descricao', $this->orgao, $this->municipio, NULLIF('$this->envolvidos', 'NULL'), '$this->dataRegistroEOUV', '$registro', '$this->protocolo', '$this->processo')
			
		";
		
		$id = $this->executarQueryID($query);
		
		$dataSemTraco = str_replace('-','', $this->dataRegistroEOUV);
		
		$numeroProvisorio = $id . "/" . $dataSemTraco . "-T";
		
		$query = "UPDATE tb_denuncias SET DS_NUMERO = '$numeroProvisorio' WHERE ID = $id";
		
		$this->setID($id);
		
		$this->cadastrarHistorico('CADASTRO', 'EFETUOU O CADASTRO');
		
		if($this->anexos != NULL){
	
			$this->cadastrarAnexos();
			
		}
		
		$resultado = $this->executarQuery($query);
		
		return $resultado;
		
	}
	
	public function triagem(){
		
		$textoMudanca = 'Foram alterados os dados: ';
		
		$query = "SELECT * FROM tb_denuncias WHERE ID=$this->id";
		
		$lista = $this->executarQueryListaID($query);
		
		$textoMudanca .= ($lista['BL_ACESSO_RESTRITO'] == $this->restrito) ? '' : ' Acesso restrito;';
		$textoMudanca .= ($lista['ID_RESPONSAVEL_TRIAGEM'] == $this->responsavel) ? '' : ' Responsável pela triagem;';
		$textoMudanca .= ($lista['DS_RELEVANCIA'] == $this->relevancia) ? '' : ' Relevância;';
		$textoMudanca .= ($lista['DT_TERMINO_TRIAGEM'] == $this->termino) ? '' : ' Data de término da triagem;';
		$textoMudanca .= ($lista['DS_ANDAMENTO'] == $this->andamento) ? '' : ' Andamento;';
		$textoMudanca .= ($lista['DS_SITUACAO'] == $this->situacao) ? '' : ' Situação;';
		$textoMudanca .= ($lista['ID_UNIDADE_APURACAO'] == $this->unidadeApuracao) ? '' : ' Unidade de apuração;';
		
		$query = "UPDATE tb_denuncias SET BL_ACESSO_RESTRITO = $this->restrito, ID_RESPONSAVEL_TRIAGEM = $this->responsavel, DS_RELEVANCIA = nullif('$this->relevancia',''), DT_TERMINO_TRIAGEM = nullif('$this->termino',''), DS_ANDAMENTO = '$this->andamento', DS_SITUACAO = '$this->situacao', ID_UNIDADE_APURACAO = $this->unidadeApuracao WHERE ID = $this->id";
		
		//echo $query; exit;
		
		$resultado = $this->executarQuery($query);
		
		if($this->anexos != NULL){
	
			$this->cadastrarAnexos();
			
			$textoMudanca .= ' Adicionou anexos;';
			
		}
		
		if($this->palavras != NULL){
			
			foreach($this->palavras as $palavra){
				
				$query = "INSERT INTO tb_palavras_chave_denuncia (ID_DENUNCIA, DS_PALAVRA_CHAVE) VALUES ($this->id, '$palavra')";
				
				$this->executarQuery($query);				
			}
			
			$textoMudanca .= ' Adicionou palavras-chave;';		
			
		}
		
		$this->cadastrarHistorico('SALVAMENTO DE TRIAGEM',"SALVOU A TRIAGEM. $textoMudanca");
		
		return $resultado;
		
	}
	
	public function getTriagensPrazoExpirado(){
		
		$query = "
		
		SELECT a.*,

		b.DS_NOME_MACRO NOME_MACRO, b.DS_NOME_MICRO NOME_MICRO
		
		FROM tb_denuncias a
		
		INNER JOIN tb_assuntos_denuncia b ON a.ID_ASSUNTO = b.ID
		
		WHERE DT_TERMINO_TRIAGEM IS NOT NULL 
		
		AND DT_TERMINO_TRIAGEM < NOW() 
		
		AND ID_RESPONSAVEL_TRIAGEM = ".$_SESSION['ID']."
		
		AND BL_TRIAGEM_CONCLUIDA = 0
		
		";
		
		$lista = $this->executarQueryLista($query);
		
		return $lista;

	}
	
	public function andamento(){
		
		$textoMensagem = 'DEU ANDAMENTO A DENÚNCIA.';
		
		$query = "UPDATE tb_denuncias SET DS_STATUS = '$this->status' WHERE ID = $this->id";
		
		$resultado = $this->executarQuery($query);
		
		if($this->anexos != NULL){
		
			$resultado = $this->cadastrarAnexos();
			
			$textoMensagem .= ' Foram adicionados anexos.';
			
		}
		
		if($this->nomesTrilha != NULL){
		
			for($key = 0; $key < sizeof($this->nomesTrilha); $key++){
			
				$nomeTrilha = $this->nomesTrilha[$key];
				
				$gerarAlerta = $this->gerarAlertas[$key];
						
				$unidadeTrilha = $this->unidadesTrilha[$key];
				
				$periodicidadeTrilha = $this->periodicidadesTrilha[$key];
			
				$query = "INSERT INTO tb_trilhas (ID_DENUNCIA, DS_NOME, BL_ALERTA, ID_UNIDADE_APURACAO, NR_PERIODICIDADE, DT_ALERTA) VALUES ($this->id, '$nomeTrilha', '$gerarAlerta', $unidadeTrilha, '$periodicidadeTrilha', CURDATE()+$periodicidadeTrilha)";
				
				$this->executarQuery($query);
			
			}
			
			$textoMensagem .= ' Foram adicionadas trilhas.';
	
		}
		
		$this->cadastrarHistorico('ANDAMENTO', $textoMensagem);
	
		return $resultado;
					
	}
	
	public function cadastrarAnexos(){
		
		$data = date('Y-m-d');
		
		foreach($this->anexos['error'] as $key => $error){
				
			$nomeAnexo = $this->retiraCaracteresEspeciais($this->anexos['name'][$key]);	
				
			$caminho = $_SERVER['DOCUMENT_ROOT'].'/_registros/anexos/';
		
			if(file_exists($caminho.$nomeAnexo)){ 
				$a = 1;
				while(file_exists($caminho."[$a]".$nomeAnexo."")){
				$a++;
				}
				$nomeAnexo = "[".$a."]".$nomeAnexo;
			}
			
			move_uploaded_file($this->anexos['tmp_name'][$key], $caminho.$nomeAnexo);
			
			$tipo = (is_array($this->tipos)) ? $this->tipos[$key] : $this->tipos;
					
			$comentario = ($this->comentarios[$key] == '') ? '' : addslashes($this->comentarios[$key]);
						
			$dataEOUV = $this->datas[$key];
			
			$query = "INSERT INTO tb_anexos (ID_DENUNCIA, DS_TIPO, DS_COMENTARIOS, DT_RECEBIMENTO_EOUV, DT_RECEBIMENTO_SISTEMA, NM_ARQUIVO) VALUES ('$this->id','$tipo','$comentario','$dataEOUV', '$data','$nomeAnexo')";
			
			$resultado = $this->executarQuery($query);
			
		}		
		
	}
	
	public function editar(){
		
		$textoMudanca = 'Foram alterados os dados: ';
		
		$query = "SELECT * FROM tb_denuncias WHERE ID=$this->id";
		
		$lista = $this->executarQueryListaID($query);
		
		$textoMudanca .= ($lista['DS_TIPO'] == $this->tipo) ? '' : ' Tipo da denúncia;';
		$textoMudanca .= ($lista['ID_ASSUNTO'] == $this->assunto) ? '' : ' Assunto da denúncia;';
		if($this->nome != 'NULL'){
			$textoMudanca .= ($lista['DS_NOME_DENUNCIANTE'] == $this->nome) ? '' : ' Nome do denunciante;';
		}
		if($this->CPF != 'NULL'){
			$textoMudanca .= ($lista['DS_CPF_DENUNCIANTE'] == $this->CPF) ? '' : ' CPF do denunciante;';
		}
		if($this->telefone != 'NULL'){
			$textoMudanca .= ($lista['DS_TELEFONE_DENUNCIANTE'] == $this->telefone) ? '' : ' Telefone do denunciante;';
		}
		if($this->email != 'NULL'){
			$textoMudanca .= ($lista['DS_EMAIL_DENUNCIANTE'] == $this->email) ? '' : ' E-mail do denunciante;';
		}
		$textoMudanca .= ($lista['TX_DESCRICAO_FATO'] == $this->descricao) ? '' : ' Texto de descrição da denúncia;';
		$textoMudanca .= ($lista['ID_ORGAO_DENUNCIADO'] == $this->orgao) ? '' : ' Órgão denunciado;';
		$textoMudanca .= ($lista['ID_MUNICIPIO_FATO'] == $this->municipio) ? '' : ' Município fato;';
		if($this->envolvidos != 'NULL'){
			$textoMudanca .= ($lista['DS_ENVOLVIDOS'] == $this->envolvidos) ? '' : ' Envolvidos;';
		}
		$textoMudanca .= ($lista['DT_REGISTRO_EOUV'] == $this->dataRegistroEOUV) ? '' : ' Data do registro no EOUV;';
		$textoMudanca .= ($lista['DS_PROTOCOLO_EOUV'] == $this->protocolo) ? '' : ' Protocolo vinculado ao EOUV;';
		$textoMudanca .= ($lista['DS_NUMERO_PROCESSO_SEI'] == $this->processo) ? '' : ' Número do processo no SEI;';
	
		$query = "UPDATE tb_denuncias SET DS_TIPO = '$this->tipo', ID_ASSUNTO = $this->assunto , DS_NOME_DENUNCIANTE = NULLIF('$this->nome', 'NULL'), DS_CPF_DENUNCIANTE = NULLIF('$this->CPF', 'NULL'), DS_TELEFONE_DENUNCIANTE = NULLIF('$this->telefone', 'NULL'), DS_EMAIL_DENUNCIANTE = NULLIF('$this->email', 'NULL'), TX_DESCRICAO_FATO = '$this->descricao' , ID_ORGAO_DENUNCIADO = $this->orgao, ID_MUNICIPIO_FATO = $this->municipio , DS_ENVOLVIDOS = NULLIF('$this->envolvidos', 'NULL'), DT_REGISTRO_EOUV = '$this->dataRegistroEOUV',  DS_PROTOCOLO_EOUV='$this->protocolo', DS_NUMERO_PROCESSO_SEI = '$this->processo' WHERE ID = $this->id";

		$resultado = $this->executarQuery($query);
		
		$this->cadastrarHistorico('EDIÇÃO',"EDITOU A DENÚNCIA. $textoMudanca");
		
		if($this->anexos != NULL){
	
			$this->cadastrarAnexos();
			
			$textoMudanca .= ' Adicionou anexos;';
			
		}
	
		return $resultado;

	}
	
	public function excluir(){
		
		$this->excluirArquivo('anexos', $this->anexo);
		
		$resultado = parent::excluir();
		
		return $resultado;

	}
	
	public function getDadosID(){
		
		$query = "
		
		SELECT 
		
		a.*,
		
		b.DS_NOME_MACRO NOME_MACRO_ASSUNTO, b.DS_NOME_MICRO NOME_MICRO_ASSUNTO,
		
		c.DS_ABREVIACAO ABREVIACAO_ORGAO, c.DS_NOME NOME_ORGAO,
		
		d.DS_NOME NOME_MUNICIPIO,
		
		e.DS_NOME NOME_RESPONSAVEL_TRIAGEM, 
		
		f.DS_ABREVIACAO ABREVIACAO_UNIDADE, f.DS_NOME NOME_UNIDADE,
		
		g.DS_NOME SERVIDOR_CADASTROU,
		
		h.DS_ABREVIACAO NOME_ORGAO_UNIDADE
		
		FROM tb_denuncias a
		
		INNER JOIN tb_assuntos_denuncia b ON a.ID_ASSUNTO = b.ID 
		
		LEFT JOIN tb_orgaos c ON a.ID_ORGAO_DENUNCIADO = c.ID
		
		LEFT JOIN tb_municipios d ON a.ID_MUNICIPIO_FATO = d.ID 
		
		LEFT JOIN tb_servidores e ON a.ID_RESPONSAVEL_TRIAGEM = e.ID 
		
		LEFT JOIN tb_unidades_apuracao f ON a.ID_UNIDADE_APURACAO = f.ID
		
		INNER JOIN tb_servidores g ON a.ID_SERVIDOR = g.ID 
		
		LEFT JOIN tb_orgaos h ON f.ID_ORGAO = h.ID

		WHERE a.ID = $this->id
		
		";
				
		$lista = $this->executarQueryListaID($query);
		
		return $lista;
		
	}
	
	public function getAnexos(){
		
		$query = "SELECT * FROM tb_anexos WHERE ID_DENUNCIA = $this->id";
		
		$listaAnexos = $this->executarQueryLista($query);
		
		return $listaAnexos;
		
	}
	
	public function getTrilhas(){
		
		$query = "
		
		SELECT a.*,

		b.DS_NOME NOME_UNIDADE
		
		FROM tb_trilhas a
		
		INNER JOIN tb_unidades_apuracao b ON a.ID_UNIDADE_APURACAO = b.ID
		
		WHERE ID_DENUNCIA = $this->id";
		
		$listaTrilhas = $this->executarQueryLista($query);
		
		return $listaTrilhas;
		
	}
	
	public function encerrar(){
		
		$query = "UPDATE tb_denuncias SET DS_STATUS = 'ENCERRADA' WHERE ID = $this->id";
		
		$resultado = $this->executarQuery($query);
		
		$this->cadastrarHistorico('ENCERRAMENTO','ENCERROU A DENÚNCIA');
		
		return $resultado;
		
	}


	public function getPalavrasChave(){
		
		$query = "SELECT * FROM tb_palavras_chave_denuncia WHERE ID_DENUNCIA = $this->id";
		
		$listaPalavrasChave = $this->executarQueryLista($query);
		
		return $listaPalavrasChave;
		
	}
	
	public function removerAnexo(){
		
		$query = "DELETE FROM tb_anexos WHERE ID = $this->idAnexo";
		
		$resultado = $this->executarQuery($query);
		
		$this->excluirArquivo('anexos', $this->nomeAnexo);
		
		$this->cadastrarHistorico('REMOÇÃO DE ANEXO','REMOVEU UM ANEXO');
		
		return $resultado;
			
	}
	
	public function removerPalavraChave(){
		
		$query = "DELETE FROM tb_palavras_chave_denuncia WHERE ID = $this->idPalavraChave";
		
		$resultado = $this->executarQuery($query);
		
		$this->cadastrarHistorico('REMOÇÃO DE PALAVRA-CHAVE','REMOVEU UMA PALAVRA-CHAVE');
		
		return $resultado;
			
	}

	public function getDenuncias(){
		
		$unidade = $_SESSION['UNIDADE'];
		
		$restricaoUsuario = ($_SESSION['TIPO'] == 'UNIDADE DE APURAÇÃO') ? "AND (a.ID_UNIDADE_APURACAO = $unidade)" : '';
		
		$query = 
		
			"SELECT 
			
			a.*,
			
			b.DS_NOME_MACRO, b.DS_NOME_MICRO, 
			
			c.DS_ABREVIACAO NOME_ORGAO_DENUNCIADO,
			
			d.DS_NOME NOME_SERVIDOR,
			
			e.DS_NOME NOME_MUNICIPIO
			
			FROM  tb_denuncias a
			
			INNER JOIN tb_assuntos_denuncia b ON a.ID_ASSUNTO = b.ID 
			
			LEFT JOIN tb_orgaos c ON a.ID_ORGAO_DENUNCIADO = c.ID 
			
			INNER JOIN tb_servidores d ON a.ID_SERVIDOR = d.ID 
			
			LEFT JOIN tb_municipios e ON a.ID_MUNICIPIO_FATO = e.ID 
			
			WHERE DS_STATUS != 'ENCERRADA'
			
			$restricaoUsuario
			
			ORDER BY a.DT_REGISTRO_EOUV desc
			
			";
		
		$lista = $this->executarQueryLista($query);
		
		return $lista;
		
	}
	
	public function getDenunciasComFiltro(){
		
		$situacao = ($this->situacao == '%') ? '' : "AND (DS_SITUACAO = '$this->situacao')" ;
		
		$responsavel = ($this->responsavel == '%') ? '' : "AND (ID_RESPONSAVEL_TRIAGEM = $this->responsavel)" ;
		
		$unidade = ($this->unidadeApuracao == '%') ? '' : "AND (a.ID_UNIDADE_APURACAO = $this->unidadeApuracao)" ;
		
		$assunto = ($this->assunto == '%') ? '' : "AND (ID_ASSUNTO = $this->assunto)" ;
		
		$municipio = ($this->municipio == '%') ? '' : "AND (ID_MUNICIPIO_FATO = $this->municipio)" ;
		
		$periodoInicio = ($this->dataRegistroInicio == '%') ? '' : "AND (DT_REGISTRO >= '$this->dataRegistroInicio')" ;
		
		$periodoFim = ($this->dataRegistroFim == '%') ? '' : "AND (DT_REGISTRO <= '$this->dataRegistroFim')" ;
		
		$restrito = ($this->restrito == '%') ? '' : "AND (BL_ACESSO_RESTRITO = $this->restrito)" ;
		
		$analise = ($this->status == '%') ? '' : "AND (DS_STATUS = '$this->status')";
		
		$unidadeUsuario = $_SESSION['UNIDADE'];
		
		$restricaoUsuario = ($_SESSION['TIPO'] == 'UNIDADE DE APURAÇÃO') ? " AND a.ID_UNIDADE_APURACAO = $unidadeUsuario" : '';
		
		if($this->idPalavraChave == '%' or $this->idPalavraChave == ''){
			
			$palavras = '';
			
		}else{
			
			$palavrasChave = explode(',', $this->idPalavraChave);
			
			$palavras = "AND a.ID IN (SELECT ID_DENUNCIA FROM tb_palavras_chave_denuncia WHERE DS_PALAVRA_CHAVE IN (";
			
			for($i=0; $i < count($palavrasChave); $i++){
			
				$palavras .= "'$palavrasChave[$i]',";
			
			}

			$palavras .= ')';
			
			$palavras = str_replace(',)', ')', $palavras);
			
			$palavras .= ')';
			
		}
		
		$trilha = ($this->nomesTrilha == '%' or $this->nomesTrilha == '') ? '' : "AND a.ID IN (SELECT ID_DENUNCIA FROM tb_trilhas WHERE DS_NOME LIKE '%$this->nomesTrilha%')";
		
		
		$query = 
		
		"SELECT 
		
		a.*,
		
		b.DS_NOME_MACRO, b.DS_NOME_MICRO, 
		
		c.DS_ABREVIACAO NOME_ORGAO_DENUNCIADO,
		
		e.DS_NOME NOME_MUNICIPIO
		
		FROM  tb_denuncias a
		
		INNER JOIN tb_assuntos_denuncia b ON a.ID_ASSUNTO = b.ID 
		
		LEFT JOIN tb_orgaos c ON a.ID_ORGAO_DENUNCIADO = c.ID 
		
		LEFT JOIN tb_municipios e ON a.ID_MUNICIPIO_FATO = e.ID 
		
		WHERE DS_NUMERO LIKE '%$this->numero%'
		
		$restricaoUsuario
		
		$situacao
		
		$responsavel
	   
    	$unidade
	
		$assunto
		
		$municipio
		
		$periodoInicio 
		
		$periodoFim 
		
		$restrito
		
		$analise
		
		$palavras
		
		$trilha
		
		ORDER BY a.DT_REGISTRO_EOUV desc
		
		";
		
		$lista = $this->executarQueryLista($query);
		
		return $lista;
		
	}
	
	public function concluirTriagem(){
		
		$query = "SELECT DS_SITUACAO FROM tb_denuncias WHERE ID = $this->id";
		
		$resultado = $this->executarQueryRegistro($query);
		
		$modificarNumeroDenuncia = ($resultado == 'APTA') ? ", DS_NUMERO = REPLACE(DS_NUMERO,'-T','')" : '';
		
		$query = "UPDATE tb_denuncias SET BL_TRIAGEM_CONCLUIDA = 1 $modificarNumeroDenuncia WHERE ID = $this->id";
		
		$resultado = $this->executarQuery($query);
		
		$this->cadastrarHistorico('CONCLUSÃO DE TRIAGEM','CONCLUIU A TRIAGEM');
		
		$query = "SELECT 
		
		a.DS_TIPO, a.ID_UNIDADE_APURACAO,

		b.DS_NOME_MACRO as NOME_ASSUNTO_MACRO, b.DS_NOME_MICRO as NOME_ASSUNTO_MICRO
		
		FROM tb_denuncias a

        INNER JOIN tb_assuntos_denuncia b ON a.ID_ASSUNTO = b.ID		
		
		WHERE a.ID = $this->id";
		
		$denuncia = $this->executarQueryListaID($query);
		
		$tipo = $denuncia['DS_TIPO'];
		
		$unidadeApuracao = $denuncia['ID_UNIDADE_APURACAO'];
		
		$assunto = $denuncia['NOME_ASSUNTO_MACRO'] . ' - ' . $denuncia['NOME_ASSUNTO_MICRO'];
		
		$query = "SELECT DS_NOME, DS_EMAIL FROM tb_servidores WHERE ID_UNIDADE_APURACAO = $unidadeApuracao";
		
		$listaServidores = $this->executarQueryLista($query);
		
		$mensagem = ", foi encaminhada uma denúncia para a sua unidade de apuração do tipo $tipo com o assunto $assunto. Verifique o sistema Banco de Denúncias para ver mais detalhes.";
		
		foreach($listaServidores as $servidor){
			
			mail($servidor['DS_EMAIL'], utf8_decode('Uma denúncia foi encaminhada'), $servidor['DS_NOME'].utf8_decode($mensagem));
			
		}

		return $resultado;
	
	}
	
	public function getQuantidadeTotalDenuncias(){
		
		$restricaoUsuario = 
		($_SESSION['TIPO'] != 'UNIDADE DE APURAÇÃO') ? '' : 'WHERE ID_UNIDADE_APURACAO = ' . $_SESSION['UNIDADE'];
		
		$query = "SELECT COUNT(ID) FROM tb_denuncias $restricaoUsuario";

		$quantidade = $this->executarQueryRegistro($query);
		
		return $quantidade;
		
	}
	
	public function getQuantidadeDenunciasTipo($tipo){
		
		$restricaoUsuario = 
		($_SESSION['TIPO'] != 'UNIDADE DE APURAÇÃO') ? '' : 'AND ID_UNIDADE_APURACAO = ' . $_SESSION['UNIDADE'];
		
		$query = "SELECT COUNT(ID) FROM tb_denuncias WHERE DS_TIPO ='$tipo' $restricaoUsuario";
		
		$quantidade = $this->executarQueryRegistro($query);
		
		return $quantidade;
		
	}

	
	public function getQuantidadeDenunciasMunicipio(){
		
		$restricaoUsuario = 
		($_SESSION['TIPO'] != 'UNIDADE DE APURAÇÃO') ? '' : 'AND ID_UNIDADE_APURACAO = ' . $_SESSION['UNIDADE'];
		
		$query = "
		
		SELECT 
		
		c.ID,
		c.DS_NOME NOME_MUNICIPIO,
		COUNT(*) QUANTIDADE
		
		FROM tb_denuncias a
		
		LEFT JOIN tb_municipios c ON a.ID_MUNICIPIO_FATO = c.ID
		
		WHERE ID_MUNICIPIO_FATO IS NOT NULL
		
		$restricaoUsuario
		
		GROUP BY c.ID
		
		ORDER BY QUANTIDADE DESC

		";
		
		$listaDados = $this->executarQueryLista($query);
		
		return $listaDados;
		
	}
	
	public function getQuantidadeDenunciasOrgao(){
		
		$restricaoUsuario = 
		($_SESSION['TIPO'] != 'UNIDADE DE APURAÇÃO') ? '' : 'AND ID_UNIDADE_APURACAO = ' . $_SESSION['UNIDADE'];
		
		$query = "
		
		SELECT 
		
		c.ID,
		c.DS_ABREVIACAO NOME_ORGAO,
		COUNT(*) QUANTIDADE
		
		FROM tb_denuncias a
		
		LEFT JOIN tb_orgaos c ON a.ID_ORGAO_DENUNCIADO = c.ID
		
		WHERE ID_ORGAO_DENUNCIADO IS NOT NULL
		
		$restricaoUsuario
		
		GROUP BY c.ID
		
		ORDER BY QUANTIDADE DESC

		";
		
		$listaDados = $this->executarQueryLista($query);
		
		return $listaDados;
		
	}
	
	public function getQuantidadeDenunciasUnidade(){
		
		$restricaoUsuario = 
		($_SESSION['TIPO'] != 'UNIDADE DE APURAÇÃO') ? '' : 'AND ID_UNIDADE_APURACAO = ' . $_SESSION['UNIDADE'];
		
		$query = "
		
		SELECT 
		
		c.ID,
		c.DS_NOME NOME_UNIDADE,
		COUNT(*) QUANTIDADE
		
		FROM tb_denuncias a
		
		LEFT JOIN tb_unidades_apuracao c ON a.ID_UNIDADE_APURACAO = c.ID
		
		WHERE ID_UNIDADE_APURACAO IS NOT NULL
		
		$restricaoUsuario
		
		GROUP BY c.ID
		
		ORDER BY QUANTIDADE DESC

		";
		
		$listaDados = $this->executarQueryLista($query);
		
		return $listaDados;
		
	}
	
	public function getQuantidadeTriagensDentroPrazo(){
		
		$restricaoUsuario = 
		($_SESSION['TIPO'] != 'UNIDADE DE APURAÇÃO') ? '' : 'AND ID_UNIDADE_APURACAO = ' . $_SESSION['UNIDADE'];
		
		$query = "
		
		SELECT COUNT(*) QUANTIDADE FROM tb_denuncias 
		
		WHERE DT_TERMINO_TRIAGEM IS NOT NULL
		
		$restricaoUsuario
		
		AND DT_TERMINO_TRIAGEM >= NOW()
		
		AND DS_STATUS != 'ENCERRADA'
		
		";
		
		$quantidade = $this->executarQueryRegistro($query);
		
		return $quantidade;
	}
	
	public function getQuantidadeTriagensAtrasadas(){
		
		$restricaoUsuario = 
		($_SESSION['TIPO'] != 'UNIDADE DE APURAÇÃO') ? '' : 'AND ID_UNIDADE_APURACAO = ' . $_SESSION['UNIDADE'];
		
		$query = "
		
		SELECT COUNT(*) QUANTIDADE FROM tb_denuncias 
		
		WHERE DT_TERMINO_TRIAGEM IS NOT NULL
		
		$restricaoUsuario
		
		AND DT_TERMINO_TRIAGEM < NOW()
		
		AND DS_STATUS != 'ENCERRADA'
		
		";

		$quantidade = $this->executarQueryRegistro($query);
		
		return $quantidade;
	}
	
	public function getQuantidadeDenunciasAssunto(){
		
		$restricaoUsuario = 
		($_SESSION['TIPO'] != 'UNIDADE DE APURAÇÃO') ? '' : 'WHERE ID_UNIDADE_APURACAO = ' . $_SESSION['UNIDADE'];
		
		$query = "
		
		SELECT 
		
		c.ID,
		c.DS_NOME_MACRO NOME_MACRO, c.DS_NOME_MICRO NOME_MICRO,
		COUNT(*) QUANTIDADE
		
		FROM tb_denuncias a
		
		INNER JOIN tb_assuntos_denuncia c ON a.ID_ASSUNTO = c.ID
		
		$restricaoUsuario
		
		GROUP BY c.ID
		
		ORDER BY QUANTIDADE DESC
		
		";
		
		
		$listaDados = $this->executarQueryLista($query);
		
		return $listaDados;
		
	}
	
}	

?>