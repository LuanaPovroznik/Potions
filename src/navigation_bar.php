<?php
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die( header( 'location: index.php' ) );
    }
?>
<link rel="stylesheet" href="css/navigation_bar_style.css">
<ol>
    <li><p><span>LEAKY</span> CAULDRON</p></li>
    <li style="float: right"><a href="login.php">Sou funcionário</a></li>
    <li style="float: right"><a href="register_cliente.php">Cadastre-se</a></li>
    <li style="float: right"><a href="login_cliente.php">Login</a></li>
    <li style="float: right"><a href="index.php">Inicial</a></li>
</ol>