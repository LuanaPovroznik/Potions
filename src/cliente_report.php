<html>
<head>
    <title>Relatório de Produtos Cadastrados</title>
    <?php include ('config.php'); 
    include 'logged_user_nav_bar.php';
    include 'host.php'; ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
</head>
    <body>
        <?php        
        $sql = "SELECT nome, login, cpf FROM cliente";
        $result = mysqli_query($con, $sql);
        $clientes = [];
        if ($result != null) {
            $clientes = $result->fetch_all(MYSQLI_ASSOC);
        }
        if (@$_REQUEST['botao'] == "Exportar arquivo"){
            $myfile = fopen("relatorios/clientes.txt", "a");
            if(!empty($clientes)){
                foreach($clientes as $cliente) {
                    echo "<script> console.log(\" Entrei no foreach\")</script>";
                    @$nome = $cliente['nome'];
                    @$login = $cliente['login'];
                    @$cpf = $cliente['cpf'];
                    echo "<script> console.log(\"2 Entrei no foreach\")</script>";
                    $txt = "$nome $login $cpf \n";
                    fwrite($myfile, $txt); 
                } 
            }
            
            fclose($myfile); 
        }
        ?>
        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
        <table id="tblUser">
            <thead>
                <th>Nome</th>
                <th>Login</th>
                <th>CPF</th>
            </thead>
            <tbody>
                <?php if(!empty($clientes)) { ?>
                    <?php foreach($clientes as $cliente) { ?>
                        <tr>
                            <td><?php echo $cliente['nome']; ?></td>
                            <td><?php echo $cliente['login']; ?></td>
                            <td><?php echo $cliente['cpf']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        <form action="#" method="POST">
            <a href="vendas.txt" download><button value="Exportar arquivo" name="botao">Exportar arquivo</button></a>
        </form>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
        <script>
        jQuery(document).ready(function($) {
            $('#tblUser').DataTable();
        } );
        </script>
    </body>
</html>