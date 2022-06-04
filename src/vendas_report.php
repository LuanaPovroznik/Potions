<html>
<head>
    <title>Relatório de Vendas</title>
    <?php include ('config.php'); 
    include 'logged_user_nav_bar.php';
    include 'host.php'; 

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
                    echo '<script> console.log(" Entrei no foreach")</script>';
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
                    echo '<script> console.log("2 Entrei no foreach")</script>';
                    $txt = "$data $produtoNome $clienteNome $total\n";
                    fwrite($myfile, $txt); 
                } 
            }
            
            fclose($myfile); 
        }
    ?>
</head>
    <body>
        <input 
         type="text" 
         id="myInput" 
         onkeyup="myFunction()" 
         placeholder="Procure pela venda" 
         title="Filtra a tabela">
        <table id="myTable">
            <thead>
                <th onclick="sortTable(0)">Data</th>
                <th onclick="sortTable(1)">Produto</th>
                <th onclick="sortTable(2)">Cliente</th>
                <th onclick="sortTable(3)">Total</th>
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
            <tfoot>
                <p id="totalRegister"></p>
            </tfoot>
        </table>
        <form action="#" method="POST">
            <a href="vendas.txt" download><button value="Exportar arquivo" name="botao">Exportar arquivo</button></a>
            <a href="vendas_pdf.php" target="_blank"><input type="button" value="Imprimir"/>
        </form>
        <script>
            const myFunction = () => {
                const trs = document.querySelectorAll('#myTable tr:not(.header)')
                const filter = document.querySelector('#myInput').value
                const regex = new RegExp(filter, 'i')
                const isFoundInTds = td => regex.test(td.innerHTML)
                const isFound = childrenArr => childrenArr.some(isFoundInTds)
                const setTrStyleDisplay = ({ style, children }) => {
                    style.display = isFound([
                    ...children 
                ]) ? '' : 'none' 
                }
  
                trs.forEach(setTrStyleDisplay)
            }
            var x = document.getElementById("myTable").rows.length;
            document.getElementById("totalRegister").innerHTML = "Há "+x+" registros";
            function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("myTable");
            switching = true;
            dir = "asc";
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                    }
                }
                }
                if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount ++;
                } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
                }
            }
            }
        </script>
    </body>
</html>