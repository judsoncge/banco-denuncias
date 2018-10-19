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
		
		$numeroProvisorio = $id . "/" . $dataSemTraco;
		
		$query = "UPDATE tb_denuncias SET DS_NUMERO = '$numeroProvisorio' WHERE ID = $id";
		
		$resultado = $this->executarQuery($query);
		
		return $resultado;
		
	}
	
	public function editar(){
		
		$query = "UPDATE tb_denuncias SET DS_TIPO = '$this->tipo', ID_ASSUNTO = $this->assunto , DS_NOME_DENUNCIANTE = '$this->nome', DS_CPF_DENUNCIANTE = '$this->CPF' , DS_TELEFONE_DENUNCIANTE = '$this->telefone', DS_EMAIL_DENUNCIANTE = '$this->email' , TX_DESCRICAO_FATO = '$this->descricao' , ID_ORGAO_DENUNCIADO = $this->orgao, ID_MUNICIPIO_FATO = $this->municipio , DS_ENVOLVIDOS = '$this->envolvidos' , DT_REGISTRO_EOUV = '$this->dataRegistro' , DS_NUMERO_PROCESSO_SEI = '$this->processo' WHERE ID = $this->id";

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
		
		a.ID, a.DS_TIPO, a.DS_NOME_DENUNCIANTE, a.DS_CPF_DENUNCIANTE, a.DS_EMAIL_DENUNCIANTE, a.DS_TELEFONE_DENUNCIANTE, a.ID_ASSUNTO, a.TX_DESCRICAO_FATO, a.ID_ORGAO_DENUNCIADO, a.ID_MUNICIPIO_FATO, a.DS_ENVOLVIDOS, a.DT_REGISTRO_EOUV, a.DS_NUMERO_PROCESSO_SEI,
		
		b.DS_NOME_MACRO NOME_MACRO_ASSUNTO, b.DS_NOME_MICRO NOME_MICRO_ASSUNTO,
		
		c.DS_ABREVIACAO ABREVIACAO_ORGAO, c.DS_NOME NOME_ORGAO,
		
		d.DS_NOME NOME_MUNICIPIO
		
		FROM tb_denuncias a
		
		INNER JOIN tb_assuntos_denuncia b ON a.ID_ASSUNTO = b.ID 
		
		LEFT JOIN tb_orgaos c ON a.ID_ORGAO_DENUNCIADO = c.ID
		
		LEFT JOIN tb_municipios d ON a.ID_MUNICIPIO_FATO = d.ID 

		WHERE a.ID = '$this->id'
		
		";
				
		$lista = $this->executarQueryListaID($query);
		
		return $lista;
		
	}

	public function getDenuncias(){
		
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

}	

?>