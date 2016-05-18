<?
session_start();
header("Content-Type:text/html; charset=utf-8");
?>
<html>
	<head>
		<title>Гостьова книга</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	
	<body>
   		<div id='conteiner'>
   			<div id='head'>
   			</br>	
	    		<h1 style='color:#07CFCC'><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Гостьова книга<i></h1>
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
		    		
			<div id='content' text-color='#AECCAC' align='center'>	
				<?
					if (!isset($_SESSION['password'])) {
 						$_SESSION['password']=$_POST["password"];
 					}

 					if (!isset($_SESSION['login'])){
						$_SESSION['login']=$_POST["login"];
					}

					if ($_SESSION['login']===null || $_SESSION['password']===null){
						echo "Ви не вказали логін або пароль. &nbsp;&nbsp; ";
						echo "<a href='login.php' style='color:#FF5252'>Повторіть спробу</a>";
						exit;
					}
					elseif ($_SESSION["login"]==='admin'&& $_SESSION["password"]==='admin'){
						
						//дяні для зєднання з базою
						$hostname="mysql.tinhost.ru";
						$username="u442468482_12345";
						$password="12345678";
						$dbName="u442468482_data";
						$usersTable="users";

						//зєднюємось з базою 
						mysql_connect($hostname,$username,$password) or DIE("зєднання не встановлено");
						mysql_select_db($dbName) or DIE(mysql_error());
				

						//нижче йде опрацювання запиту на зміни рядка з бази
						$update=$_POST['update'];
						$field=$_POST['field'];
						$text=$_POST['coment'];

						if($update!=null && $text!=null){
							$query="UPDATE users SET $field = '$text' WHERE id=$update";
							/*echo "щось працює не так";
							echo $update;
							echo $field;
							echo $text;*/
							mysql_query($query) or DIE(mysql_error());
						}
						

						
						//нижче йде опрацювання запиту на видалення рядка з бази
						$id=$_POST['delete'];

						if(isset($id)){
							$query="DELETE FROM users WHERE id = $id";
							mysql_query($query) or DIE(mysql_error());
						}

						//потрібно відобразити всі запити з бази
						$res=mysql_query('SELECT * FROM users ORDER BY data') or DIE(mysql_error());
						$number=mysql_num_rows($res);

						/*при відображені запитів з таблиці потрібно встановити прапорці видалення/редагування рядка
						Структура відміток виглядає наступним чином:
						
						видалення: встановлені радіокномпки з іменем "delete" і значенням "id користувача". 
						Біля кожної відмітки є кнопка Delete яка відправить запит на сервер 

						зміни: окремо виведено поле для внесення змін в бажаний рядок (потрібно вказати id);

						*/

						if($number==0){
								echo "Запитів не знайдено";
							}
							else{
								echo "<h2 style='color:#07CFCC'>Відгуки користувачів:</h2></br></br>";
								echo "<form action='form.php' method='post'><table border='1' style='border: solid #A1A9A8; color: #DEFCFE'>";
								echo "Вкажіть бажані зміни:</br>";
								echo "id користувача&nbsp;<input type='text' name='update' value='' size='2'>&nbsp;Замінити поле:&nbsp;
								<select name='field' size='1'>
									<option value='name'>Імя</option>
									<option value='coment'>Комент</option>
									<option value='email'>ел. адреса</option>
								</select>
								 Замінити на:&nbsp; <textarea name='coment' id='coment' cols='20' rows='1'></textarea></br></br>
								 <input type='submit' name='' value='Update'></br>";
								echo"<tr><td>id користувача</td><td>імя</td><td>ел. адреса</td><td>комент</td>
								<td>дата створення</td><td>браузер</td><td>ір адреса</td><td>опція</td>";
								
								while ($row=mysql_fetch_array($res)) {
									echo"<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['email']."</td><td>".$row['coment']."
									</td><td>".$row['data']."</td><td>".$row['browser']."</td><td>".$row['ip']."</td><td>
									<input type='radio' name='delete' value='".$row['id']."'>&nbsp;&nbsp;<input type='submit' name='' value='Delete'></td></tr>";
								}

								echo "</table></form></br></br>";
							}

					}
					else{
						echo "Не кооретний логін або пароль. &nbsp;&nbsp; ";
						echo "<a href='login.php' style='color:#FF5252'>Повторіть спробу</a>";
						exit;
					}
				?>
			</div>
			   	
    	</div>
	</body>
</html>