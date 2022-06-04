<!doctype html>
    <?php
        include 'config.php';
        include 'verification.php';
        include 'logged_user_nav_bar.php';

        @$userLogin = $_SESSION['login'];
        @$userId = $_SESSION['id'];
    ?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Bem vindo</title>
</head>
<body>
    <?php
        $sql = "SELECT * FROM cliente WHERE id = $userId";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_array($result);
            if($result != null){
                echo "<div class=\"row\">";
                echo "<form action=\"\" method=\"POST\" enctype=\"multipart/form-data\">";
                echo "<div class=\"column\">";       
                echo "<div class=\"card\">";
                echo "<div class=\"upper-line\">";
                echo "</div>";
                echo "<div class=\"container\">";
                echo '<img class="size" style=" max-width:80px;  border-radius: 20px 2px;" src="uploaded_img/'.$data['avatar'].'">';
                echo '<input type="file" name="avatar" id="avatar" accept="image/jpg, image/jpeg, image/png">';
                $nome =$data['nome'];
                echo "<h4><b> Nome: <input type=\"text\" name=\"nome\" id=\"inputNome\" maxlength=\"80\" placeholder=\"Digite seu nome\" value=\"$nome\" required></b></h4>";
                $login =$data['login'];
                echo "<h4><b> Login: <input type=\"text\" name=\"login\" id=\"inputLogin\" maxlength=\"60\" value=\"$login\" required></b></h4>";
                $password =$data['password'];
                echo "<h4><b> Senha: <input type=\"password\" name=\"password\" id=\"password\" maxlength=\"80\" required></b></h4>";
                $cpf =$data['cpf'];
                echo "<h4><b> CPF: <input type=\"text\" name=\"cpf\" id=\"inputCPF\" maxlength=\"80\" placeholder=\"$cpf\" value=\"$cpf\" disabled></b></h4>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "<input type=\"submit\" name=\"botao\" id=\"update\" value=\"Update\" class=\"button\"><br> ";
                echo "</form>";
                    
                echo "</div>";
            } else {
                echo "Error find Client.";
                header("Refresh:7");
            }
    
    if(@$_REQUEST['botao'] == "Update"){
        $password = md5($_POST['password']);  
        if($_FILES['avatar']['name'] != ''){
            $image_name = $_FILES['avatar']['name'];
            $image_size = $_FILES['avatar']['size'];
            $image_tmp_name = $_FILES['avatar']['tmp_name'];
            $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $new_name = $_POST['nome'].'.'.$extension;       
            $image_folder = "uploaded_img/".$new_name;
            $insere = "UPDATE cliente SET 
             nome = '{$_POST['nome']}'
            , login = '{$_POST['login']}'
            , password = '$password'
            , avatar = '$new_name'
            WHERE id = $userId";
            $result_update = mysqli_query($con, $insere);
            if ($result_update){
                move_uploaded_file($image_tmp_name, $image_folder);
                echo "<h2> Perfil atualizado com sucesso!!!</h2>";
                echo "<script>top.location.href=\"cliente_profile.php\"</script>";
            } else {
                echo "<h2> Não consegui atualizar!!!</h2>"; 
            }  
        exit; 
        } else{
            $insere = "UPDATE cliente SET 
             nome = '{$_POST['nome']}'
            , login = '{$_POST['login']}'
            , password = '$password'
            WHERE id = $userId";
            $result_update = mysqli_query($con, $insere);
            if ($result_update){
                move_uploaded_file($image_tmp_name, $image_folder);
                echo "<h2> Perfil atualizado com sucesso!!!</h2>";
                echo "<script>top.location.href=\"cliente_profile.php\"</script>";
            } else {
                echo "<h2> Não consegui atualizar!!!</h2>"; 
            }  
        exit; 
        }  
        
    }
    ?>
</body>
</html>
