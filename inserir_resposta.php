<?php
		// conexao com banco
		/*$con = mysql_connect('mysql.hostinger.com.br','u350647156_dbadm','123456');
		mysql_query("SET NAMES 'utf8';");//csg acentuar nomes
		mysql_select_db('u350647156_apdoc');
		*/
		$con = mysql_connect('localhost','root','1234');
		mysql_select_db('appdoc');		
		
		// pegar campos recebidos remotamente
		$meu_nome = $_POST['nome'];
		$resposta = $_POST['resposta'];
		$pergunta = $_POST['perguntaID'];
		
		// rotina de insercao
		$mensagem = "sucesso";
		try {
			mysql_query("INSERT INTO respostas ( nome, resposta, perguntaID ) values ('$meu_nome','$resposta', '$pergunta')");
			} catch (Exception $e) {
				$mensagem = "erro na insercao";		
		}
	
		echo $mensagem;
		//echo $meu_nome;
		//echo $meu_come;
		mysql_close($con);
?>