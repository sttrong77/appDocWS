<?php
 
	$con = mysql_connect('localhost','root','1234');
	mysql_select_db('appdoc');		
		
	$perguntaID = isset($_POST['perguntaID']) ? mysql_real_escape_string($_POST['perguntaID']) : "";
	$respondida = isset($_POST['respondida']) ? mysql_real_escape_string($_POST['respondida']) : "";
	 
	// Add your validations
	if(!empty($perguntaID)){
		$qur = mysql_query("UPDATE  `appdoc`.`perguntas` SET  `respondida` =  '$respondida' WHERE  `perguntas`.`id` ='$perguntaID';");
	if($qur){
		$json = array("status" => 1, "msg" => "Pontuacao foi atualizada!!.");
	}else{
		$json = array("status" => 0, "msg" => "Erro ao atualizar pontuacao");
	}
	}else{
		$json = array("status" => 0, "msg" => "Usuario nao foi definido");
	}
	
	@mysql_close($conn);
	 
	
	header('Content-type: application/json');
	echo json_encode($json);