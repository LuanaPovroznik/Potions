<html>
    <head>
        <link rel="stylesheet" href="../css/posts_page_style.css">
        <title>Gerenciar Poção</title>
    </head>
<?php
    include 'config.php';
    include 'verification.php';
    include 'logged_user_nav_bar.php';
    @$userLogin = $_SESSION['login'];
    @$userId = $_SESSION['id'];
    @$potionId = $_GET['id'];

    $sql = "SELECT * FROM potion WHERE id = $potionId";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_array($result);

   
        if($result != null){
            echo "<div class=\"row\">";
            echo "<form action=\"\" method=\"POST\">";
            $potionId = $data['id'];
            echo "<span name=\"potionId\">$potionId</span>";
            $nome =$data['nome'];
            echo "<h4><b> Nome: <input type=\"text\" name=\"nomePotion\" id=\"inputNome\" maxlength=\"60\" value=\"$nome\"></b></h4>";
            $preco =$data['preco'];
            echo "<p> <span>Preço da poção:</span> <input type=\"text\" name=\"preco\" id=\"preco\" maxlength=\"60\" value=\"$preco\"></p>";
            @$tipoId = $row['tipo'];
            @$getTipoNome = mysqli_query($con, "SELECT nome FROM tipo WHERE id = $tipoId");
            while(@$resultTipoNome = mysqli_fetch_array($getTipoNome)){
                @$tipoNome = @$resultTipoNome['nome'];
            }
            echo "<input type=\"submit\" name=\"botao\" id=\"update\" value=\"Update\" class=\"button\"><br> ";
            echo "</form>";
            echo "</div>";
        } else {
            echo "There is no post.";
            header("Refresh:7");
        }

if(@$_REQUEST['botao'] == "Update"){
    $insere = "UPDATE potion SET 
        nome = '{$_POST['nomePotion']}'
        , preco = '{$_POST['preco']}'
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
