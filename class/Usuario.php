<?php

class Usuario
{
	private $id_usuario;
	private $login;
	private $senha;
	private $dt_cadastro;
	
	//***** GETTER/SETTER ID do Usuário
	public function getIdUsuario()
	{
		return $this->id_usuario;
	}
	public function setIdUsuario($id_usuario)
	{
		$this->id_usuario = $id_usuario;
	}
	
	//***** GETTER/SETTER Login
	public function getLogin()
	{
		return $this->login;
	}
	public function setLogin($login)
	{
		$this->login = $login;
	}

	//***** GETTER/SETTER Senha
	public function getSenha()
	{
		return $this->senha;
	}
	public function setSenha($senha)
	{
		$this->senha = $senha;
	}

	//***** GETTER/SETTER Data de Cadastro
	public function getDtCadastro()
	{
		return $this->dt_cadastro;
	}
	public function setDtCadastro($dt_cadastro)
	{
		$this->dt_cadastro = $dt_cadastro;
	}

	public function loadByID($id)
	{
		$sql = new Sql();
		
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE id_usuario = :ID;", array(":ID"=>$id));
		
		if (count($results) > 0)
		{
			$row = $results[0];
			$this->setData($results[0]);
		}
	}

	public static function getList()
	{
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY id_usuario;");
	}

	public static function search($login)
	{
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE login LIKE :SEARCH ORDER BY id_usuario;", array(":SEARCH"=>"%" . $login . "%"));

	}

	public function login($login, $senha)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE login = :LOGIN AND senha = :SENHA;", array(":LOGIN"=>$login, ":SENHA"=>$senha));
		
		if (count($results) > 0)
		{
			$row = $results[0];
			$this->setData($results[0]);
		}
		else
		{
			throw new Exception("Login e/ou Senha inválidos.");
		}
	}

	public function setData($data)
	{
		$this->setIdUsuario($data['id_usuario']);
		$this->setLogin($data['login']);
		$this->setSenha($data['senha']);
		$this->setDtCadastro(new DateTime($data['dt_cadastro']));
	}

	public function insert()
	{
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(':LOGIN'=>$this->getLogin(),':PASSWORD'=>$this->getSenha()));
		if (count($results) > 0)
		{
			$this->setData($results[0]);
		}
	}

	public function update($login, $senha)
	{
		$this->setLogin($login);
		$this->setSenha($senha);

		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET login = :LOGIN, senha = :SENHA WHERE id_usuario = :ID;", array(
			':LOGIN'=>$this->getLogin(),
			':SENHA'=>$this->getSenha(),
			':ID'=>$this->getIdUsuario()
		));
	}

	public function delete()
	{
		$sql = new Sql();
		$sql->query("DELETE FROM tb_usuarios WHERE id_usuario = :ID;", array(
			':ID'=>$this->getIdUsuario()
		));

		$this->setIdUsuario(0);
		$this->setLogin("");
		$this->setSenha("");
		$this->setDtCadastro(new DateTime);
	}

	public function __toString()
	{
		return json_encode(array(
			"id_usuario"=>$this->getIdUsuario(),
			"login"=>$this->getLogin(),
			"senha"=>$this->getSenha(),
			"dt_cadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
		));
	}

}

/*
USE dbphp7;
CREATE PROCEDURE 'sp_usuarios_insert' (plogin VARCHAR(64), psenha VARCHAR(256))
BEGIN
	INSERT INTO tb_usuarios (login, senha) VALUES (plogin, psenha);
    SELECT * FROM tb_usuarios WHERE id_usuario = LAST_INSERT_ID();
END;
*/

?>