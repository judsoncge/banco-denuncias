<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/view/View.php';

class DenunciasView extends View{
	
	
	public function adicionarScripts(){
	
		
		if($this->conteudo == 'listar'){ ?>
			<script src='/view/_libs/js/filtros.js'></script>
			<!--<script src='/view/_libs/js/exportar.js'></script>-->
			<script type='text/javascript'>
				function esconderMostrarFiltro(){
					
					var x = document.getElementById('filtro');
					if (x.style.display === 'none') {
						x.style.display = 'block';
						document.getElementById('esconderMostrar').innerHTML="<a href='javascript:void(0)' onclick='esconderMostrarFiltro()'>esconder filtro</a>";
					} else {
						x.style.display = 'none';
						document.getElementById('esconderMostrar').innerHTML="<a href='javascript:void(0)' onclick='esconderMostrarFiltro()'>mostrar filtro</a>";
					}
				}
			</script>
	
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
		
		}elseif($this->conteudo == 'cadastrar' or $this->conteudo == 'editar' or $this->conteudo == 'triagem'){ ?>
		
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
							"Selecione o anexo: <a href='javascript:void(0)' title='remover' onclick='removerAnexo("+id+");'><i class='fa fa-times' aria-hidden='true'></i></a><br>"+
								"<input type='file' id='selecao-arquivo' name='anexos[]' id='anexo' required />"+	
						"</div>"+
					"</div>"+
					"<div class='row'>"+
						"<div class='col-md-4'>"+
							"Tipo:<br>"+
							"<select id='tipos' name='tipos[]' required>:"+
								"<option value=''>Selecione</option>"+	
								"<option value='CADASTRO'>CADASTRO</option>"+	
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
					
					newdiv.setAttribute("name", "palavra-"+idPalavra);
					
					newdiv.setAttribute("id", "palavra-"+idPalavra);
					
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
					
					document.getElementById("palavra-"+idPalavra).innerHTML=""; 
					
				}
				
			</script>
        
			
			<script src='/view/_libs/tinymce/tinymce.min.js'></script>
		
			<script>tinymce.init({ selector:'textarea', language:'pt_BR' })</script>

			<script type="text/javascript">
				function travarDestravarCamposDenunciante(){
					
					var tipo = document.getElementById("tipo").value;
					
					if(tipo == 'NÃO IDENTIFICADA'){
						
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
		}elseif($this->conteudo == 'andamento'){  $listaUnidadesApuracao = $_REQUEST['LISTA_UNIDADES_APURACAO'];	?>
		
			<script type='text/javascript'>
		
				var id_row = 1;
				var id = 1;
				
				
				function adicionarTrilha(){
					
					var newdiv = document.createElement('div');
					
					newdiv.setAttribute("name", "campos"+id);
					
					newdiv.setAttribute("id", id);
					
					newdiv.innerHTML = 
					"<div class='row'>"+
						"<div class='col-md-2'>"+
							"Nome da trilha:<br>"+
							"<input class='form-control' id='nomes' name='nomes[]' type='text' maxlength='50' placeholder='Máx. 50 caracteres'required/>"+	
						"</div>"+
						"<div class='col-md-2'>"+
							"Gerar Alerta?<br>"+
							"<select id='gerarAlertas' name='gerarAlertas[]' required >:"+
								"<option value=''>Selecione</option>"+	
								"<option value='1'>SIM</option>"+	
								"<option value='0'>NÃO</option>"+	
							"</select>"+	
						"</div>"+
						"<div class='col-md-4'>"+
							"Unidade de apuração<br>"+
							"<select id='unidades' name='unidades[]' required >:"+
								"<option value=''>Selecione</option>"+	
								<?php foreach($listaUnidadesApuracao as $unidade){ ?>
								"<option value='<?php echo $unidade['ID'] ?>'><?php echo $unidade['DS_NOME'] ?></option>"+
								<?php } ?>							
							"</select>"+	
						"</div>"+
						"<div class='col-md-2'>"+
							"Periodicidade:<br>"+
							"<input class='form-control' placeholder='Em dias' id='periodicidades' name='periodicidades[]' type='number' required />"+	
						"</div>"+
						"<div class='col-md-2'>"+
							"Possui agrupador?<br>"+
							"<select id='agrupadores' name='agrupadores[]' required>:"+
								"<option value=''>Selecione</option>"+	
								"<option value='1'>SIM</option>"+	
								"<option value='0'>NÃO</option>"+	
							"</select>"+	
						"</div>"+
					"</div>"+
					"</div><a href='javascript:void(0)' onclick='removerTrilha("+id+");'>Remover</a><hr>";
					
					var nova_anexo = document.getElementById("adicionarTrilha");

					nova_anexo.appendChild(newdiv);
					
					id++;
				}
				
				
				function removerTrilha(id){
					
					document.getElementById(id).innerHTML=""; 
					
				}
				
			</script>
		
		<?php }
	}
	
	public function carregarFiltro(){
		
		
		$listaServidores = $_REQUEST['LISTA_SERVIDORES']; 
		
		$listaUnidades = $_REQUEST['LISTA_UNIDADES_APURACAO']; 
		
		$listaMunicipios = $_REQUEST['LISTA_MUNICIPIOS']; 
		
		$listaAssuntos = $_REQUEST['LISTA_ASSUNTOS'];

?>	

		<div class='well'>
			<div id='esconderMostrar' class='row' style='text-align:center;'>
				<a href='javascript:void(0)' onclick='esconderMostrarFiltro()'>mostrar filtro</a>
			</div>
			<hr>
			<div id='filtro' style='display:none;'>
				<form>
					<div class='row'>	
						<div class='col-md-3'>
							<div class='form-group'>
								<label class='control-label' title='Número da denúncia'>NCD</label><br>
								<input class='form-control' type='text' id='filtroncd' name='filtroncd'>
							</div>
						</div>
						<div class='col-md-3'>
							<div class='form-group'>
								<label class='control-label'>Situação Denúncia</label><br>
									<select class='form-control'  id='filtrosituacao' name='filtrosituacao'>
										<option value='%'>Todos</option>
										<option value='AGUARDANDO TRIAGEM'>AGUARDANDO TRIAGEM</option>
										<option value='EM TRIAGEM'>EM TRIAGEM</option>
										<option value='APTA'>APTA</option>
										<option value='NÃO APTA'>NÃO APTA</option>
									</select>
							</div>
						</div>
						<div class='col-md-3'>
							<div class='form-group'>
								<label class='control-label'>Responsável</label><br>
								<select class='form-control'  id='filtroresponsavel' name='filtroresponsavel'>
									<option value='%'>Todos</option>
									<?php foreach($listaServidores as $servidor){ ?>
											<option value='<?php echo $servidor['ID'] ?>'>
												<?php echo $servidor['DS_NOME']; ?>
											</option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class='col-md-3'>
							<div class='form-group'>
								<label  class='control-label'>Unidade Apuração</label><br>
									<select class='form-control' id='filtrounidade' name='filtrounidade'>
										<option value='%'>Todos</option>
										<?php foreach($listaUnidades as $unidade){ ?>
											<option value='<?php echo $unidade['ID'] ?>'>
												<?php echo $unidade['DS_ABREVIACAO'] . ' - ' . $unidade['DS_NOME']; ?>
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
									<select class='form-control'  id='filtroassunto' name='filtroassunto'>
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
					<div class='row'>
						<div class='col-md-3'>
							<div class='form-group'>
								<label class='control-label'>Município</label><br>
									<select class='form-control'  id='filtromunicipio' name='filtromunicipio'>
										<option value='%'>Todos</option>
										<?php foreach($listaMunicipios as $municipio){ ?>
												<option value='<?php echo $municipio['ID'] ?>'>
													<?php echo $municipio['DS_NOME']; ?>
												</option>
										
										<?php } ?>
									</select>
							</div>
						</div>
						<div class='col-md-3'>
							<div class='form-group'>
								<label class='control-label'>Período</label><br>
								<input class='form-control' type='date' id='filtroperiodo' name='filtroperiodo' >
							</div>
						</div>
						<div class='col-md-3'>
							<div class='form-group'>
								<label class='control-label'>Acesso restrito</label><br>
									<select class='form-control'  id='filtrorestrito' name='filtrorestrito'>
										<option value='%'>Todos</option>
										<option value='1'>SIM</option>
										<option value='0'>NÃO</option>
									</select>
							</div>
						</div>
						<div class='col-md-3'>
							<div class='form-group'>
								<label class='control-label'>Situação Análise</label><br>
									<select class='form-control'  id='filtroanalise' name='filtroanalise'>
										<option value='%'>Todos</option>
										<option value='PROCEDENTE'>PROCEDENTE</option>
										<option value='NÃO PROCEDENTE - NÃO OCORRÊNCIA DO FATO DENUNCIADO'>NÃO PROCEDENTE - NÃO OCORRÊNCIA DO FATO DENUNCIADO</option>
										<option value='NÃO PROCEDENTE - INEXISTÊNCIA DE PROVAS'>NÃO PROCEDENTE - INEXISTÊNCIA DE PROVAS</option>
									</select>
							</div>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-12'>
							<div class='form-group'>
								<label class='control-label'>Palavras-chave</label><br>
								<input type='text' class='form-control'  id='filtropalavrachave' name='filtropalavrachave' placeholder='utilize vírgulas para separar as palavras'/>
							</div>
						</div>
					</div>
				</form>
			</div>
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
						<!--<button onclick='javascript: exportar();' class='btn btn-sm btn-success' name='submit' value='Send'>Exportar</button>-->
					</div>
					
				</h5>
			</center>
		
			<table class='table table-hover tabela-dados'>
				<thead>
					<tr>
						<th>Número</th>
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
							<td><?php echo $denuncia['DS_NUMERO'] ?></td>
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
								
								<?php if(!$denuncia['BL_TRIAGEM_CONCLUIDA']){ ?>
									<a href="/denuncias/triagem/<?php echo $denuncia['ID'] ?>" >
										<button type='button' class='btn btn-secondary btn-sm' title='Fazer Triagem'>
											<i class='fa fa-exchange' aria-hidden='true'></i>
										</button>
									</a>
								
								
								<a href="/denuncias/editar/<?php echo $denuncia['ID'] ?>">
									<button type='button' class='btn btn-secondary btn-sm' title='Editar'>
										<i class='fa fa-pencil' aria-hidden='true'></i>
									</button>
								</a>

								<?php }else{ ?>
								
									<a href="/denuncias/andamento/<?php echo $denuncia['ID'] ?>" >
										<button type='button' class='btn btn-secondary btn-sm' title='Dar andamento'>
											<i class='fa fa-forward' aria-hidden='true'></i>
										</button>
									</a>
								
								<?php }
								
								if($denuncia['DS_STATUS'] != 'NÃO TRATADA'){ ?>
								
									<a href="/editar/denuncia/encerrar/<?php echo $denuncia['ID'] ?>/" >
										<button type='button' class='btn btn-secondary btn-sm' title='Encerrar Denúncia'>
											<i class='fa fa-check' aria-hidden='true'></i>
										</button>
									</a>
								
								<?php } ?>
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
		
		$listaAnexos = ($this->conteudo == 'cadastrar') ? NULL : $_REQUEST['LISTA_ANEXOS'];
		
		if($this->conteudo == 'editar'){
			
			$listaDados = $_REQUEST['DADOS_DENUNCIA'];
			$action = "/editar/denuncia/info/".$listaDados['ID']."/";
			$nomeBotao = 'Editar';
			$valueTipo = $listaDados['DS_TIPO'];
			$nomeTipo = $listaDados['DS_TIPO'];
			
	
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
							<option value='NÃO IDENTIFICADA'>NÃO IDENTIFICADA</option>
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
								echo "value = '".$listaDados['DS_NOME_DENUNCIANTE']."' disabled";
							}
						?>
						
						
						/>
					</div> 
				</div>
				<div class='col-md-3'>
					<div class='form-group'>
						<label class='control-label'>CPF do denunciante</label>
						<input class='form-control' id='CPF' name='CPF' placeholder='Digite o CPF' type='text' 
						<?php 
							if($this->conteudo == 'editar'){
								echo "value = '".$listaDados['DS_CPF_DENUNCIANTE']."' disabled";
							}
						?> 
						/>				  
					</div>				
				</div>
				<div class='col-md-3'>
					<div class='form-group'>
						<label class='control-label'>E-mail do denunciante</label>
						<input class='form-control' id='email' name='email' placeholder='Digite o e-mail' type='email' 

						<?php 
							if($this->conteudo == 'editar'){
								echo "value = '".$listaDados['DS_EMAIL_DENUNCIANTE']."' disabled"; 
							}
						?>

						/>				  
					</div>				
				</div>
				<div class='col-md-3'>
					<div class='form-group'>
						<label class='control-label'>Telefone do denunciante</label>
						<input class='form-control' id='telefone' name='telefone' placeholder='Digite o telefone' type='text' maxlength='8' 
						<?php 
							if($this->conteudo == 'editar'){
								echo "value = '".$listaDados['DS_TELEFONE_DENUNCIANTE']."' disabled";
							}
						?>
						/>				  
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
						<textarea class='form-control' id='descricao' name='descricao' rows='15' required /><?php if($this->conteudo=='editar'){echo $listaDados['TX_DESCRICAO_FATO'];}else{echo '.';} ?></textarea>
					</div>  
				</div>
			</div>			
			<div class='row'>
				<div class='col-md-6'>
					<div class='form-group'>
						<label class='control-label'>Órgão do fato</label>
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
						<label class='control-label'>Município do fato</label>
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
				<div class='col-md-4'>
					<div class='form-group'>
						<label class='control-label'>Data de registro no e-OUV*</label>
						<input class='form-control' id='dataRegistro' name='dataRegistro' type='date'  value="<?php if($this->conteudo=='editar'){echo $listaDados['DT_REGISTRO_EOUV'];} ?>" required />
					</div>  
				</div>
				<div class='col-md-4'>
					<div class='form-group'>
						<label class='control-label'>Número do Protocolo Vinculado ao EOUV*</label>
						<input class='form-control' id='protocolo' name='protocolo' type='text' value="<?php if($this->conteudo=='editar'){echo $listaDados['DS_PROTOCOLO_EOUV'];} ?>" maxlength='10' required />
					</div>  
				</div>
				<div class='col-md-4'>
					<div class='form-group'>
						<label class='control-label'>Número do Processo vinculado cadastrado no SEI*</label>
						<input class='form-control' id='processo' name='processo' type='text' value="<?php if($this->conteudo=='editar'){echo $listaDados['DS_NUMERO_PROCESSO_SEI'];} ?>" required />
					</div>  
				</div>
			</div>
			<hr>
			<?php if($listaAnexos != NULL and $this->conteudo == 'editar'){ ?>
			<div class='row'>	
				<div class='col-md-12'>
					<label class='control-label'>Anexos cadastrados</label>
					<div class='well'>
					<?php
						foreach($listaAnexos as $anexo){
							
							echo $anexo['NM_ARQUIVO'] . " <a href='/editar/denuncia/remover-anexo/".$listaDados['ID']."/".$anexo['ID']."/".$anexo['NM_ARQUIVO']."/'>remover</a><br> "; 
							
						}
					?>	
					</div>
				</div>
			</div>
			<hr>
			<?php } ?>
			<div class='row'>	
				<div class='col-md-6'>
					<label class='control-label'>Adicionar anexos</label>
					<a href='javascript:void(0)' onclick='adicionarAnexo()'>
						<i class='fa fa-plus-circle' aria-hidden='true'></i>
					</a>
				</div>
			</div>
			<div id='adicionarAnexo'>

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
		
		$listaUnidadesApuracao = $_REQUEST['LISTA_UNIDADES_APURACAO'];
		
		$listaAnexos = $_REQUEST['LISTA_ANEXOS'];
		
		$listaPalavrasChave = $_REQUEST['LISTA_PALAVRAS_CHAVE'];
		
?>	
	<div class='well' style='height:70px;'>
		<a href="/denuncias/listar/0"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'><i class='fa fa-arrow-left' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;Voltar</button></a>
		
		<?php if($listaDados['DS_SITUACAO']!='AGUARDANDO TRIAGEM' AND $listaDados['DS_SITUACAO']!='EM TRIAGEM') { ?>
			<a href="/editar/denuncia/concluir/<?php echo $listaDados['ID'] ?>/"><button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-dar-saida'>Concluir Triagem</button></a>
		<?php } ?>
	</div>
	<hr>
	<form name='cadastro' method='POST' action="/triagem/<?php echo $listaDados['ID'] ?>" enctype='multipart/form-data'> 
		<div class='row'>
			<div class='col-md-3'>
				<?php 
					if($listaDados['BL_ACESSO_RESTRITO'] != NULL){
						$interfaceRestrito = ($listaDados['BL_ACESSO_RESTRITO']) ? 'SIM' : 'NÃO';
						$valueRestrito = ($listaDados['BL_ACESSO_RESTRITO']) ? 1 : 0;
					}else{
						$interfaceRestrito = 'Selecione';
						$valueRestrito = ''; 
					} 
				?>
				<div class='form-group'>
					<label class='control-label'>Denúncia de acesso restrito</label>
					<select class='form-control' id='restrito' name='restrito' />
						<option value='<?php echo $valueRestrito ?>'><?php echo $interfaceRestrito ?></option>
						<option value='1'>SIM</option>
						<option value='0'>NÃO</option>
					</select>
				</div> 
			</div>
			<div class='col-md-3'>
				<?php 
					$interfaceResponsavel = ($listaDados['ID_RESPONSAVEL_TRIAGEM'] != NULL) ? $listaDados['NOME_RESPONSAVEL_TRIAGEM'] : 'Selecione';
					$valueResponsavel = ($listaDados['ID_RESPONSAVEL_TRIAGEM'] != NULL) ? $listaDados['ID_RESPONSAVEL_TRIAGEM'] : '';
				?>
				<div class='form-group'>
					<label class='control-label'>Responsável pela triagem</label>
					<select class='form-control' id='responsavel' name='responsavel' />
						<option value="<?php echo $valueResponsavel ?>"><?php echo $interfaceResponsavel ?></option>
							<?php foreach($listaServidores as $servidor){ ?>
								<option value="<?php echo $servidor['ID'] ?>"><?php echo $servidor['DS_NOME'] ?></option> 
							<?php } ?>
					</select>
				</div>  
			</div>
			<div class='col-md-3'>
				<?php 
					$interfaceRelevancia = ($listaDados['DS_RELEVANCIA'] != NULL) ? $listaDados['DS_RELEVANCIA'] : 'Selecione';
					$valueRelevancia = ($listaDados['DS_RELEVANCIA'] != NULL) ? $listaDados['DS_RELEVANCIA'] : '';
				?>
				<div class='form-group'>
					<label class='control-label'>Grau de relevância do fato</label>
					<select class='form-control' id='relevancia' name='relevancia' />
						<option value='<?php echo $valueRelevancia ?>'><?php echo $interfaceRelevancia ?></option>
						<option value='BAIXO'>BAIXO</option>
						<option value='MÉDIO'>MÉDIO</option>
						<option value='ALTO'>ALTO</option>
					</select>
				</div> 
			</div>
			<div class='col-md-3'>
				<?php 
					$data = ($listaDados['DT_TERMINO_TRIAGEM'] != NULL) ? $listaDados['DT_TERMINO_TRIAGEM'] : '';
				?>
				<div class='form-group'>
					<label class='control-label'>Previsão para término da triagem</label>
					<input class='form-control' id='termino' name='termino' type='date'  value="<?php echo $data ?>" />
				</div>  
			</div>
		</div>
		<div class='row'>
			<div class='col-md-4'>
				<?php 
					$interfaceResultado = ($listaDados['DS_ANDAMENTO'] != NULL) ? $listaDados['DS_ANDAMENTO'] : 'Selecione';
					$valueResultado = ($listaDados['DS_ANDAMENTO'] != NULL) ? $listaDados['DS_ANDAMENTO'] : '';
				?>
				<div class='form-group'>
					<label class='control-label'>Andamento da triagem</label>
					<select class='form-control' id='andamento' name='andamento' required />
						<option value='<?php echo $valueResultado ?>'><?php echo $interfaceResultado ?></option>
						<option value='AGUARDANDO COMPLEMENTAÇÃO DO DENUNCIANTE'>AGUARDANDO COMPLEMENTAÇÃO DO DENUNCIANTE</option>
						<option value='AGUARDANDO ANÁLISE PRELIMINAR DA OUVIDORIA'>AGUARDANDO ANÁLISE PRELIMINAR DA OUVIDORIA</option>
					</select>
				</div> 
			</div>
			<div class='col-md-4'>
				<?php 
					$interfaceResultado = ($listaDados['DS_SITUACAO'] != NULL) ? $listaDados['DS_SITUACAO'] : 'Selecione';
					$valueResultado = ($listaDados['DS_SITUACAO'] != NULL) ? $listaDados['DS_SITUACAO'] : '';
				?>
				<div class='form-group'>
					<label class='control-label'>Resultado da triagem</label>
					<select class='form-control' id='situacao' name='situacao' required />
						<option value='<?php echo $valueResultado ?>'><?php echo $interfaceResultado ?></option>
						<option value='EM TRIAGEM'>EM TRIAGEM</option>
						<option value='APTA'>APTA</option>
						<option value='NÃO APTA'>NÃO APTA</option>
					</select>
				</div> 
			</div>
			<div class='col-md-4'>
				<?php 
					$interfaceUnidade = ($listaDados['ID_UNIDADE_APURACAO'] != NULL) ? $listaDados['ABREVIACAO_ORGAO'] . ' - ' . $listaDados['ABREVIACAO_UNIDADE'] . ' - ' . $listaDados['NOME_UNIDADE'] : 'Selecione';
					
					$valueUnidade = ($listaDados['ID_UNIDADE_APURACAO'] != NULL) ? $listaDados['ID_UNIDADE_APURACAO'] : '';
				?>
				<div class='form-group'>
					<label class='control-label'>Unidade de apuração</label>
					<select class='form-control' id='unidadeApuracao' name='unidadeApuracao' required />
						<option value='<?php echo $valueUnidade ?>'><?php echo $interfaceUnidade ?></option>
						<?php foreach($listaUnidadesApuracao as $unidadeApuracao){ ?>
							<option value='<?php echo $unidadeApuracao['ID'] ?>'><?php echo $unidadeApuracao['ABREVIACAO_ORGAO'] . ' - ' .$unidadeApuracao['DS_ABREVIACAO'] . ' - ' . $unidadeApuracao['DS_NOME'] ; ?></option>
						<?php } ?>
					</select>
				</div> 
			</div>
		</div>
		<?php if($listaAnexos != NULL or $listaPalavrasChave != NULL ){ ?>
		<hr>
		<div class='row'>	
			<div class='col-md-6'>
				<label class='control-label'>Anexos cadastrados</label>
				<div class='well'>
				<?php
					foreach($listaAnexos as $anexo){
						
						echo $anexo['NM_ARQUIVO'] . " <a href='/editar/denuncia/remover-anexo/".$listaDados['ID']."/".$anexo['ID']."/".$anexo['NM_ARQUIVO']."/'>remover</a><br> "; 
						
					}
				?>	
				</div>
			</div>
			<div class='col-md-6'>
				<label class='control-label'>Palavras-chave cadastradas</label>
				<div class='well'>
				<?php
					foreach($listaPalavrasChave as $palavraChave){
						
						echo $palavraChave['DS_PALAVRA_CHAVE'] . " <a href='/editar/denuncia/remover-palavra-chave/".$listaDados['ID']."/".$palavraChave['ID']."'>remover</a><br> "; 
						
					}
				?>	
				</div>
			</div>
		
		
		</div>
		<?php } ?>
		<hr>
		<div class='row'>	
			<div class='col-md-6'>
				<label class='control-label'>Adicionar anexos</label>
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
				<label class='control-label'>Adicionar palavras-chave</label>
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
				<button type='submit' class='btn btn-default' name='submit' value='Send' id='submit'>Salvar Triagem</button>
			</div>
		</div>
	</form>

<?php	
		
	}
	
	public function andamento(){
		
		$listaDados = $_REQUEST['DADOS_DENUNCIA'];
				
?>		
	<div style='height:70px;'>
		<a href="/denuncias/listar/0"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'><i class='fa fa-arrow-left' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;Voltar</button></a>
	</div>
	<form name='cadastro' method='POST' action="/andamento/<?php echo $listaDados['ID'] ?>" enctype='multipart/form-data'> 
		<div class='row'>
			<div class='col-md-4'>
				<div class='form-group'>
					<label class='control-label'>Status da Denúncia</label>
					<select class='form-control' id='status' name='status' required />
						<option value=''>Selecione</option>
						<option value='PROCEDENTE'>PROCEDENTE</option>
						<option value='NÃO PROCEDENTE - NÃO OCORRÊNCIA DO FATO DENUNCIADO'>NÃO PROCEDENTE - NÃO OCORRÊNCIA DO FATO DENUNCIADO</option>
						<option value='NÃO PROCEDENTE - INEXISTÊNCIA DE PROVAS'>NÃO PROCEDENTE - INEXISTÊNCIA DE PROVAS</option>
					</select>
				</div> 
			</div>
			<div class='col-md-3'>
				<div class='form-group'>
					<label class='control-label'>Comentário</label>
					<input class='form-control' type='text' id='comentario' name='comentario[]' maxlength='100' placeholder='máx. 100 caracteres'/>
				</div>  
			</div>
			<div class='col-md-3'>
				<div class='form-group'>
					<label class='control-label'>Anexo</label>
					<input type='file' id='selecao-arquivo' name='anexo[]' />
				</div>  
			</div>
		</div>
		<hr>		
		<div class='row'>	
			<div class='col-md-6'>
				<label class='control-label'>Adicionar trilhas</label>
				<a href='javascript:void(0)' onclick='adicionarTrilha()'>
					<i class='fa fa-plus-circle' aria-hidden='true'></i>
				</a>
			</div>
		</div>
		<div id='adicionarTrilha'>

		</div>
		<hr>
		<div class='row' id='cad-button'>
			<div class='col-md-12'>
				<button type='submit' class='btn btn-default' name='submit' value='Send' id='submit'>Salvar</button>
			</div>
		</div>
	</form>
		
<?php 		
		
	}

	public function visualizar(){
		
		$listaDados = $_REQUEST['DADOS_DENUNCIA']; 
		
		$listaAnexos = $_REQUEST['LISTA_ANEXOS'];
		
		$listaPalavrasChave = $_REQUEST['LISTA_PALAVRAS_CHAVE'];
		
		$listaTrilhas = $_REQUEST['LISTA_TRILHAS'];
		
		$historico = $_REQUEST['HISTORICO'];
		
?>		

		<div style='height:70px;'>
			<a href="/denuncias/listar/0"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'><i class='fa fa-arrow-left' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;Voltar</button></a>
		</div>
		STATUS: <?php echo $listaDados['DS_STATUS'] ?>
		<div class='well'>
			<strong>Dados de cadastro:</strong><br><br>
				
				Número de cadastro: <?php echo $listaDados['DS_NUMERO']; ?><br>
				Tipo da denúncia:   <?php echo $listaDados['DS_TIPO']; ?><br>
				Servidor que cadastrou: <?php echo $listaDados['SERVIDOR_CADASTROU']; ?><br>
				Assunto: <?php echo $listaDados['NOME_MACRO_ASSUNTO'] . ' - ' . $listaDados['NOME_MICRO_ASSUNTO']; ?><br>
				
				<?php if($listaDados['DS_TIPO'] == 'IDENTIFICADA'){ ?>
				
				Nome do denunciante: <?php echo $listaDados['DS_NOME_DENUNCIANTE']; ?><br>
				CPF do denunciante:  <?php echo $listaDados['DS_CPF_DENUNCIANTE']; ?><br>
				E-mail do denunciante:  <?php echo $listaDados['DS_EMAIL_DENUNCIANTE']; ?><br>
				Telefone do denunciante:  <?php echo $listaDados['DS_TELEFONE_DENUNCIANTE']; ?><br>
				Número de cadastro:  <?php echo $listaDados['DS_NUMERO']; ?><br>
				
				<?php } ?>
		
				Descrição do fato:
				<div class='well' style='background-color: white;'>
				
				<?php echo $listaDados['TX_DESCRICAO_FATO']; ?>
				
				</div>	
				
				Órgão: <?php echo $listaDados['NOME_ORGAO']; ?><br>
				Município: <?php echo $listaDados['NOME_MUNICIPIO']; ?><br>
				Envolvidos: <?php echo $listaDados['DS_ENVOLVIDOS']; ?><br>
				Data de registro no EOUV: <?php echo date_format(new DateTime($listaDados['DT_REGISTRO_EOUV']), 'd/m/Y'); ?><br>
				Data de registro no Sistema: <?php echo date_format(new DateTime($listaDados['DT_REGISTRO']), 'd/m/Y'); ?><br>
				Número do protocolo vinculado ao EOUV: <?php echo $listaDados['DS_PROTOCOLO_EOUV']; ?><br>
				Número do processo no SEI: <?php echo $listaDados['DS_NUMERO_PROCESSO_SEI']; ?><br>
	
		</div>
		<div class='well'>
			<strong>Dados de triagem:</strong><br><br>
				
				Acesso Restrito: <?php if($listaDados['BL_ACESSO_RESTRITO']){echo 'SIM';}else{echo 'NÃO';}  ?><br>
				Responsável pela triagem: <?php echo $listaDados['NOME_RESPONSAVEL_TRIAGEM'] ?><br>
				Grau de Relevância: <?php echo $listaDados['DS_RELEVANCIA'] ?><br>
				Data de término da triagem: <?php if($listaDados['DT_TERMINO_TRIAGEM']!='0000-00-00'){echo date_format(new DateTime($listaDados['DT_TERMINO_TRIAGEM']), 'd/m/Y');}else{echo 'Sem data';} ?><br>
				Situação: <?php echo $listaDados['DS_SITUACAO'] ?><br>
				Unidade de apuração: <?php echo $listaDados['NOME_UNIDADE'] ?><br>
				Triagem concluída: <?php if($listaDados['BL_TRIAGEM_CONCLUIDA']){echo 'SIM';}else{echo 'NÃO';}  ?><br>
		</div>
		<?php if($listaAnexos != NULL){ ?>
		<div class='well'>
			<strong>Anexos:</strong><br><br>
					
			<table class='table' border= '2'>
				<thead>
					<tr>
						<th>Tipo</th>
						<th>Comentários</th>
						<th>Data de recebimento</th>
						<th>Download</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($listaAnexos as $anexo){ ?>
					<tr>
						<td><?php echo $anexo['DS_TIPO'] ?></td>
						<td><?php echo $anexo['DS_COMENTARIOS'] ?></td>
						<td><?php 
								if($anexo['DT_RECEBIMENTO_EOUV']!='0000-00-00'){
									echo date_format(new DateTime($anexo['DT_RECEBIMENTO_EOUV']), 'd/m/Y');
								}else{
								    echo 'Sem data';
								} 
							?>
						</td>
						<td><a href='/_registros/anexos/<?php echo $anexo['NM_ARQUIVO'] ?>' download>Baixar</a></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
		<?php } 
		if($listaPalavrasChave != NULL){ ?>
		<div class='well'>
			<strong>Palavras-chave:</strong><br><br>
					
				<?php foreach($listaPalavrasChave as $palavra){ 
					 echo $palavra['DS_PALAVRA_CHAVE'] ?>;</br>
				<?php } ?>
				</tbody>
			</table>
		</div>
		<?php } 
		if($listaTrilhas != NULL){ ?>
		<div class='well'>
			<strong>Trilhas:</strong><br><br>
					
			<table class='table' border= '2'>
				<thead>
					<tr>
						<th>Nome</th>
						<th>Alerta?</th>
						<th>Unidade</th>
						<th>Periodicidade</th>
						<th>Agrupador?</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($listaTrilhas as $trilha){ ?>
					<tr>
						<td><?php echo $trilha['DS_NOME'] ?></td>
						<td><?php 
								if($trilha['BL_ALERTA']){
									echo 'SIM';
								}else{
									echo 'NÃO';
								} 
							?>
						</td>
						<td><?php echo $trilha['NOME_UNIDADE'] ?></td>
						<td><?php echo $trilha['NR_PERIODICIDADE'] . ' dias'?></td>
						<td><?php 
								if($trilha['BL_AGRUPADOR']){
									echo 'SIM';
								}else{
									echo 'NÃO';
								} 
							?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
		<?php } ?>
		<div class='well'>
		<?php $this->carregarHistorico($historico); ?>
		</div>
		
<?php
		
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