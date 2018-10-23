<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/model/Model.php';

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
	private $processo;
	private $numero;
	
	private $restrito;
	private $responsavel;
	private $relevancia;
	private $termino;
	private $resultado;
	private $unidadeApuracao;
	
	private $anexos;
	private $tipos;
	private $comentarios;
	private $datas;
	private $palavras;
	
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
	
	public function setResultado($resultado){
		$this->resultado = $resultado;
		
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
		$this->descricao = $descricao;
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
	
	public function setProcesso($processo){
		$this->processo = $processo;
	}
	
	public function setNumero($numero){
		$this->numero = $numero;
	}
	
	public function cadastrar(){
		
		
		$nome = ($this->nome == '') ? '' : $this->nome;
		$CPF = ($this->CPF == '') ? '' : $this->CPF;
		$email = ($this->email == '') ? '' : $this->email;
		$telefone = ($this->telefone == '') ? '' : $this->telefone;
		$orgao = ($this->orgao == '') ? 'null' : $this->orgao;
		$municipio = ($this->municipio == '') ? 'null' : $this->municipio;
		$envolvidos = ($this->envolvidos == '') ? '' : $this->envolvidos;
		
		$query = "
		
		INSERT INTO tb_denuncias 
		
		(DS_TIPO, ID_SERVIDOR, ID_ASSUNTO, DS_NOME_DENUNCIANTE, DS_CPF_DENUNCIANTE, DS_EMAIL_DENUNCIANTE, DS_TELEFONE_DENUNCIANTE, TX_DESCRICAO_FATO, ID_ORGAO_DENUNCIADO, ID_MUNICIPIO_FATO, DS_ENVOLVIDOS, DT_REGISTRO_EOUV, DS_NUMERO_PROCESSO_SEI) 
		
		
		VALUES 
		
		
		('$this->tipo', ".$_SESSION['ID'].", $this->assunto, NULLIF('','$nome'), NULLIF('','$CPF'), NULLIF('','$email'), NULLIF('','$telefone'), '$this->descricao', $orgao, $municipio, NULLIF('','$envolvidos'), '$this->dataRegistro', '$this->processo')";
		
		$id = $this->executarQueryID($query);
		
		$dataSemTraco = str_replace('-','', $this->dataRegistro);
		
		$numeroProvisorio = $id . "/" . $dataSemTraco . "-P";
		
		$query = "UPDATE tb_denuncias SET DS_NUMERO = '$numeroProvisorio' WHERE ID = $id";
		
		$resultado = $this->executarQuery($query);
		
		return $resultado;
		
	}
	
	public function triagem(){
		
		$query = "UPDATE tb_denuncias SET BL_ACESSO_RESTRITO = $this->restrito, ID_RESPONSAVEL_TRIAGEM = $this->responsavel, BL_RELEVANCIA = $this->relevancia, DT_TERMINO_TRIAGEM = '$this->termino', DS_RESULTADO_TRIAGEM = '$this->resultado', ID_UNIDADE_APURACAO = $this->unidadeApuracao WHERE ID = $this->id";
		
		$resultado = $this->executarQuery($query);
		
		if($this->anexos != NULL){
			
			$this->cadastrarAnexos();
			
		}
		
		if($this->palavras != NULL){
			foreach($this->palavras as $palavra){
				
				$query = "INSERT INTO tb_palavras_chave_denuncia (ID_DENUNCIA, DS_PALAVRA_CHAVE) VALUES ($this->id, '$palavra')";
				
				$this->executarQuery($query);			
			}
		}
		
		return $resultado;
		
	}
	
	public function cadastrarAnexos(){
		
		if($this->anexos != NULL){
		
			foreach ($this->anexos['error'] as $key => $error){
					
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
				
				$tipo = $this->tipos[$key];
				
				$comentario = ($this->comentarios[$key] == '') ? '' : addslashes($this->comentarios[$key]);
							
				$data = $this->datas[$key];
				
				$query = "INSERT INTO tb_anexos (ID_DENUNCIA, DS_TIPO, DS_COMENTARIOS, DT_RECEBIMENTO, NM_ARQUIVO) VALUES ('$this->id','$tipo','$comentario','$data','$nomeAnexo')";
				
				$resultado = $this->executarQuery($query);
				
				$mensagemResposta = ($resultado) 
					? 'Operação realizada com sucesso!' 
					: 'Ocorreu alguma falha na operação. Por favor, procure o suporte';
					
				$this->setMensagemResposta($mensagemResposta);
				
			}
			
			return $resultado;
			
		}else{
			$mensagemResposta = 'Operação realizada com sucesso!';
			
			$this->setMensagemResposta($mensagemResposta);
			
			return 1;
			
		}
	}
	
	public function editar(){
		
		$nome = ($this->nome == '') ? '' : $this->nome;
		$CPF = ($this->CPF == '') ? '' : $this->CPF;
		$email = ($this->email == '') ? '' : $this->email;
		$telefone = ($this->telefone == '') ? '' : $this->telefone;
		$orgao = ($this->orgao == '') ? 'null' : $this->orgao;
		$municipio = ($this->municipio == '') ? 'null' : $this->municipio;
		$envolvidos = ($this->envolvidos == '') ? '' : $this->envolvidos;
		
		$query = "UPDATE tb_denuncias SET DS_TIPO = '$this->tipo', ID_ASSUNTO = $this->assunto , DS_NOME_DENUNCIANTE = NULLIF('','$nome'), DS_CPF_DENUNCIANTE = NULLIF('','$CPF'), DS_TELEFONE_DENUNCIANTE = NULLIF('','$telefone'), DS_EMAIL_DENUNCIANTE = NULLIF('','$email') , TX_DESCRICAO_FATO = '$this->descricao' , ID_ORGAO_DENUNCIADO = $orgao, ID_MUNICIPIO_FATO = $municipio , DS_ENVOLVIDOS = NULLIF('','$envolvidos') , DT_REGISTRO_EOUV = '$this->dataRegistro' , DS_NUMERO_PROCESSO_SEI = '$this->processo' WHERE ID = $this->id";

		$resultado = $this->executarQuery($query);
		
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
		
		f.DS_ABREVIACAO ABREVIACAO_UNIDADE, f.DS_NOME NOME_UNIDADE
		
		FROM tb_denuncias a
		
		INNER JOIN tb_assuntos_denuncia b ON a.ID_ASSUNTO = b.ID 
		
		LEFT JOIN tb_orgaos c ON a.ID_ORGAO_DENUNCIADO = c.ID
		
		LEFT JOIN tb_municipios d ON a.ID_MUNICIPIO_FATO = d.ID 
		
		LEFT JOIN tb_servidores e ON a.ID_RESPONSAVEL_TRIAGEM = e.ID 
		
		LEFT JOIN tb_unidades_apuracao f ON a.ID_UNIDADE_APURACAO = f.ID 

		WHERE a.ID = $this->id
		
		";
				
		$lista = $this->executarQueryListaID($query);
		
		return $lista;
		
	}

	public function getDenuncias(){
		
		$query = 
		
		"SELECT 
		
		a.ID, a.DS_TIPO, a.ID_SERVIDOR, a.BL_TRIAGEM_CONCLUIDA,
		
		b.DS_NOME_MACRO, b.DS_NOME_MICRO, 
		
		c.DS_ABREVIACAO NOME_ORGAO_DENUNCIADO,
		
		d.DS_NOME NOME_SERVIDOR,
		
		e.DS_NOME NOME_MUNICIPIO
		
		FROM  tb_denuncias a
		
		INNER JOIN tb_assuntos_denuncia b ON a.ID_ASSUNTO = b.ID 
		
		LEFT JOIN tb_orgaos c ON a.ID_ORGAO_DENUNCIADO = c.ID 
		
		INNER JOIN tb_servidores d ON a.ID_SERVIDOR = d.ID 
		
		LEFT JOIN tb_municipios e ON a.ID_MUNICIPIO_FATO = e.ID 
		
		ORDER BY a.DT_REGISTRO_EOUV desc
		
		";
		
		$lista = $this->executarQueryLista($query);
		
		return $lista;
		
	}
	
	public function getDenunciasComFiltro(){
		
		$servidor = ($this->servidor == '%') ? '' : "AND (ID_SERVIDOR = $this->servidor)" ;
		
		$orgao = ($this->orgao == '%') ? '' : "AND (ID_ORGAO_DENUNCIADO = $this->orgao)" ;
		
		$municipio = ($this->municipio == '%') ? '' : "AND (ID_MUNICIPIO_FATO = $this->municipio)" ;
		
		$assunto = ($this->assunto == '%') ? '' : "AND (ID_ASSUNTO = $this->assunto)" ;
		
		$query = 
		
		"SELECT 
		
		a.ID, a.DS_TIPO, a.ID_SERVIDOR, 
		
		b.DS_NOME_MACRO, b.DS_NOME_MICRO, 
		
		c.DS_ABREVIACAO NOME_ORGAO_DENUNCIADO,
		
		d.DS_NOME NOME_SERVIDOR,
		
		e.DS_NOME NOME_MUNICIPIO
		
		FROM  tb_denuncias a
		
		INNER JOIN tb_assuntos_denuncia b ON a.ID_ASSUNTO = b.ID 
		
		LEFT JOIN tb_orgaos c ON a.ID_ORGAO_DENUNCIADO = c.ID 
		
		INNER JOIN tb_servidores d ON a.ID_SERVIDOR = d.ID 
		
		LEFT JOIN tb_municipios e ON a.ID_MUNICIPIO_FATO = e.ID 
		
		WHERE a.DS_TIPO LIKE '$this->tipo'
		
		$servidor
	   
    	$orgao
		
		$municipio
		
		$assunto
		
		ORDER BY a.DT_REGISTRO_EOUV desc
		
		";
		
		$lista = $this->executarQueryLista($query);
		
		return $lista;
		
	}
	
	public function concluirTriagem(){
		
		$query = "SELECT DS_RESULTADO_TRIAGEM FROM tb_denuncias WHERE ID = $this->id";
		
		$resultado = $this->executarQueryRegistro($query);
		
		$modificarNumeroDenuncia = ($resultado == 'APTA') ? ", DS_NUMERO = REPLACE(DS_NUMERO,'-P','')" : '';
		
		$query = "UPDATE tb_denuncias SET BL_TRIAGEM_CONCLUIDA = 1 $modificarNumeroDenuncia WHERE ID = $this->id";
		
		$resultado = $this->executarQuery($query);

		return $resultado;
	
	}

}	

?>