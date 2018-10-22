<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/view/View.php';

class DenunciasView extends View{
	
	
	public function adicionarScripts(){
	
		
		if($this->conteudo == 'listar'){ ?>
			<script src='/view/_libs/js/receber.js'></script>
			<script src='/view/_libs/js/filtros.js'></script>
			<script src='/view/_libs/js/exportar.js'></script>

	
		<?php 
		
		}elseif($this->conteudo == 'visualizar'){ ?>
			
			<link rel='stylesheet' type='text/css' href='/view/_libs/css/multiple-select.css'>
			<script type='text/javascript' src='/view/_libs/js/multiple-select.js'></script>
			<script type='text/javascript'>
				window.onload = function(){
					$('#responsaveis').multipleSelect();
					$('#apensos').multipleSelect();
					
				}
			</script>	

        <?php			
		
		}elseif($this->conteudo == 'triagem'){ ?>
		
			<script type='text/javascript'>
		
				var id_row = 1;
				var id = 1;
				
				
				function adicionarAnexo(){
					
					var newdiv = document.createElement('div');
					
					newdiv.setAttribute("name", "campos"+id);
					
					newdiv.setAttribute("id", id);
					
					newdiv.innerHTML = 
					"<div class='row'>"+
						"<div class='col-md-3'>"+
							"Selecione a anexo: <a href='javascript:void(0)' title='remover' onclick='removerAnexo("+id+");'><i class='fa fa-times' aria-hidden='true'></i></a><br>"+
								"<input type='file' id='selecao-arquivo' name='anexos[]' accept='.jpg, .jpeg, .pjpeg, .gif, .png' id='anexo' required />"+	
						"</div>"+
					"</div>"+
					"<div class='row'>"+
						"<div class='col-md-4'>"+
							"Tipo:<br>"+
							"<select id='tipos' name='tipos[]' required>:"+
								"<option value=''>Selecione</option>"+	
								"<option value='COMPLEMENTO DO DENUNCIANTE'>COMPLEMENTO DO DENUNCIANTE</option>"+	
								"<option value='RESULTADO DE TRIAGEM'>RESULTADO DE TRIAGEM</option>"+	
							"</select>"+	
						"</div>"+
						"<div class='col-md-4'>"+
							"Comentários:<br>"+
							"<input class='form-control' id='comentarios' name='comentarios[]' type='text' maxlength='100' placeholder='Máx. 100 caracteres'/>"+	
						"</div>"+
						"<div class='col-md-4'>"+
							"Data de recebimento no eOUV:<br>"+
							"<input class='form-control' id='datas' name='datas[]' type='date' />"+	
						"</div>"+
					"</div><hr>";
					
					var nova_anexo = document.getElementById("adicionarAnexo");

					nova_anexo.appendChild(newdiv);
					
					id++;
				}
				
				
				function removerAnexo(id){
					
					document.getElementById(id).innerHTML=""; 
					
				}
				
			</script>
			
			<script type='text/javascript'>
		
				var idPalavra_row = 1;
				var idPalavra = 1;
				
				
				function adicionarPalavrasChave(){
					
					var newdiv = document.createElement('div');
					
					newdiv.setAttribute("name", "campos"+idPalavra);
					
					newdiv.setAttribute("id", idPalavra);
					
					newdiv.innerHTML = 
					"<div class='row'>"+
						"<div class='col-md-6'>"+
							"<input class='form-control' id='palavras' name='palavras[]' type='text' maxlength='20' placeholder='Máx. 20 caracteres'/>"+	
						"</div><a href='javascript:void(0)' title='remover' onclick='removerPalavraChave("+idPalavra+");'><i class='fa fa-times' aria-hidden='true'></i></a><br>"+
					"</div><hr>";
					
					var nova_palavraChave = document.getElementById("adicionarPalavraChave");

					nova_palavraChave.appendChild(newdiv);
					
					idPalavra++;
				}
				
				
				function removerPalavraChave(idPalavra){
					
					document.getElementById(idPalavra).innerHTML=""; 
					
				}
				
			</script>
        
		<?php   
        
		}elseif($this->conteudo == 'cadastrar' or $this->conteudo == 'editar'){ ?>
		
			<script src='/view/_libs/tinymce/tinymce.min.js'></script>
		
			<script>tinymce.init({ selector:'textarea', language:'pt_BR' })</script>

			<script type="text/javascript">
				function travarDestravarCamposDenunciante(){
					
					var tipo = document.getElementById("tipo").value;
					
					if(tipo == 'ANÔNIMA'){
						
						document.getElementById("nome").value = "";
						document.getElementById('nome').disabled = true;
						document.getElementById("CPF").value = "";
						document.getElementById("CPF").disabled = true;
						document.getElementById("email").value = "";
						document.getElementById("email").disabled = true;
						document.getElementById("telefone").value = "";
						document.getElementById("telefone").disabled = true;

					}else{
						
						document.getElementById('nome').disabled = false;
						document.getElementById("CPF").disabled = false;
						document.getElementById("email").disabled = false;
						document.getElementById("telefone").disabled = false;

					}
	
				}
			</script>	

		<?php
		} 
	}
	
