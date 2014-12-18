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
        $qur = mysql_query("SELECT feedbacks.titulo as tituloFeedback,
					tipos.descricao as tipoDescricao,
					  feedbacks.descricao as descricaoFeedback
					   FROM 
					   feedbacks
					INNER JOIN tipos ON tipos.id = feedbacks.tipo_id WHERE tipos.id='$cod'") or die("".mysql_error());
        $result =array();
        while($r = mysql_fetch_array($qur)){
            extract($r);
            $result[] = array("tituloFeedback" => $tituloFeedback,
							"tipoDescricao" => $tipoDescricao,
							"descricaoFeedback" => $descricaoFeedback
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