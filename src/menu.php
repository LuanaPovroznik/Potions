<!doctype html>
<?php
include 'config.php';
include 'navigation_bar.php';
include 'verification.php';
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Potions</title>
</head>
<body>
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
            echo "<input type=\"hidden\" value=\"$potionId\" name=\"potionId\">";
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
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<button type=\"submit\" name=\"botao\" id=\"comprarModal\"value=\"comprar potion\" class=\"button\">comprar poção</button>";
            echo "</form>";
    }
    echo "</div>";       
} else {
    echo "There is no potions.";
    header("Refresh:7");
}
?>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Some text in the Modal..</p>
    </div>
</div>
<script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("comprarModal");
    var span = document.getElementsByClassName("close")[0];


    btn.onclick = function() {
    modal.style.display = "block";
    }


    span.onclick = function() {
    modal.style.display = "none";
    }


    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }
</script>
</body>
</html>
