
<?php 
//header("Content-Type: text/html; charset=ISO-8859-1",true); 
	mysql_connect('localhost','root','1234');
	mysql_query('SET CHARACTER SET utf8');
	//mysql_set_charset('utf8');
	//mysql_query("SET NAMES 'utf8';");//csg acentuar nomes
	mysql_select_db('testando');		
	
	$categoriaid = 1;
	if (isset($_GET['categoria'])) {//Se houver categoria informa o filtro no SELECT
		$categoriaid 	= $_GET['categoria'];
		$produtos 	= mysql_query("SELECT * FROM tipos");
	
	}else{
		$produtos= mysql_query( "SELECT t.id, t.nome as nome FROM teste t
                    ");
	}
	$retorno = array();
	
	function toUtf8(&$item, $key) {
		$item = iconv("iso-8859-1","utf-8",$item);
	}
	
	while ($row = mysql_fetch_object($produtos)) {
		//array_walk($row, 'toUtf8');
		$retorno[] = utf8_encode($row);
	}	
	//Resposta em JSON
	$meuJSON = json_encode($retorno);
	echo  $meuJSON;
?>