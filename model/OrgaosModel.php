<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/model/Model.php';

class OrgaosModel extends Model{
	
	public function getOrgaos(){
		
		$query = 'SELECT * FROM tb_orgaos ORDER BY DS_NOME';
		
		$listaOrgaos = $this->executarQueryLista($query);
		
		return $listaOrgaos;
	
	}
	
	public function getUnidadesApuracao(){
		
		$query = 'SELECT 
		
		a.*,
		
		b.DS_ABREVIACAO ABREVIACAO_ORGAO	
		
		FROM tb_unidades_apuracao a
		
		INNER JOIN tb_orgaos b ON a.ID_ORGAO = b.ID		
		
		ORDER BY b.DS_NOME';
		
		$listaUnidades = $this->executarQueryLista($query);
		
		return $listaUnidades;
	
	}

}	

?>