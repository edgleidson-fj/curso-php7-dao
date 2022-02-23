<?php

require_once("config.php");

/*Carrega um usuário.
$user = new Usuario();
$user->loadById(4);
echo $user*/
//--------------------------------------------

/*Carrega lista de usuários.
$lista = Usuario::getList(); //Acessando o método sem precisar instânciar a Classe(Usuário) devido a ser Static. 
echo json_encode($lista);*/
//--------------------------------------------

/*Carregar a lista de usuários buscando pelo login.
$buscarPorLogin = Usuario::search("la");
echo json_encode($buscarPorLogin);*/
//--------------------------------------------

//Carregando usuário autenticado.
$usuario = new Usuario();
$usuario->login("zezinho", "12");
echo $usuario;

?>