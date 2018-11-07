<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/view/View.php';

class HomeView extends View{

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
	
		<div class='grafico'>
			
			
		</div>

<?php 
	
	}

}

?>