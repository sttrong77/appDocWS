<?php 

	mysql_connect('localhost','root','1234');
	mysql_query("SET NAMES 'utf8';");//csg acentuar nomes
	mysql_select_db('appdoc');		
	
	$categoriaid = 1;
	if (isset($_GET['categoria'])) {//Se houver categoria informa o filtro no SELECT
		$categoriaid 	= $_GET['categoria'];
		$produtos 	= mysql_query("SELECT produtoID, nomeproduto, foto_pequena, descricao FROM produtos WHERE categoriaID = $categoriaid");
	
	}else{
		$produtos= mysql_query( "SELECT usuarios.id, perfis.descricao as perfilNome,
						usuarios.nome as nomeUsuario,
					   usuarios.username as usernameUsuario,
					   usuarios.password as passwordUsuario,
					   usuarios.email as emailUsuario,
					   usuarios.ativo as ativoUsuario
					  
					   
					    FROM 
					   usuarios
					INNER JOIN perfis ON perfis.id = usuarios.perfil_id
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