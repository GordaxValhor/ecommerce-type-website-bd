<?php
session_start();
? >
<?php
    if(isset($_SESSION["shopping_cart"]))
    {
        //stergem tot cosul
        if(isset($_POST['sterge_tot']))
        {
            $_SESSION["shopping_cart"]= array();
        }
        //stergem doar un anumit element
        if(isset($_POST['sterge_unu_x']) and isset($_POST['sterge_unu_y']) )
        {
            $id=$_POST['id'];
            $marime=$_POST['marime'];
            foreach($_SESSION['shopping_cart'] as $produs => $value)
            {
                if($value['marime']==$marime && $value['id']==$id)
                {
                    unset($_SESSION["shopping_cart"][$produs]);
                }
            }
        }
    }
? >
<html>
    <head>
        <title>Cos cumparaturi-Bellisima Design</title>
        <link rel="shortcut icon" href="./icon.ico">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css"  href="./CSS/menu_bar-style.css">
        <link rel="stylesheet" type="text/css"  href="./CSS/home-page.css">
        <link rel="stylesheet" type="text/css"  href="./CSS/general-style.css">
        <link rel="stylesheet" type="text/css"  href="./CSS/cos.css">
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
            ? >
        </div>
        <div>
            <!-- Tabel cu produsele adaugate in cos --> 
            <h2 style="margin-top:200px; margin-left:20px;margin-bottom: 50px;">Coșul dumneavoastră:</h2>
            <?php
                $i=1;
                $total=0;
                if(empty($_SESSION["shopping_cart"]) or !(isset($_SESSION["shopping_cart"]))) {
                        echo "
                            <div style='margin-top: 50px; margin-left:25px;'>
                                <h3>Din păcate coșul dumneavoastră este gol.<br>
                                Intrați in <a style='text-decoration: underline;'href='./shop.php'>magazin</a> pentru a adăuga produse in coș.</h3>
                            </div>
                        ";
                    }
                
                else {
                    
                    foreach($_SESSION['shopping_cart'] as $produs)
                    {
                        echo
                        "   
                            <div class='produs'>
                            <p>".$i.".</p>
                            <div class='img' class='item'><a href='./product-page.php?id=".$produs['id']."'><img src='./img_p/".$produs['numar']."/".$produs['numar']."_1.jpg' alt='imagine'></a></img></div>
                            <div class='item-1'>
                            <a href='./product-page.php?id=".$produs['id']."'><h2 class='item'>".$produs['nume']."</h2></a>
                            <p class='item'>Descriere:<br>".$produs['descriere']."</p>
                            </div>
                            <div class='produs_flex'>
                            <p class='item center'>Cantitate: ".$produs['cantitate']."</p>
                            <p class='item center'>Mărime: ".$produs['marime']."</p>
                            <h2 class='item center'><span>Preț: ".number_format($produs['pret'],2)."</span></h2>
                            <form   method='POST' action=''>
                                <input type='hidden' name='id' value=".$produs['id'].">
                                <input type='hidden' name='marime' value=".$produs['marime'].">
                                <input class='item-2' type='image' src='./images/x.png' name='sterge_unu'  alt='submit'>
                            </form>
                            </div>
                            </div>";
                        $i++;
                        $total=$total+($produs['pret']*$produs['cantitate']);
                    }

                }
            ? >
            
        </div>
        <div class='total'>
                <?php
                    if(!(empty($_SESSION["shopping_cart"]) or !(isset($_SESSION["shopping_cart"])))) {
                        echo "
                            <p style='font-size: 16px;'>Daca dorești si alte produse<br><a style='text-decoration: underline;'href='./shop.php'>Intră din nou in magazin</a></p>
                            <hr>
                        ";
                    }
                    else {
                        echo "<hr>";
                    }
                ? >
                
                <p><span>Total coș: </span><?php $total = number_format($total,2); echo $total; ?> lei</p>
        </div>
        <div>
            <!-- Butoane -->
            <form method='Post' action=''>
            <input type="submit" name='sterge_tot' value="Șterge tot">
            </form>
        </div>
        <?php
            if(!(empty($_SESSION["shopping_cart"])))
            {
                echo "<a class='place_order' href='./order_place-page.php'>Plasează comanda</a>";
            }
        ? >
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