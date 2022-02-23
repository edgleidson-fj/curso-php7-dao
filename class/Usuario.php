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
	//---

	//Construtor com parâmetros por padrão vázios.
	public function __construct($login = "", $senha = ""){
		$this->setLogin($login);
		$this->setSenha($senha);
	}
	//--


	//Métodos.
	//Buscar por ID.
	public function loadById($id){
		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id
		));

		if(count($result) > 0){			
			$this->setData($result[0]);
		}
	}
	//--

	//Listar tudo - Método Estático -> Não necessita Instância a Classe para ser utilizado.
	public static function getList(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY login");
	}
	//--

	//Buscar pelo login - Método Estático.
	public static function search($login){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE login LIKE :SEARCH ORDER BY login", array(
			":SEARCH"=>"%" . $login . "%"
		));
	}
	//--

	//Buscar dados do login autenticado.
	public function login($login, $senha){
		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE login = :LOGIN AND senha = :SENHA", array(
			":LOGIN"=>$login,
			":SENHA"=>$senha
		));

		if(count($result) > 0){
			$linha = $result[0];

			$this->setData($result[0]);
		}
		else{
			throw new Exception("Login e/ou senha inválidos.");
		}
	}
	//--

	//Insert.
	public function insert(){
		$sql = new Sql();

		//Procedure no MYSQL -> utiliza a palavra reservada CALL nomeProcedure(Atributos).
		$result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
			":LOGIN"=>$this->getLogin(),
			":SENHA"=>$this->getSenha()
		)); 

		if(count($result) > 0){
			$this->setData($result[0]);
		}
	}
	//--

	//Dados.
	public function setData($data){
		$this->setIdUsuario($data['idusuario']);
		$this->setLogin($data['login']);
		$this->setSenha($data['senha']);
		$this->setDtCadastro(new DateTime($data['dtcadastro'])); //DateTime().
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