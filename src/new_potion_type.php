<?php
include 'config.php';
?>
    <!doctype html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Cadastrar Novo Tipo</title>
    </head>
    <body>
    <div class="container">
        <div class="form">
            <form action="new_potion_type.php" method="POST" name="newPotionTypeForm" id="newPotionTypeForm">
                <p>Cadastrar Nova Poção</p>
                <label for="potionTypeName">Nome:</label><br>
                <input type="text" name="potionTypeName"><br><br>
                <label for="potionTypeEffect">Efeito da Poção:</label><br>
                <textarea id="potionTypeEffect" name="potionTypeEffect"></textarea><br><br>
                <input type="submit" name="addButton" value="Cadastrar">
            </form>
        </div>
    </div>
    </body>
    </html>

<?php
if(@$_REQUEST['addButton'] == "Cadastrar") {
    @$potionTypeName = $_POST["potionTypeName"];
    @$potionTypeEffect = $_POST["potionTypeEffect"];


    $sql = "INSERT INTO tipo (nome, efeito) 
                    VALUES ('$potionTypeName', '$potionTypeEffect')";


    if (mysqli_query($con, $sql)) {
        echo "Cadastrado com sucesso.";
    } else {
        echo "Erro ao cadastrar";
    }
}
?>