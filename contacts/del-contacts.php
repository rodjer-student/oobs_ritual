<h3>Удаление контактов</h3>
<?php
	@session_start();
	if(!isset($_SESSION['login'])){
		header("Location:false.php");
		exit;
	}

	require_once "lib/contacts_class.php";
	$contact = Contact::getObject();
	
	if(isset($_POST["delcont"])){
		$idtodel = $_POST["idtodel"];
		$del_success = $contact->delContact($idtodel);
	}
	
	if(isset($_POST["searchcont"])){
		$sbbank = $_POST["searchbank"];
		$_SESSION['bank'] = $sbbank;
		$sbregion = $_POST["searchregion"];
		$_SESSION['region'] = $sbregion;
		$sbfullname = $_POST["searchname"];
		$_SESSION['fullname'] = $sbfullname;
	}
	$result2 = $contact->showSearchBankContacts($_SESSION['bank'], $_SESSION['region'], $_SESSION['fullname']);
	
	$_SESSION['result2'] = $result2;
	
	$quantity=15;
	$limit=10;
	if (!isset($_GET['page'])) $page=1;
	else $page = $_GET['page'];
	if (!is_numeric($page)) $page=1;
	if ($page<1) $page=1;
	$num = mysqli_num_rows($_SESSION['result2']);
	
	$pages = $num/$quantity;
	$pages = ceil($pages);
	$pages++;
	if ($page>$pages) $page = 1;
	if (!isset($list)) $list=0;
	$list=--$page*$quantity;
	
	if(!isset($_GET['sort']))$sorting = 'id ASC';
		else $sorting = $_GET['sort'];
		
		if($sorting == 'bank-asc'){
		$sorting = 'bank ASC';
		$sort_name = 'Банки А-я';
		}
		if($sorting == 'bank-desc'){
		$sorting = 'bank DESC';
		$sort_name = 'Банки Я-а';
		}
		if($sorting == 'fullname-asc'){
		$sorting = 'fullname ASC';
		$sort_name = 'ФИО А-я';
		}
		if($sorting == 'fullname-desc'){
		$sorting = 'fullname DESC';
		$sort_name = 'ФИО Я-а';
		}
	
	$result_set = $contact->showSearchBankContactsIf($_SESSION['bank'], $_SESSION['region'], $_SESSION['fullname'], $sorting, $quantity, $list);
	
	$num_result = mysqli_num_rows($result_set);

	function printResultSet($result_set){
		$id_for_del[] = array();
		$i = 1;
		while(($row = $result_set->fetch_assoc()) != false) {
			echo "<tr>";
			echo "<td id = 'tdcont'>";
			$idtodel = $row['id'];
			//echo $idtodel;
			echo "
			<form action='' method='post'>
				<input type='hidden' name='idtodel' value='$idtodel' />
				
				<input type='submit' name='delcont' id = 'search_button' value='&#9989;' title ='Удалить запись' />
				
			</form> 
			";
			echo "</td>";
			
			echo "<td id = 'tdcont'>".$row['bank']."   "."</td>";
			echo "<td id = 'tdcont'>".$row['region']."   "."</td>";
			echo "<td id = 'tdcont'>".$row['service']."   "."</td>";
			echo "<td id = 'tdcont'>".$row['position']."   "."</td>";
			echo "<td id = 'tdcont'>".$row['fullname']."   "."</td>";
			echo "<td id = 'tdcont'>".$row['phone1']."   "."</td>";
			echo "<td id = 'tdcont'>".$row['phone2']."   "."</td>";
			echo "</tr>";
			$id_for_del[$i] = $row['id'];
			$i++;
		}
		$_SESSION['iddel'] = array ($id_for_del);
		
	}
?>
	<table id = "tablecont">
	
	<tr><td id = "tdcont"  colspan="3"><?php echo "Количество записей: <font color = 'green'>" .$_SESSION['result2']->num_rows."</font>";?></td>
		<td id = "tdcont"  colspan="3"><?php echo "На странице:  <font color = 'green'>" .$result_set->num_rows."</font>";?></td>	
	<td id = "tdcont"  colspan="2">
			<a id = "select-sort">Сортировать</a>
				<ul id = "sorting-list">
				<li><a href = "<?php echo $_SERVER['SCRIPT_NAME'].'?page='.($page+1).'&sort=bank-asc';?>">Банки А-я</a></li>
				<li><a href = "<?php echo $_SERVER['SCRIPT_NAME'].'?page='.($page+1).'&sort=bank-desc';?>">Банки Я-а</a></li>
				<li><a href = "<?php echo $_SERVER['SCRIPT_NAME'].'?page='.($page+1).'&sort=fullname-asc';?>">ФИО А-я</a></li>
				<li><a href = "<?php echo $_SERVER['SCRIPT_NAME'].'?page='.($page+1).'&sort=fullname-desc';?>">ФИО Я-а</a></li>
				</ul>
		</td>
	</tr>
	<tr>
	<form name = "contactsearch" action = "" method = "post">
	<td colspan = "8">
		<input type = "text" name = "searchbank" id = "searchbankconttext" placeholder="банк.." />
		<span style = "margin-left: 10px; margin-right: 10px;">и/или</span>
		<input type = "text" name = "searchregion" id = "searchregionconttext" placeholder="регион.." />
		<span style = "margin-left: 10px; margin-right: 10px;">и/или</span>
		<input type = "text" name = "searchname" id = "searchnameconttext" placeholder="ФИО сотрудника.." />
		<input type = "submit" name = "searchcont" id = "search_button" value = "&#128269;" />
	</td>
	</form>
	</tr>
	<tr>
		<td id = "tdcont"><font color = "orangered"><h4><img src = "images/close.png"></h4></font></td>
		<td id = "tdcont"><font color = "orangered"><h4>Банк</h4></font></td>
		<td id = "tdcont"><font color = "orangered"><h4>Регион</h4></font></td>
		<td id = "tdcont"><font color = "orangered"><h4>Служба</h4></font></td>
		<td id = "tdcont"><font color = "orangered"><h4>Должность</h4></font></td>
		<td id = "tdcont"><font color = "orangered"><h4>ФИО</h4></font></td>
		<td id = "tdcont"><font color = "orangered"><h4>Телефон 1</h4></font></td>
		<td id = "tdcont"><font color = "orangered"><h4>Телефон 2</h4></font></td>
	</tr>

	<?php printResultSet($result_set);?>
	
		<tr><td id = "tdcont"  colspan="9">
	<?php	
	if ($page>=1) {
    echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?page=1' . '&sort=' . $sorting . '">первая</a> &nbsp; ';
    echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?page=' . $page . '&sort=' . $sorting . '">&#9668;</a> &nbsp; ';
	}
	$this1 = $page+1;
	$start = $this1-$limit;
	$end = $this1+$limit;
	for ($j = 1; $j<$pages; $j++) {
	if ($j>=$start && $j<=$end) {
		if ($j==($page+1)) echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?page=' . $j . '&sort=' . $sorting . '"><strong style="color: #df0000">' . $j . '</strong></a> &nbsp; ';
			else echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?page=' . $j . '&sort=' . $sorting . '">' . $j . '</a> &nbsp; ';
		}
	}
	
	if ($j>$page && ($page+2)<$j) {
    echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?page=' . ($page+2) . '&sort=' . $sorting . '">&#9658;</a> &nbsp; ';
    echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?page=' . ($j-1) . '&sort=' . $sorting . '">последняя</a> &nbsp; ';
	}
	?>
	</td></tr>
	</table>	
