<?php
    include 'db_connect.php';
    session_start();
? >
<html>
    <head>
        <title>Belissima Design</title>
        <meta name="title" content="Belissima Design">
        <meta name="description" content="Cele mai bune materiale si cea mai profesionistă echipă. Toate pentru a crea cele mai bune rochii si fuste.">
        <meta name="keywords" content="rochii,fuste,imbracaminte,rochie de seara,banchet,evenimente">
        <meta name="robots" content="index, follow">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=yes"/>
        <link rel="shortcut icon" href="./icon.ico">
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" type="text/css"  href="./CSS/menu_bar-style.css">
        <link rel="stylesheet" type="text/css"  href="./CSS/home-page.css">
        <link rel="stylesheet" type="text/css"  href="./CSS/general-style.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
        <meta property="og:title" content="Belissima Design">
        <meta property="og:description" content="Am pregătit noua colecție doar pentru voi. Grăbește-te și cumpără la cele mai bune prețuri">
        <meta property="og:image" content="http://belissimadesign.com/images/best_iThink.jpg">
        

    </head>
    <body onload='iframeResize()'>
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
        <div class='animating_slide'>
            <div class='animating_box'>
            </div>
            <h1>Bun venit pe site-ul nostru!</h1>
        </div>
        <div class="background-img">
        </div>
        <img class="arrow" src="./images/arrow@2x.png">
        <div class="block-text1">
            <h1 class="bold">Puțin despre noi</h1>
            <h3>Suntem o companie de croitorie in plină dezvoltare și sperăm că produsele noastre 
                să aducă un zâmbet și puțină mândrie pe fețele clienților noștri.
                Suntem profesioniști și asta provine din munca depusă de-a lungul timpului dar vă 
                lăsam să vă convingeți singuri de acest aspect.</h3>
            <h3>Specialitatea noastră sunt rochiile. Creăm rochii de seară, 
            rochii pentru evenimente speciale cât și rochii de mireasă. Pe lângă acesta creăm bluze și fuste pentru damă.
             Asa că dacă doriți ceva drăguț intrați in magazin și cu siguranță o sa vă găsiți ceva pe plac.</h3>
        </div>
        <div class="box">
            <h2 style="text-align: center;">Intră în magazin!</h2>
            <p><a class="shop-button" href="./shop.php">Magazin</a></p>
        </div>
        <h2 class='minititlu'>Câteva din produsele noastre:</h2>
        <div class="ex_produse">
               
            <?php
                echo "<div id='slide'>";
                $sql = "SELECT * FROM produse limit 0,3;" ;
                $results =  mysqli_query($conn,$sql);  
                $numResults = mysqli_num_rows($results);
                ? >
                <div class="container">
                    <?php
                        if ($numResults > 0) 
                        {
                            while($row = mysqli_fetch_assoc($results))
                            {
                                $id=$row['id'];
                                $nm=$row['nume'];
                                $numar_p=$row['numar'];
                                $pret = number_format( $row['pret'] ,2);
                                $error_img = 'onerror="this.onerror=null;'. "this.src='./images/alternative.jpg'" . '"';
                                echo "<div class='produs' >
                                    <div class='img_list'>
                                        <a href='./product-page.php?id=$id&nume=$nm'><img  class='img_p imagine' src='./img_p/".$numar_p."/".$numar_p."_2.jpg' ".$error_img."></img></a>
                                        <a href='./product-page.php?id=$id&nume=$nm'><img  class='img_p imagine img_ontop' src='./img_p/".$numar_p."/".$numar_p."_1.jpg' ></img></a>
                                    </div>
                                    <a href='./product-page.php?id=$id'><h2>".$row['nume']."</h2></a>
                                    <h3>Pret: <span>".$pret."</span> ron.</h3> 
                                    </div>"
                            ;}
                        ;}
                echo "</div>";
            ? >
        </div>
            <div class="arrows">
                <div class='move_arrow' onclick='prevS()'>
                    <img src="./images/arrow@2x.png">
                </div>
                <div class='move_arrow arrow2' onclick='nextS()'>
                        <img src="./images/arrow@2x.png">
                </div>
            </div>
        </div>
        <div class="block-text2">
            <h1 class="bold">Motto-ul nostru</h1>
            <h3>"Poartă-ți hainele cu mândrie pentru că ceea ce porți este alegerea ta. Alege ce e mai bun pentru tine!"</h3>
            <h3>Ceea ce facem noi este o muncă, o muncă cu un scop, scopul find sa fim cât mai profesionali cu 
                    putință, ne bazăm pe sfaturi si părerea clienților astfel
                    încât ei să fie complet mulțumiți.</h3>
        </div>
        <div class="ex-pareri">
            <h2 class='minititlu'>Părerile câtorva clienți:</h2>
                <div class="pareri">
                    <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fgeorgiana.buiciuc%2Fposts%2F1622700957827459%3A0&width=200&show_text=true&height=330&appId" width="100%" height="370" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>                              
                    <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fbebelusaa.dodii%2Fposts%2F2166117716754691&width=500&show_text=true&height=532&appId" width="100%" height="550" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                    <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fraluka.ralu.589%2Fposts%2F2165784146840404&width=500&show_text=true&height=156&appId" width="100%" height="210" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                </div>
            <p style='text-align:center;'>Daca vă plac produsele si serviciile noastre scrieți-vă parerea pe pagina noastra de Facebook : <a href='https://www.facebook.com/pg/croitoriecomada'><span style="text-decoration: underline;">Belissima Design</span></a></p>
        </div>
        <div class="box">
            <h2 style="text-align: center;">Intră în magazin!</h2>
            <p><a class="shop-button" href="./shop.php">Magazin</a></p>
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
        <script>
            var slide=document.getElementById('slide');
            var xhr = new XMLHttpRequest();
            var slide_nr = 0;
            function nextS(){
                slide_nr += 1;
                if(slide_nr <= 4 )
                {
                    xhr.open('GET','new_slide.php?&q='+ slide_nr ,true);
                }
                else {
                    slide_nr = 0;
                    xhr.open('GET','new_slide.php?&q='+ slide_nr ,true);
                }
                xhr.open('GET','new_slide.php?&q='+ slide_nr ,true);
                console.log(slide_nr);
                xhr.onload = function() {
                    if(this.status == 200) 
                    {
                        output = this.responseText;
                        var slide = document.getElementById('slide');
                        slide.innerHTML = output;
                    }
                }
                xhr.send();
            }
            function prevS(){
                slide_nr -= 1;
                if(slide_nr >= 0 )
                {
                    xhr.open('GET','new_slide.php?&q='+ slide_nr ,true);
                }
                else {
                    slide_nr = 4;
                    xhr.open('GET','new_slide.php?&q='+ slide_nr ,true);
                }
                console.log(slide_nr);
                xhr.onload = function() {
                    if(this.status == 200) 
                    {
                        output = this.responseText;
                        var slide = document.getElementById('slide');
                        slide.innerHTML = output;
                    }
                }
                xhr.send();
            }
            //for iframes
            function iframeResize(){
                var pareri_container=document.querySelector(".pareri");
                console.log(pareri_container);
                var w = document.documentElement.clientWidth;
                if(w>1300){
                    pareri_container.innerHTML= "<iframe src='https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fgeorgiana.buiciuc%2Fposts%2F1622700957827459%3A0&width=200&show_text=true&height=330&appId' width='350' height='330' style='border:none;overflow:hidden' scrolling='no' frameborder='0' allowTransparency='true' allow='encrypted-media'></iframe><iframe src='https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fbebelusaa.dodii%2Fposts%2F2166117716754691&width=500&show_text=true&height=532&appId' width='500' height='532' style='border:none;overflow:hidden' scrolling='no' frameborder='0' allowTransparency='true' allow='encrypted-media'></iframe><iframe src='https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fraluka.ralu.589%2Fposts%2F2165784146840404&width=500&show_text=true&height=156&appId' width='500' height='156' style='border:none;overflow:hidden' scrolling='no' frameborder='0' allowTransparency='true' allow='encrypted-media'></iframe>";

                }
            }
        </script>
        <script type="text/javascript" src="./JS/menu.js"></script>
        <script type="text/javascript" src="./JS/img_hoverChange.js"></script>
    </body>
</html>
