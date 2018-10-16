<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/model/Model.php';

class AssuntosModel extends Model{
	
	public function getAssuntosMacro(){
		
		$query = 'SELECT DISTINCT(DS_NOME_MACRO) FROM tb_assuntos_denuncia ORDER BY DS_NOME_MACRO';
		
		$listaAssuntosMacro = $this->executarQueryLista($query);
		
		return $listaAssuntosMacro;
	
	}
	
	public function getAssuntosMicro(){
		
		$query = 'SELECT DS_NOME_MICRO FROM tb_assuntos_denuncia ORDER BY DS_NOME_MACRO, DS_NOME_MICRO';
		
		$listaAssuntosMicro = $this->executarQueryLista($query);
		
		return $listaAssuntosMicro;
	
	}

}	

?>