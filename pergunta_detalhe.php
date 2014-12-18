<?php 
 
	mysql_connect('localhost','root','1234');
	mysql_query("SET NAMES 'utf8';");//csg acentuar nomes
	mysql_select_db('appdoc');		
	
	$id =$_GET['id'];
		
	$perguntas= mysql_query( "SELECT perguntas.id, niveis.tipo as tipoNivel, 
					   perguntas.nome as nomePergunta,
					   categorias.descricao as descricaoCategoria,
					   perguntas.resposta1,
					   perguntas.resposta2,
					   perguntas.resposta3,
					   perguntas.resposta4,
					   perguntas.respostaCerta,
					   perguntas.poster as posterPergunta
					   
					   FROM 
					   perguntas
					INNER JOIN categorias ON categorias.id = perguntas.categoria_id
					INNER JOIN niveis ON niveis.id = perguntas.nivel_id
					WHERE id="+$id);
	
	$retorno = array();
	while ($row = mysql_fetch_object($perguntas)) {
		$retorno[] = $row;
	}	
	//Resposta em JSON
	$meuJSON = json_encode($retorno);
	echo  $meuJSON;
?>