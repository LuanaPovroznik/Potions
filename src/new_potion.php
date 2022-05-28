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
                <select name="potionType" id="potionType">
                    <option value="Type1">Type 1</option>
                    <option value="Type2">Type 2</option>
                </select>
                <input type="submit" name="addButton" value="Cadastrar">
            </form>
        </div>
    </div>
    </body>
    </html>

<?php
if(@$_REQUEST['addButton'] == "Cadastrar") {
    @$employeeName = $_POST["employeeName"];
    @$employeeLevel = $_POST["employeeLevel"];
    @$employeeCPF = $_POST["employeeCPF"];
    @$employeeLogin = $_POST["employeeLogin"];
    @$employeePassword = md5($_POST['employeePassword']);


    $sql = "INSERT INTO potion (isAdm, nome, cpf, login, password) 
                    VALUES ('$isAdm', '$employeeName', '$employeeCPF', '$employeeLogin', '$employeePassword')";


    if (mysqli_query($con, $sql)) {
        echo "Cadastrado com sucesso.";
    } else {
        "Erro ao cadastrar";
    }
}
?>