<?php
    include 'config.php';
    include 'navigation_bar.php';
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastrar Novo Funcionário</title>
</head>
    <body>
        <div class="container">
            <div class="form">
                <form action="new_employee.php" method="POST" name="newEmployeeForm" id="newEmployeeForm">
                    <p>Cadastrar Novo Funcionário</p>
                    <label for="employeeName">Nome:</label><br>
                    <input type="text" name="employeeName"><br><br>
                    <label for="employeeLevel">Permissão de administrador:</label><br>
                    <input type="radio" name="employeeLevel" value="Sim"> Sim<br>
                    <input type="radio" name="employeeLevel" value="Não"> Não<br><br>
                    <label for="employeeCPF">CPF:</label><br>
                    <input type="text" name="employeeCPF" onfocusout="checkCPF()" id="employeeCPF"><br>
                    <script>
                        function checkCPF(){
                            fetch("http://localhost/Trabalho2Bimestre/api/check_cpf.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                                },
                                body: `cpf=${document.getElementById("employeeCPF").value}`,
                            }).then((response) => response.text())
                                .then((res) => {
                                    document.getElementById("result_cpf").innerHTML = res;
                                    letRegisterCPF();
                                });
                        }
                    </script>
                    <p id="result_cpf" style="font-style: italic; font-size: small"></p>
                    <script>
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
                    <label for="employeeLogin">Login:</label><br>
                    <input type="text" name="employeeLogin"><br><br>
                    <label for="employeePassword">Senha:</label><br>
                    <input type="password" name="employeePassword"><br><br>
                    <input type="submit" name="addButton" value="Cadastrar" id="addButton">
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

        if(@$employeeLevel == "Sim"){
            $isAdm = 1;
        } else {
            $isAdm = 0;
        }

        $sql = "INSERT INTO funcionario (isAdm, nome, cpf, login, password) 
                    VALUES ('$isAdm', '$employeeName', '$employeeCPF', '$employeeLogin', '$employeePassword')";


        if (mysqli_query($con, $sql)) {
            echo "Cadastrado com sucesso.";
        } else {
            echo "Erro ao cadastrar";
        }
    }
?>
