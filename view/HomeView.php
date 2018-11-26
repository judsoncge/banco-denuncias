<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/view/View.php';

class HomeView extends View{
	
	public function adicionarScripts(){ ?>
		
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>	
		
<?php 		
	}

	public function home(){ ?>
		
		<?php 
		$listaTriagensExpiradas = $_REQUEST['TRIAGENS_EXPIRADAS'];
		if(count($listaTriagensExpiradas)>0){ 
		?>
			<div style='background-color:red;text-align:center;width:100%;'>
				<font color='white'>Existe(m) <?php echo count($listaTriagensExpiradas) ?> triagem(ns) com o prazo expirado a(s) qual(is) você está como responsável:<br><br>
				
					<?php foreach($listaTriagensExpiradas as $triagem){ ?>
						
					- Denúncia <?php $triagem['DS_TIPO'] ?> de número <?php echo $triagem['DS_NUMERO'] ?> sobre <?php echo $triagem['NOME_MACRO'] ?> - <?php echo $triagem['NOME_MICRO'] ?>. <a href='/denuncias/triagem/<?php echo $triagem['ID'] ?>'>Continuar</a><br>	
					
	
					<?php } ?>
				</font>
			</div>
		<?php } ?>
		
		<hr>
	
		<div class='row linha-grafico'>
			<div class='col-md-12' style='height: 40px;'>
				<center>
					<b>
						Total de denúncias: 
						
						<?php echo $_REQUEST['QTD_TOTAL_DENUNCIAS']; ?>
					</b>
				</center>
			</div>
		</div>
		
		<script type="text/javascript">
			  google.charts.load('current', {'packages':['corechart']});
			  google.charts.setOnLoadCallback(drawChart);

			  function drawChart() {
				  
				var data = google.visualization.arrayToDataTable([ 
				
					['Tipo', 'Quantidade'],
				  	['IDENTIFICADA',<?php echo $_REQUEST['QTD_DENUNCIAS_IDENTIFICADAS'] ?>],
				    ['NÃO IDENTIFICADA',<?php echo $_REQUEST['QTD_DENUNCIAS_NAO_IDENTIFICADAS'] ?>]

				]);

				var options = {
				  title: 'Denúncias por tipo'
				};

				var chart = new google.visualization.PieChart(document.getElementById('denunciasTipo'));

				chart.draw(data, options);
			  }
		</script>
		
		<script type="text/javascript">
	
			google.charts.load('current', {packages: ['corechart', 'bar']});
			google.charts.setOnLoadCallback(drawStacked);
			
			

			function drawStacked() {
				  var data = google.visualization.arrayToDataTable([
					['Municipio', 'Quantidade'],
					
					
					 <?php 
				  
						$listaDenunciasMunicipio = $_REQUEST['QTD_DENUNCIAS_MUNICIPIO'];
				  
						foreach($listaDenunciasMunicipio as $municipio){ ?>
					 
							['<?php echo $municipio['NOME_MUNICIPIO'] ?>',<?php echo $municipio['QUANTIDADE'] ?>]
							<?php if($municipio != end($listaDenunciasMunicipio)){ ?>,<?php } 
					 
				        } 
						
						?>
				  
				  
				  ]);

				  var options = {
					title: 'Quantidade de denúncias por município',
					chartArea: {width: '70%'},
					isStacked: true,
					hAxis: {
					  title: 'Total',
					  format:'0',
					  minValue: 0,
					},
					vAxis: {
					  title: 'Município'
					  
					}
				  };
				  var chart = new google.visualization.BarChart(document.getElementById('denunciasMunicipio'));
				  chart.draw(data, options);
				}

		</script>
		
		<script type="text/javascript">
	
			google.charts.load('current', {packages: ['corechart', 'bar']});
			google.charts.setOnLoadCallback(drawStacked);
			
			

			function drawStacked() {
				  var data = google.visualization.arrayToDataTable([
					['Órgão', 'Quantidade'],
					
					
					 <?php 
				  
						$listaDenunciasOrgao = $_REQUEST['QTD_DENUNCIAS_ORGAO'];
				  
						foreach($listaDenunciasOrgao as $orgao){ ?>
					 
							['<?php echo $orgao['NOME_ORGAO'] ?>',<?php echo $orgao['QUANTIDADE'] ?>]
							<?php if($orgao != end($listaDenunciasOrgao)){ ?>,<?php } 
					 
				        } 
						
						?>
				  
				  
				  ]);

				  var options = {
					title: 'Quantidade de denúncias por órgão',
					chartArea: {width: '70%'},
					isStacked: true,
					hAxis: {
					  title: 'Total',
					  format:'0',
					  minValue: 0,
					},
					vAxis: {
					  title: 'Órgão'
					  
					}
				  };
				  var chart = new google.visualization.BarChart(document.getElementById('denunciasOrgao'));
				  chart.draw(data, options);
				}

		</script>
		
		<script type="text/javascript">
	
			google.charts.load('current', {packages: ['corechart', 'bar']});
			google.charts.setOnLoadCallback(drawStacked);
			
			

			function drawStacked() {
				  var data = google.visualization.arrayToDataTable([
					['Unidade', 'Quantidade'],
					
					
					 <?php 
				  
						$listaDenunciasUnidadeApuracao = $_REQUEST['QTD_DENUNCIAS_UNIDADE_APURACAO'];
				  
						foreach($listaDenunciasUnidadeApuracao as $unidade){ ?>
					 
							['<?php echo $unidade['NOME_UNIDADE'] ?>',<?php echo $unidade['QUANTIDADE'] ?>]
							<?php if($unidade != end($listaDenunciasUnidadeApuracao)){ ?>,<?php } 
					 
						} 
						
						?>
				  
				  
				  ]);

				  var options = {
					title: 'Quantidade de denúncias por Unidade de Apuração',
					chartArea: {width: '70%'},
					isStacked: true,
					hAxis: {
					  title: 'Total',
					  format:'0',
					  minValue: 0,
					},
					vAxis: {
					  title: 'Unidade'
					  
					}
				  };
				  var chart = new google.visualization.BarChart(document.getElementById('denunciasUnidade'));
				  chart.draw(data, options);
				}

		</script>
		
		
		<script type="text/javascript">
			  google.charts.load('current', {'packages':['corechart']});
			  google.charts.setOnLoadCallback(drawChart);

			  function drawChart() {
				  
				var data = google.visualization.arrayToDataTable([ 
				
					['Prazo', 'Quantidade'],
				  	['Dentro do prazo',<?php echo $_REQUEST['QTD_TRIAGENS_DENTRO_PRAZO'] ?>],
				    ['Atrasadas',<?php echo $_REQUEST['QTD_TRIAGENS_ATRASADAS'] ?>]

				]);

				var options = {
				  title: 'Triagens dentro do prazo/atrasadas (das denúncias ativas)'
				};

				var chart = new google.visualization.PieChart(document.getElementById('triagensPrazo'));

				chart.draw(data, options);
			  }
		</script>
		
	
	
		
		<center>
			<div id='denunciasTipo' style='width: 900px; height: 500px;'></div>
		
			<div id='denunciasMunicipio' style='width: 900px; height: 500px;'></div>
				
			<div id='denunciasOrgao' style='width: 900px; height: 500px;'></div>
			
			<div id='denunciasUnidade' style='width: 900px; height: 500px;'></div>
			
			<div id='triagensPrazo' style='width: 900px; height: 500px;'></div>
			
		</center>
		
		
			<div class='row linha-grafico'>		
				<div class='col-md-12'>
					<div class='grafico' id='processos-ativos'>
						<strong>Assuntos mais recorrentes</strong><br>
							<table class='table table-bordered'>
								<thead>
										<tr>
											<th><center>Assunto MACRO</center></th>
											<th><center>Assunto MICRO</center></th>
											<th><center>Quantidade</center></th>
										</tr>
						
								</thead>
								<tbody>
									<?php
										$lista = $_REQUEST['QTD_DENUNCIAS_ASSUNTO'];							
										foreach($lista as $assunto){ 
									?>
										<tr>
											<td><center><?php echo $assunto['NOME_MACRO'] ?></center></td>
											<td><center><?php echo $assunto['NOME_MICRO'] ?></center></td>
											<td><center><?php echo $assunto['QUANTIDADE'] ?></center></td>
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
		</center>

<?php 
	
	}

}

?>