|<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
</html>
<?php 
	mysql_connect('localhost','root','1234');
	mysql_query("SET NAMES 'utf8';");//csg acentuar nomes
	mysql_select_db('appdoc');		
	
	$categoriaid = 1;
	if (isset($_GET['categoria'])) {//Se houver categoria informa o filtro no SELECT
		$categoriaid 	= $_GET['categoria'];
		$produtos 	= mysql_query("SELECT * FROM tipos");
	
	}else{
		$produtos= mysql_query( "SELECT t.id, t.descricao as nome FROM tipos t
                    ");
	}
	$retorno = array();
	while ($row = mysql_fetch_object($produtos)) {
		$retorno[] = $row;
	}	
	//Resposta em JSON
	$meuJSON = json_encode($retorno);
	echo  $meuJSON;
?>