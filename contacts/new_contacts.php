<h3>Добавление информации</h3>
<?php
	@session_start();
	if(!isset($_SESSION['login'])){
		header("Location:false.php");
		exit;
	}
	require_once "lib/contacts_class.php";
	$contact = Contact::getObject();
	if(isset($_POST["addcont"])){
		$sbbank = $_POST["bank"];
		$sbregion = $_POST["region"];
		$sbservice = $_POST["service"];
		$sbposition = $_POST["position"];
		$sbfullname = $_POST["fullname"];
		$sbphone1 = $_POST["phone1"];
		$sbphone2 = $_POST["phone2"];
		$add_success = $contact->addContact($sbbank, $sbregion, $sbservice, $sbposition, $sbfullname, $sbphone1, $sbphone2);
		if($add_success){
			$alarm = "<span style='color:green'>Контакт успешно внесен в базу данных.</span>";
		}
		else $alarm = "<span style='color:red'>Данные не добавлены. Проверьте правильность заполнения полей или обратитесь к системному администратору.</span>";
	}
?>
<div id = "addcont">
<form name = "addcont" action = "" method = "post">
	<table>
		<tr>
			<td><div id = "addcont_note" >Банк:&nbsp;</div></td>
			<td><input type = "text" id = "addconttext" name = "bank" placeholder="обязательно к заполнению" /></td>
		</tr>
		<tr>
			<td><div id = "addcont_note">Регион:&nbsp;</div></td>
			<td><input type = "text" id = "addconttext" name = "region" /></td>
		</tr>
		<tr>
			<td><div id = "addcont_note">Служба:&nbsp;</div></td>
			<td><input type = "text" id = "addconttext" name = "service" /></td>
		</tr>
		<tr>
			<td><div id = "addcont_note">Должность:&nbsp;</div></td>
			<td><input type = "text" id = "addconttext" name = "position" /></td>
		</tr>
		<tr>
			<td><div id = "addcont_note">ФИО:&nbsp;</div></td>
			<td>
				<input type = "text" id = "addconttext" name = "fullname" placeholder="обязательно к заполнению" /></td>
		</tr>
		<tr>
			<td><div id = "addcont_note">Телефон 1:&nbsp;</div></td>
			<td>
				<input type = "text" id = "addconttext" name = "phone1" placeholder="обязательно к заполнению" /></td>
		</tr>
		<tr>
			<td><div id = "addcont_note">Телефон 2:&nbsp;</div></td>
			<td>
				<input type = "text" id = "addconttext" name = "phone2" /></td>
		</tr>
		<!--<tr>
			<td><div id = "addcont_note">E-mail:&nbsp;</div></td>
			<td>
				<input type = "email" id = "addconttext" name = "email" /></td>
		</tr>-->
		<tr><td></td>
			<td><?php if(!isset($alarm)){} else echo $alarm; ?></td>
		</tr>
		<tr><td></td>
			<td><input type = "submit" id = "addcontbutton" name = "addcont" value = "Добавить контакт" /></td>
		</tr>
	</table>
</form>
</div>		
