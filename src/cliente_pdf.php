<?php 
    include 'host.php'; 
    require "../api/fpdf/fpdf.php";

    $db = new PDO('mysql:host=localhost; dbname=potions', 'root', '');

        $con = mysqli_connect('localhost','root','');
        @$url_id = mysqli_real_escape_string($con, $_SESSION['login']);
        $sql = "SELECT login FROM cliente WHERE login = '{$url_id}'";
        $result = mysqli_query($con, $sql);

        $sql2 = "SELECT login FROM funcionario WHERE login = '{$url_id}'";
        $result2 = mysqli_query($con, $sql2);

        if(mysqli_num_rows($result) > 0){
            header("Location: logged_index.php");
            exit;
        }

        if(mysqli_num_rows($result2) > 0){
            if (@$_SESSION['isAdm'] == 0){
                header("Location: logged_index.php");
                exit;
            }
        }

    class myPDF extends FPDF{
        function header(){
            $this->SetFont('Arial', 'B', 14);
            $this->Cell(276, 5, 'RELATORIO DE CLIENTES', 0,0,'C');
            $this->Ln(20);
        }
        function footer(){
            $this->SetY(-15);
            $this->SetFont('Arial', '', 8);
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
            $this->Ln();
        }
        function headerTable(){
            $this->SetFont('Times', 'B', 12);
            $this->Cell(30,10,'',0,0,'C');
            $this->Cell(80,10,'Nome',1,0,'C');
            $this->Cell(60,10,'Login',1,0,'C');
            $this->Cell(80,10,'CPF',1,0,'C');
            $this->Ln();
        }
        function viewTable($db){
            $this->SetFont('Times', '',12);
            $stmt = $db->query('SELECT nome, login, cpf FROM cliente');
            while($cliente = $stmt->fetch(PDO::FETCH_OBJ)){
                $this->Cell(30,10,'',0,0,'C');
                $this->Cell(80,10,$cliente->nome,1,0,'C');
                $this->Cell(60,10,$cliente->login,1,0,'C');
                $this->Cell(80,10,$cliente->cpf,1,0,'C');
                $this->Ln();
            }
        }

    }

    $pdf = new myPDF();
    $pdf->AliasNbPAges();
    $pdf->AddPage('L', 'A4', 0);
    $pdf->headerTable();
    $pdf->viewTable($db);
    $pdf->Output();

?>