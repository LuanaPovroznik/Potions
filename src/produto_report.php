<html>
<head>
    <title>Relatório de Produtos Cadastrados</title>
    <?php include ('config.php'); 
    include 'navigation_bar.php';
    include 'host.php'; ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
</head>
    <body>
        <?php        
        $sql = "SELECT nome, preco, tipo FROM potion";
        $result = mysqli_query($con, $sql);
        $produtos = [];
        if ($result != null) {
            $produtos = $result->fetch_all(MYSQLI_ASSOC);
        }
        if (@$_REQUEST['botao'] == "Exportar arquivo"){
            $myfile = fopen("relatorios/produtos.txt", "a");
            if(!empty($produtos)){
                foreach($produtos as $produto) {
                    echo "<script> console.log(\" Entrei no foreach\")</script>";
                    @$nome = $produto['nome'];
                    @$preco = $produto['preco'];
                    @$tipoId = $produto['tipo'];
                    @$getTipoNome = mysqli_query($con, "SELECT nome FROM tipo WHERE id = $tipoId");
                    while(@$resultTipoNome = mysqli_fetch_array($getTipoNome)){
                        @$TipoNome = @$resultTipoNome['nome'];
                    } 
                    echo "<script> console.log(\"2 Entrei no foreach\")</script>";
                    $txt = "$nome $preco $TipoNome \n";
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
                <th>Preco</th>
                <th>Tipo</th>
            </thead>
            <tbody>
                <?php if(!empty($produtos)) { ?>
                    <?php foreach($produtos as $produto) { ?>
                        <tr>
                            <td><?php echo $produto['nome']; ?></td>
                            <td><?php echo $produto['preco']; ?></td>
                            <?php 
                                @$tipoId = $produto['tipo'];
                                @$getTipoNome = mysqli_query($con, "SELECT nome FROM tipo WHERE id = $tipoId");
                                while(@$resultTipoNome = mysqli_fetch_array($getTipoNome)){
                                    @$tipoNome = @$resultTipoNome['nome'];
                                } 
                            ?>
                            <td><?php echo $tipoNome; ?></td>
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