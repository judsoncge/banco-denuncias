<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/view/DenunciasView.php';

class OuvDenunciasView extends DenunciasView{
	
	public function andamento(){
		echo "<script>alert('Você não tem permissão para acessar esta página.')</script>";
		echo "<script>history.back();</script>";
		
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
								<?php if($denuncia['DS_STATUS'] != 'ENCERRADA'){ 	
									if(!$denuncia['BL_TRIAGEM_CONCLUIDA']){ ?>
									
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
									
									<?php }

									if($denuncia['DS_SITUACAO'] == 'NÃO APTA' and $denuncia['BL_TRIAGEM_CONCLUIDA']){ ?>
								
									<a href="/editar/denuncia/encerrar/<?php echo $denuncia['ID'] ?>/" >
										<button type='button' class='btn btn-secondary btn-sm' title='Encerrar Denúncia'>
											<i class='fa fa-check' aria-hidden='true'></i>
										</button>
									</a>
									
									<?php }	
								}
								?>
								
							</td>				
						</tr>
				  <?php } ?>		
				</tbody>
			</table>
		</div>
<?php 
		
	}
	
}