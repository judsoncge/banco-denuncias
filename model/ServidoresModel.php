<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/model/Model.php';

class ServidoresModel extends Model{

	private $nome;
	private $matricula;
	private $email;
	private $telefone;
	private $orgao;
	private $foto;	
	private $tipo;
	private $cpf;
	private $senha;
	private $confirmaSenha;
	
	public function setTipo($tipo){
		$this->tipo = $tipo;
	}
	
	public function setMatricula($matricula){
		$this->matricula = $matricula;
	}
	
	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function setOrgao($orgao){
		$this->orgao = $orgao;
	}
	
	public function setNome($nome){
		$this->nome = addslashes($nome);
	}
	
	public function setCPF($cpf){
		$this->cpf = $cpf;	
	}
	
	public function setSenha($senha){
		$this->senha = md5($senha);
	}
	
	public function setConfirmaSenha($confirmaSenha){
		$this->confirmaSenha = md5($confirmaSenha);
	}
	
	public function setFoto($foto){
		$this->foto = $foto;
	}
	
	public function getFoto(){
		return $this->foto;
	}
	
	public function login(){
		
		$query = "
		
		SELECT 
		
		ID, DS_NOME, ID_ORGAO, DS_FOTO, DS_TIPO, DS_CPF
		
		FROM tb_servidores
		
		WHERE DS_CPF = '$this->cpf' 
		
		AND SENHA = '$this->senha'";
		
		$dadosUsuario = $this->executarQueryLista($query);
		
		return $dadosUsuario;
	
	}
	
	public function getServidores(){
		
		$query = "
		
		SELECT 
		
		s1.ID, s1.DS_CPF, s1.DS_NOME, s1.DS_EMAIL, s1.DS_TELEFONE, s1.DS_TIPO, s2.DS_ABREVIACAO
		
		FROM tb_servidores s1
		
		INNER JOIN tb_orgaos s2 ON s1.ID_ORGAO = s2.ID  
		
		ORDER BY s1.DS_NOME";
		
		$lista = $this->executarQueryLista($query);
		
		return $lista;
	
	}
	
	public function getDadosID(){
		
		$query = "
		
		SELECT 
		
		s1.ID, s1.DS_NOME, s1.DS_MATRICULA, s1.DS_CPF, s1.DS_TELEFONE, s1.DS_EMAIL, s1.DS_TIPO, s2.ID ID_ORGAO, s2.DS_NOME NOME_ORGAO
		
		FROM tb_servidores s1
		
		INNER JOIN tb_orgaos s2 ON s1.ID_ORGAO = s2.ID 

		WHERE s1.ID = '$this->id'
		
		";
		
		
		$lista = $this->executarQueryListaID($query);
		
		return $lista;
		
	}
	
	public function cadastrar(){
		
		$existeCPF = $this->verificaExisteRegistro('DS_CPF', $this->cpf);
		$existeMatricula = $this->verificaExisteRegistro('DS_MATRICULA', $this->matricula);
		
		if($existeCPF or $existeMatricula){
			
			$this->setMensagemResposta('Já existe um(a) servidor(a) com este(a) CPF ou matrícula. Por favor, tente outro(a).');
			
			return 0;
		
		}else{
			
			$query = "INSERT INTO tb_servidores (DS_NOME, DS_MATRICULA, DS_EMAIL, DS_TELEFONE, ID_ORGAO, DS_TIPO, DS_CPF) VALUES ('$this->nome', '$this->matricula', '$this->email','$this->telefone', '$this->orgao', '$this->tipo', '$this->cpf')";
			
			$resultado = $this->executarQuery($query);
			
			return $resultado;
		}
		
	}
	
	public function editar(){
		
		if($this->cpf != NULL){
			
			$existe = $this->verificaExisteRegistroId('DS_CPF', $this->cpf);
		
			if($existe){
			
				$this->setMensagemResposta('Já existe um(a) servidor(a) com este CPF. Por favor, tente outro.');
			
				return 0;
		
			}
			
		}	

		if($this->matricula != NULL){
			
			$existe = $this->verificaExisteRegistroId('DS_MATRICULA', $this->cpf);
		
			if($existe){
			
				$this->setMensagemResposta('Já existe um(a) servidor(a) com esta matrícula. Por favor, tente outra.');
			
				return 0;
		
			}
			
		}			
		
		$query  = "UPDATE tb_servidores SET  DS_NOME = '$this->nome', DS_MATRICULA = '$this->matricula', DS_EMAIL = '$this->email', DS_TELEFONE = '$this->telefone', ID_ORGAO = $this->orgao, DS_TIPO = '$this->tipo', DS_CPF = '$this->cpf' WHERE ID = $this->id";
		
		$resultado = $this->executarQuery($query);
		
		return $resultado;
		
	}
	
	public function editarSenha(){
		
		if($this->senha != $this->confirmaSenha){
			
			$this->setMensagemResposta('As senhas não conferem!');
			
			return 0;
			
		}else{
			
			$query = "UPDATE tb_servidores SET SENHA = '$this->senha' WHERE ID = $this->id";
			
			$resultado = $this->executarQuery($query);
			
			return $resultado;
		
		}
	}
	
	public function editarFoto(){
		
		$this->excluirFoto($_SESSION['FOTO']);
		
		$nomeAnexo = $this->registrarAnexo($this->foto, 'fotos');		
		
		$query = "UPDATE tb_servidores SET DS_FOTO = '$nomeAnexo' WHERE ID = $this->id";
		
		$resultado = $this->executarQuery($query);
		
		$this->setFoto($nomeAnexo);
		
		return $resultado;
		
	}
	
	public function excluirFoto($foto){
		
		if($foto != 'default.jpg'){
			
			$this->excluirArquivo('fotos', $foto);
			
		}
	
	}	
	
	public function excluir(){
		
		$query = "DELETE FROM tb_servidores WHERE ID = $this->id";
			
		$resultado = $this->executarQuery($query);
			
		return $resultado;
		
	}
	
}	

?>