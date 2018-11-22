<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/view/DenunciasView.php';

class UapDenunciasView extends DenunciasView{
	
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
						<div class='col-md-4'>
							<div class='form-group'>
								<label class='control-label'>NCD</label><br>
								<input class='form-control' type='text' id='filtroncd' name='filtroncd'>
							</div>
						</div>
						<div class='col-md-4'>
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
						<div class='col-md-4'>
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
								<input class='form-control' type='date' id='filtroperiodo' name='filtroperiodo' style='height:37px;'>
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
							
								<?php if($denuncia['BL_TRIAGEM_CONCLUIDA']){ ?>
								
									<a href="/denuncias/andamento/<?php echo $denuncia['ID'] ?>" >
										<button type='button' class='btn btn-secondary btn-sm' title='Dar andamento'>
											<i class='fa fa-forward' aria-hidden='true'></i>
										</button>
									</a>
								
								<?php } ?>
								
								<?php if($denuncia['DS_STATUS'] != 'NÃO TRATADA'){ ?>
								
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
	
	public function cadastrar(){
		echo "<script>alert('Você não tem permissão para acessar esta página.')</script>";
		echo "<script>history.back();</script>";
	}
	
	public function editar(){
		echo "<script>alert('Você não tem permissão para acessar esta página.')</script>";
		echo "<script>history.back();</script>";
	}
	
	public function triagem(){
		echo "<script>alert('Você não tem permissão para acessar esta página.')</script>";
		echo "<script>history.back();</script>";
	}

}