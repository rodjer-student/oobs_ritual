<?php
	require_once "lib/user_class.php";
	$user = User::getObject();
	$auth = $user->isAuth();
		if(isset($_POST["auth"])){
		$login = $_POST["login"];
		$password = $_POST["password"];
		$auth_success = $user->login($login, $password);
		if($auth_success){
			header("Location: ".$_SERVER["HTTP_REFERER"]);
			exit;
		}
		/*else{
			header("Location:false.php");
			exit;
		}*/
	}
?>
<?php
	$poupauth = "Авторизация";
	if($auth){
		$poupauth = "<b><img src='images/user.png' width='20' height='20' alt='user'><span style='vertical-align:top'> " .$_SESSION["login"] . "</span></b>";
	}
	else{
		if($_POST["auth"]){
			if(!$reg_success) $poupauth = "Неверное имя пользователя и/или пароль";
		}
	}
	$_SESSION['poupauth'] = $poupauth;	
	
?>
<style>a{text-decoration: none;}</style>
<div id = "header">
			<div id = "auth">
				<a href="#?w=500" rel="popup_name" class="poplight">
					<?php echo $poupauth; ?>
				</a>
			</div>
			<div id = "auth_exit">
				<?php echo "<a href = 'logout.php'><img src='images/logout.png' width='35' height='35' alt='Выход'></a>"; ?>
			</div>
			
		</div>