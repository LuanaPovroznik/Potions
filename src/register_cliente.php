<html>
<head>
    <title>Cadastre-se</title>
    <?php include ('config.php'); 
    include 'navigation_bar.php';
    include 'host.php'; ?>
    <link href="css/style.css" rel="stylesheet">
</head>
    <body>
    <?php
    $id = @$_REQUEST['id'];
    if (isset($_POST['submit'])){
        $password = md5($_POST['password']);  
        $image_name = $_FILES['avatar']['name'];
        $image_size = $_FILES['avatar']['size'];
        $image_tmp_name = $_FILES['avatar']['tmp_name'];
        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $new_name = $_POST['nome'].'.'.$extension;       
        $image_folder = "uploaded_img/".$new_name;
        if (!$_REQUEST['id']){
            $insere = "INSERT into cliente (nome, login, password, cpf, avatar) VALUES ('{$_POST['nome']}', '{$_POST['login']}', '$password',  '{$_POST['cpf']}', '$new_name')";
            $result_insere = mysqli_query($con, $insere);
            move_uploaded_file($image_tmp_name, $image_folder);
            echo "<script>alert('Cadastrado com sucesso!'); top.location.href='login_cliente.php';</script>";                
            } else {
                echo "<h2> Nao consegui inserir!!!</h2>";
            }
    } /*else {
            $insere = "UPDATE cliente SET 
                    nome = '{$_POST['nome']}'
                    , login = '{$_POST['login']}'
                    , password = '{$_POST['password']}'
                    , cpf = = '{$_POST['cpf']}'
                    , avatar = = '{$_POST['avatar']}'
                    WHERE id = '{$_REQUEST['id']}'
                ";
            $result_update = mysqli_query($con, $insere);
            if ($result_update) echo "<h2> Registro atualizado com sucesso!!!</h2>";
            else echo "<h2> Nao consegui atualizar!!!</h2>";
    }*/

    if (@$_REQUEST['importar'] == "importar") {
        @$file_name = $_FILES['avatar']['tmp_name'];
        echo $file_name;
    }
    ?>
    <h2 style="text-align: center"><span>Potions</span></h2>
<div class="container">
    <h2>Cadastro <span>de Cliente</span></h2>
    <form action="register_cliente.php" method="post" name="user" enctype="multipart/form-data">
        <input type="text" placeholder="Username" onkeyup="checkUser('<?php echo $localUrl; ?>')" name="login" id= "login" value="<?php echo @$_POST['login']; ?>" required>
        <script>
            function checkUser(url) {
                fetch(`${url}/api/check_user.php`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                    },
                    body: `login=${document.getElementById("login").value}`,
                }).then((response) => response.text())
                    .then((res) => {
                        document.getElementById("result").innerHTML = res;
                        letRegister();
                    });
            }
        </script>
        <p id="result"></p>
        <input type="text" placeholder="Nome" name="nome" value="<?php echo @$_POST['nome']; ?>" required><br>
        <input type="text" onfocusout="CalculaCPF('<?php echo $localUrl; ?>')" placeholder="CPF" name="cpf" id="cpf" value="<?php echo @$_POST['cpf']; ?>" required><br>
        <script>
            function CalculaCPF(url) {
                fetch(`${url}/api/check_cpf.php`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                    },
                    body: `cpf=${document.getElementById("cpf").value}`,
                }).then((response) => response.text())
                    .then((res) => {
                        console.log("** entrei"+res);
                        document.getElementById("result_cpf").innerHTML = res;
                        letRegisterCPF();
                    });
            }
        </script>
        <p id="result_cpf"></p>
        <input type="password" id="password" name="password" value="<?php echo @$_POST['password']; ?>" placeholder="Senha" required><br>
        <input type="file" name="avatar" id="avatar" accept="image/jpg, image/jpeg, image/png">
        <input type="submit" value="importar" name="importar" id="importar" class="button">
        <script>
            function letRegister(){
                userAvaiable = document.getElementById("result").innerHTML.valueOf();
                if(userAvaiable == "Esse login já existe em nosso sistema."){
                    document.getElementById("buttonGravar").style.backgroundColor="grey";
                    document.user.button.disabled=true
                } else {
                    document.getElementById("buttonGravar").style.backgroundColor="#008CBA";
                    document.user.button.disabled=false
                }
            }
            function letRegisterCPF(){
                cpfAvaiable = document.getElementById("result_cpf").innerHTML.valueOf();
                if(cpfAvaiable == "CPF Inválido." || cpfAvaiable == "Obrigatório CPF com 11 dígitos."){
                document.querySelector('#addButton').disabled = true;
                document.getElementById("result_cpf").style.color="red";
                } else {
                    document.getElementById("result_cpf").style.color="green";
                    document.querySelector('#addButton').disabled = false;
                    }
                }
        </script>
        <input type="submit" value="Gravar" name="submit" id="addButton" class="button">
        <a href="login_cliente.php">
            <button type="button" class="button">Já tenho uma conta</button>
        </a>
    <input type="hidden" name="id" value="<?php echo @$_REQUEST['id'] ?>">

    </form>
</div>
    </body>
</html>