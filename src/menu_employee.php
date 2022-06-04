
<!doctype html>
<?php
    include 'config.php';
    include 'logged_user_nav_bar.php';
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <title>Potions</title>
</head>
<body>
<a href="new_employee.php"><button type="button" class="button">Cadastrar novo funcionario!</button></a>
<ul>
    <li style="float: right; padding-top: 12px">
        <input type="text" id="myFilter" class="form-control" onkeyup="myFunctionCateg()" placeholder="Procure pela categoria">
        <input type="text" id="myFilterPrec" class="form-control" onkeyup="myFunctionPrec()" placeholder="Procure por preço">
    </li>
</ul>
<?php
    @$userLogin = $_SESSION['login'];
    @$userId = $_SESSION['id'];
    if(!isset($_SESSION['login'])){
        echo "<script>top.location.href='index.php';</script>";
    }

echo "<script>
            function myFunctionCateg() {
              var input, filter, cards, cardContainer, title, i;
              input = document.getElementById(\"myFilter\");
              filter = input.value.toUpperCase();
              cardContainer = document.getElementById(\"myProducts\");
              cards = cardContainer.getElementsByClassName(\"card\");
              for (i = 0; i < cards.length; i++) {
                title = cards[i].querySelector(\".cardCategory\");
                if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                  cards[i].style.display = \"\";
                } else {
                  cards[i].style.display = \"none\";
                }
              }
            }

            function myFunctionPrec() {
              var input, filter, cards, cardContainer, title, i;
              input = document.getElementById(\"myFilterPrec\");
              filter = input.value.toUpperCase();
              cardContainer = document.getElementById(\"myProducts\");
              cards = cardContainer.getElementsByClassName(\"card\");
              for (i = 0; i < cards.length; i++) {
                title = cards[i].querySelector(\".cardPrice\");
                if (title.innerText.includes(filter)) {
                  cards[i].style.display = \"\";
                } else {
                  cards[i].style.display = \"none\";
                }
              }
            }
        </script>";

$sql = "SELECT * FROM potion";
$result = mysqli_query($con, $sql);

if($result != null){
    echo "<div class=\"row\" id=\"myProducts\">";
    while($row = mysqli_fetch_array($result)){
            echo "<form action=\"\" method=\"POST\">";
            echo "<div class=\"column\">";
            $potionId = $row['id'];
            echo "<div class=\"card\">";
            echo "<div class=\"upper-line\">";
            echo "</div>";
            echo "<div class=\"container\">";
            echo "<h4><b><span>Nome:</span> ".$row['nome']."</b></h4>";
            echo "<p> <span>Preco:</span> ".$row['preco']."</p>";

            @$tipoId = $row['tipo'];
            @$getTipoNome = mysqli_query($con, "SELECT nome FROM tipo WHERE id = $tipoId");
            while(@$resultTipoNome = mysqli_fetch_array($getTipoNome)){
                @$tipoNome = @$resultTipoNome['nome'];
            }

            echo "<p class=\"cardCategory\"> <span>Tipo da poção:</span> ".$tipoNome."</p>";

            // BOTÕES APENAS PARA ADMIN
            @$getUserAdmin = mysqli_query($con, "SELECT * FROM funcionario WHERE id = $userId");
            while(@$resultUserAdmin = mysqli_fetch_array($getUserAdmin)){
                @$userIsAdmin = @$resultUserAdmin['isAdm'];
            }
            if($userIsAdmin == 1){
                echo "<button type=\"submit\" name=\"botao\" value=\"deletar poção\" class=\"button\">deletar poção</button>";
                echo "<a><button type=\"submit\" name=\"botao\" value=\"gerenciar potion\" class=\"button\">gerenciar poção</button></a>";
            }
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</form>";
    }
    echo "</div>";
} else {
    echo "There is no potions.";
    header("Refresh:7");
}

if(@$_REQUEST['botao'] == "deletar poção"){
    @$potionToDelete = $_POST["potionId"];
    
    $deletePotion = "DELETE FROM potion WHERE id = $potionToDelete";
    $result = mysqli_query($con, $deletePotion);
    if ($result){
      echo @$potionToDelete;
      echo "Poção deletada com sucesso.";
      header("Refresh: 3");
    } else {
      echo @$potionToDelete;
      echo "Erro ao deletar poção.";
      header("Refresh: 3");
    }
}

if(@$_REQUEST['botao'] == "gerenciar potion"){
    @$postToUpdate = $_POST["potionId"];
    echo "<script>top.location.href=\"update_post.php?id=$postToUpdate\"</script>";
}
?>
</body>
</html>
