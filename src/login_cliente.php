<html>
	<head>
		<title>Login</title>
		<link href="css/style.css" rel="stylesheet">
	</head>
	<?php
	include ('config.php');
	session_start(); 

	if (@$_REQUEST['button']=="Login")
	{
		$login = $_POST['login'];
		$password = md5($_POST['password']);
		
		$query = "SELECT * FROM cliente WHERE login = '$login' AND password = '$password' ";
		$result = mysqli_query($con, $query);
		while ($coluna=mysqli_fetch_array($result)) 
		{
			$_SESSION["id"]= $coluna["id"]; 
			$_SESSION["login"] = $coluna["login"]; 
			header("Location: menu.php"); 
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
				<a href="register_cliente.php"><button type="button" class="button">Seja um cliente!</button></a>
				<input type="submit" name="button" value="Login" class="button"><br>
			</form>
			<a href="produtos.php"><button type="button" class="button">Visualizar produtos</button></a>
		</div>
	</body>
</html>