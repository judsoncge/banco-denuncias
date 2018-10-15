<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/model/Model.php';

class OrgaosModel extends Model{
	
	public function getOrgaos(){
		
		$query = 'SELECT * FROM tb_orgaos ORDER BY DS_NOME';
		
		$listaOrgaos = $this->executarQueryLista($query);
		
		return $listaOrgaos;
	
	}

}	

?>