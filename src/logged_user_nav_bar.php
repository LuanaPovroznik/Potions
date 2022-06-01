<?php
    include 'verification.php';
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die( header( 'location: index.php' ) );
    }

        echo "<link rel=\"stylesheet\" href=\"css/navigation_bar_style.css\">";
        echo "<ol>";
        echo "<img style=\"float: left;\" src=\"img/potion-one.gif\" alt=\"LEAKY CAULDRON\" height=\"100\" width=\"120\"/>";
        echo "<div style=\"margin-top: 30px; margin-right: 30px\">";
        echo "<li><p><span>LEAKY</span> CAULDRON</p></li>";
        echo "<li style=\"float: right\"><a href=\"logout.php\">Sair</a></li>";
        echo "<li class=\"dropdown\" style=\"float: right\">";
        echo "<a href=\"javascript:void(0)\" class=\"dropbtn\">Poções</a>";
        echo "<div class=\"dropdown-content\">";
        if($_SESSION['isAdm'] == 1){
            echo "<a href=\"menu_employee.php\">Visualizar poções</a>";
            echo "<a href=\"new_potion.php\">Cadastrar nova poção</a>";
            echo "<a href=\"new_potion_type.php\">Cadastrar novo tipo de poção</a>";
        } else {
            echo "<a href=\"menu.php\">Comprar poções</a>";
        }
        echo "</div>";
        echo "</li>";
        echo "<li class=\"dropdown\" style=\"float: right\">";
        echo "<a href=\"javascript:void(0)\" class=\"dropbtn\">Relatórios</a>";
        echo "<div class=\"dropdown-content\">";
        if($_SESSION['isAdm'] == 1){
            echo "<a href=\"cliente_report.php\">Clientes</a>";
            echo "<a href=\"vendas_report.php\">Vendas</a>";
            echo "<a href=\"produto_report.php\">Produtos</a>";
        }
        echo "</div>";
        echo "</li>";
        echo "<li style=\"float: right\"><a href=\"index.php\">Inicial</a></li>";
        echo "</div>";
        echo "</ol>";
?>