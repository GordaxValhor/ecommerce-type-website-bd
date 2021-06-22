<?php
 session_start();
 if(!(isset($_SESSION["shopping_cart"])))
 {
        header("Location: https://belissimadesign.com/cos-page.php");
 }
?>
<html>
    <head>
        <title>Plasare Comanda-Belissima Design</title>
        <link rel="shortcut icon" href="./icon.ico">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css"  href="./CSS/menu_bar-style.css">
        <link rel="stylesheet" type="text/css"  href="./CSS/general-style.css">
        <link rel="stylesheet" type="text/css"  href="./CSS/o_place.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=yes"/>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>
    <div class="menu_bar">
            <div class="menu-icon">
                <img title="Meniu." src="./images/menu-icon2.png">
            </div>
            <div class="menu">
                    <ul>
                        <li><p>Menu</p></li>
                        <li><a href="./shop.php?q=rochie">Rochii</a></li>
                        <li><a href="./shop.php?q=bluza">Bluze</a></li>
                        <li><a href="./shop.php?q=fusta">Fuste</a></li>
                    </ul>
                    <ul style="margin-top: 70px;">
                        <span><li><a href="./shop.php">Magazin</a></li>
                        <li><a href="./info-page.php">Informații</a></li>
                        <li><a href="./contact-page.php">Contact</a></li></span>
                    </ul>
            </div>
            <div class="logo">
                    <a href="index.php"><img  src="./images/logo_r2.png"></a>
            </div>
            <div class="basket">
                <a href="./cos-page.php" title="Cos de cumparaturi."><img src="./images/basket2.png"></a>
            </div>
            <?php
            if(isset($_SESSION["shopping_cart"]))
            {
                $nr_p=count($_SESSION["shopping_cart"]);
                $_SESSION['nr_p']=$nr_p;
                if($_SESSION['nr_p']!=0)
                {
                    echo "<div class='nr_p'>
                                <p>".$_SESSION['nr_p']."</p>
                        </div>";
                }
            }
            ?>
    </div>
    <h2 style="margin-top:200px;margin-left:10px">Plasarea comenzi: </h2>
    <p style="margin-left: 20px;">Vă rugăm sa introduce-ți datele dumneavoastră pentru procesarea comenzi.</p>
    <!--formuri pt comanda-->
    
    <!--Date client-->
        <!--linkul unde ne trimite acest form este pagina speciala euplatesc unde se face plata-->
        <form class='form1 container' action='./plata/order_finish.php' method="POST">
            <div class='formuri'>
            <p style="font-weight: 600;">Date client:</p>
                <input type="text" name='nume' title="Introduceti-va corect numele ." placeholder='Nume:' required><br>
                <input type="text" name='prenume' title="Introduceti-va corect prenumele ." placeholder='Prenume:' required><br>
                <input type="tel" name='tel' pattern="[0-9]{10}" title="Introduceti-va corect numarul de tel. " placeholder='Nr. de telefon:' required><br>
                <input type="email" name='e-mail' placeholder='E-mail:' title="Introduceti-va corect adresa de e-mail." required><br>
            <!--Adresa-->
            <p style="font-weight: 600;">Adresă client:</p>
                <input type="text" name='judet' placeholder='Judet:' title="Introduceti-va corect numele Judetului. De exemplu: 'Suceava'." required><br>
                <input type="text" name='adresa' placeholder='Oras/sat,strada,bloc/apartament,nr:' title="De exemplu: 'Baia Mare,Luminisului, scara:2,nr:24'" required><br>
            </div>
        
            <div class='total_order'>
                <p style="font-weight: 600;" >Detalii comandă:</p>
                <?php
                //afisam produsele din cos doar nume si pret
                $i=1;
                $total=0;
                echo "<p>Produse:</p>";
                echo "<div class='produs'> ";
                foreach($_SESSION['shopping_cart'] as $produs)
                {
                    echo
                    "   
                            <div class='item-1'>
                                <p>".$i.".</p>
                                <a href='./product-page.php?id=".$produs['id']."'><p>".$produs['nume']."</p></a>
                                <p>".$produs['pret']." ron.</p>
                            </div>
                    ";
                    $i++;
                    $total=$total+($produs['pret']*$produs['cantitate']);
                    //$total = number_format( $total ,2);
                }
                echo "</div>";
                echo "<hr>";
                echo "<p>Total comanda:  <span style='font-weight: 600;'> ".$total." </span>ron</p>";
            ?>
                <input type='hidden' name='total_pret' value="<?php echo ($total); ?>">
                <h4 style="margin-top:30px;">Alegeti metoda de plată:</h4>
                <!--<p>Prin card (Plata se face prin euplatesc.ro)<input type="radio" name="metodaPlata" id="" value='prinCard' required></p>-->
                <p>Prin ramburs (Livrare rapida prin curier)<input type="radio" name="metodaPlata" id="" value='prinRamburs' required></p>
                <!--<p>Prin virament bancar<input type="radio" name="metodaPlata" id="" value='prinTransfer' required></p>-->
                <input type="submit" class='order_button' name='submit_order' value="Trimite comanda">
            </div>
        </form>
        
    </div>
    <div class="bottom-tag">
            <div class='bottom-box'>
                <ul>
                    <li><a href='./index.php'>Acasă</a></li>
                    <li><a href='./shop.php'>Magazin</a></li>
                    <li><a href='./info-page.php'>Informații</a></li>
                    <li><a href='./info-page.php'>Termeni și conditii</a></li>
                </ul>
                <ul>
                    <li><a href='./info-page.php'>Metode de plată</a></li>
                    <li><a href='./info-page.php'>Informații retur</a></li>
                    <li><a href='https://anpc.ro/'>ANPC</a></li>
                </ul>
                <ul>
                <li ><a href='https://www.facebook.com/pg/croitoriecomada'><img style='height:25px;' src='./images/f_logo_RGB-White_58.png'></a></li>
                </ul>
            </div>
            <p style="margin-bottom: 30px;"><img style="width: 70%;max-width: 700px;" src="./images/eu_platescImg.jpg" alt=""></p>
            <p style="margin: 15px; margin-bottom: 50px;">Contact - Telefon: (+40) 0767660498 sau (+40) 0721955639, E-mail: office@belissimadesign.com</p>
            <p>Copyright © 2019-2020 belissimadesign.com. Toate drepturile rezervate.</p>
            <p>Web design by <a href='https://www.facebook.com/ianos.calin'>Ianoș Călin</a></p>
        </div>
    <script type="text/javascript" src="./JS/menu.js"></script>
    </body>
</html>
