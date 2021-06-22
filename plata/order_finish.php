<?php
    session_start();
    include 'db_connect.php';
    //odata ce el da submit la comanda o sa avem o verificare  de ce fel de submit a facut card sau virament bancar
    //daca e virament bancar ne ocupam noi
    //daca e plata cu card ii trimitem la euplatesc.com
    if(!(isset($_SESSION['shopping_cart']))){
        header("Location:  https://belissimadesign.com/cos-page.php");
    }
    require '../phpmailer/PHPMailerAutoload.php';
? >
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
            if((isset($_POST['submit_order'])))
            {
                if($_POST['metodaPlata']=='prinCard')
                {   
                    //variabile pentru comanda
                    $nume_client= $_POST['nume'] . " " .$_POST['prenume'];
                    $tel=$_POST['tel'];
                    $mail=$_POST['e-mail'];
                    $adresa=" Judet ".$_POST['judet']." ,".$_POST['adresa'];
                    $data= date("d/m/Y"); $data_procesari_comenzii= $data;
                    $pret=$_POST['total_pret'];
                    $produse="";
                    if(isset($_SESSION['shopping_cart'])){
                            foreach($_SESSION['shopping_cart'] as $produs)
                            {
                                if($produse!=""){
                                    $produse=$produse.", ".($produs['nume']."(".$produs['marime']."|".$produs['cantitate'].")");
                                }
                                else {
                                    $produse=$produse.($produs['nume']."(".$produs['marime']."|".$produs['cantitate'].")");;
                                }
                                
                            }
                        }
                    $query = "SELECT * FROM comenzi ORDER BY id DESC LIMIT 1";
                    $results=mysqli_query($conn,$query);
                    $numResults = mysqli_num_rows($results);
                            if ($numResults > 0) 
                            {
                                while($row = mysqli_fetch_assoc($results))
                                {
                                    $numar_comanda=$row['nr_comanda']+1;
                                }
                            }
                    $nume_comanda="#".$numar_comanda."-".$produse."-pret total: ".$pret." ron
                    ";
                    $m_plata='ramburs';
                    //cream sesiunea pt order_new
                    $order_new = array(
                        'nume_comanda'=>$nume_comanda,
                        'nr_comanda'=>$numar_comanda,
                        'nume_client'=> $nume_client ,
                        'tel_client'=> $tel,
                        'email_client'=> $mail,
                        'pret_total'=>$pret,
                        'adresa' => $adresa,
                        'data' => $data_procesari_comenzii
                        );
                    $_SESSION["order_new"] = $order_new;   
                    include'ep_send.php';
                }
                else {
                    //header("Location:  http://localhost./order_finish.php");
                    //aici trimitem sa faca plata si dupa sa se intoarca to pe acesta pagina.
                }
                
            }
            //PENTRU RAMBURS 
            if((isset($_POST['submit_order'])))
            {
                if($_POST['metodaPlata']=='prinRamburs'){
                    $nume_client= $_POST['nume'] . " " .$_POST['prenume'];
                    $tel=$_POST['tel'];
                    $mail=$_POST['e-mail'];
                    $adresa=" Judet ".$_POST['judet']." ,".$_POST['adresa'];
                    $data= date("d/m/Y"); $data_procesari_comenzii= $data;
                    $pret=$_POST['total_pret'];
                    $produse="";
                    if(isset($_SESSION['shopping_cart'])){
                            foreach($_SESSION['shopping_cart'] as $produs)
                            {
                                if($produse!=""){
                                    $produse=$produse.", ".($produs['nume']."(".$produs['marime']."|".$produs['cantitate'].")");
                                }
                                else {
                                    $produse=$produse.($produs['nume']."(".$produs['marime']."|".$produs['cantitate'].")");;
                                }
                                
                            }
                        }
                    
                    $query = "SELECT * FROM comenzi ORDER BY id DESC LIMIT 1";
                    $results=mysqli_query($conn,$query);
                    $numResults = mysqli_num_rows($results);
                            if ($numResults > 0) 
                            {
                                while($row = mysqli_fetch_assoc($results))
                                {
                                    $numar_comanda=$row['nr_comanda']+1;
                                }
                            }
                    $nume_comanda="#".$numar_comanda."-".$produse."-pret total: ".$pret." ron
                    ";
                    $m_plata='ramburs';
                    $query="INSERT INTO comenzi(nr_comanda,nume_comanda,nume_client,nr_tel_client,mail_client,adresa_client,m_plata,produse,total_plata,data_comenzii) VALUES ($numar_comanda,'$nume_comanda','$nume_client','$tel','$mail','$adresa','$m_plata','$produse',$pret,'$data_procesari_comenzii');";
                    $result=mysqli_query($conn,$query);
                    if($result)
                    {
                        //aici o sa avem doua chesti si anume trimiterea mailului spre client cat si spre matusa
                        //afisam pagina de finalizare
                        echo "
                            
                            <div class='box'>
                                <h3>Multumim <span style='font-weight:300;'>".$nume_client."</span> ca ai ales servicile noastre!</h3>
                                <p>Comanda dumneavoastra #".$numar_comanda." in valoare de ".$pret." ron + transport
                                 a fost inregistrata. 
                                Metoda de plata aleasa de dumneavoastra este prin ".$m_plata." iar toate informatile 
                                necesare va vor fi trimise prin e-mail.</p>
                                <p>Veti primi in scurta durata un e-mail cu confirmarea comenzii.</p>
                                <h3>Produsele comandate:</h3>
                                <hr>
                            ";
                            if(isset($_SESSION['shopping_cart'])){
                                foreach($_SESSION['shopping_cart'] as $produs)
                                    {
                                        echo"
                                        <div class='produs'>
                                            <div class='cutie'>
                                            <div class='img'><a href='./product-page.php?id=".$produs['id']."' target='_blank'><img src='../img_p/".$produs['numar']."/".$produs['numar']."_1.jpg'></a></img></div>
                                                <a href='./product-page.php?id=".$produs['id']."' target='_blank'><h3>".$produs['nume']."</h3></a>
                                            <div class='produs_flex'>
                                                <p class='item'>Cantitate: ".$produs['cantitate']."</p>
                                                <p class='item'>Marime: ".$produs['marime']."</p>
                                                <h4 class='item'><span>Pret: ".number_format($produs['pret'],2)." ron</span></h4>
                                            </div>
                                            </div>
                                        </div>";
                                    }
                            }
                        echo "<hr><h3>Pret total ".$pret." ron
                        </h3></div>";
                        
                        //mail pt client
                    if(isset($_SESSION['shopping_cart']))
                        {
                        $htmlContent_produse="";
                            if(isset($_SESSION['shopping_cart'])){
                                $i=1;
                                foreach($_SESSION['shopping_cart'] as $produs)
                                    {
                                        
                                        $htmlContent_produse.="<tr style='padding: 2px 0 2px 0;'>
                                            <td style='width: 5px;font-size: 12px;padding: 1px;'>".$i.".</td>
                                            <td style='font-size: 12px;padding: 1px;'>".$produs['nume']."</td>
                                            <td style='font-size: 12px;padding: 1px;'>".$produs['marime']."</td>
                                            <td style='font-size: 12px;padding: 1px 4px 1px 2px;'>".$produs['cantitate']."</td>
                                            <td style='font-size: 12px;padding: 1px;'>".$produs['pret']." ron</td>
                                        </tr>";
                                        $i=$i+1;
                                    }
                            }
                            $htmlContent="<head> 
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
                            </style>
                            <body>
                                <table cellspacing='0' style=' width: 100%;'>
                                    <tr>    
                                        <td align='center' style='padding: 0px 0 30px 0; '><img style='box-shadow: 0px 4px 4px 0px rgb(48, 48, 48);' src='https://belissimadesign.com/images/logo_r2_small.png' alt='Belissima design'></td>
                                    </tr>
                                    <tr>  
                                        <td style='background-color:#1A1A1A; padding: 10px 30px 0px 30px;'>
                                            <table cellspacing='0' style='color:white;width: 100%;'>
                                                <tr>
                                                    <td>Salut,</td>
                                                </tr>
                                                <tr>
                                                    <td style='padding: 20px 0 10px 0;'>Multumim ca ati ales belissimadesign.com! Comanda dumneavoastra #".$numar_comanda." a fost inregistrata si urmeaza sa fie procesata. 
                                                    Metoda de plata aleasa de dumneavoastra este prin ".$m_plata.". Veti plati comanda odata ce curierul v-a adus produsele.</td>
                                                </tr>
                                                <tr>
                                                    <td style='padding: 0px 0 10px 0;'>Daca apar anumite probleme cu disponibilitatea produselor o sa fiti anuntati de catre un operator belissimadesign.com.</td>
                                                </tr>
                                                <tr>
                                                    <td style='padding: 0px 0 10px 0;'>Pentru informatii suplimentare ne puteti contacta pe e-mail: office@belissimadesign.com sau la numarul: (+40) 0767660498.</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr> 
                                    <tr> 
                                        <td style='padding: 10px 30px 10px 30px;'>
                                                <table cellspacing='0' style=' width: 100%;'>
                                                    <tr>
                                                        <td style='font-size: 14px;'>Detalii comanda:</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Numar comanda: #".$numar_comanda."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Data: ".$data_procesari_comenzii."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Cumparator: ".$nume_client."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>E-mail: ".$mail."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Telefon: ".$tel."</td>
                                                    </tr>
                                                </table>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td style='background-color:#1A1A1A;padding: 10px 30px 10px 30px;'>
                                                <table cellspacing='0' style='color:white;width: 100%;'>
                                                    <tr>
                                                        <td style='font-size: 14px;'>Date facturare:</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Metoda plata: prin ".$m_plata."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Metoda livrare: curier</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Adresa livrare:".$adresa."</td>
                                                    </tr>
                                                </table>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td style='padding: 10px 30px 10px 30px;'>
                                                <table cellspacing='0' style='width: 100%;word-break:normal;'>
                                                    <tr style='width: 100%;'>
                                                        <td>Produse comandate:</td>
                                                    </tr>
                                                    ".$htmlContent_produse."
                                                    <tr style='width: 100%;'>
                                                        <td>Total: ".$pret." ron + transport</td>
                                                    </tr>
                                                </table>
                                        </td>
                                    </tr> 
                                </table> 
                            </body>";

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
                            $send_mail->Subject='Comanda dumneavoastra cu numarul #'.$numar_comanda;
                            $send_mail->Body = $htmlContent;
                            $send_mail->AddAddress($mail);

                            if($send_mail->Send()){ 
                                //echo 'Email has sent successfully.';
                                //session_destroy();
                            }else{ 
                            echo 'A aparut o eroare cu adresa dumneavoastra de email.'; 
                            }
                            //SEND mail la matusa  
                            $htmlContent = "<head>
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
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Numar comanda: #".$numar_comanda."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Data: ".$data_procesari_comenzii."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Cumparator: ".$nume_client."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>E-mail: ".$mail."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Telefon: ".$tel."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Detalii comanda ".$nume_comanda."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Adresa client:".$adresa."</td>
                                                    </tr>
                                                </table>
                                        </td>
                                </table>
                            </body>'";

                            //php mailer
                             
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
                            $send_mail->Subject='Comanda noua cu numarul #'.$numar_comanda;
                            $send_mail->Body = $htmlContent;
                            $send_mail->AddAddress('office@belissimadesign.com');

                            if($send_mail->Send()){ 
                                //echo 'Email has sent successfully.';
                                session_destroy();
                            }else{ 
                            echo 'A aparut o eroare cu adresa dumneavoastra de email.'; 
                            } 
                        }
                    }
                }
            }            //send mail matusa
