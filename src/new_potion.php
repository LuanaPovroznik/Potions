<?php
    include 'verification.php';
    include 'config.php';
?>
<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Cadastrar Nova Poção</title>
    </head>
    <body>
        <div class="container">
            <div class="form">
                <form action="new_potion.php" method="POST" name="newPotionForm" id="newPotionForm">
                    <p>Cadastrar Nova Poção</p>
                    <label for="potionName">Nome:</label><br>
                    <input type="text" name="potionName"><br><br>
                    <label for="potionPrice">Preço:</label><br>
                    <input type="float" name="potionPrice"><br><br>
                    <label for="potionType">Tipo da poção:</label><br>
                    <?php
                    $sqlGet = "SELECT nome FROM tipo ORDER BY nome ASC";
                    $resultGet = mysqli_query($con, $sqlGet);
                    echo '<select name="potionType" id="potionType">';
                    while($row = mysqli_fetch_array($resultGet)){
                        echo "<option value='{$row['nome']}'>" . $row['nome'] . "</option>";
                    }
                    echo '</select>';
                    ?>
                    <br><br>
                    <input type="submit" name="addButton" value="Cadastrar">
                </form>
            </div>
        </div>
    </body>
</html>

<?php
if(@$_REQUEST['addButton'] == "Cadastrar") {
    @$potionName = $_POST["potionName"];
    @$potionPrice = $_POST["potionPrice"];
    @$potionType = $_POST["potionType"];

    @$getPotionTypeId = mysqli_query($con, "SELECT id FROM tipo WHERE nome = '".@$potionType."'");
    while(@$resultCategory = mysqli_fetch_array($getPotionTypeId)){
        @$typeId = @$resultCategory['id'];
    }

    $sql = "INSERT INTO potion (nome, preco, tipo) 
                    VALUES ('$potionName', '$potionPrice', $typeId)";


    if (mysqli_query($con, $sql)) {
        echo "Cadastrado com sucesso.";
        header('Location: new_potion.php');
        die();
    } else {
        echo "Erro ao cadastrar";
    }
}
?>