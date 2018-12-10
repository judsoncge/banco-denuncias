<?php 

date_default_timezone_set('America/Bahia');

$conexao = mysqli_connect('localhost', 'root', '', 'banco-denuncias') or die(mysqli_error($conexao));	

mysqli_query($conexao, "SET NAMES 'utf8'");

mysqli_query($conexao, 'SET character_set_connection=utf8');

mysqli_query($conexao, 'SET character_set_client=utf8');

mysqli_query($conexao, 'SET character_set_results=utf8');

$dataHoje = date('Y-m-d');

$resultadoQuery = mysqli_query($this->conexao, 

"

SELECT 

t.ID, t.DS_NOME NOME_TRILHA, t.NR_PERIODICIDADE, t.DT_ALERTA,

d.ID ID_DENUNCIA, d.ID_UNIDADE_APURACAO,

s.DS_NOME NOME_SERVIDOR, s.DS_EMAIL

FROM tb_trilhas t 

LEFT JOIN tb_denuncias d ON t.ID_DENUNCIA = d.ID
LEFT JOIN tb_servidores s ON d.ID_UNIDADE_APURACAO = s.ID_UNIDADE_APURACAO

WHERE 

d.DS_STATUS != 'ENCERRADA'

AND

t.BL_ALERTA = 1

AND 

t.DT_ALERTA = '$dataHoje'

");

while($trilha = mysqli_fetch_array($resultadoQuery)){
	
	$nomeTrilha = $trilha['NOME_TRILHA'];
	$nomeServidor = $trilha['NOME_SERVIDOR'];
	$id = $trilha['ID'];
	$periodicidade = $trilha['NR_PERIODICIDADE'];
	
	mail($trilha['DS_EMAIL'], utf8_decode("Banco de Denúncias - Lembrete de trilha"), utf8_decode("$nomeServidor, este é um lembrete para resolução da trilha $nomeTrilha"));
	
	mysqli_query($this->conexao, "UPDATE tb_trilhas SET DT_ALERTA = DATE_ADD(DT_ALERTA, INTERVAL $periodicidade DAY) WHERE ID = $id");
			
} 







?>