<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/view/View.php';

class ServidoresView extends View{
	
	
	private $tipoEdicao;
	
	public function setTipoEdicao($tipoEdicao){
		
		$this->tipoEdicao = $tipoEdicao;
		
	}
	
	
	public function listar(){ ?>
		
		<div class='col-md-12 table-responsive' style='overflow: auto; width: 100%; height: 300px;'>
			<table class='table table-hover tabela-dados'>
				<thead>
					<tr>
						<th>CPF</th>
						<th>Nome</th>
						<th>Órgão</th>
						<th>Tipo</th>
						<th>E-mail</th>
						<th>Telefone</th>
						<th>Ação</th>
					</tr>	
				</thead>
				<tbody>
					<?php 
						
						$lista = $_REQUEST['LISTA_SERVIDORES'];
						
						foreach($lista as $servidor){ 
					
					?>
							<tr>
								<td><?php echo $servidor['DS_CPF']; ?></td>
								<td><?php echo $servidor['DS_NOME']; ?></td>
								<td><?php echo $servidor['DS_ABREVIACAO']; ?></td>
								<td><?php echo $servidor['DS_TIPO']; ?></td>										
								<td><?php echo $servidor['DS_EMAIL']; ?></td>										
								<td><?php echo $servidor['DS_TELEFONE']; ?></td>
								<td>
									<a href="/servidores/editar/<?php echo $servidor['ID'] ?>">
										<button type='button' class='btn btn-secondary btn-sm' title='Editar'>
											<i class='fa fa-pencil' aria-hidden='true'></i>
										</button>
									</a>
									
									<?php if($_SESSION['ID'] != $servidor['ID']){ ?>
										<a href="/excluir/servidor/<?php echo $servidor['ID'] ?>" type='submit' onclick="return confirm('Você tem certeza que deseja inativar este servidor?');" >
											<button type='button' class='btn btn-secondary btn-sm' title='Inativar'>
												<i class='fa fa-trash' aria-hidden='true'></i>
											</button>
										</a>
									<?php } ?>
																			
								</td>
							</tr>
					<?php

						} 
				  
					?>		
				</tbody>
			</table>
		</div>
<?php 
	
	}
	
	
	public function cadastrar(){

		$this->carregarFormulario();	
	
	}
	
	
	public function editar(){
		
		switch($this->tipoEdicao){
			
			case 'info':
				$this->carregarFormulario();
				break;
			
			case 'senha':
				$this->carregarEdicaoSenha();
				break;
			
			case 'foto':
				$this->carregarEdicaoFoto();
				break;
		
		}
	
	}
	
	
	public function carregarFormulario(){ 
	
		
		$listaOrgaos = $_REQUEST['LISTA_ORGAOS'];
		
		$listaUnidadesApuracao = $_REQUEST['LISTA_UNIDADES_APURACAO'];
		
		
		if($this->conteudo == 'editar'){
			
			$listaDados = $_REQUEST['DADOS_SERVIDOR'];
			$action = "/editar/servidor/info/".$listaDados['ID']."/";
			$idOrgao = $listaDados['ID_ORGAO'];
			$nomeOrgao = $listaDados['NOME_ORGAO'];
			$idUnidade = $listaDados['ID_UNIDADE_APURACAO'];
			$nomeUnidade = $listaDados['NOME_UNIDADE'];
			$valueTipo = $listaDados['DS_TIPO'];
			$nomeTipo = $listaDados['DS_TIPO'];
			$nomeBotao = 'Editar';
			
		}else{
			
			$action = '/cadastrar/servidor/';
			$idOrgao = '';
			$nomeOrgao = 'Selecione';
			$idUnidade = '';
			$nomeUnidade = 'Selecione';
			$valueTipo = '';
			$nomeTipo = 'Selecione';
			$nomeBotao = 'Cadastrar';
		
		}

?>		
		
		<form name='cadastro' method='POST' action='<?php echo $action; ?>' enctype='multipart/form-data'> 
			<div class='row'>
				<div class='col-md-4'>
					<div class='form-group'>
						<label class='control-label'>Nome</label>
						<input class='form-control' id='nome' name='nome' placeholder='Digite o nome (somente letras)' type='text' maxlength='50' minlength='4' pattern='[a*A*-z*Z*]*+' value='<?php if($this->conteudo == 'editar'){echo $listaDados['DS_NOME'];} ?>' required />
					</div> 
				</div>
				<div class='col-md-4'>
					<div class='form-group'>
						<label class='control-label'>Órgão</label>
						<select class='form-control' id='orgao' name='orgao' required />
							<option value='<?php echo $idOrgao ?>'><?php echo $nomeOrgao ?></option>
							<?php foreach($listaOrgaos as $orgao){ ?>
								<option value='<?php echo $orgao['ID'] ?>'><?php echo $orgao['DS_NOME']; ?></option>
							<?php } ?>
						</select>
					</div> 
				</div>
				<div class='col-md-4'>
					<div class='form-group'>
						<label class='control-label'>Unidade de apuração</label>
						<select class='form-control' id='unidadeApuracao' name='unidadeApuracao' />
							<option value='<?php echo $idUnidade ?>'><?php echo $nomeUnidade ?></option>
							<?php foreach($listaUnidadesApuracao as $unidadeApuracao){ ?>
								<option value='<?php echo $unidadeApuracao['ID'] ?>'><?php echo $unidadeApuracao['ABREVIACAO_ORGAO'] . ' - ' .$unidadeApuracao['DS_ABREVIACAO'] . ' - ' . $unidadeApuracao['DS_NOME'] ; ?></option>
							<?php } ?>
						</select>
					</div> 
				</div>
			</div>
			<div class='row'>
				<div class='col-md-4'>
					<div class='form-group'>
						<label class='control-label'>CPF</label>
						<input class='form-control' id='CPF' name='CPF' placeholder='Digite o CPF' type='text' value='<?php if($this->conteudo == 'editar'){echo $listaDados['DS_CPF'];} ?>' required />				  
					</div>				
				</div>
				<div class='col-md-4'>
					<div class='form-group'>
						<label class='control-label'>Telefone</label>
						<input class='form-control' id='telefone' name='telefone' placeholder='Digite o telefone' type='text' maxlength='10' value='<?php if($this->conteudo == 'editar'){echo $listaDados['DS_TELEFONE'];} ?>' required />				  
					</div>				
				</div>
				<div class='col-md-4'>
					<div class='form-group'>
						<label class='control-label'>E-mail</label>
						<input class='form-control' id='email' name='email' placeholder='Digite o e-mail' type='email' value='<?php if($this->conteudo == 'editar'){echo $listaDados['DS_EMAIL'];} ?>' required />				  
					</div>				
				</div>
			</div>
			<div class='row'> 
				<div class='col-md-6'>
					<div class='form-group'>
						<label class='control-label'>Matrícula</label>
						<input class='form-control' id='matricula' name='matricula' placeholder='Digite a matrícula' type='text' maxlength='10' value='<?php if($this->conteudo == 'editar'){echo $listaDados['DS_MATRICULA'];} ?>' required />
					</div> 
				</div>				
				<div class='col-md-6'>
					<div class='form-group'>
						<label class='control-label'>Tipo</label>
						<select class='form-control' id='tipo' name='tipo' required />
							<option value='<?php echo $valueTipo ?>'><?php echo $nomeTipo ?></option>
							<option value='OUVIDORIA'>OUVIDORIA</option>
							<option value='UNIDADE DE APURAÇÃO'>UNIDADE DE APURAÇÃO</option>
						</select>
					</div> 
				</div>
			</div>
			
			<div class='row' id='cad-button'>
				<div class='col-md-12'>
					<button type='submit' class='btn btn-default' name='submit' value='Send' id='submit'><?php echo $nomeBotao; ?></button>
				</div>
			</div>
		</form>
		
<?php		
		
	}
	
	
	public function carregarEdicaoSenha(){
		
?>
		
	<form name='cadastro' method='POST' action="/editar/servidor/senha/<?php echo $_SESSION['ID'] ?>/" enctype='multipart/form-data'> 
		<div class='row'>
			<div class='col-md-5'>
				<div class='form-group'>
					<label class='control-label'>Nova senha</label>
					<input class='form-control' type='password' id='nova_senha' name='senha'/>
				</div>	
			</div>
			<div class='col-md-5'>
				<div class='form-group'>
					<label class='control-label'>Confirme a nova senha</label>
					<input class='form-control' type='password' id='confirmaSenha' name='confirmaSenha'/>
				</div>	
			</div>
			<div class='col-md-2'>
				<div class='form-group'>
					<button type='submit' class='btn btn-sm btn-success' name='submit' value='Send' style='margin-top:32px;'>
						Alterar senha
					</button>
				</div>	
			</div>
		</div>
	</form>


<?php 
	
	}
	
	
	public function carregarEdicaoFoto(){
		
?>	

	<form name='cadastro' method='POST' action="/editar/servidor/foto/<?php echo $_SESSION['ID'] ?>/" enctype='multipart/form-data'> 
		<div class='row'>
			<div class='col-md-10'>
				<div class='form-group'>
					<label class='control-label'>Selecione a nova foto</label>
					<input class='form-control' type='file' id='arquivoFoto' name='arquivoFoto' enctype='multipart/form-data'/>
				</div>	
			</div>
			<div class='col-md-2'>
				<div class='form-group'>
					<button type='submit' class='btn btn-sm btn-success' name='submit' value='Send' style='margin-top:32px;'>
						Alterar foto
					</button>
				</div>	
			</div>
		</div>
	</form>
		
<?php 

	}

}

?>