<?
session_start();
header("Content-Type:text/html; charset=utf-8");
date_default_timezone_set( 'Europe/Kiev' );
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
		    		
			<div id='content' text-color='#AECCAC'>	
				</br>
				<?php

				//отримуємо дату та час відповідно
				$data=date("Y.m.d H:i:s");
				$filter=array("<",">",";","=","/");
				$xss=str_replace($filter,"|",$_POST['coment']);

				$name=$_POST['name'];
				$email=$_POST['email'];
				$coment=$xss;
				$email1="pmatsibokh@gmail.com";
						
				$pattern_mail='/([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}/'; //вираз для перевірки ел.пошти
				$pattern_name='/^([A-zА-яії]+)$/u'; //вираз для перевірки імені

				if ($_SESSION["captcha"]===$_POST["captcha"] && $_POST["name"]!=null && $_POST["email"]!=null&&$_POST['coment']!=null&&
				preg_match($pattern_mail, $email)&&preg_match($pattern_name, $name)){
																
					//отримуємо ір адресу користувача і інформацію про браузер
					$ip=getenv("REMOTE_ADDR");

					if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Firefox') ) $browser = 'firefox';
					elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Chrome') ) $browser = 'chrome';
					elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Safari') ) $browser = 'safari';
					elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Opera') ) $browser = 'opera';
					elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') ) $browser = 'ie6';
					elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') ) $browser = 'ie7';
					elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0') ) $browser = 'ie8';
					elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.0') ) $browser = 'ie9';
					elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Mozilla') ) $browser = 'Mozilla Firefox';
					else $browser="other";


					$text='Доброго дня. Дякуємо за вибір нашого ресурсу. 
					Ваше звернення відправлено адміністратору сайту';
					$text1="Створено новий запит на сайті від користувача {$name} пошта {$email}</p>";
					$subj="Відгук про сайт";


					echo "Доброго дня, {$name}.</br> 
					Дякуємо за вибір послуг нашого ресурсу.</br></br> Відповідь на Ваше запитання поступить на вказану Вами адресу: {$email}.";
					echo'</br>Всі відгуки Ви можете переглянути на сторінці: <a href="../content/result.php">
					<i style="color:#07CFCC">Відгуки.</i></a>';

					mail($email,$subj,$text);
					mail($email1,$text1,$coment);

					//дяні для зєднання з базою
					$hostname="mysql.tinhost.ru";
					$username="u442468482_12345";
					$password="12345678";
					$dbName="u442468482_data";
					$usersTable="users";

					//нижче знаходяться запити для створення і видалення бази і таблиці
					/*$create='CREATE DATABASE u442468482_data;';
					$use="USE u442468482_data;";*/
					/*$drop="DROP TABLE IF EXISTS users;";
					$table='CREATE TABLE users(id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(20) NOT NULL, email VARCHAR(50) NOT NULL,
					coment VARCHAR(500) NOT NULL, ip VARCHAR(15), browser VARCHAR(20), data TIMESTAMP)';*/
	
					mysql_connect($hostname,$username,$password) or DIE("зєднання не встановлено");
					//echo"</br> Зєднання з mysql встановлено";

					mysql_select_db($dbName) or DIE(mysql_error());
					/*mysql_query($create) or DIE(mysql_error());
					mysql_query($use) or DIE(mysql_error());
					mysql_query($drop) or DIE(mysql_error());
					mysql_query($table) or DIE(mysql_error());*/

					
					$query="INSERT INTO $usersTable VALUES('id','$name','$email','$coment','$ip','$browser','$data')";

					mysql_query($query) or DIE(mysql_error());

					unset($_SESSION["captcha"]);
				}
				else //перевіряємо що саме не введено

				{ 

					if(!preg_match($pattern_mail, $email))
						echo "Не корректно введена ел. адреса</br>";
					if(!preg_match($pattern_name, $name))
						echo "Не корректно введено імя (повинні бути введені символи тільки латиниці/кирилиці)</br>";
					if($coment==null)
						echo "Не введено коментар</br>";
					if($_SESSION["captcha"]!=$_POST["captcha"])
						echo "Не корректно введено текст з картинки</br>";
											
					echo "<a href='vidhuk.php' style='color:#FF5252'>Повторіть спробу</a>";
					exit;
				}	
				?>
				</div> 	
    	</div>
	</body>
</html>