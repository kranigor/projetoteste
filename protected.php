<?php
session_start();

include_once "conexaoBD.php";

$sql = "SELECT * FROM produtos";
$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0) {
    $produtos = $resultado->fetch_all(MYSQLI_ASSOC);
} else {
    $produtos = [];
}

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja do David</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="protected-container">
        <button id="user-btn" class="top-right">Usuário</button>
        <div class="user-popup">
            <a href="#">Minha Conta</a>
            <a href="logout.php">Logout</a>
        </div>

        <div class="cart top-right">
            <p><a class="cart-link" href="#">Carrinho de Compras</a></p>
        </div>

        <div class="store-title">
            <h2>Loja do David</h2>
        </div>
        <div class="product-container">
            <?php foreach ($produtos as $produto) : ?>
                <div class="product">
                    <p class="product-name"><?php echo $produto['NOME']; ?></p>
                    <p class="product-description"><?php echo $produto['DESCRIPT']; ?></p>
                    <p class="product-price">$<?php echo number_format($produto['PRECO'], 2, ',', '.'); ?></p>
                    <button class="buy-btn">Comprar</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        document.getElementById("user-btn").addEventListener("click", function () {
            var userPopup = document.querySelector(".user-popup");
            userPopup.style.display = (userPopup.style.display === "block") ? "none" : "block";
        });

        window.addEventListener("click", function (event) {
            if (!event.target.matches("#user-btn") && !event.target.matches(".user-popup")) {
                var userPopup = document.querySelector(".user-popup");
                if (userPopup.style.display === "block") {
                    userPopup.style.display = "none";
                }
            }
        });
    </script>
</body>
</html>