	public function carregarFiltro(){
		
		
		$listaServidores = $_REQUEST['LISTA_SERVIDORES']; 
		
		$listaOrgaos = $_REQUEST['LISTA_ORGAOS']; 
		
		$listaMunicipios = $_REQUEST['LISTA_MUNICIPIOS']; 
		
		$listaAssuntos = $_REQUEST['LISTA_ASSUNTOS'];

?>	

		<div class='well'>
			<form>
				<div class='row'>	
					<div class='col-md-4'>
						<div class='form-group'>
							<label class='control-label'>Servidor que cadastrou</label><br>
							<select id='filtroservidor' name='filtroservidor'>
								<option value='%'>Todos</option>
								<?php foreach($listaServidores as $servidor){ ?>
										<option value='<?php echo $servidor['ID'] ?>'>
											<?php echo $servidor['DS_NOME']; ?>
										</option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class='col-md-2'>
						<div class='form-group'>
							<label class='control-label'>Tipo</label><br>
								<select id='filtrotipo' name='filtrotipo'>
									<option value='%'>Todos</option>
									<option value='IDENTIFICADA'>IDENTIFICADA</option>
									<option value='ANÔNIMA'>ANÔNIMA</option>
								</select>
						</div>
					</div>
					<div class='col-md-2'>
						<div class='form-group'>
							<label class='control-label'>Órgão denunciado</label><br>
								<select id='filtroorgao' name='filtroorgao'>
									<option value='%'>Todos</option>
									<?php foreach($listaOrgaos as $orgao){ ?>
										<option value='<?php echo $orgao['ID'] ?>'>
											<?php echo $orgao['DS_ABREVIACAO']; ?>
										</option>
									<?php } ?>
								</select>
						</div>
					</div>
					<div class='col-md-3'>
						<div class='form-group'>
							<label class='control-label'>Município fato</label><br>
								<select id='filtromunicipio' name='filtromunicipio'>
									<option value='%'>Todos</option>
									<?php foreach($listaMunicipios as $municipio){ ?>
										<option value='<?php echo $municipio['ID'] ?>'>
											<?php echo $municipio['DS_NOME']; ?>
										</option>
									<?php } ?>
								</select>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-12'>
						<div class='form-group'>
							<label class='control-label'>Assuntos</label><br>
								<select id='filtroassunto' name='filtroassunto'>
									<option value='%'>Todos</option>
									<?php foreach($listaAssuntos as $assunto){ ?>
										<option value='<?php echo $assunto['ID'] ?>'>
											<?php echo $assunto['DS_NOME_MACRO'] . ' - ' . $assunto['DS_NOME_MICRO']; ?>
										</option>
									<?php } ?>
								</select>
						</div>
					</div>
				</div>
			</form>
		</div>
		
		

<?php
	}
	
	
	public function listar(){
		
		
		$listaDenuncias = $_REQUEST['LISTA_DENUNCIAS'];
		
?>		
		
		<div id='resultado' class='col-md-12 table-responsive' style='overflow: auto; width: 100%; height: 300px;'>
			
			
			<div id='carregando' class='carregando'><i class='fa fa-refresh spin' aria-hidden='true'></i> <span>Carregando dados...</span></div>
			
			<center>				
				<h5>
					<div id='qtde'>Total: <?php echo sizeof($listaDenuncias) . " " ?>
						<button onclick='javascript: exportar();' class='btn btn-sm btn-success' name='submit' value='Send'>Exportar</button>
					</div>
					
				</h5>
			</center>
		
			<table class='table table-hover tabela-dados'>
				<thead>
					<tr>
						<th>Servidor cadastro</th>
						<th>Tipo</th>
						<th>Assunto Macro</th>
						<th>Assunto Micro</th>
						<th>Órgão Denunciado</th>
						<th>Município</th>
						<th>Ação</th>
					</tr>	
				</thead>
				<tbody>
						
					<?php 
					
						foreach($listaDenuncias as $denuncia){ 
				
					?>
						
						<tr>
							<td><?php echo $denuncia['NOME_SERVIDOR'] ?></td>
							<td><?php echo $denuncia['DS_TIPO'] ?></td>
							<td><?php echo $denuncia['DS_NOME_MACRO']  ?></td>
							<td><?php echo $denuncia['DS_NOME_MICRO'] ?></td>
							<td><?php echo $denuncia['NOME_ORGAO_DENUNCIADO'] ?></td>
							<td><?php echo $denuncia['NOME_MUNICIPIO'] ?></td>
							
							<td>	
								<a href="/denuncias/visualizar/<?php echo $denuncia['ID'] ?>">
									<button type='button' class='btn btn-secondary btn-sm' title='Visualizar Informações'>
										<i class='fa fa-eye' aria-hidden='true'></i>
									</button>
								</a>
								
								<a href="/denuncias/triagem/<?php echo $denuncia['ID'] ?>">
									<button type='button' class='btn btn-secondary btn-sm' title='Fazer Triagem'>
										<i class='fa fa-exchange' aria-hidden='true'></i>
									</button>
								</a>
								
								<a href="/denuncias/editar/<?php echo $denuncia['ID'] ?>">
									<button type='button' class='btn btn-secondary btn-sm' title='Editar'>
										<i class='fa fa-pencil' aria-hidden='true'></i>
									</button>
								</a>
							</td>				
						</tr>
				  <?php } ?>		
				</tbody>
			</table>
		</div>
<?php 
		
	}
	
	
	public function exportar(){
		
		ini_set('memory_limit', '256M');
		
		ini_set('max_execution_time', 300000); 
		
		include($_SERVER['DOCUMENT_ROOT'].'/view/_libs/mpdf60/mpdf.php');
		
		$listaDenuncias = $_REQUEST['LISTA_PROCESSOS'];
		
		$html = "<style type='text/css'>
		#customers {
		font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
		}

		#customers td, #customers th {
			border: 1px solid #ddd;
			padding: 8px;
		}

		#customers tr:nth-child(even){background-color: #f2f2f2;}

		#customers tr:hover {background-color: #ddd;}

