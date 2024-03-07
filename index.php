<?php
session_start();

include_once "conexaoBD.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_email = $_POST["email"];
    $input_senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios WHERE email = '$input_email' AND senha = '$input_senha'";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["usuario_nome"] = $usuario["nome"];

        header("Location: protected.php");
        exit;
    } else {
        $error_message = "E-mail e/ou senha estão inválidos. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login-style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($error_message)) : ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="email">E-mail:</label>
            <input type="email" name="email" required>
            <br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required>
            <br>
            <input type="submit" value="Login">
        </form>

        <div>
            <a href="senha.php">Esqueceu a Senha?</a>
        </div>
        <div>
            <a href="cadastro.php">Cadastro</a>
        </div>
        <div>
            <a href="usuarios.php">Listar Usuários</a>
        </div>
    </div>
</body>
</html>
