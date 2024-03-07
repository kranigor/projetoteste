<?php
$nomeservidor = "localhost";
$usuario = "root";
$senha = "";
$nomebd = "loja_david";


$conexao = new mysqli($nomeservidor, $usuario, $senha, $nomebd);

if ($conexao->connect_error) {
  die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
  }

?>
