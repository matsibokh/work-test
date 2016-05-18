<?
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
		    		
			<div id='content' text-color='#AECCAC'>	
				</br>
			    <h2 align='center'><i>Для входу в адмін панель, будь ласка, авторизуйтесь:</i></h2></br>
			    <form action="form.php" method="post">
			    	<h2 align='center'>Логін&nbsp;&nbsp;<input type="text" name="login" value=''></h2>
			    	<h2 align='center'>Пароль&nbsp;<input type="password" name="password" value=''></h2>
			    	<h2 align='center'><input type="submit" value="Авторизуватися"></h2>
				</form>
			</div>
			   	
    	</div>
	</body>
</html>