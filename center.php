<br/><br/><br/>
<h1 style = "font-size: 45px; margin-left: 50px;"><?php echo $_SESSION['poupauth']; ?></h1>
<br/><br/>
<table align = "center">
	<tr>
		<td>
<form name="auth" action="#" method="post">
			<table>
				<tr>
					<td style = "font-size: 45px; text-align: right;">Логин:</td>
					<td>
						<input type="text" id="user" style = "width: 350px; height: 50px; font-size: 45px;" name="login" />
					</td>
				</tr>
				<tr>
					<td style = "font-size: 45px; text-align: right;">Пароль:</td>
					<td>
						<input type="password" id="user" style = "width: 350px; height: 50px; font-size: 45px;" name="password" />
					</td>
				</tr>
				<tr>
					<td colspan="2" align="right">
						<input type="submit" id = "addcontbutton" style = "width: 250px; height: 50px; font-size: 25px;" name="auth" value="Войти" />
					</td>
				</tr>	
			</table>
		</form>
		</td>
	</tr>	
</table>
