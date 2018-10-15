<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/view/View.php';

class SobreView extends View{
	
	public function visualizar(){

?>	
		
	<div class="container caixa-conteudo">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-12">
					<p class="text-justify">O Sistema Banco de Denúncias CGE tem o objetivo de dar maior qualificação à análise das informações prestadas pelos cidadãos, bem como agilidade nos procedimentos de apuração, com indicativo do aumento da economia potencial gerada pelas ações de fiscalização e controle, que por sua vez justificam a nossa missão institucional.</p>
					<p class="text-justify">Este projeto visa avaliar e tratar denúncias recebidas, inicialmente, pela ouvidoria desta Controladoria, situações em que poderá adotar várias iniciativas, tais como, ações de auditoria, fiscalização e apuração pelas áreas cabíveis, sugestão de melhorias na regulação, criação de rankings de órgãos/entidades por índice de denúncias, ações educativas, etc, sempre no intuito de evitar a má gestão dos recursos públicos, bem como combater eventuais irregularidades cometidas por servidores públicos ou por particulares, no âmbito do poder executivo estadual.</p>
					<hr>
				</div>
			</div>
			<center><p style="font-size: 20pt;">Equipe</p>	
				<div class="row">
					<div class='col-md-3'>
						<div class='box-equipe'>
							<img src='/_registros/fotos-equipe/clara.png' class='equipe-img'>
						</div>
						<div class='equipe_servidor'><b>Maria Clara Bugarim</b><br>Apoio</div>
					</div>
					<div class='col-md-3'>
						<div class='box-equipe'>
							<img src='/_registros/fotos-equipe/bruna.jpg' class='equipe-img'>
						</div>
						<div class='equipe_servidor'><b>Bruna Cansanção</b><br>Coordenadora</div>
					</div>
					<div class='col-md-3'>
						<div class='box-equipe'>
							<img src='/_registros/fotos-equipe/judson.jpg' class='equipe-img'>
						</div>
						<div class='equipe_servidor'><b>Judson Bandeira</b><br>Analista de TI</div>
					</div>
					<div class='col-md-3'>
						<div class='box-equipe'>
							<img src='/_registros/fotos-equipe/vilker.jpg' class='equipe-img'>
						</div>
						<div class='equipe_servidor'><b>Vilker Tenório</b><br>Analista de TI</div>
					</div>	
				</div>
			</center>				
		</div>
	</div>
		
<?php		
		
	}

}

?>