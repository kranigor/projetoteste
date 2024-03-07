<?php
session_start();

include_once "conexaoBD.php";


$sql = "SELECT * FROM usuarios";
$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0) {
    $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);
} else {
    $usuarios = [];
}

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Lista de Usuários</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) : ?>
                    <tr>
                        <td><?php echo $usuario['ID']; ?></td>
                        <td><?php echo $usuario['NOME']; ?></td>
                        <td><?php echo $usuario['EMAIL']; ?></td>
                        <td>
                        <a href="editar-usuario.php?id=<?php echo $usuario['ID']; ?>">Editar</a>
                            <a href="excluir-usuario.php?id=<?php echo isset($usuario['ID']) ? $usuario['ID'] : ''; ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
