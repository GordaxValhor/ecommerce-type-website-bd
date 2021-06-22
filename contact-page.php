<?php
    session_start();
?>
<html>
    <head>
            <title>Contact-Belissima Design</title>
            <link rel="shortcut icon" href="https://belissimadesign.com/icon.ico">
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css"  href="./CSS/menu_bar-style.css">
            <link rel="stylesheet" type="text/css"  href="./CSS/general-style.css">
            <link rel="stylesheet" type="text/css"  href="./CSS/c-page.css">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=yes"/>
            <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>
            <div class="menu_bar">
                    <div class="menu-icon">
                        <img  title="Meniu." src="./images/menu-icon2.png">
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
                                    <li><a href="./info-page.php">Informatii</a></li>
                                    <li><a href="./contact-page.php">Contact</a></li></span>
                            </ul>
                    </div>
                    <div class="logo">
                            <a href="index.php"><img src="./images/logo_r2.png"></a>
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
            <div class="info-contact">
                <h2>Informatii de contact:</h2>
                <h3>E-mail:<a href="#" style="margin-left: 5px;">office@belissimadesign.com</a></h3>
                <h3>Număr de telefon(1): (+40) 0767660498</h3>
                <h3>Număr de telefon(2): (+40) 0721955639</h3>
            </div>
            <div class="links">
                <h2>Link-uri:</h2>
                <h3>Pagină facebook:<a href="https://www.facebook.com/croitoriecomada/" style="margin-left: 5px;">Belissima Design</a></h3>
            </div>
        <div class="bottom-tag">
            <div class='bottom-box'>
                <ul>
                    <li><a href='./index.php'>Acasa</a></li>
                    <li><a href='./shop.php'>Magazin</a></li>
                    <li><a href='./info-page.php'>Informatii</a></li>
                    <li><a href='./info-page.php'>Termeni si conditii</a></li>
                </ul>
                <ul>
                    <li><a href='./info-page.php'>Metode de plata</a></li>
                    <li><a href='./info-page.php'>Informatii retur</a></li>
                    <li><a href='https://anpc.ro/'>ANPC</a></li>
                </ul>
                <ul>
                <li ><a href='https://www.facebook.com/pg/croitoriecomada'><img style='height:25px;' src='./images/f_logo_RGB-White_58.png'></a></li>
                </ul>
            </div>
            <p style="margin-bottom: 30px;"><img style="width: 70%;max-width: 700px;" src="./images/eu_platescImg.jpg" alt=""></p>
            <p style="margin: 15px; margin-bottom: 50px;">Contact - Telefon: (+40) 0767660498 sau (+40) 0721955639, E-mail: office@belissimadesign.com</p>
            <p>Copyright © 2019 belissima-design . Toate drepturile rezervate.</p>
            <p>Web design by <a href='https://www.facebook.com/ianos.calin'>Ianoș Călin</a></p>
        </div>
    <div class="butonel">
            <a href="./admin/logto_Apage.php?code=yeah">A</a>
    </div>
    <script type="text/javascript" src="./JS/menu.js"></script>
    </body>
</html>