<!DOCTYPE html>
<html>
<head>
	<title> Login </title>
	<link rel="stylesheet" a href="style.css">
	<link rel="stylesheet" a href="css\font-awesome.min.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body class="login">

	<div class="container">
	<img src="M.png"/>
		<form method="post" action="">
			<div class="form-input">
				
				<input type="text" name="login" placeholder="Enter the User Name"/>	
			</div>
			<div class="form-input">
			
				<input type="password" name="password" placeholder="password"/>
			</div>
			<button type="submit"  name="submit"class="btn-login"> login</button>
			<?php
			if(isset($_POST['submit'])){
			include_once('adminClass.php');
			$admin=new admin();
			$name=$_POST['login'];
			$pass=$_POST['password'];
			session_start();
			$_SESSION['login']=$name;
			$admin->sedtpassword($pass);
			$admin->setlogin($name);
			$reponse=$admin->testLogin();
			if($reponse->fetch()){ 
				session_start();
			$_SESSION['login']=$name;
			header('location:home.php');
		    }else echo "<p  style='color:red;  font-weight: bold; font-size: 30px;'> accès interdit !! </p>";
			}
			?>
		</form>
	</div>
</body>
</html>