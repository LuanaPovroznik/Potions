<html>
	<head>
		<title>Login</title>
		<link href="css/style.css" rel="stylesheet">
	</head>
	<?php
	include ('config.php');
	include 'navigation_bar.php';
	session_start(); 

	if (@$_REQUEST['button']=="Login")
	{
		$login = $_POST['login'];
		$password = md5($_POST['password']);
		
		$query = "SELECT * FROM funcionario WHERE login = '$login' AND password = '$password' ";
		$result = mysqli_query($con, $query);
		while ($coluna=mysqli_fetch_array($result)) 
		{
			$_SESSION["id"]= $coluna["id"]; 
			$_SESSION["login"] = $coluna["login"]; 
			$_SESSION["isAdm"] = $coluna["isAdm"];

			$cargo = $coluna['isAdm'];
			if($cargo == "0"){ 
				header("Location: menu_employee.php"); 
				exit; 
			}
			if($cargo == "1"){ 
				header("Location: menu_employee.php"); 
				exit; 
			}
		}
		
	}
	?>

	<body>
	<h2 style="text-align: center"><span>Potions</span></h2>
		<div class="container">
			<h1>Seja <span>bem vindo</span></h1>
			<form class="user" action=# method=post>
				<input type="text" aria-describedby="emailHelp" placeholder="Enter username" name="login"><br><br>
				<input type="password" id="password" placeholder="Password" name="password"> <br><br>
				<input type="submit" name="button" value="Login" class="button"><br>
			</form>
		</div>
	</body>
</html>