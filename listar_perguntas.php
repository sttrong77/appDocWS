<?php
 	// parametros iniciais
	$callback = isset($_GET['callback']) ? preg_replace('/[^a-zA-Z0-9$_]/s', '', $_GET['callback']) : false;
	header('Content-Type: ' . ($callback ? 'application/javascript' : 'application/json') . ';charset=UTF-8'); 
	header('Access-Control-Allow-Origin: *');
 
 	// conexar com banco
	$con = mysql_connect('localhost','root','1234');
	mysql_select_db('appdoc');		
		
	// criar consulta
	$produtos 	= mysql_query("SELECT perguntas.id, niveis.tipo as tipoNivel, 
					   perguntas.nome as nomePergunta,
					   categorias.descricao as descricaoCategoria,
					   perguntas.resposta1,
					   perguntas.resposta2,
					   perguntas.resposta3,
					   perguntas.resposta4,
					   perguntas.respostaCerta,
					   perguntas.poster as posterPergunta,
					   perguntas.respondida
					   
					   FROM 
					   perguntas
					  
					INNER JOIN categorias ON categorias.id = perguntas.categoria_id
					INNER JOIN niveis ON niveis.id = perguntas.nivel_id
						
					");
	
	// criar objeto
	$retorno = array();
	while ($row = mysql_fetch_object($produtos)) {
		$retorno[] = $row;
	}	
 
	// saida	
	echo ($callback ? $callback . '(' : '') . json_encode($retorno) . ($callback ? ')' : '');
	
	mysql_close($con);
?>	