//=========================================================================================================
            if((isset($_POST['submit_order'])))
            {
                if($_POST['metodaPlata']=='prinTransfer'){
                    $nume_client= $_POST['nume'] . " " .$_POST['prenume'];
                    $tel=$_POST['tel'];
                    $mail=$_POST['e-mail'];
                    $adresa=" Judet ".$_POST['judet']." ,".$_POST['adresa'];
                    $data= date("d/m/Y"); $data_procesari_comenzii= $data;
                    $pret=$_POST['total_pret'];
                    $produse="";
                    if(isset($_SESSION['shopping_cart'])){
                        foreach($_SESSION['shopping_cart'] as $produs)
                        {
                            if($produse!=""){
                                $produse=$produse.", ".($produs['nume']."(".$produs['marime']."|".$produs['cantitate'].")");
                            }
                            else {
                                $produse=$produse.($produs['nume']."(".$produs['marime']."|".$produs['cantitate'].")");;
                            }
                            
                        }
                    }
                    
                    $query = "SELECT * FROM comenzi ORDER BY id DESC LIMIT 1";
                    $results=mysqli_query($conn,$query);
                    $numResults = mysqli_num_rows($results);
                            if ($numResults > 0) 
                            {
                                while($row = mysqli_fetch_assoc($results))
                                {
                                    $numar_comanda=$row['nr_comanda']+1;
                                }
                            }
                    $nume_comanda="#".$numar_comanda."-".$produse."-pret total: ".$pret." ron
                    ";
                    $m_plata='virament';
                    $query="INSERT INTO comenzi(nr_comanda,nume_comanda,nume_client,nr_tel_client,mail_client,adresa_client,m_plata,produse,total_plata,data_comenzii) VALUES ($numar_comanda,'$nume_comanda','$nume_client','$tel','$mail','$adresa','$m_plata','$produse',$pret,'$data_procesari_comenzii');";
                    $result=mysqli_query($conn,$query);
                    if($result)
                    {
                        //aici o sa avem doua chesti si anume trimiterea mailului spre client cat si spre matusa
                        //afisam pagina de finalizare
                        echo "
                            
                            <div class='box'>
                                <h3>Multumim <span style='font-weight:300;'>".$nume_client."</span> ca ai ales servicile noastre!</h3>
                                <p>Comanda dumneavoastra #".$numar_comanda." in valoare de ".$pret." ron
                                 a fost inregistrata. 
                                Metoda de plata aleasa de dumneavoastra este prin ".$m_plata." iar toate informatile 
                                necesare va vor fi trimise prin e-mail.</p>
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
                                            <div class='img'><a href='./product-page.php?id=".$produs['id']."' target='_blank'><img src='../img_p/".$produs['numar']."/".$produs['numar']."_1.jpg'></a></img></div>
                                                <a href='./product-page.php?id=".$produs['id']."' target='_blank'><h3>".$produs['nume']."</h3></a>
                                            <div class='produs_flex'>
                                                <p class='item'>Cantitate: ".$produs['cantitate']."</p>
                                                <p class='item'>Marime: ".$produs['marime']."</p>
                                                <h4 class='item'><span>Pret: ".number_format($produs['pret'],2)." ron
                                                </span></h4>
                                            </div>
                                            </div>
                                        </div>";
                                    }
                            }
                        echo "<hr><h3>Pret total ".$pret." ron
                        </h3></div>";
                        
                        //mail pt client
                    if(isset($_SESSION['shopping_cart']))
                        {
                        $htmlContent_produse="";
                            if(isset($_SESSION['shopping_cart'])){
                                $i=1;
                                foreach($_SESSION['shopping_cart'] as $produs)
                                    {
                                        
                                        $htmlContent_produse.="
                                        <tr style='padding: 2px 0 2px 0;'>
                                            <td style='width: 5px;font-size: 12px;padding: 1px;'>".$i.".</td>
                                            <td style='font-size: 12px;padding: 1px;'><img style='height: 30px; src='https://belissimadesign.com/img_p/".$produs['numar']."/".$produs['numar']."_1.jpg' alt='imagine' alt='img'></td>
                                            <td style='font-size: 12px;padding: 1px;'>".$produs['nume']."</td>
                                            <td style='font-size: 12px;padding: 1px;'>".$produs['marime']."</td>
                                            <td style='font-size: 12px;padding: 1px 4px 1px 2px;'>".$produs['cantitate']."</td>
                                            <td style='font-size: 12px;padding: 1px;'>".$produs['pret']." ron</td>
                                        </tr>";
                                        $i=$i+1;
                                    }
                            }
                            $htmlContent="<html>
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
                            </style>
                            <body>
                                <table cellspacing='0' style=' width: 100%;'>
                                    <tr>    
                                        <td align='center' style='padding: 0px 0 30px 0; '><img style='box-shadow: 0px 4px 4px 0px rgb(48, 48, 48);height: 30px;'src='https://belissimadesign.com/images/logo_r2.png' alt='Belissima design'></td>
                                    </tr>
                                    <tr>  
                                        <td style='background-color:#1A1A1A; padding: 10px 30px 0px 30px;'>
                                            <table cellspacing='0' style='color:white;width: 100%;'>
                                                <tr>
                                                    <td>Salut,</td> 
                                                </tr>
                                                <tr>
                                                    <td style='padding: 20px 0 10px 0;'>Multumim ca ati ales belissimadesign.com! Comanda dumneavoastra #".$numar_comanda." a fost inregistrata si urmeaza sa fie procesata. 
                                                    Metoda de plata aleasa de dumneavoastra este prin ".$m_plata.". Codul IBAN la care o sa faceti viramentul bancar este 123456789.</td>
                                                </tr>
                                                <tr>
                                                    <td style='padding: 0px 0 10px 0;'>Daca apar anumite probleme cu disponibilitatea produselor o sa fiti anuntati de catre un operator belissimadesign.com.</td>
                                                </tr>
                                                <tr>
                                                    <td style='padding: 0px 0 10px 0;'>Pentru informati suplimentare ne puteti contacta pe e-mail: office@belissimadesign.com sau la numarul: (+40) 0767660498.</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr> 
                                    <tr> 
                                        <td style='padding: 10px 30px 10px 30px;'>
                                                <table cellspacing='0' style=' width: 100%;'>
                                                    <tr>
                                                        <td style='font-size: 14px;'>Detalii comanda:</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Numar comanda: #".$numar_comanda."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Data: ".$data_procesari_comenzii."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Cumparator: ".$nume_client."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>E-mail: ".$mail."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Telefon: ".$tel."</td>
                                                    </tr>
                                                </table>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td style='background-color:#1A1A1A;padding: 10px 30px 10px 30px;'>
                                                <table cellspacing='0' style='color:white;width: 100%;'>
                                                    <tr>
                                                        <td style='font-size: 14px;'>Date facturare:</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Metoda plata: prin ".$m_plata."</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Metoda livrare: curier</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='font-size: 12px;padding: 0px 0px 0px 10px;'>Adresa livrare:".$adresa."</td>
                                                    </tr>
                                                </table>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td style='padding: 10px 30px 10px 30px;'>
                                                <table cellspacing='0' style='width: 100%;'>
                                                    <tr>
                                                        <td>Produse comandate:</td>
                                                    </tr>".$htmlContent_produse."<tr>
                                                        <td>Total: ".$pret."ron</td>
                                                    </tr>
                                                </table>
                                        </td>
                                    </tr> 
                                </table> 
                            </body> 
                            </html>";
                            $to = $mail; 
                            $from = 'belissimadesign.com'; 
                            $fromName = 'echipa belissima design'; 
                            $subject = 'test';
                            $headers = "MIME-Version: 1.0" . "\r\n"; 
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                            $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n";  
                            // Send email 
                            if(mail($to, $subject, $htmlContent, $headers)){ 
                                //echo 'Email has sent successfully.';
                                session_destroy();
                            }else{ 
                            echo 'A aparut o eroare cu adresa dumneavoastra de email.'; 
                            }
                            //mail matusa 
                            //inca nu il am dar stiu cum il fac
                        }
                    }
                }
            }
        ? >  
    </div>
    <a style='text-align:center; margin: 10px;' href='../index.php'><p>Intoarceti-va la site</p></a>
                            
</body>
</html>