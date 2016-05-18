<?
header("Content-Type:text/html; charset=utf-8");
//зберігаємо інформацію в куки (якщо відвідувач ставить якісь фільтри)
if (isset($_GET['order'])) {
	SetCookie("order", $_GET['order']);
}
if (isset($_GET['desc'])) {
	SetCookie("desc", $_GET['desc']);
}
if (isset($_GET['perPage'])) {
	SetCookie("perPage", $_GET['perPage']); 
}

//якщо користувач відправляє запит на сортування - брати дані з пост, якщо заходить з іншої стор.- з кукі
// Сортувати за:
if(!isset($_GET['order'])){
		if(isset($_COOKIE['order'])){
			$order = $_COOKIE['order'];
		}
		else{
			$order = 'data'; //за замовчуванням по даті
		}
	}
else{
		$order=$_GET['order'];
	}

// Порядок сортування:
if(!isset($_GET['desc'])){
		if(isset($_COOKIE['desc'])){
			$desc = $_COOKIE['desc'];
		}
		else{
			$desc = 'old'; //за замовчуванням від новіших
		}
	}
else{
		$desc=$_GET['desc'];
	}

// К-ть запитів на сторінці:
if(!isset($_GET['perPage'])){
		if(isset($_COOKIE['perPage'])){
			$perPage = $_COOKIE['perPage'];
		}
		else{
			$perPage = 5; //за замовчуванням по даті
		}
	}
else{
		$perPage=$_GET['perPage'];
	}

?>

<html>
	<head>
		<title>Гостьова книга</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<!-- швидкий доступ в адмінку-->
		<a href="../admin/login.php" accesskey="a"></a>
		<a href="../admin/login.php" accesskey="ф"></a>
	</head>
	
	<body>
   		<div id='conteiner'>
   			<div id='head'>
   			</br>	
	    		<h1 style='color:#07CFCC'><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Гостьова книга</br><i></h1>
	    		<h3 style='color:#07CFCC'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V 1.1</h3>
	    	</div>
    			
		    <div id='menu' align='center'>
		    	</br></br>
		    	<a href="../index.php">
		    		<img src='../img/shablon_knopka1.png'> <!-- тут буде головна сторінка 
		    		(на ній наприклад буде інформація про фірму, на яку люди будуть відгук заришати).-->
		    	</a>

		    	</br></br>
		    	<a href="../content/vidhuk.php">
		    		<img src='../img/shablon_knopka2.png'> <!-- тут буде силка на сторінку, де можна відгуки залишити-->
		    	</a>

		    	</br></br>
		    	<a href="../content/result.php">
		    		<img src='../img/shablon_knopka3.png'> <!-- тут буде силка на сторінку, де можна переглядати раніше залишені відгуки-->
		    	</a>
		    </div>
		    		
			<div id='content' text-color='#AECCAC'>	
				<div id='filter' align='center'>
					<!-- створюємо форму для можливості сортування-->
					<form action="../content/result.php" method="get">
						&nbsp;&nbsp;Сортувати: &nbsp;&nbsp;
						<!--сортування в порядку зростання або спадання-->
						<select name='desc' size='1'>
							<option value='new' <?=($desc == 'new')?"selected":""?>
							>В порядку зростання</option>
							<option value='old' <?=($desc == 'old')?"selected":""?>
							>В порядку спадання</option>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;

						Відображати по &nbsp;
						<select name='perPage' size='1'>
							<option value='5' <?=($perPage == '5')?"selected":""?>
							>5</option>
							<option value='10' <?=($perPage == '10')?"selected":""?>
							>10</option>
							<option value='15' <?=($perPage == '15')?"selected":""?>
							>15</option>
							<option value='20' <?=($perPage == '20')?"selected":""?>
							>20</option>
							<option value='25' <?=($perPage == '25')?"selected":""?>
							>25</option>
						</select>&nbsp; запитів на сторінку&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

						<input type="submit" value="Сортувати">
					</form>
				</div>	

				<div id='result' align='center'>
											
						<?
							if (isset($_GET['page']))
							   $page = ($_GET['page'] - 1); 
							else $page = 0; // номер сторінки для вичислення першого запису

							$from=$page*$perPage; // мінімальне число
											
							function first(){
								global $order;
								global $from;
								global $perPage;
								
								$query="SELECT * FROM users ORDER BY $order DESC LIMIT $from,$perPage";
								return $query;
							}

							function last(){
								global $order;
								global $from;
								global $perPage;

								$query="SELECT * FROM users ORDER BY $order LIMIT $from,$perPage";
								return $query;
							}

														
							//в залежності від вибору виду сортування(нові/старі) буде змінюватись запит
							if($desc=='new'){
								$query=last();
							}else
								$query=first();
							
							//дяні для зєднання з базою
							$hostname="mysql.tinhost.ru";
							$username="u442468482_12345";
							$password="12345678";
							$dbName="u442468482_data";
							$usersTable="users";

							mysql_connect($hostname,$username,$password) or DIE("зєднання не встановлено");
							//echo"</br> Зєднання з mysql встановлено";
							mysql_select_db($dbName) or DIE(mysql_error());

							$res=mysql_query($query) or DIE(mysql_error()); 

							$number=mysql_num_rows(mysql_query('SELECT * FROM users'));//рахує кількість всіх рядків в базі

							$numPages=ceil($number/$perPage); //рахуємо к-ть сторінок з запитами


							//перевіряємо кількість знайдених запитів, зберігаємо кожен рядок в масив доки не закінчаться рядки і виводимо дані
							if($number==0){
								echo "Запитів не знайдено";
							}
							else{
								echo "<h2 style='color:#07CFCC'>Відгуки користувачів:</h2></br></br>";
								echo "<table border='1' style='border: solid #A1A9A8; color: #DEFCFE'>";
								echo '<tr><td  style="text-align:center"><a href="?order=name"><b style="color:#07CFCC">Імя</b></a></td>';
								echo '<td  style="text-align:center"><a href="?order=email"><b style="color:#07CFCC">email</b></a></td>';
								echo '<td style="text-align:center"><b style="color:#07CFCC">Відгук</b></td>';
								echo '<td style="text-align:center"><a href="?order=data"><b style="color:#07CFCC">Дата</b></a></td></tr>';
								while ($row=mysql_fetch_array($res)) {
									echo"<tr><td>".$row['name']."</td><td>".$row['email']."</td><td>".$row['coment']."
									</td><td>".$row['data']."</td></tr>";
								}
								echo "</table></br></br></br>";
							}
							for($i = 1; $i <= $numPages; $i++) {
							  if (($i - 1) == $page) {
							    echo "<b>" . $i . "</b>&nbsp;";
							  } else {
							    echo '<a href="?page=' . $i . '"><b style="color:#07CFCC">' . $i . '</b></a>&nbsp;';
							  }
							}
						?>

				</div>
			</div>
			   	
    	</div>
	</body>
</html>