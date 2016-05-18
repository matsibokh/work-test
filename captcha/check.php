<?php
session_start();
if (isset($_SESSION["captcha"]) && $_SESSION["captcha"]===$_POST["captcha"]) echo "Текс введен верно";
else echo "Текст введен не верно";
unset($_SESSION["captcha"]);
?>