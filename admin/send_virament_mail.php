<?php
    include 'db_connect.php';
    $nume_client=$_POST['nume_client'];
    $mail_client = $_POST['mail_client'];
    $nume_comanda = $_POST['nume_comanda'];
    echo "Ai trimis mail clientului ".$nume_client;
    echo "<br>".$nume_comanda;

 $mesaj="    Salut ".$nume_client." plata pentru comanda ta ".$nume_comanda." a fost inregistrata si in curand ne vom pune pe treaba ca tu sa primesti produsele comandate.
    
    Cu stima echipa Belissima Design.";
                $sbj="comanda ".$nume_comanda.".";
                $headers = "From: webmaster@example.com\r\n";
                if(mail($mail_client,$sbj,$mesaj,$headers))
                {
                    echo "<br>s-a trimis";
                    
                }
                else { echo "<br>nu s-a trimis";}
?>