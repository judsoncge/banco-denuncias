<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/model/Model.php';

class DenunciasModel extends Model{

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
		
		$query = "
		
		INSERT INTO tb_denuncias 
		
		(DS_TIPO, ID_SERVIDOR, ID_ASSUNTO, DS_NOME_DENUNCIANTE, DS_CPF_DENUNCIANTE, DS_EMAIL_DENUNCIANTE, DS_TELEFONE_DENUNCIANTE, DS_DESCRICAO_FATO, ID_ORGAO_DENUNCIADO, ID_MUNICIPIO_FATO, DS_ENVOLVIDOS, DT_REGISTRO_EOUV, DS_NUMERO_PROCESSO_SEI) 
		
		
		VALUES 
		
		
		('$this->tipo', ".$_SESSION['ID']." , $this->assunto, NULLIF(NULL, '$this->nome'), NULLIF(NULL, '$this->CPF'), NULLIF(NULL, '$this->email'), NULLIF(NULL, '$this->telefone'), '$this->descricao', NULLIF(NULL, '$this->orgao'), NULLIF(NULL, '$this->municipio'), NULLIF(NULL, '$this->envolvidos'), '$this->dataRegistro', '$this->processo')";
		
		$id = $this->executarQueryID($query);
		
		$dataSemTraco = str_replace('-','', $this->dataRegistro);
		
		$numeroProvisorio = $id . "/" . $dataSemTraco;
		
		$query = "UPDATE tb_denuncias SET DS_NUMERO = '$numeroProvisorio' WHERE ID = $id";
		
		$resultado = $this->executarQuery($query);
		
		return $resultado;
		
	}
	
	public function editar(){
		
		$query = "UPDATE tb_arquivos SET DS_TIPO = '$this->tipo', ID_SERVIDOR_DESTINO = $this->servidorDestino WHERE ID = $this->id";

		$resultado = $this->executarQuery($query);
		
		return $resultado;

	}
	
	public function excluir(){
		
		$this->excluirArquivo('anexos', $this->anexo);
		
		$resultado = parent::excluir();
		
		return $resultado;

	}

	public function getDenuncias(){
		
		$query = 
		
		"SELECT 
		
		a.ID, a.DS_TIPO, a.ID_SERVIDOR, 
		
		b.DS_NOME_MACRO, b.DS_NOME_MICRO, 
		
		c.DS_NOME NOME_ORGAO_DENUNCIADO,
		
		d.DS_NOME NOME_SERVIDOR,
		
		e.DS_NOME NOME_MUNICIPIO
		
		FROM  tb_denuncias a
		
		INNER JOIN tb_assuntos_denuncia b ON a.ID_ASSUNTO = b.ID 
		
		INNER JOIN tb_orgaos c ON a.ID_ORGAO_DENUNCIADO = c.ID 
		
		INNER JOIN tb_servidores d ON a.ID_SERVIDOR = d.ID 
		
		INNER JOIN tb_servidores e ON a.ID_MUNICIPIO_FATO = e.ID 
		
		ORDER BY a.DT_REGISTRO_EOUV desc
		
		";
		
		$lista = $this->executarQueryLista($query);
		
		return $lista;
		
	}

}	

?>