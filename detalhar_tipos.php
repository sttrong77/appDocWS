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
        $qur = mysql_query("SELECT t.id, t.descricao FROM tipos t WHERE t.id='$cod'") or die("".mysql_error());
        $result =array();
        while($r = mysql_fetch_array($qur)){
            extract($r);
            $result[] = array("id" => $id, "descricao" =>$descricao
			);
        }
       // $json = array("status" => 1, "info" => $result);
		 $json = array($result);
    }else{
        $json = array("status" => 0, "msg" => "User ID not define");
    }
    @mysql_close($conn);
 
    /* Output header */
    header('Content-type: application/json');
	echo ($callback ? $callback . '(' : '') . json_encode($json) . ($callback ? ')' : '');
    //echo json_encode($json);
?>	