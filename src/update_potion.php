<html>
    <head>
        <link href="css/register_style.css" rel="stylesheet">
        <title>Gerenciar Poção</title>
    </head>
<?php
    include 'config.php';
    include 'logged_user_nav_bar.php';
    @$userLogin = $_SESSION['login'];
    @$userId = $_SESSION['id'];
    @$potionId = $_GET['id'];

    $sql = "SELECT * FROM potion WHERE id = $potionId";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_array($result);

   
        if($result != null){
            echo "<div class=\"container\">";
            echo "<form action=\"\" method=\"POST\">";
            $potionId = $data['id'];
            echo "<input type=\"hidden\" value=\"$potionId\" name=\"potionId\">";
            $nome =$data['nome'];
            echo "<h4><b> Nome: <input type=\"text\" name=\"nomePotion\" id=\"inputNome\" maxlength=\"60\" value=\"$nome\"></b></h4>";
            $preco =$data['preco'];
            echo "<p> <span>Preço:</span> <input type=\"text\" name=\"preco\" id=\"preco\" maxlength=\"60\" value=\"$preco\"></p>";
            @$tipoId = $row['tipo'];
            echo '<label for="potionType" style="margin-right: 150px;"><span>Tipo da poção</span></label><br>';
            $sqlGet = "SELECT nome FROM tipo ORDER BY nome ASC";
            $resultGet = mysqli_query($con, $sqlGet);
            echo '<select name="potionType" id="potionType">';
            while($row = mysqli_fetch_array($resultGet)){
                echo "<option style='color: grey' value='{$row['nome']}'>" . $row['nome'] . "</option>";
            }
            echo '</select>';
            echo '<br><br>';
            echo "<input type=\"submit\" name=\"botao\" id=\"update\" value=\"Update\" class=\"loginButton\"><br> ";
            echo "</form>";
            echo "</div>";
        } else {
            echo "There is no post.";
            header("Refresh:7");
        }

if(@$_REQUEST['botao'] == "Update"){
    @$potionType = $_POST["potionType"];

    @$getPotionTypeId = mysqli_query($con, "SELECT id FROM tipo WHERE nome = '".@$potionType."'");
    while(@$resultCategory = mysqli_fetch_array($getPotionTypeId)){
        @$typeId = @$resultCategory['id'];
    }
    $insere = "UPDATE potion SET 
        nome = '{$_POST['nomePotion']}'
        , preco = '{$_POST['preco']}'
        , tipo = '$typeId'
        WHERE id = $potionId";
        $result_update = mysqli_query($con, $insere);
        if ($result_update){
            echo "<h2> Anúncio $postId atualizado com sucesso!!!</h2>";
            echo "<script>top.location.href=\"menu_employee.php\"</script>";
        } else {
            echo "<h2> Não consegui atualizar!!!</h2>"; 
        }  
    exit; 
}
?>
</html>
