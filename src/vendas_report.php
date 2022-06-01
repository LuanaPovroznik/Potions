<html>
<head>
    <title>Relatório de Vendas</title>
    <?php include ('config.php'); 
    include 'navigation_bar.php';
    include 'host.php'; ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
</head>
    <body>
        <?php        
        $sql = "SELECT data, total, produto, cliente, pagamento FROM venda";
        $result = mysqli_query($con, $sql);
        $vendas = [];
        if ($result != null) {
            $vendas = $result->fetch_all(MYSQLI_ASSOC);
        }
        if (@$_REQUEST['botao'] == "Exportar arquivo"){
            $myfile = fopen("relatorios/vendas.txt", "a");
            if(!empty($vendas)){
                foreach($vendas as $venda) {
                    echo "<script> console.log(\" Entrei no foreach\")</script>";
                    @$data = $venda['data'];
                    @$produtoId = $venda['produto'];
                    @$produtoId = $venda['produto'];
                    @$getProdutoNome = mysqli_query($con, "SELECT nome FROM potion WHERE id = $produtoId");
                    while(@$resultProdutoNome = mysqli_fetch_array($getProdutoNome)){
                        @$produtoNome = @$resultProdutoNome['nome'];
                    }                
                    @$clienteId = $venda['cliente'];
                    @$getClienteNome = mysqli_query($con, "SELECT nome FROM cliente WHERE id = $clienteId");
                    while(@$resultClienteNome = mysqli_fetch_array($getClienteNome)){
                        @$clienteNome = @$resultClienteNome['nome'];
                    }
                    @$total = $venda['total'];
                    echo "<script> console.log(\"2 Entrei no foreach\")</script>";
                    $txt = "$data $produtoNome $clienteNome $total\n";
                    fwrite($myfile, $txt); 
                } 
            }
            
            fclose($myfile); 
        }
        ?>
        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
        <table id="tblUser">
            <thead>
                <th>Data</th>
                <th>Produto</th>
                <th>Cliente</th>
                <th>Total</th>
            </thead>
            <tbody>
                <?php if(!empty($vendas)) { ?>
                    <?php foreach($vendas as $venda) { ?>
                        <tr>
                            <td><?php echo $venda['data']; ?></td>
                            <?php 
                                @$produtoId = $venda['produto'];
                                @$getProdutoNome = mysqli_query($con, "SELECT nome FROM potion WHERE id = $produtoId");
                                while(@$resultProdutoNome = mysqli_fetch_array($getProdutoNome)){
                                    @$produtoNome = @$resultProdutoNome['nome'];
                                }
                            ?>
                            <td><?php echo $produtoNome; ?></td>
                            <?php 
                                @$clienteId = $venda['cliente'];
                                @$getClienteNome = mysqli_query($con, "SELECT nome FROM cliente WHERE id = $clienteId");
                                while(@$resultClienteNome = mysqli_fetch_array($getClienteNome)){
                                    @$clienteNome = @$resultClienteNome['nome'];
                                }
                            ?>
                            <td><?php echo $clienteNome; ?></td>
                            <td><?php echo $venda['total']; ?></td>
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