<html>
<head>
    <title>Cadastre-se</title>
    <?php include ('config.php');  ?>
    <link href="css/register_style.css" rel="stylesheet">
</head>
    <body>
    <?php
    $id = @$_REQUEST['id'];
    if (@$_REQUEST['button'] == "Gravar"){
        $password = md5($_POST['password']);     

        if (!$_REQUEST['id']){
            $insere = "INSERT into cliente (nome, login, password, cpf) VALUES ('{$_POST['nome']}', '{$_POST['login']}', '$password',  '$cpf'";
            $result_insere = mysqli_query($con, $insere);
            if ($result_insere){
                echo "<script>alert('Cadastrado com sucesso!'); top.location.href='login_cliente.php';</script>";
            } else {
                echo "<h2> Nao consegui inserir!!!</h2>";
            }
        } else {
            $insere = "UPDATE user SET 
                    nome = '{$_POST['isAdm']}'
                    , login = '{$_POST['login']}'
                    , password = '{$_POST['password']}'
                    , cpf = = '{$_POST['cpf']}'
                    WHERE id = '{$_REQUEST['id']}'
                ";
            $result_update = mysqli_query($con, $insere);
            if ($result_update) echo "<h2> Registro atualizado com sucesso!!!</h2>";
            else echo "<h2> Nao consegui atualizar!!!</h2>";
        }

        
    }
    ?>
    <h2 style="text-align: center"><span>Potions</span></h2>
<div class="container">
    <h2>Cadastro <span>de Cliente</span></h2>
    <form action="register_cliente.php" method="post" name="user">
        <input type="text" placeholder="Username" onkeyup="checkUser()" name="login" id= "login" value="<?php echo @$_POST['login']; ?>" required>
        <script>
            function checkUser() {
                fetch("http://localhost/projects/potions/Potions/api/check_user.php", {
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
        <input type="text" onfocusout="CalculaCPF()" placeholder="CPF" name="cpf" id="cpf" value="<?php echo @$_POST['cpf']; ?>" required><br>
        <script>
            function CalculaCPF() {
                fetch("http://localhost/projects/potions/Potions/api/check_cpf.php", {
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
                userAvaiable = document.getElementById("result_cpf").innerHTML.valueOf();
                if(userAvaiable == "cpf invalido"){
                    document.getElementById("buttonGravar").style.backgroundColor="grey";
                    document.user.button.disabled=true
                } else {
                    document.getElementById("buttonGravar").style.backgroundColor="#008CBA";
                    document.user.button.disabled=false
                }
            }
        </script>
        <input type="submit" value="Gravar" name="button" id="buttonGravar" class="button">
        <a href="login_cliente.php">
            <button type="button" class="button">Já tenho uma conta</button>
        </a>
    <input type="hidden" name="id" value="<?php echo @$_REQUEST['id'] ?>">

    </form>
</div>
    </body>
</html>