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
				</br>
			    <h2 align='center'><i></br>Нижче у Вас є можливість залишити відгук про наш сайт</br></br></i></h2>
			    
					<form action="../content/controller.php" method="post">
						
						<div id='form' align="left">
							Ваше імя <i style="color:red">*<i>
							<input type="text"
								name="name"
								value=""></br>
						</div>

						<div id='form' align="center">
							Нижче Ви можете залишити Ваш коментар<i style="color:red">*<i>
							<textarea name="coment" id="coment" cols="30" rows="4"></textarea>
							</br></br>
							</br></br>

							<img src="../captcha/captcha.php" alt="Картинка" /><br />
							Текст на картинці<i style="color:red">*<i>:</br> <input type="text" name="captcha" /><br /></br></br>
																			
						<input type="submit" value="Залишити заявку" name="submit"></br></br></br>
						<i style="font-size:14; color:#FF5252"><u>*** Відмічені поля є обовязковими для заповнення</u></i></br></br>
						</div>

						<div id='form' align="center">
							Адреса ел. скриньки <i style="color:red">*<i>
							<input type="text"
								name="email"
								value=""></br>
							</div>
						</div>
					</form>
			    
			</div>
			   	
    	</div>
	</body>
</html>