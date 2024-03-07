<?php
session_start();

include_once "conexaoBD.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_nome = $_POST["nome"];
    $input_email = $_POST["email"];
    $input_senha = $_POST["senha"];

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$input_nome', '$input_email', '$input_senha')";

    if ($conexao->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        $error_message = "Erro ao cadastrar usuário. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="cadastro-style.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro</h2>
        <?php if (isset($error_message)) : ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>
            <br>
            <label for="email">E-mail:</label>
            <input type="email" name="email" required>
            <br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required>
            <br>
            <input type="submit" value="Cadastrar">
        </form>

        <div>
            <a href="index.php">Voltar para o Login</a>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector("form").addEventListener("submit", function() {
            alert("Cadastro realizado com sucesso. Faça o login agora.");
        });
    });
</script>
</body>
</html>
