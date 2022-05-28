<?php
    include "config.php";
    $login = $_POST['login'];
    $sql = "SELECT * FROM cliente";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)){
        if ($login == $row['login']){
            echo "Esse login já existe em nosso sistema.";
        } else {
            echo "";
        }
    }
?>