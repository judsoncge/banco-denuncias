<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/model/Model.php';

class MunicipiosModel extends Model{
	
	public function getMunicipios(){
		
		$query = 'SELECT * FROM tb_municipios ORDER BY DS_NOME';
		
		$listaMunicipios = $this->executarQueryLista($query);
		
		return $listaMunicipios;
	
	}

}	

?>