<h3>Все контакты</h3>
<?php

	require_once "lib/contacts_class.php";
	$contact = Contact::getObject();
	$result2 = $contact->showAllContacts();
	$quantity=25;
	$limit=10;
	if (!isset($_GET['page'])) $page=1;
	else $page = $_GET['page'];
	if (!is_numeric($page)) $page=1;
	if ($page<1) $page=1;
	$num = mysqli_num_rows($result2);
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

		
	$result_set = $contact->showAllContactsIf($sorting, $quantity, $list);
	
	$num_result = mysqli_num_rows($result_set);

	function printResultSet($result_set){
		while(($row = $result_set->fetch_assoc()) != false) {
			echo "<tr>";
			echo "<td id = 'tdcont'>".$row['bank']."   "."</td>";
			echo "<td id = 'tdcont'>".$row['region']."   "."</td>";
			echo "<td id = 'tdcont'>".$row['service']."   "."</td>";
			echo "<td id = 'tdcont'>".$row['position']."   "."</td>";
			echo "<td id = 'tdcont'>".$row['fullname']."   "."</td>";
			echo "<td id = 'tdcont'>".$row['phone1']."   "."</td>";
			echo "<td id = 'tdcont'>".$row['phone2']."   "."</td>";
			echo "</tr>";
		}
	}
	
	
	
?>

	<table id = "tablecont">
	<tr><td id = "tdcont"  colspan="3"><?php echo "Количество записей: <font color = 'green'>" .$result2->num_rows."</font>";?></td>
		<td id = "tdcont"  colspan="2"><?php echo 	"На странице:  <font color = 'green'>" .$result_set->num_rows."</font>";?></td>
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
		<td id = "tdcont"><font color = "orangered"><h4>Банк</h4></font></td>
		<td id = "tdcont"><font color = "orangered"><h4>Регион</h4></font></td>
		<td id = "tdcont"><font color = "orangered"><h4>Служба</h4></font></td>
		<td id = "tdcont"><font color = "orangered"><h4>Должность</h4></font></td>
		<td id = "tdcont"><font color = "orangered"><h4>ФИО</h4></font></td>
		<td id = "tdcont"><font color = "orangered"><h4>Телефон-1</h4></font></td>
		<td id = "tdcont"><font color = "orangered"><h4>Телефон-2</h4></font></td>
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

	

	