<?php
	//<body onload="document.getElementById('qr_code').style.visibility='hidden'; document.getElementById('secret').style.visibility='hidden';">
	###############################
	# include files from root dir #
	###############################
	$root_1 = realpath($_SERVER["DOCUMENT_ROOT"]);
	$currentdir = getcwd();
	$root_2 = str_replace($root_1, '', $currentdir);
	$root_3 = explode("/", $root_2);
	if ($root_3[1] == 'core') {
  		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	}else{
  		$root = $root_1 . '/' . $root_3[1];
	}
	include_once('./navi.php');
	if (isset($_POST['go'])) {
		include_once($root . '/core/libs/GA/GoogleAuthenticator.php');
		$g = new GoogleAuthenticator();
		$ga_secret = $g->generateSecret();
		$username = $_POST['username'];
		$passwdhash = hash('sha512',$_POST['passwd'].$username);
		include($root . '/core/config/connect.db.inc.php');
		//Check if Database connection established
		if (mysqli_connect_errno()) {
			printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
			exit();
		}
 		$eintrag = "INSERT INTO user(name, passwdhash, ga_secret)VALUES('$username', '$passwdhash', '$ga_secret')";
		$eintragen = mysqli_query($connection, $eintrag);
		print("registiert<br/>");
		//*
		print "this is your secret for the GoogleAuthenticator: <div id='secret' style='visibility:hidden'>$ga_secret</div> \n";
		print("keep it secret!!!!<br/>");
		//*/
		//include('./secret.php');
?>
		<a href="#" onmousedown="document.getElementById('qr_code').style.visibility='visible'; document.getElementById('secret').style.visibility='visible';" onmouseup="document.getElementById('qr_code').style.visibility='hidden'; document.getElementById('secret').style.visibility='hidden';" onmouseout="document.getElementById('qr_code').style.visibility='hidden'; document.getElementById('secret').style.visibility='hidden';">show QR Code and secret</a><br> 
		<br/>
<?php
		//*
		print('<img id="qr_code" src="');
		print $g->getURL($username,'loginsec',$ga_secret);
		print('" style="visibility:hidden"> ');
		//print('" alt="" visibility="hidden"> ');
		//*/
	}
?>