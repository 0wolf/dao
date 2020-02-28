<?php

require_once("config.php");

/**** OLD VERSION
$sql = new Sql();
$login = "maisumteste@test.com";
$usuarios = $sql->select("SELECT * FROM tb_usuarios WHERE login = :LOGIN;", array(":LOGIN"=>$login));
echo json_encode($usuarios);
*/

/**** Carrega um único usuário
$root = new Usuario();
$root->loadByID(25);
echo $root;
*/

/**** Carrega uma lista de usuários
$lista = Usuario::getList();
echo json_encode($lista);
*/

/**** Carrega uma lista de usuário buscando pelo login
$search = Usuario::search("log");
echo json_encode($search);
*/

/**** Carrega um usuário usando o login e senha
$usuario = new Usuario();
$usuario->login("maisumteste@test.com", "22$22");
echo $usuario;
echo "<br/><br/>";
*/

/**** Testa exceção
$usuario = new Usuario();
$usuario->login("mandragora", "xxxxxx");
echo $usuario;
echo "<br/><br/>";
*/

/**** Inserir um novo cadastro e retorná-lo na tela
$aluno = new Usuario();
$aluno->setLogin("clean");
$aluno->setSenha("000000");
$aluno->insert();
echo $aluno;
echo "<br/><br/>";
*/

/**** Alterar um registro na tabela de cadastro e retorná-lo para tela
$usuario = new Usuario();
$usuario->loadByID(8);
echo $usuario;
echo "<br/>";
echo "---------------------------------------------";
echo "<br/>";
$usuario->update("professor", "oooooooooo");
echo $usuario;
echo "<br/><br/>";
*/

//**** Deletar um registro na tabela de cadastro
$usuario = new Usuario();
$usuario->loadByID(8);
echo $usuario;
echo "<br/>";
echo "---------------------------------------------";
echo "<br/>";
$usuario->delete();
echo $usuario;
echo "<br/><br/>";

?>