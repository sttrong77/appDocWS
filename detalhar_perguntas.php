<?php
 	// parametros iniciais
	$callback = isset($_GET['callback']) ? preg_replace('/[^a-zA-Z0-9$_]/s', '', $_GET['callback']) : false;
	header('Content-Type: ' . ($callback ? 'application/javascript' : 'application/json') . ';charset=UTF-8'); 
	header('Access-Control-Allow-Origin: *');
 
 	// conexar com banco
	$con = mysql_connect('localhost','root','1234');
	mysql_select_db('appdoc');		
	
	 $cod = isset($_GET['cod']) ? mysql_real_escape_string($_GET['cod']) :  "";
    if(!empty($cod)){
        $qur = mysql_query("SELECT perguntas.id, niveis.tipo as tipoNivel, 
					   perguntas.nome as nomePergunta,
					   categorias.descricao as descricaoCategoria,
					   perguntas.resposta1,
					   perguntas.resposta2,
					   perguntas.resposta3,
					   perguntas.resposta4,
					   perguntas.dica,
					   perguntas.respostaCerta,
					   perguntas.poster as posterPergunta,
					   perguntas.respondida
					   
					   FROM 
					   perguntas
					INNER JOIN categorias ON categorias.id = perguntas.categoria_id
					INNER JOIN niveis ON niveis.id = perguntas.nivel_id WHERE perguntas.id='$cod'") or die("".mysql_error());
        $result =array();
        while($r = mysql_fetch_array($qur)){
            extract($r);
            $result[] = array("nomePergunta" => $nomePergunta, "descricaoCategoria" => $descricaoCategoria, "tipoNivel" => $tipoNivel,
			"resposta1" => $resposta1,
			"resposta2" => $resposta2,
			"resposta3" => $resposta3,
			"resposta4" => $resposta4,
			"respostaCerta" => $respostaCerta,
			"posterPergunta" => $posterPergunta,
			"dica"			=>$dica,
			"respondida"	=>$respondida
			);
        }
        $json = array($result);
		//  $json = array("status" => 1, "info" => $result);
    }else{
        $json = array("status" => 0, "msg" => "User ID not define");
    }
    @mysql_close($conn);
 
    /* Output header */
	echo ($callback ? $callback . '(' : '') . json_encode($json) . ($callback ? ')' : '');
   // echo json_encode($json);
?>	