<?php
session_start();

include_once "conexaoBD.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST["id"];
    $novoNome = $_POST["nome"];
    $novoEmail = $_POST["email"];
    $novaSenha = $_POST["senha"];

    $sql = "UPDATE usuarios SET NOME = '$novoNome', EMAIL = '$novoEmail', SENHA = '$novaSenha' WHERE ID = $idUsuario";

    if ($conexao->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar registro: " . $conexao->error;
    }

    $conexao->close();
} else {
    if (!isset($_GET["id"])) {
        die("ID do usuário não fornecido.");
    }

    $idUsuario = $_GET["id"];

    $sql = "SELECT * FROM usuarios WHERE ID = $idUsuario";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
    } else {
        die("Usuário não encontrado.");
    }
    ?>

    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Usuário</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <h2>Editar Usuário</h2>

            <form method="post" action="editar-usuario.php">
                <input type="hidden" name="id" value="<?php echo $usuario['ID']; ?>">
                
                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="<?php echo $usuario['NOME']; ?>" required>
                <br>

                <label for="email">E-mail:</label>
                <input type="email" name="email" value="<?php echo $usuario['EMAIL']; ?>" required>
                <br>

                <label for="senha">Nova Senha:</label>
                <input type="password" name="senha" required>
                <br>

                <input type="submit" value="Salvar">
            </form>
        </div>
    </body>
    </html>

<?php
}
?>
