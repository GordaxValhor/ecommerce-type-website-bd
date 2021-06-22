<?php
	session_start();
	include 'db_connect.php';
	require '../phpmailer/PHPMailerAutoload.php';
?>
<!DOCTYPE html>
		<html lang="en">
		<head>
			<title>Finalizare comanda-Belissima Design</title>
			<link rel="shortcut icon" href="https://belissimadesign.com/icon.ico">
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=yes"/>
			<link rel="stylesheet" href=" https://belissimadesign.com/CSS/general-style.css">
			<link rel="stylesheet" href=" https://belissimadesign.com/CSS/o_f_page.css">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
		</head>
<body>
<div class="container">
        <h2>Finalizare comanda</h2>
	<?php
	$key=""; //**
			$zcrsp =  array (
			'amount'     => addslashes(trim(@$_POST['amount'])),  //original amount
			'curr'       => addslashes(trim(@$_POST['curr'])),    //original currency
			'invoice_id' => addslashes(trim(@$_POST['invoice_id'])),//original invoice id
			'ep_id'      => addslashes(trim(@$_POST['ep_id'])), //Euplatesc.ro unique id
			'merch_id'   => addslashes(trim(@$_POST['merch_id'])), //your merchant id
			'action'     => addslashes(trim(@$_POST['action'])), // if action ==0 transaction ok
			'message'    => addslashes(trim(@$_POST['message'])),// transaction responce message
			'approval'   => addslashes(trim(@$_POST['approval'])),// if action!=0 empty
			'timestamp'  => addslashes(trim(@$_POST['timestamp'])),// meesage timestamp
			'nonce'      => addslashes(trim(@$_POST['nonce'])),
			);
			
			$zcrsp['fp_hash'] = strtoupper(euplatesc_mac($zcrsp, $key));

			$fp_hash=addslashes(trim(@$_POST['fp_hash']));
		if($zcrsp['fp_hash']===$fp_hash)	{
		// start facem update in baza de date
			if($zcrsp['action']=="0") {
			echo 
					"<div class='box'>
                    <h3>Multumim <span style='font-weight:300;'>".$_SESSION['order_new']['nume_client']."</span> ca ai ales servicile noastre!</h3>
					<p>Comanda dumneavoastra #".$_SESSION['order_new']['nr_comanda']." in valoare de ".$_SESSION['order_new']['pret_total']." ron a fost inregistrata.</p>
					<p>Plata prin card a avut succes si toate informatiile necesare va vor fi trimise prin e-mail.</p>
                    <p>Veti primi in scurta durata un e-mail cu confirmarea comenzi.</p>
                    <h3>Produsele comandate:</h3>
                    <hr>
					";
					if(isset($_SESSION['shopping_cart'])){
						foreach($_SESSION['shopping_cart'] as $produs)
							{
								echo"
								<div class='produs'>
									<div class='cutie'>
									<div class='img'><img src='../img_p/".$produs['numar']."/".$produs['numar']."_1.png'></img></div>
										<h3>".$produs['nume']."</h3>
									<div class='produs_flex'>
										<p class='item'>Cantitate: ".$produs['cantitate']."</p>
										<p class='item'>Marime: ".$produs['marime']."</p>
										<h4 class='item'><span>Pret: ".number_format($produs['pret'],2)." ron</span></h4>
									</div>
									</div>
								</div>";
							}
					}
				echo "<hr><h3>Pret total ".$_SESSION['order_new']['pret_total']." ron</h3></div>";
			// aici o sa fie afisarea mesajului daca tranzactia a avut SUCCES
			//afisam ce avem si in order finish[mesaj multumire,detali comanda, produse]
			//update in baza de date
			$m_plata='card';
			$numar_comanda = $_SESSION['order_new']['nr_comanda'];
			$nume_comanda = $_SESSION['order_new']['nume_comanda'];
			$nume_client = $_SESSION['order_new']['nume_client'];
			$tel = $_SESSION['order_new']['tel_client'];
			$mail = $_SESSION['order_new']['email_client'];
			$adresa = $_SESSION['order_new']['adresa'];
			$pret = $_SESSION['order_new']['pret_total'];
			$data_procesari_comenzii = $_SESSION['order_new']['data'];
			$query="INSERT INTO comenzi(nr_comanda,nume_comanda,nume_client,nr_tel_client,mail_client,adresa_client,m_plata,produse,total_plata,data_comenzii)  VALUES ($numar_comanda,'$nume_comanda','$nume_client','$tel','$mail','$adresa','$m_plata','-',$pret,'$data_procesari_comenzii');";
			$result=mysqli_query($conn,$query);
			if($result){
				echo "succes";
			}
			else {
				echo $query;
			}
			$htmlContent = "
                            <html>
                            <head> 
                                <title></title> 
                            </head>
                            <style>
                                *{
                                    font-family: 'Open Sans', sans-serif;
                                    font-size: 14px;
                                }
                                body {
                                    margin: 20px;
                                }
                                img {
                                    box-shadow: 0px 4px 4px 0px rgb(48, 48, 48);
                                    height: 50px;
                                }
                            </style>
                            <body>
                                <table cellspacing='0' style=' width: 100%;'>
                                    <tr>    
                                        <td align='center' style='padding: 0px 0 30px 0; '><img style='box-shadow: 0px 4px 4px 0px rgb(48, 48, 48);height: 50px;' src='https://belissimadesign.com/images/logo_r2.png' alt='Belissima design'></td>
                                    </tr>
                                        <td style='padding: 10px 30px 10px 30px;'>
                                                <table cellspacing='0' style=' width: 100%;'>
                                                    <tr>
                                                        <td style='font-size: 14px;'>Comanda noua:</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Numar comanda: #".$_SESSION['order_new']['nr_comanda']."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Data: ".$_SESSION['order_new']['data']."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Cumparator: ".$_SESSION['order_new']['nume_client']."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>E-mail: ".$_SESSION['order_new']['email_client']."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Telefon: ".$_SESSION['order_new']['tel_client']."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Detalii comanda ".$_SESSION['order_new']['nume_comanda']."</td>
													</tr>
													<tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Adresa client ".$_SESSION['order_new']['adresa']."</td>
                                                    </tr>
                                                </table>
                                        </td>
                                </table>
                            </body>
                            ";
							//PHP mailer
							$send_mail = new PHPMailer;

                            $send_mail -> charSet = "UTF-8";
                            $send_mail->host='mail.belissimadesign.com';
                            $send_mail->port= 465;
                            $send_mail->SMTPAuth=true;
                            $send_mail->SMTPSecure='ssl';
                            $send_mail->Username='office@belissimadesign.com';
                            $send_mail->Password='casiana543';

                            $send_mail->IsHTML(true);
                            $send_mail->From='office@belissimadesign.com';
                            $send_mail->FromName='Belissima Design';
                            $send_mail->Sender='office@belissimadesign.com';
                            $send_mail->AddReplyTo=('office@belissimadesign.com');
                            $send_mail->Subject='Comanda noua cu numarul #'.$_SESSION['order_new']['nr_comanda'];
                            $send_mail->Body = $htmlContent;
                            $send_mail->AddAddress('office@belissimadesign.com');

                            if($send_mail->Send()){ 
                                //echo 'Email has sent successfully.';
                                session_destroy();
                            }else{ 
                            echo 'A aparut o eroare cu adresa dumneavoastra de email.'; 
                            } 
			//mail-ul care o sa il primeasca matusa cu comanda
			//session_destroy();
			}
			else {
			echo "<div class='box'>
					<br>
					<h3>Ne pare rau dar plata comenzii dumneavoastra nu a avut succes.</h3>
					<p>Din aceasta cauza comanda nu a fost inregistrata. Veti primi in scurta durata un email cu mai multe informatii despre comanda.</p>
					<p>Dupa aflarea si rezolvarea eventualei probleme va rugam sa incercati sa faceti o alta comanda.</p>
				<hr>
			";
			// aici o sa fie afisarea mesajului daca tranzactia a ESUAT
			// plus motivul esuari 
			//update in baza de date
			// informatii de contact pt verificare comenzii si a presupusei probleme
			session_destroy();
			}
		// end facem update in baza de date
		}
		else {
		echo "Invalid signature";
		session_destroy();
		}
	?>
	<?php
	function hmacsha1($key,$data) {
	$blocksize = 64;
	$hashfunc  = 'md5';
	
	if(strlen($key) > $blocksize)
		$key = pack('H*', $hashfunc($key));
	
	$key  = str_pad($key, $blocksize, chr(0x00));
	$ipad = str_repeat(chr(0x36), $blocksize);
	$opad = str_repeat(chr(0x5c), $blocksize);
	
	$hmac = pack('H*', $hashfunc(($key ^ $opad) . pack('H*', $hashfunc(($key ^ $ipad) . $data))));
	return bin2hex($hmac);
	}
	// ===========================================================================================
	function euplatesc_mac($data, $key = NULL)
	{
	$str = NULL;

	foreach($data as $d)
	{
		if($d === NULL || strlen($d) == 0)
		$str .= '-'; // valorile nule sunt inlocuite cu -
		else
		$str .= strlen($d) . $d;
	}
		
	$key = pack('H*', $key); 

	return hmacsha1($key, $str);
	}

	?>
	<a style='text-align:center; margin: 10px;' href='../index.php'><p>Intoarceti-va la site</p></a>
</body>