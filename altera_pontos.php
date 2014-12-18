<?php
	$con = mysql_connect('localhost','root','1234');
	mysql_select_db('appdoc');		
		
	$usuarioID = isset($_POST['usuarioID']) ? mysql_real_escape_string($_POST['usuarioID']) : "";
	$pontos = isset($_POST['pontos']) ? mysql_real_escape_string($_POST['pontos']) : "";
	 
	// Add your validations
	if(!empty($usuarioID)){
		$qur = mysql_query("UPDATE  `appdoc`.`usuarios` SET  `pontos` =  '$pontos' WHERE  `usuarios`.`id` ='$usuarioID';");
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