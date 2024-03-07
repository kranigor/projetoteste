<?php
session_start();

include_once "conexaoBD.php";

if (isset($_GET["id"])) {
    $usuario_id = $_GET["id"];

    $sql_delete = "DELETE FROM usuarios WHERE id = $usuario_id";

    if ($conexao->query($sql_delete) === TRUE) {
        header("Location: usuarios.php");
        exit;
    } else {
        $error_message = "Erro ao excluir usuário: " . $conexao->error;
    }
} else {
    $error_message = "ID do usuário não fornecido.";
}

$conexao->close();
?>
