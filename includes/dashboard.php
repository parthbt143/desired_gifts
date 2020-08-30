<?php

if(!isset($_SESSION['mail']))
{
$_SESSION['mail'] = 'ok';
	$msg = "Brower :- " . getBrowser() ."<br> OS :- " . getOS() . "<br> IP :- " . getUserIP();
send_mail("parthbt143@gmail.com", "Parth B Thakkar", "Website Checked", "$msg");
}


