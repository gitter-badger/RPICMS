<?php
	include_once('./navi.php');
	include_once('./GoogleAuthenticator.php');
	$g = new GoogleAuthenticator();
	function die_back($str) {
		die ($str.'<br/><a href="./login.php">back</a>');
	}
	$token = $_GET['token'];
	$user = $_GET['username'];
	$hash = $_GET['hash'];
	$ga_token_input = $_GET['ga_token'];
	$verbindung = mysql_connect ("localhost","db_acess", "raspberry") or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
 	mysql_select_db("login_sec") or die("db geht nicht");
 	$token_vaild = false;
 	$abfrage = "SELECT time,vaild_sec,token FROM hashtoken WHERE token = '$token'"; 
 	$ergebnis = mysql_query($abfrage);
 
 	while($row = mysql_fetch_object($ergebnis)){
   		$token_vaild = true;
		$creat_time = $row->time;
		$vaild_sec = $row->vaild_sec;
	}
   
	if (!($token_vaild)) {
		die_back('something went wrong :/');
	}
	if (($creat_time + $vaild_sec) < time()) {
		die_back('timeout');
	}
	$loeschen = "DELETE FROM hashtoken WHERE token = '$token'";
	$loesch = mysql_query($loeschen);
	$user_exist = false;
	$abfrage = "SELECT name,passwdhash,id,ga_secret FROM user WHERE name = '$user'"; 
	$ergebnis = mysql_query($abfrage);
	while($row = mysql_fetch_object($ergebnis)){
		$user_exist = true;
		$passwdhash = $row->passwdhash;
		$userid = $row->id;
		$ga_secret = $row->ga_secret;
	}
	if (!userexist) {
		die_back('unbekanter benutzername');
	}
	$hash_db = hash('sha512',$passwdhash.$token);
	if ($hash_db == $hash) {
		//print("du bist eingelogt");
	} else {
		die_back('falsches passwort');
	}

	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	    $ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
    	$ip = $_SERVER['REMOTE_ADDR'];
	}
	$hash=hash('sha512',$_SERVER['HTTP_USER_AGENT'].$ip); 

	$vorhanden = false;

	$abfrage = "SELECT id, hash FROM cookiedata WHERE hash = '$hash'";
	$ergebnis = mysql_query($abfrage);
	while($row = mysql_fetch_object($ergebnis)){
   		if ($row->hash == $hash){
   			$id_cookie = $row->id;	
   			$vorhanden =true;
   		}
   	}
   
	$expiration_time = time() +120*60; //laenge des auth
	$cookie = hash('sha512',$hash.$userid.$expiration_time);
 	if ($vorhanden){
		$aendern = "UPDATE cookiedata Set hash = '$hash', userid = '$userid', vaildtime = '$expiration_time' cookie_hash = '$cookie' WHERE id = '$id_cookie'";
		$update = mysql_query($aendern);
		print("update");
	} else {
		$eintrag = "INSERT INTO cookiedata (hash, userid, vaildtime, cookie_hash) VALUES ('$hash', '$userid', '$expiration_time', '$cookie')";
		$eintragen = mysql_query($eintrag);
		print("new");
	}

	if ($eintragen ||$update) {
		if ($g->checkCode($ga_secret,$ga_token_input)) {
			setcookie("acess",$cookie,$expiration_time);
			print("Hallo ".$user."<br/>Wilkommen");
		} else {
			die_back("the token is wrong or to old, try it again");
		}
	} else {
		die_back("something on the db went wrong");
	}
?>