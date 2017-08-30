<?php



// stare=============


	/* Set e-mail mine */
	$myemail = ($_POST['myemail']);

	// dane od odbiorcy
	$bonType = ($_POST['bonType']);
	$name = ($_POST['name']);
	$nameobda = ($_POST['nameobda']);
	$email = ($_POST['email']);
	$phonevar = ($_POST['phone']);

	$message = ($_POST['message']);
	$message=nl2br($message);

	// temat i unikalny id
		$subject = ($_POST['mysubject']);
		$t=time();
		$ID=date("hms",$t).rand(1,10);
		$subject= $subject.$ID;







	// headers
		// $headers = 'MIME-Version: 1.0' . "\r\n";
		// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


		// $headers .= 'From: prestiz-spa < zamowienia@prestiz-spa.pl >' . " \r\n" .
		//             'Reply-To: prestiz-spa < zamowienia@prestiz-spa.pl >' "\r\n" .
		//             'X-Mailer: PHP/' . phpversion();

		$headers = "From: prestiz-spa < zaproszenia@prestiz-spa.pl >\r\n";
		$headers .= "Reply-To: prestiz-spa < zaproszenia@prestiz-spa.pl >\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

		$headers2= $headers;
		// $headers2.='From: <' . $myemail .'>' . " \r\n" .
		//             'Reply-To: '.  $myemail . "\r\n" .
		//             'X-Mailer: PHP/' . phpversion();


	$page = $modx->getObject('modResource', 11);
	$wstep=$page->getTVValue('trescWstepu');
	$stopka=$page->getTVValue('stopkaMaila');


	//  poloa

		$bon = ($_POST['select-override-bon']);
		$platnosc= ($_POST['select-override-platnosc']);
		$wysylka= ($_POST['select-override-wysylka']);
		$trescwysylka=($_POST['select-override-wysylka-tresc']);
		$trescPayment=($_POST['paymanetText']);
		$kwota=($_POST['kwota']);
		$kwotaBonKwot=($_POST['kwotaBonKwot']);


	// jezeli type 1
		$bonDodatek="";
		$typeText="";
		$bonfull="";
		if($bonType ==="1"){
			$typeText="zabiegi";
			$bon=str_replace(",","</li><li>",$bon);
			$bon="<ul><li>".$bon."</li></ul>";
			$bonfull=$bon;
		}
		else{
			$typeText="kwotę";
			$bon="<p>".$kwotaBonKwot. "zł</p>";
			$bonDodatek= "bon na kwotę: ";
			$bonfull="<ul><li>".$bonDodatek.$kwotaBonKwot." zł</li></ul>";
		}



	$message = "
	<center><div style='background-color: #e4f4f4; max-width: 800px; padding:40px; text-align:left'>
		<p>$wstep</p>

		<p>Witaj, <b>$name  ($email).</b>  </p>
		<p>Nr telefonu: $phonevar  </p>
		<p>ID zamówienia: <b>$ID</b></p>
		<p>Wybrałeś bon upominkowy dla <b>$nameobda</b> na $typeText:</p>
		$bon

		<br>
		<p>Wybrana metoda dostawy $trescwysylka</p>

		<br>
		<p>Adres dostawy / dodatkowe informacje:</p>
		<p>$message</p>
		<br>
		<br>

		<p><b>Podsumowanie:</b></p>
		$bonfull
		<ul><li>$wysylka</li></ul>
		<p><b>Suma: $kwota zł</b></p>
		<br>

		<p>Wybrany rodzaj płatności $trescPayment</p>
	</div></center>

	<br>
	<br>
	$stopka
	";




	// echo $email;
	/* Send the message using mail() function */
	// echo $myemail . "   " .$email;
	mail($myemail,$subject,$message,$headers);

	// echo $to= $myemail.",".$email;
	$succ=mail($email,$subject,$message,$headers);

	if ($succ) {
		echo 1;
	} else {
		echo 0;

	}
	// mail($myemailServer, $subject, $message);




?>

