<html>
<head>
    <title>Relatório de Produtos Cadastrados</title>
    <?php include ('config.php'); 
    include 'logged_user_nav_bar.php';
    include 'host.php'; ?>
    
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
        <input 
         type="text" 
         id="myInput" 
         onkeyup="myFunction()" 
         placeholder="Procure pelo produto" 
         title="Filtra a tabela">
        
        <table id="myTable">
            <thead>
                <th onclick="sortTable(0)">Nome</th>
                <th onclick="sortTable(1)">Preco</th>
                <th onclick="sortTable(2)">Tipo</th>
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
            <tfoot>
                <p id="totalRegister"></p>
            </tfoot>
        </table>
        <form action="#" method="POST">
            <a href="vendas.txt" download><button value="Exportar arquivo" name="botao">Exportar arquivo</button></a>
            <a href="produto_pdf.php" target="_blank"><input type="button" value="Imprimir"/>
        </form>  
    </body>
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
</html>