<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/model/Model.php';

class AssuntosModel extends Model{
	
	public function getAssuntos(){
		
		$query = 'SELECT * FROM tb_assuntos_denuncia ORDER BY DS_NOME_MACRO, DS_NOME_MICRO';
		
		$listaAssuntos = $this->executarQueryLista($query);
		
		return $listaAssuntos;
	
	}

}	

?>