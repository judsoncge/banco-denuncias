<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/model/Model.php';

class DenunciasModel extends Model{

	private $tipo;
	private $dataCriacao;
	private $servidorCriacao;
	private $servidorDestino;
	private $anexo;
	
	public function getID(){
		return $this->id;
	}
	
	public function getTipo(){
		return $this->tipo;
	}
	
	public function getDataCriacao(){
		return $this->dataCriacao;
	}
	
	public function getServidorCriacao(){
		return $this->servidorCriacao;
	}
	
	public function getServidorDestino(){
		return $this->servidorDestino;
	}
	
	public function getStatus(){
		return $this->status;
	}
	
	public function getAnexo(){
		return $this->anexo;
	}
	
	public function setID($id){
		$this->id = $id;
	}
	
	public function setTipo($tipo){
		$this->tipo = $tipo;
	}
	
	public function setDataCriacao($dataCriacao){
		$this->dataCriacao = $dataCriacao;
	}
	
	public function setServidorCriacao($servidorCriacao){
		$this->servidorCriacao = $servidorCriacao;
	}
	
	public function setServidorDestino($servidorDestino){
		$this->servidorDestino = $servidorDestino;
	}
	
	public function setStatus($status){
		$this->status = $status;
	}
	
	public function setAnexo($anexo){
		$this->anexo = $anexo;
	}
	
	public function cadastrar(){
		
		$data = date('Y-m-d');
		
		$nomeAnexo = $this->registrarAnexo($this->anexo, 'anexos');
	
		$query = "INSERT INTO tb_arquivos (DS_TIPO, DT_CRIACAO, ID_SERVIDOR_CRIACAO, ID_SERVIDOR_DESTINO, DS_STATUS, DS_ANEXO) VALUES ('$this->tipo','$data', ".$_SESSION['ID']." , $this->servidorDestino, 'ATIVO', '$nomeAnexo')";
		
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