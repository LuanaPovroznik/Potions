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
    <link rel="stylesheet" href="css/style.css">
    <title>Potions</title>
</head>
<body>
    <?php
    @$userLogin = $_SESSION['login'];
    @$userId = $_SESSION['id'];
    @$potionId = $_GET['id'];

    $sql = "SELECT * FROM potion WHERE id = $potionId";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_array($result);

   
        if($result != null){
            echo "<div class=\"row\">";
                    echo "<form action=\"\" method=\"POST\">";
                    echo "<div class=\"column\">";
                    echo "<div class=\"card\">";
                    echo "<div class=\"upper-line\">";
                    echo "</div>";
                    echo "<div class=\"container\">";
                    $potionId = $data['id'];
                    $nome =$data['nome'];
                    echo "<h4><b> Nome: $nome </b></h4>";
                    $preco =$data['preco'];
                    echo "<p> <span>Total: </span>$preco</p>";
                    @$tipoId = $data['tipo'];
                    @$getTipoPotion = mysqli_query($con, "SELECT nome FROM tipo WHERE id = $tipoId");
                    while(@$resultTipoPotion = mysqli_fetch_array($getTipoPotion)){
                        @$nomeTipo = @$resultTipoPotion['nome'];
                    }
                    echo "<p> <span>Tipo: </span> ".$nomeTipo."</p>";
                    @$tipoId = $data['tipo'];
                    @$getEfeitoPotion = mysqli_query($con, "SELECT efeito FROM tipo WHERE id = $tipoId");
                    while(@$resultEfeitoPotion = mysqli_fetch_array($getEfeitoPotion)){
                        @$efeitoPotion = @$resultEfeitoPotion['efeito'];
                    }
                    echo "<p> <span>Tipo: </span> ".$efeitoPotion."</p>";
                    echo "<p\"> <span>Tipo de pagamento:</span></p>";
                    echo "<input type=\"radio\" name=\"pagamento\" value=\"Boleto\">Boleto<br>";
                    echo "<input type=\"radio\" name=\"pagamento\" value=\"Cartao\">Cartão<br>";
                    echo "<input type=\"submit\" name=\"botao\" id=\"finalizar\" value=\"Finalizar Compra\" class=\"button\"><br> ";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                }
            echo "</div>";
if(@$_REQUEST['botao'] == "Finalizar Compra"){
    @$data = date('d-m-y h:i:s');
    echo @$data;
    @$total =  $preco;
    echo @$total;
    @$produto = $potionId;
    echo @$produto;
    @$cliente =  $userId;
    echo @$cliente;
    @$pagamento = $_POST["pagamento"];

    if(@$pagamento == "Boleto"){
        $pagamento = "boleto";
    } else {
        $pagamento = "cartao";
    }
    echo @$pagamento;
    $sql = "INSERT INTO venda (data, total, produto, cliente, pagamento) 
        VALUES ('$data', '$total', '$produto', '$cliente', '$pagamento')";

    $result_insere = mysqli_query($con, $sql);
    if ($result_insere){
        echo "<script>alert('Compra realizada com sucesso!'); top.location.href='menu.php';</script>";
    } else {
        echo "<h2> Nao consegui inserir!!!</h2>";
    }

}
?>
</body>
</html>