		#customers th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color: #4CAF50;
			color: white;
		}
		</style>
		
		*os processos são ordenados pela urgência (linha amarela) e depois pela quantidade de dias
		
		<table id='customers'>
			<thead>
				<tr>
					<th>Número</th>
					<th>Servidor</th>
					<th>Setor</th>
					<th>Prazo</th>
					<th>Status</th>
					<th>Situação</th>
					<th>Dias</th>
					<th>Recebido</th>
				</tr>	
			</thead>";
			
		foreach($listaDenuncias as $denuncia){
			
			$linhaTabela = ($denuncia['BL_URGENCIA']) ? "<tr style='background-color:#f1c40f;'>" : '<tr>';
			
			$atrasado = ($denuncia['BL_ATRASADO']) ? 'ATRASADO' : 'DENTRO DO PRAZO';

			$recebido = ($denuncia['BL_RECEBIDO']) ? 'SIM' : 'NÃO';
			
			$html .= 
		
		"
		$linhaTabela 
			<td>
				
					".$denuncia['DS_NUMERO']."
				
			</td>
			<td>
				
					".$denuncia['NOME_SERVIDOR']."
				
			</td>
			<td>
				
					".$denuncia['NOME_SETOR']."
				
			</td>
			<td>
				
					".$denuncia['DT_PRAZO']."
				
			</td>
			<td>
				
					".$denuncia['DS_STATUS']."
				
			</td>
			<td>
				
					".$atrasado."
				
			</td>
			<td>
				
					".$denuncia['NR_DIAS']."
				
			</td>
			<td>
				
					".$recebido."
				
			</td>				
		</tr>";

		}
		
		$html .= 
		"  </tbody>	
		</table>";
				
		$mpdf = new mPDF();
		
		$mpdf -> WriteHTML($html);   
		
		$mpdf -> Output();
		
		exit();
		
	}
	
	
	public function cadastrar(){ 

		$this->carregarFormulario();
	
	}
	
	
	public function editar(){
		
		$this->carregarFormulario();	
		
	}
	
	
	public function carregarFormulario(){
		
		
		$listaMunicipios = $_REQUEST['LISTA_MUNICIPIOS'];
		
		$listaAssuntos = $_REQUEST['LISTA_ASSUNTOS'];
		
		$listaOrgaos = $_REQUEST['LISTA_ORGAOS'];		
		
		if($this->conteudo == 'editar'){
			
			$listaDados = $_REQUEST['DADOS_DENUNCIA'];
			$action = "/editar/denuncia/info/".$listaDados['ID']."/";
			$nomeBotao = 'Editar';
			$valueTipo = $listaDados['DS_TIPO'];
			$nomeTipo = $listaDados['DS_TIPO'];
			$camposDenunciante = "value = '' disabled";
			
	
		}else{
			
			$listaDados = NULL;
			$action = '/cadastrar/denuncia/';
			$nomeBotao = 'Cadastrar';
			$valueTipo = '';
			$nomeTipo = 'Selecione';
			
		}
	
?>		
		
		<form name='cadastro' method='POST' action='<?php echo $action; ?>' enctype='multipart/form-data'> 
			<div class='row'>
				<div class='col-md-12'>
					<div class='form-group'>
						<label class='control-label'>Tipo*</label>
						<select class='form-control' id='tipo' name='tipo' onblur='travarDestravarCamposDenunciante()' required />
							<option value='<?php echo $valueTipo ?>'><?php echo $nomeTipo ?></option>
							<option value='ANÔNIMA'>ANÔNIMA</option>
							<option value='IDENTIFICADA'>IDENTIFICADA</option>
						</select>
					</div> 
				</div>
			</div>
			<hr>
			<div class='row'>	
				<div class='col-md-3'>
					<div class='form-group'>
						<label class='control-label'>Nome do denunciante*</label>
						<input class='form-control' id='nome' name='nome' placeholder='Digite o nome (somente letras)' type='text' maxlength='50' minlength='4' pattern='[a*A*-z*Z*]*+' required
						
						<?php 
							if($this->conteudo == 'editar'){
								echo $camposDenunciante ; 
							}else{
								echo "value = '".$listaDados['DS_NOME_DENUNCIANTE']."'";
							} 
						?>
						
						
						/>
					</div> 
				</div>
				<div class='col-md-3'>
					<div class='form-group'>
						<label class='control-label'>CPF do denunciante</label>
						<input class='form-control' id='CPF' name='CPF' placeholder='Digite o CPF' type='text' <?php if($this->conteudo == 'editar'){echo $camposDenunciante ; }else{echo 'value = '.$listaDados['DS_CPF_DENUNCIANTE'];} ?> />				  
					</div>				
				</div>
				<div class='col-md-3'>
					<div class='form-group'>
						<label class='control-label'>E-mail do denunciante</label>
						<input class='form-control' id='email' name='email' placeholder='Digite o e-mail' type='email' 

						<?php 
							if($this->conteudo == 'editar'){
								echo $camposDenunciante ; 
							}else{
								echo "value = '".$listaDados['DS_EMAIL_DENUNCIANTE']."'";
							} 
						?>

						/>				  
					</div>				
				</div>
				<div class='col-md-3'>
					<div class='form-group'>
						<label class='control-label'>Telefone do denunciante</label>
						<input class='form-control' id='telefone' name='telefone' placeholder='Digite o telefone' type='text' maxlength='8' <?php if($this->conteudo == 'editar'){echo $camposDenunciante ; }else{echo 'value = '.$listaDados['DS_TELEFONE_DENUNCIANTE'];} ?> />				  
					</div>				
				</div>
			</div>	
			<hr>
			<div class='row'>	
				<div class='col-md-12'>
					<div class='form-group'>
						<label class='control-label'>Assunto*</label>
						<select class='form-control' id='assunto' name='assunto' required />
							<option value="<?php if($this->conteudo=='editar'){echo $listaDados['ID_ASSUNTO'];} ?>"><?php if($this->conteudo=='editar'){echo $listaDados['NOME_MACRO_ASSUNTO'] . " - " . $listaDados['NOME_MICRO_ASSUNTO'];}else{echo 'Selecione';} ?></option>
								<?php foreach($listaAssuntos as $assunto){ ?>
									<option value="<?php echo $assunto['ID'] ?>"><?php echo $assunto['DS_NOME_MACRO'] . ' - '.  $assunto['DS_NOME_MICRO'] ?></option> 
								<?php } ?>
						</select>
					</div>  
				</div>
			</div>
			<div class='row'>
				<div class='col-md-12'>
					<div class='form-group'>
						<label class='control-label'>Descrição do fato*</label>
						<textarea class='form-control' id='descricao' name='descricao' rows='15' required /><?php if($this->conteudo=='editar'){echo $listaDados['TX_DESCRICAO_FATO'];}else{echo "Seu texto aqui";} ?></textarea>
					</div>  
				</div>
			</div>			
			<div class='row'>
				<div class='col-md-6'>
					<div class='form-group'>
						<label class='control-label'>Órgão fato</label>
						<select class='form-control' id='orgao' name='orgao'/>
							<option value="<?php if($this->conteudo=='editar'){echo $listaDados['ID_ORGAO_DENUNCIADO'];} ?>"><?php if($this->conteudo=='editar'){echo $listaDados['ABREVIACAO_ORGAO'] . " - " . $listaDados['NOME_ORGAO'];}else{echo 'Selecione';} ?></option>
								<?php foreach($listaOrgaos as $orgao){ ?>
									<option value="<?php echo $orgao['ID'] ?>"><?php echo $orgao['DS_ABREVIACAO'] . " - " . $orgao['DS_NOME'] ?></option> 
								<?php } ?>
						</select>
					</div>  
				</div>
				<div class='col-md-6'>
					<div class='form-group'>
						<label class='control-label'>Município fato</label>
						<select class='form-control' id='municipio' name='municipio'/>
							<option value="<?php if($this->conteudo=='editar'){echo $listaDados['ID_MUNICIPIO_FATO'];} ?>"><?php if($this->conteudo=='editar'){echo $listaDados['NOME_MUNICIPIO'];}else{echo 'Selecione';} ?></option>
								<?php foreach($listaMunicipios as $municipio){ ?>
									<option value="<?php echo $municipio['ID'] ?>"><?php echo $municipio['DS_NOME'] ?></option> 
								<?php } ?>
						</select>
					</div>  
				</div>
			</div>
			<div class='row'>
				<div class='col-md-12'>
					<div class='form-group'>
						<label class='control-label'>Envolvidos</label>
						<input class='form-control' id='envolvidos' name='envolvidos' placeholder='Digite os envolvidos (máx 100 caracteres)' type='text' maxlength='100' value="<?php if($this->conteudo=='editar'){echo $listaDados['DS_ENVOLVIDOS'];} ?>"/>
					</div>  
				</div>
			</div>
			<div class='row'>
				<div class='col-md-6'>
					<div class='form-group'>
						<label class='control-label'>Data de registro no e-OUV*</label>
						<input class='form-control' id='dataRegistro' name='dataRegistro' type='date' value="<?php if($this->conteudo=='editar'){echo $listaDados['DT_REGISTRO_EOUV'];} ?>" required />
					</div>  
				</div>
				<div class='col-md-6'>
					<div class='form-group'>
						<label class='control-label'>Número do Processo vinculado cadastrado no SEI*</label>
						<input class='form-control' id='processo' name='processo' type='text' value="<?php if($this->conteudo=='editar'){echo $listaDados['DS_NUMERO_PROCESSO_SEI'];} ?>" required />
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
	
	public function triagem(){
		
		$listaDados = $_REQUEST['DADOS_DENUNCIA'];
		
		$listaServidores = $_REQUEST['LISTA_SERVIDORES'];
		
?>
		
	<form name='cadastro' method='POST' action="/editar/denuncia/triagem/<?php echo $listaDados['ID'] ?>/" enctype='multipart/form-data'> 
		<div class='row'>
			<div class='col-md-3'>
				<div class='form-group'>
					<label class='control-label'>Denúncia de acesso restrito</label>
					<select class='form-control' id='restrito' name='restrito' required />
						<option value=''>Selecione</option>
						<option value='SIM'>SIM</option>
						<option value='NÃO'>NÃO</option>
					</select>
				</div> 
			</div>
			<div class='col-md-3'>
				<div class='form-group'>
					<label class='control-label'>Responsável pela triagem</label>
					<select class='form-control' id='responsavel' name='responsavel' required />
						<option value="<?php if($this->conteudo=='editar'){echo $listaDados['ID_ASSUNTO'];} ?>"><?php if($this->conteudo=='editar'){echo $listaDados['NOME_MACRO_ASSUNTO'] . " - " . $listaDados['NOME_MICRO_ASSUNTO'];}else{echo 'Selecione';} ?></option>
							<?php foreach($listaServidores as $servidor){ ?>
								<option value="<?php echo $servidor['ID'] ?>"><?php echo $servidor['DS_NOME'] ?></option> 
							<?php } ?>
					</select>
				</div>  
			</div>
			<div class='col-md-3'>
				<div class='form-group'>
					<label class='control-label'>Grau de relevância do fato</label>
					<select class='form-control' id='relevancia' name='relevancia' required />
						<option value=''>Selecione</option>
						<option value='SIM'>SIM</option>
						<option value='NÃO'>NÃO</option>
					</select>
				</div> 
			</div>
			<div class='col-md-3'>
				<div class='form-group'>
					<label class='control-label'>Previsão para término da triagem</label>
					<input class='form-control' id='termino' name='termino' type='date' value="<?php if($this->conteudo=='editar'){echo $listaDados['DT_REGISTRO_EOUV'];} ?>" required />
				</div>  
			</div>
		</div>
		<hr>
		<div class='row'>
			<div class='col-md-3'>
				<div class='form-group'>
					<label class='control-label'>Resultado da triagem</label>
					<select class='form-control' id='resultado' name='resultado' required />
						<option value=''>Selecione</option>
						<option value='APTA'>APTA</option>
						<option value='NÃO'>NÃO</option>
					</select>
				</div> 
			</div>
		</div>
		<hr>
		<div class='row'>	
			<div class='col-md-6'>
				<label class='control-label' for='exampleInputEmail1'>Adicionar anexos</label>
				<a href='javascript:void(0)' onclick='adicionarAnexo()'>
					<i class='fa fa-plus-circle' aria-hidden='true'></i>
				</a>
			</div>
		</div>
		
		<div id='adicionarAnexo'>

		</div>
		<hr>
		<div class='row'>	
			<div class='col-md-6'>
				<label class='control-label' for='exampleInputEmail1'>Adicionar palavras-chave</label>
				<a href='javascript:void(0)' onclick='adicionarPalavrasChave()'>
					<i class='fa fa-plus-circle' aria-hidden='true'></i>
				</a>
			</div>
		</div>
		
		<div id='adicionarPalavraChave'>

		</div>
		<hr>
		<div class='row' id='cad-button'>
			<div class='col-md-12'>
				<button type='submit' class='btn btn-default' name='submit' value='Send' id='submit'>Triagem</button>
			</div>
		</div>
	</form>
		
		
		
		
		
		
		
		
<?php	
		
	}
	
	
	public function visualizar(){
		
		$lista = $_REQUEST['DADOS_PROCESSO'];
		
		$listaDocumentos = $_REQUEST['DOCUMENTOS_PROCESSO'];
		
		$listaResponsaveis = $_REQUEST['RESPONSAVEIS_PROCESSO'];
		
		$listaApensados = $_REQUEST['PROCESSOS_APENSADOS'];
		
		$historico = $_REQUEST['HISTORICO_PROCESSO'];
	
		$ativo = $_REQUEST['ATIVO'];	
		
		$apensado = $_REQUEST['APENSADO'];
		
		$listaServidores = $_REQUEST['LISTA_SERVIDORES'];
		
		$listaPodemSerResponsaveis = $_REQUEST['LISTA_PODEM_SER_RESPONSAVEIS'];
		
		$listaDenunciasApensar = $_REQUEST['LISTA_APENSAR']; ?>	
	
		
		<div class='container'>
			
			<?php if($ativo and !$lista['BL_RECEBIDO']){ ?>
			
					<div class='row linha-modal-processo'>
						<div class='alert alert-warning'>O processo físico foi recebido?
							<a href='/editar/processo/receber/<?php echo $lista['ID'] ?>/'>Sim</a>
							/
							<a href='/editar/processo/devolver/<?php echo $lista['ID'] ?>/'>Não</a>
						</div>
					</div>
 
		<?php		
					exit();
				} ?>
		</div>
		
				
<?php 	

		if($ativo){
			
			if($lista['BL_URGENCIA']){	?>						

				<div class='alert alert-warning'>&#9888; ESTE PROCESSO É URGENTE!</div>
 
<?php		} 
			
			
			if($lista['BL_SOBRESTADO']){ ?>

				<div class='alert alert-warning'>&#9888; ESTE PROCESSO ESTÁ EM SOBRESTADO!: <?php echo $lista['DS_JUSTIFICATIVA'] ?></div>
					
<?php   	} 
			
			
			if((!$apensado)){
						
?>						
						<div class='row linha-modal-processo'>

<?php	
							if(!$lista['BL_SOBRESTADO']){
?>
								
								<a href="/editar/processo/sobrestado/<?php echo $lista['ID'] ?>/1"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Marcar sobrestado&nbsp;&nbsp;&nbsp;<i class='fa fa-warning' aria-hidden='true'></i></button></a>
							
<?php	
							}else{
?>
								
								<a href="/editar/processo/sobrestado/<?php echo $lista['ID'] ?>/0"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Desmarcar sobrestado&nbsp;&nbsp;&nbsp;<i class='fa fa-warning' aria-hidden='true'></i></button></a>
							
<?php	
							}
							
							if(!$lista['BL_URGENCIA']){
?>
								
								<a href="/editar/processo/urgencia/<?php echo $lista['ID'] ?>/1"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-urgencia'>Marcar como urgente&nbsp;&nbsp;&nbsp;<i class='fa fa-warning' aria-hidden='true'></i></button></a>
							
<?php	
							}else{
?>
								
								<a href="/editar/processo/urgencia/<?php echo $lista['ID'] ?>/0"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-urgencia'>Desmarcar urgência&nbsp;&nbsp;&nbsp;<i class='fa fa-warning' aria-hidden='true'></i></button></a>
							
<?php	
							}
?>
								
								<a href="/processo/editar/<?php echo $lista['ID'] ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Editar&nbsp;&nbsp;&nbsp;<i class='fa fa-pencil' aria-hidden='true'></i></button></a>
						
								
								<a href="/excluir/processo/<?php echo $lista['ID'] ?>"><button type='submit' onclick="return confirm('Você tem certeza que deseja apagar este processo?');" class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Excluir&nbsp;&nbsp;&nbsp;<i class='fa fa-trash' aria-hidden='true'></i></button></a>
							
						</div>

						<div class='row linha-modal-processo'>

<?php 						
							if($lista['DS_STATUS']=='EM ANDAMENTO'){
								
								
?>								
								<a href="/editar/processo/status/<?php echo $lista['ID'] ?>/FINALIZADO PELO SETOR"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Finalizar em nome do setor&nbsp;&nbsp;&nbsp;<i class='fa fa-calendar-check-o' aria-hidden='true'></i></button></a>	
<?php	
							}
							
							if($lista['DS_STATUS']=='FINALIZADO PELO SETOR'){
?>
									
								<a href="/editar/processo/status/<?php echo $lista['ID'] ?>/FINALIZADO PELO GABINETE"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Finalizar em nome do gabinete&nbsp;&nbsp;&nbsp;<i class='fa fa-calendar-check-o' aria-hidden='true'></i></button></a>
								
								
								<a href="/editar/processo/desfazerstatus/<?php echo $lista['ID'] ?>/EM ANDAMENTO"><button type='submit' class='btn btn-sm btn-success pull-left' name='submit' value='Send' id='botao-dar-saida'>Desfazer finalização do setor&nbsp;&nbsp;<i class='fa fa-external-link-square' aria-hidden='true'></i></button></a>	
								
<?php	
							}
					
							if($lista['DS_STATUS']=='FINALIZADO PELO GABINETE'){
?>
								
								<a href="/editar/processo/desfazerstatus/<?php echo $lista['ID'] ?>/FINALIZADO PELO SETOR"><button type='submit' class='btn btn-sm btn-success pull-left'name='submit' value='Send' id='botao-dar-saida'>Desfazer finalização do gabinete&nbsp;&nbsp;<i class='fa fa-external-link-square' aria-hidden='true'></i></button></a>
								
								
								<a href="/editar/processo/status/<?php echo $lista['ID'] ?>/SAIU"><button type='submit' class='btn btn-sm btn-success pull-left' name='submit' value='Send' id='botao-dar-saida'>Dar saída&nbsp;&nbsp;<i class='fa fa-external-link-square' aria-hidden='true'></i></button></a>						
<?php	
							}if($lista['DS_STATUS']=='FINALIZADO PELO GABINETE' || $lista['DS_STATUS']=='FINALIZADO PELO SETOR'){
?>								
								
								<a href="/editar/processo/status/<?php echo $lista['ID'] ?>/ARQUIVADO"><button type='submit' class='btn btn-sm btn-warning pull-left' name='submit' value='Send' id='botao-arquivar'>Arquivar&nbsp;&nbsp;<i class='fa fa-folder' aria-hidden='true'></i></button></a>	
<?php
							}

?>					</div>
								
<?php			
			}
		
		
		}elseif(!$apensado){
					
					
			if($lista['DS_STATUS'] == 'SAIU'){ 
			
?>				
				<div class='row linha-modal-processo'>
					
					<a href="/editar/processo/voltar/<?php echo $lista['ID'] ?>"><button type='submit' class='btn btn-sm btn-success pull-left'name='submit' value='Send' id='botao-dar-saida'>Voltar processo&nbsp;&nbsp;<i class='fa fa-external-link-square' aria-hidden='true'></i></button></a>
					
				</div>
						
<?php

			}elseif($lista['DS_STATUS'] == 'ARQUIVADO'){

?>				
				<div class='row linha-modal-processo'>
					
					<a href="/editar/processo/desarquivar/<?php echo $lista['ID'] ?>"><button type='submit' class='btn btn-sm btn-success pull-left' name='submit' value='Send' id='botao-dar-saida'>Desarquivar&nbsp;&nbsp;<i class='fa fa-external-link-square' aria-hidden='true'></i></button></a>

				</div>
	
<?php		} 
		}
?>				
				<div class='row linha-modal-processo'>
					
					<div class='col-md-12'>
						
						STATUS: <?php echo $lista['DS_STATUS'] ?><br><br>
						
						Está com: <?php echo $lista['NOME_SERVIDOR'] ?><br>
						
						No Setor: <?php echo $lista['NOME_SETOR'] ?><br>

						Assunto: <?php echo $lista['NOME_ASSUNTO'] ?><br>
						
						Detalhes: <?php echo $lista['DS_DETALHES'] ?><br><br>
						
						Órgão interessado: <?php echo $lista['NOME_ORGAO'] ?><br>
						
						Nome do interessado: <?php echo $lista['DS_INTERESSADO'] ?><br><br>
						
						Dias no órgão: <?php echo $lista['NR_DIAS'] ?><br>
							
						Dias em sobrestado: <?php echo $lista['NR_DIAS_SOBRESTADO'] ?><br>	
												
						Data de entrada: <?php echo $lista['DT_ENTRADA'] ?><br>
						
						Prazo: <?php echo $lista['DT_PRAZO'] ?><br>
						
						Data de saída: <?php echo $lista['DT_SAIDA'] ?>	
						
						<br><br>
						
						
						Responsáveis: 
							
<?php 					foreach($listaResponsaveis as $responsavel){
																		
							echo $responsavel['NOME_SERVIDOR'];
							
							
							if($ativo){ ?>										
								<a href="/editar/processo/removerresponsavel/<?php echo $lista['ID'] ?>/<?php echo $responsavel['ID_SERVIDOR'] ?>" title='remover responsável'><i class='fa fa-remove' aria-hidden='true'></i></a>,
								
<?php							}
								
						} ?>							
						<br>
						
						
						Responsável líder:      
<?php                                 
							
							foreach($listaResponsaveis as $responsavel){

								if($responsavel['BL_LIDER']){
									
									echo $responsavel['NOME_SERVIDOR'];
									
								}

							}
							
?>
						<br><br>
						
						
						Processos apensados:
<?php 						foreach($listaApensados as $denunciaApensado){ ?>
							
								<a href='/processos/visualizar/<?php echo $denunciaApensado['ID_PROCESSO_APENSADO'] ?>'><?php echo $denunciaApensado['DS_NUMERO'] ?></a>
							
<?php							if($ativo){ ?>

									<a href="/editar/processo/removerapenso/<?php echo $lista['ID'] ?>/<?php echo $denunciaApensado['ID_PROCESSO_APENSADO'] ?>" title='remover apenso'><i class='fa fa-remove' aria-hidden='true'></i></a>,
								
<?php							}
							} ?>
							<br>
						
						
						Processo mãe:
							<a href='/processos/visualizar/<?php echo $lista['ID_PROCESSO_MAE'] ?>'><?php echo $lista['NUMERO_PROCESSO_MAE'] ?></a><br><br>
					</div>
				
				</div>
				
				
				<div class='row linha-modal-processo'>
					
					<b>Documentos do processo</b>:<br>
					
					<table class='table table-hover tabela-dados'>
						<thead>
							<tr>
								<th>Tipo</th>
								<th>Criador</th>
								<th>Data de criação</th>
								<th>Baixar</th>
								<th>Ação</th>
							</tr>	
						</thead>
						<tbody>
<?php 
							
							foreach($listaDocumentos as $documento){
								
?>
								<tr>
									<td><?php echo $documento['DS_TIPO']; ?></td>
									<td><?php echo $documento['NOME_CRIADOR']; ?></td>
									<td><?php echo $documento['DT_CRIACAO']; ?></td>
									<td>
										<a href="/_registros/anexos/<?php echo $documento['DS_ANEXO'] ?>" title="<?php echo $documento['DS_ANEXO']; ?>" download><?php echo substr($documento['DS_ANEXO'], 0, 20) . "..." ; ?>
										</a>
									</td>
									<td>
<?php 									
										if($ativo){
?> 							
											<a href="/editar/processo/excluirdocumento/<?php echo $lista['ID'] ?>/<?php echo $documento['ID'] ?>">Excluir</a>
											
<?php									}
							} ?>
									</td>
								</tr>
						</tbody>
					</table>
				</div>
				
<?php 			
				
				$this->carregarHistorico($historico);
				
		if($ativo){
											
				
				$this->carregarEnviarMensagem('processo', $lista['ID']); ?>
				
				
				<div class='row linha-modal-processo'>
					<form method='POST' action="/editar/processo/anexardocumento/<?php echo $lista['ID'] ?>" enctype='multipart/form-data'>	
						<div class='col-md-6'>
							<div class='form-group'>
								<label class='control-label'><b>Anexar documento:</b></label>
									
									<?php $this->carregarSelectTiposDocumento(); ?>
							</div>  
						</div>
						<div class='col-md-4'>
							<div class='form-group'>
								<label class='control-label'>Enviar anexo</label><br>
								<input type='file' class='' name='arquivoAnexo' id='arquivoAnexo'/>
							</div>
						</div>	
						<div class='col-md-2'>
							<br>
							<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Anexar &nbsp;&nbsp;<i class='fa fa-arrow-circle-right'  aria-hidden='true'></i></button>
						</div>
					</form>	
				</div>
				
<?php 		
			if(!$apensado){ 
				
				
				if(!$lista['BL_SOBRESTADO']){
			
?>					
					<div class='row linha-modal-processo'>
						<label class='control-label'><b>Solicitar Sobrestado:</b></label>
						<form method='POST' action="/editar/processo/solicitarsobrestado/<?php echo $lista['ID']?>" enctype='multipart/form-data'>	
							<div class='col-md-10'>
								<input class='form-control' id='justificativa' name='justificativa' placeholder='Digite aqui a sua justificativa (Máximo de 100 caracteres)' type='text' maxlength='100' required />	
							</div>
							<div class='col-md-2'>
								<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar' >Solicitar &nbsp;&nbsp;<i class='fa fa-arrow-circle-right' aria-hidden='true'></i></button>
							</div>
						</form>
					</div>	
<?php 		
				}
	
?>
				
				<div class='row linha-modal-processo'>
					<form method='POST' action="/editar/processo/definirresponsaveis/<?php echo $lista['ID'] ?>" enctype='multipart/form-data'>	
						<div class='col-md-10'>
							<label class='control-label'><b>Defina os responsáveis</b>:</label><br>
							<select multiple id='responsaveis' name='responsaveis[]' style='width: 96%;' required>
<?php 								
									foreach($listaPodemSerResponsaveis as $podeSerResponsavel){			
?>
										<option value="<?php echo $podeSerResponsavel['ID'] ?>">
											<?php echo "  " .$podeSerResponsavel['DS_NOME']; ?>
										</option>	
<?php 
									} 
?>
							</select>
						</div>
						<div class='col-md-2'>
							<br>
							<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Definir &nbsp;&nbsp;<i class='fa fa-arrow-circle-right' aria-hidden='true'></i></button>
						</div>
					</form>	
				</div>
				
<?php 			
				if(count($listaResponsaveis) > 1){
?>				
					<form name='teste' method='POST' action="/editar/processo/definirlider/<?php echo $lista['ID'] ?>" enctype='multipart/form-data'>
						<div class='row linha-modal-processo'>
							<div class='col-md-10'>
								<label class='control-label'><b>Defina o responsável líder</b>:</label><br>
								<select class='form-control' id='lider' name='lider' required >
									<option value=''>Selecione</option>
<?php									foreach($listaResponsaveis as $responsavel){ ?>	
										
											<option value="<?php echo $responsavel['ID_SERVIDOR'] ?>"><?php echo $responsavel['NOME_SERVIDOR']; ?></option>
										
<?php 									} 
?>								</select>
							</div>
							<div class='col-md-2'>
								<br>
								<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Definir &nbsp;&nbsp;<i class='fa fa-arrow-circle-right' aria-hidden='true'></i></button>
							</div>
						</div>
					</form>
				
<?php 							
				} 
?>
				
				<div class='row linha-modal-processo'>
					<form method='POST' action="/editar/processo/apensar/<?php echo $lista['ID'] ?>" enctype='multipart/form-data'>	
						<div class='col-md-10'>
							<label class='control-label'><b>Defina os Apensos</b>:</label><br>
							<select multiple id='apensos' name='apensos[]' style='width: 96%;' required>
<?php 							
								foreach($listaDenunciasApensar as $denuncia){
?>
									<option value="<?php echo $denuncia['ID'] ?>"><?php echo $denuncia['DS_NUMERO'] ?></option>
								
<?php 							} 
?>
							</select>
						</div>
						<div class='col-md-2'>
							<br>
							<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Apensar &nbsp;&nbsp;<i class='fa fa-arrow-circle-right'  aria-hidden='true'></i></button>
						</div>
					</form>	
				</div>
				
				
				<form name='teste' method='POST' action='/editar/processo/tramitar/<?php echo $lista['ID']?>/' enctype='multipart/form-data'>	
					<div class='row linha-modal-processo'>
						<div class='col-md-10'>
							<select class='form-control' id='tramitar' name='tramitar' required />
								<option value=''>Selecione o servidor para tramitar</option>
<?php 
									foreach($listaServidores as $servidor){
?>	
										<option value='<?php echo $servidor['ID'] ?>'><?php echo $servidor['DS_NOME'] ?></option>		
										
<?php									
									}
?>
							</select>
						</div>
						<div class='col-md-2'>
							<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Tramitar &nbsp;&nbsp;<i class='fa fa-arrow-circle-right' aria-hidden='true'></i></button>
						</div>
					</div>
				</form>
<?php
			}
		}
	}
	
	
	public function consulta(){

?>
		<form name='cadastro' method='POST' action='/consultar/processo/' enctype='multipart/form-data'> 
			<div class='row'>
				<div class='col-md-12'>
					<div class='form-group'>
						<input class='form-control' id='processoConsultar' name='processoConsultar' placeholder='Digite o número do processo que deseja consultar' type='text' maxlength='20' required />
					</div>  
				</div>
			</div>
			<div class='row' id='cad-button'>
				<div class='col-md-12'>
					<button type='submit' class='btn btn-default' name='submit' value='Send' id='submit'>Consultar</button>
				</div>
			</div>
		</form>

<?php
	}

	
	public function consultar(){
		
		$lista = $_REQUEST['DADOS_PROCESSO'];
		
		$historico = $_REQUEST['HISTORICO_PROCESSO'];
		
		$listaDocumentos = $_REQUEST['DOCUMENTOS_PROCESSO'];
		
		if($lista['DS_STATUS'] == 'SAIU'){
?>
			<div class='row linha-modal-processo'>
								
				<a href="/editar/processo/voltar/<?php echo $lista['ID'] ?>"><button type='submit' class='btn btn-sm btn-success pull-left'name='submit' value='Send' id='botao-dar-saida'>Voltar processo&nbsp;&nbsp;<i class='fa fa-external-link-square' aria-hidden='true'></i></button></a>
				
			</div>
<?php
		
		}elseif($lista['DS_STATUS'] == 'ARQUIVADO'){

?>	
			<div class='row linha-modal-processo'>
								
				<a href="/editar/processo/desarquivar/<?php echo $lista['ID'] ?>"><button type='submit' class='btn btn-sm btn-success pull-left' name='submit' value='Send' id='botao-dar-saida'>Desarquivar&nbsp;&nbsp;<i class='fa fa-external-link-square' aria-hidden='true'></i></button></a>

			</div>
		
<?php
		
		}
		
?>		
		<div class='row linha-modal-processo'>
					
			<div class='col-md-12'>
				
				STATUS: <?php echo $lista['DS_STATUS'] ?><br><br>
				
				Está com: <?php echo $lista['NOME_SERVIDOR'] ?><br>
				
				No Setor: <?php echo $lista['NOME_SETOR'] ?><br>

				Assunto: <?php echo $lista['NOME_ASSUNTO'] ?><br>
				
				Detalhes: <?php echo $lista['DS_DETALHES'] ?><br><br>
				
				Órgão interessado: <?php echo $lista['NOME_ORGAO'] ?><br>
				
				Nome do interessado: <?php echo $lista['DS_INTERESSADO'] ?><br><br>
				
				Dias no órgão: <?php echo $lista['NR_DIAS'] ?><br>
					
				Dias em sobrestado: <?php echo $lista['NR_DIAS_SOBRESTADO'] ?><br>	
										
				Data de entrada: <?php echo $lista['DT_ENTRADA'] ?><br>
				
				Prazo: <?php echo $lista['DT_PRAZO'] ?><br>
				
				Data de saída: <?php echo $lista['DT_SAIDA'] ?>
				
			</div>
		
		</div>
		
		<div class='row linha-modal-processo'>
					
			<b>Documentos do processo</b>:<br>
			
			<table class='table table-hover tabela-dados'>
				<thead>
					<tr>
						<th>Tipo</th>
						<th>Criador</th>
						<th>Data de criação</th>
						<th>Baixar</th>
					</tr>	
				</thead>
				<tbody>
<?php 
					
					foreach($listaDocumentos as $documento){
						
?>
						<tr>
							<td><?php echo $documento['DS_TIPO']; ?></td>
							<td><?php echo $documento['NOME_CRIADOR']; ?></td>
							<td><?php echo $documento['DT_CRIACAO']; ?></td>
							<td>
								<a href="/_registros/anexos/<?php echo $documento['DS_ANEXO'] ?>" title="<?php echo $documento['DS_ANEXO']; ?>" download><?php echo substr($documento['DS_ANEXO'], 0, 20) . "..." ; ?>
								</a>
							</td>							
<?php								 
								
					}

?>
						</tr>
				</tbody>
			</table>
		</div>
<?php 
		$this->carregarHistorico($historico);
	}
	
	
	
	public function relatorio(){
		
?>		

		<div class='row linha-grafico'>
			<div class='col-md-12' style='height: 40px;'>
				<center>
					<b>
						Total de processos: (ativos, arquivados e saíram): 
						
						<?php echo $_REQUEST['QTD_PROCESSOS_TOTAL']; ?>
					</b>
				</center>
			</div>
		</div>	
		

		
		<script type="text/javascript">
	
			google.charts.load('current', {packages: ['corechart', 'bar']});
			google.charts.setOnLoadCallback(drawStacked);
			
			

			function drawStacked() {
				  var data = google.visualization.arrayToDataTable([
					['Setor', 'Dentro do prazo', 'Atrasados'],
					
					
					 <?php 
				  
						$listaDenunciasAtrasadosPrazoPorSetor = $_REQUEST['QTD_PROCESSOS_ATRASADOS_PRAZO_SETOR'];
				  
						foreach($listaDenunciasAtrasadosPrazoPorSetor as $setor){ ?>
					 
						['<?php echo $setor['NOME_SETOR'] ?>',<?php echo $setor['QUANTIDADE_NO_PRAZO'] ?>,<?php echo $setor['QUANTIDADE_ATRASADOS'] ?>]<?php if($setor != end($listaDenunciasAtrasadosPrazoPorSetor)){ ?> , <?php } ?> 
					 
				  <?php } ?>
				  
				  
				  ]);

				  var options = {
					title: 'Quantidade de processos por setor',
					chartArea: {width: '50%'},
					isStacked: true,
					hAxis: {
					  title: 'Total',
					  minValue: 0,
					},
					vAxis: {
					  title: 'Setor'
					}
				  };
				  var chart = new google.visualization.BarChart(document.getElementById('processosAtrasadosNoPrazoPorSetor'));
				  chart.draw(data, options);
				}

		</script>

		<script type="text/javascript">
			  google.charts.load('current', {'packages':['corechart']});
			  google.charts.setOnLoadCallback(drawChart);

			  function drawChart() {
				  
				var data = google.visualization.arrayToDataTable([ ['Setor', 'Quantidade'],
				  
				  <?php 
				  
				  $listaDenunciasDentroDoPrazoSetor = $_REQUEST['QTD_PROCESSOS_PRAZO_SETOR'];
				  
				  foreach($listaDenunciasDentroDoPrazoSetor as $setor){ ?>
					 
					 ['<?php echo $setor['NOME_SETOR'] ?>',<?php echo $setor['QUANTIDADE'] ?>]<?php if($setor != end($listaDenunciasDentroDoPrazoSetor)){ ?> , <?php } ?> 
					 
					
				  
				  <?php } ?>

				]);

				var options = {
				  title: 'Processos dentro do prazo por setor'
				};

				var chart = new google.visualization.PieChart(document.getElementById('processosDentroDoPrazoSetor'));

				chart.draw(data, options);
			  }
		</script>

		<script type="text/javascript">
			  google.charts.load('current', {'packages':['corechart']});
			  google.charts.setOnLoadCallback(drawChart);

			  function drawChart() {
				  
				var data = google.visualization.arrayToDataTable([ ['Setor', 'Quantidade'],
				  
				  <?php 
				  
				  $listaDenunciasAtrasadosPorSetor = $_REQUEST['QTD_PROCESSOS_ATRASADOS_SETOR'];
				  
				  foreach($listaDenunciasAtrasadosPorSetor as $setor){ ?>
					 
					 ['<?php echo $setor['NOME_SETOR'] ?>',<?php echo $setor['QUANTIDADE'] ?>]<?php if($setor != end($listaDenunciasAtrasadosPorSetor)){ ?> , <?php } ?> 
					 
					
				  
				  <?php } ?>

				]);

				var options = {
				  title: 'Processos atrasados por setor'
				};

				var chart = new google.visualization.PieChart(document.getElementById('processosAtrasadosSetor'));

				chart.draw(data, options);
			  }
		</script>
		
		<center><div id="processosAtrasadosNoPrazoPorSetor" style="width: 900px; height: 500px;"></div></center>	
				
		<center><div id="processosAtrasadosSetor" style="width: 900px; height: 500px;"></div></center>	

		<center><div id="processosDentroDoPrazoSetor" style="width: 900px; height: 500px;"></div></center>
		
		
		<div class='row linha-grafico'>		
			<div class='col-md-12'>
				<div class='grafico' id='processos-ativos' >
					<center>
						<b>
							<?php 
								
								echo $_REQUEST['QTD_PROCESSOS_ATIVOS'];
							
								echo " (" . $_REQUEST['QTD_PROCESSOS_PRAZO'] . " dentro do prazo e "
							
								. $_REQUEST['QTD_PROCESSOS_ATRASADOS'] . " atrasados)";
							?>
						</b>
						
						<br>
						<br>
						
						<table class='table table-bordered'>
							<thead>
								<tr>
									<th>Setor</th>
									<th>Total de processos</th>
								</tr>
							</thead>
							<tbody>
<?php								
									foreach($_REQUEST['QTD_PROCESSOS_ATIVOS_SETOR'] as $setor){ ?>
										
										<tr>
											<td><?php echo $setor['NOME_SETOR'] ?></td>
											<td><?php echo $setor['QUANTIDADE'] ?></td>
										</tr>
<?php	
									}
?>								
							</tbody>	
						</table>	
					</center>
				</div>
			</div>
		</div>
		
		<div class='row linha-grafico'>		
			<div class='col-md-12'>
				<div class='grafico' id='processos-ativos' >
					<center>
						<table class='table table-bordered'>
							<thead>
								<tr>
									<th>Setor</th>
									<th>Total de processos dentro do prazo</th>
									<th>Ação</th>
								</tr>
							</thead>
							<tbody>
<?php								
									foreach($_REQUEST['QTD_PROCESSOS_PRAZO_SETOR'] as $setor){ ?>
										
										<tr>
											<td><?php echo $setor['NOME_SETOR'] ?></td>
											<td><?php echo $setor['QUANTIDADE'] ?></td>
											<td><a target='_blank' href="/index.php?acao=exportar&modulo=Processos&filtroservidor=%&filtrosetor=<?php echo $setor['ID'] ?>&filtrosituacao=0&filtrosobrestado=%&filtrorecebido=%&filtrodias=%&filtroprocesso=%">Ver</a></td>
										</tr>
<?php	
									}
?>								
							</tbody>	
						</table>	
					</center>
				</div>
			</div>
		</div>
		
		<div class='row linha-grafico'>		
			<div class='col-md-12'>
				<div class='grafico' id='processos-ativos' >
					<center>
						<table class='table table-bordered'>
							<thead>
								<tr>
									<th>Setor</th>
									<th>Total de processos atrasados</th>
									<th>Ação</th>
								</tr>
							</thead>
							<tbody>
<?php								
									foreach($_REQUEST['QTD_PROCESSOS_ATRASADOS_SETOR'] as $setor){ ?>
										
										<tr>
											<td><?php echo $setor['NOME_SETOR'] ?></td>
											<td><?php echo $setor['QUANTIDADE'] ?></td>
											<td><a target='_blank' href="/index.php?acao=exportar&modulo=Processos&filtroservidor=%&filtrosetor=<?php echo $setor['ID'] ?>&filtrosituacao=1&filtrosobrestado=%&filtrorecebido=%&filtrodias=%&filtroprocesso=%">Ver</a></td>
										</tr>
<?php	
									}
?>								
							</tbody>	
						</table>	
					</center>
				</div>
			</div>
		</div>
		
		<div class='row linha-grafico'>		
			<div class='col-md-12'>
				<div class='grafico' id='processos-ativos' >
					<center>
						<table class='table table-bordered'>
							<thead>
								<tr>
									<th>Setor</th>
									<th>Total de processos em andamento</th>
								</tr>
							</thead>
							<tbody>
<?php								
									foreach($_REQUEST['QTD_PROCESSOS_ANDAMENTO_SETOR'] as $setor){ ?>
										
										<tr>
											<td><?php echo $setor['NOME_SETOR'] ?></td>
											<td><?php echo $setor['QUANTIDADE'] ?></td>
										</tr>
<?php	
									}
?>								
							</tbody>	
						</table>	
					</center>
				</div>
			</div>
		</div>
		
		<div class='row linha-grafico'>		
			<div class='col-md-12'>
				<div class='grafico' id='processos-ativos' >
					<center>
						<table class='table table-bordered'>
							<thead>
								<tr>
									<th>Setor</th>
									<th>Total de processos finalizados pelo setor</th>
								</tr>
							</thead>
							<tbody>
<?php								
									foreach($_REQUEST['QTD_PROCESSOS_FINALIZADOS_S_SETOR'] as $setor){ ?>
										
										<tr>
											<td><?php echo $setor['NOME_SETOR'] ?></td>
											<td><?php echo $setor['QUANTIDADE'] ?></td>
										</tr>
<?php	
									}
?>								
							</tbody>	
						</table>	
					</center>
				</div>
			</div>
		</div>
		
		<div class='row linha-grafico'>		
			<div class='col-md-12'>
				<div class='grafico' id='processos-ativos' >
					<center>
						<table class='table table-bordered'>
							<thead>
								<tr>
									<th>Setor</th>
									<th>Total de processos finalizados pelo gabinete</th>
								</tr>
							</thead>
							<tbody>
<?php								
									foreach($_REQUEST['QTD_PROCESSOS_FINALIZADOS_G_SETOR'] as $setor){ ?>
										
										<tr>
											<td><?php echo $setor['NOME_SETOR'] ?></td>
											<td><?php echo $setor['QUANTIDADE'] ?></td>
										</tr>
<?php	
									}
?>								
							</tbody>	
						</table>	
					</center>
				</div>
			</div>
		</div>
		
		
		<div class='row linha-grafico'>		
			<div class='col-md-12'>
				<div class='grafico' id='processos-ativos'>
					<center>
						<b>
							<?php 
								echo 'Tempo médio dos processos: ' . number_format($_REQUEST['TEMPO_MEDIO_PROCESSO'],0) . ' dias';
							?>
						</b>
					</center>
						<table class='table table-bordered'>
							<thead>
								
									<tr>
										<th><center>Assunto</center></th>
										<th><center>Média</center></th>
									</tr>
					
							</thead>
							<tbody>
					
<?php
									$lista = $_REQUEST['TEMPO_MEDIO_ASSUNTO'];
									
									
									foreach($lista as $assunto){ 
?>
										<tr>
											<td><center><?php echo $assunto['NOME_ASSUNTO'] ?></center></td>
											<td><center><?php echo number_format($assunto['MEDIA'],0) . " dias" ?></center></td>
										</tr>
<?php								}
?>
								
							</tbody>	
						</table>
					</center>
				</div>
			</div>
		</div>

<?php	
	
	}

}