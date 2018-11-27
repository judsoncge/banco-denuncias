<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/view/ServidoresView.php';

class UapServidoresView extends ServidoresView{
	
	public function cadastrar(){
		echo "<script>alert('Você não tem permissão para acessar esta página.')</script>";
		echo "<script>history.back();</script>";
	}
	
	public function editar(){
		echo "<script>alert('Você não tem permissão para acessar esta página.')</script>";
		echo "<script>history.back();</script>";
	}
	
}

?>