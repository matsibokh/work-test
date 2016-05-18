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
   			<div id='head' align='center'>
   			</br>	
	    		<h1 style="color:#07CFCC"><i>Гостьова книга<i></h1>
	    	</div>
    			
		    <div id='menu' align='center'>
		    	</br></br>
		    	<a href="login.php">
		    		<img src='../img/shablon_knopka.png'> <!-- тут буде головна сторінка 
		    		(на ній наприклад буде інформація про фірму, на яку люди будуть відгук заришати).-->
		    	</a>

		    	</br></br>
		    	<a href="">
		    		<!--<img src='../img/shablon_knopka.png'> <!- тут буде силка на сторінку, де можна відгуки залишити-->
		    	</a>

		    	</br></br>
		    	<a href="">
		    		<!--<img src='../img/shablon_knopka.png'> <!- тут буде силка на сторінку, де можна переглядати раніше залишені відгуки-->
		    	</a>
		    </div>
		    		
			<div id='content' text-color='#AECCAC'>	
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
						$hostname="localhost";
						$username="matsibokh";
						$password="12345678";
						$dbName="data";
						$usersTable="users";

						//зєднюємось з базою 
						mysql_connect($hostname,$username,$password) or DIE("зєднання не встановлено");
						mysql_select_db($dbName) or DIE(mysql_error());
						$res=mysql_query('SELECT * FROM users ORDER BY data') or DIE(mysql_error());
						$row=mysql_fetch_array($res);

						$id=$_POST['delete'];
						if(isset($id)){
							echo $id;
						}
						else
							echo "виберіть рядок";

						$query="DELETE FROM users WHERE id = $id";
						mysql_query($query) or DIE(mysql_error());

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