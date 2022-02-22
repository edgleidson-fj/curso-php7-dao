<?php

/*require_once("config.php");

$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);
--------------------------------------------------------*/


require_once("config.php");

$user = new Usuario();

$user->loadById(4);

echo $user;

?>