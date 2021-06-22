<?php
//preluarea datelor mele
	$nume_client=$_POST['nume'];
    $prenume_client=$_POST['prenume'];
    $tel_client=$_POST['tel'];
    $email_client=$_POST['e-mail'];
    $judet_client=$_POST['judet'];
    $adresa_client=$_POST['adresa'];
	$pret_total = $_POST['total_pret'];
//=========
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
function euplatesc_mac($data, $key)
{
  $str = NULL;

  foreach($data as $d)
  {
   	if($d === NULL || strlen($d) == 0)
  	  $str .= '-'; // valorile nule sunt inlocuite cu -
  	else
  	  $str .= strlen($d) . $d;
  }
     
  // ================================================================
  $key = pack('H*', $key); // convertim codul secret intr-un string binar
  // ================================================================

// echo " $str " ;

  return hmacsha1($key, $str);
}


  $dataAll = array(
			'amount'      => $pret,                                                  //suma de plata
			'curr'        => 'RON',                                                   // moneda de plata
			'invoice_id'  => $numar_comanda,  // numarul comenzii este generat aleator. inlocuiti cuu seria dumneavoastra
			'order_desc'  => $nume_comanda,                                            //descrierea comenzii
                     // va rog sa nu modificati urmatoarele 3 randuri
			'merch_id'    => $mid,                                                    // nu modificati
			'timestamp'   => gmdate("YmdHis"),                                        // nu modificati
 			'nonce'       => md5(microtime() . mt_rand()),                            //nu modificati
); 
  
  $dataAll['fp_hash'] = strtoupper(euplatesc_mac($dataAll,$key));

//completati cu valorile dvs
$dataBill = array(
			'fname'	   =>  $nume_client,      // nume
			'lname'	   =>  $prenume_client,   // prenume
			'country'  => 'Romania',      // tara
			'company'  => '',
			'county'   =>  $judet_client,      // judet
			'add'	   =>  $adresa_client,    // adresa
			'email'	   =>  $email_client,    // email
			'phone'	   =>  $tel_client,   // telefon
			'fax'	   => '',       // fax
);
$dataShip = array(
			'sfname'       =>  $nume_client,     // nume
			'slname'       =>  $prenume_client,  // prenume
			'scountry'     => 'Romania',     // tara
			'company'  => 	'',
			'county'       =>  $judet_client,     // oras
			'sadd'         =>  $adresa_client,      // adresa
			'semail'       =>  $email_client,    // email
			'sphone'       =>  $tel_client,  // telefon
			'sfax'	       => '',      // fax
);

// ===========================================================================================


?>
