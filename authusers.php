<?php
	require_once "lib/user_class.php";
	$user = User::getObject();
	$auth = $user->isAuth();
		if(isset($_POST["auth"])){
		$login = $_POST["login"];
		$password = $_POST["password"];
		$auth_success = $user->login($login, $password);
		if($auth_success){
			header("Location: authusers.php");
			exit;
		}
	}
?>
<html>
<head>
	<title>Авторизация</title>
</head>
<body>
<?php
		// Time zone - Minsk
		$time_object = new DateTime('', new DateTimeZone('UTC'));
		$time_object->setTimezone(new DateTimeZone('Europe/Minsk'));
		$MinskDateTime = $time_object->format('d-m-Y в H:i:s');
	
	if($auth){
		echo "Пользователь <b><font color = 'green'>". $_SESSION["login"]. "</font></b> вошел в систему в ".$MinskDateTime. " <br/><a href = 'logout.php'><font color = 'red'>Выход</font></a>";
		echo "<br/>";
	}
	else{
		if($_POST["auth"]){
			if(!$reg_success) echo "<span style = 'color: red;'>Неверное имя пользователя и/или пароль!</span>";
		}
	}
		
	
?>
	<!--<h1>Авторизация<h1>
	<form name = "auth" action = "authusers.php" method = "post">
		<table>
			<tr>
				<td>Логин:</td>
				<td>
					<input type = "text" name = "login" />
				</td>
			<tr>
			<tr>
				<td>Пароль:</td>
				<td>
					<input type = "password" name = "password" />
				</td>
			<tr>
			<tr>
				<td colspan = "2">
					<input type = "submit" name = "auth" value = "Войти" />
				</td>
			<tr>
		</table>
	</form>-->
</body>
</html>