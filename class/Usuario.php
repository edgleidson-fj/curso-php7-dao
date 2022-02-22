<?php

class Usuario{
	
	//Atibutos.
	private $idUsuario;
	private $login;
	private $senha;
	private $dtCadastro;


	//GET e SET.
	public function getIdUsuario(){
		return $this->idUsuario;
	} 

	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function getDtCadastro(){
		return $this->dtCadastro;
	}

	public function setDtCadastro($dtCadastro){
		$this->dtCadastro = $dtCadastro;
	}

	//Métodos.
	public function loadById($id){
		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id
		));

		if(count($result) > 0){
			$linha = $result[0];

			$this->setIdUsuario($linha['idusuario']);
			$this->setLogin($linha['login']);
			$this->setSenha($linha['senha']);
			$this->setDtCadastro(new DateTime($linha['dtcadastro'])); //DateTime().
		}
	}
	//--

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdUsuario(),
			"login"=>$this->getLogin(),
			"senha"=>$this->getSenha(),
			"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s") //Utilizando o format do DateTime().
		));
	}
	//--
}
?>