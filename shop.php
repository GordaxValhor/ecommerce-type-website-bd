<?php
    include 'db_connect.php';
    session_start();
?>
<html>
    <head>
        <title>Magazin-Belissima Design</title>
        <meta name="title" content="Magazin-Belissima Design">
        <meta name="description" content="Imbracaminte pentru persoane care știu ce vor. O gamă speciala de rochii,fuste si bluze pentru evenimentele speciale din viata ta.">
        <meta name="keywords" content="rochii,fuste,imbracaminte,rochie de seara,banchet,evenimente">
        <meta name="robots" content="index, follow">
        <link rel="shortcut icon" href="./icon.ico">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css"  href="./CSS/menu_bar-style.css">
        <link rel="stylesheet" type="text/css"  href="./CSS/general-style.css">
        <link rel="stylesheet" type="text/css"  href="./CSS/shop.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=yes"/>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
<body onload='show_page()'>
    <div class="menu_bar">
            <div class="menu-icon">
                <img title="Meniu." src="images/menu-icon2.png">
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
            ?>
    </div>
    <div>
        <h1><a href=./shop.php>Magazin</a></h1>
    </div>
    <div class='search_bar'><!-- Serch-bar-->
        <form action="" method="post" onsubmit="return false;">
            <img  style='height:25px; padding-bottom: 2px;cursor: pointer;' type="button" src='./images/lupa.png' onclick='act_search()'>
            <input id='search_input' type="search"  placeholder="Caută" name='search' >
        </form>
    </div> 
    <div class='filtre'><!-- Filtre-->
        <form action="" method="post" >
            <select name="f_ord" id="filtru1" onchange='act_filtre()'>
                <option>După preț</option>
                <option value="ASC" selected="selected">Crescator</option>
                <option value="DESC">Descrescator</option>
            </select>
            <select name="f_tip" id="filtru2" onchange='act_filtre()'>
                <option >După tip</option>
                <option value="rochie">Rochii</option>
                <option value="fusta">Fuste</option>
                <option value="bluza">Bluze</option>
            </select>
        </form>
        <h4 ><span style="text-decoration: underline;"><a href=./shop.php>Eliminați filtrele</a></span></h4>
    </div> 
    <div class="c_produse">
        <!-- Lista cu produse-->
     <div id='page'><?php
        if(isset($_GET['q'])){
            $sql="SELECT * FROM produse WHERE tip='".$_GET['q']."';";
            echo "<h3>Filtru pentru ".$_GET['q']." aplicat:</h3>";
        }
        else {
            $sql='SELECT * FROM produse ORDER BY pret ASC LIMIT 0 , 8;';
        }
        $results =  mysqli_query($conn,$sql);  
        $numResults = mysqli_num_rows($results);
        ?>
        <div class="container">
                <?php
                    if ($numResults > 0) 
                    {
                        while($row = mysqli_fetch_assoc($results))
                        {
                            $id=$row['id'];
                            $nm=$row['nume'];
                            $numar_p=$row['numar'];
                            $stoc=$row['stoc'];
                            $stoc=strtolower($stoc);
                            $red=$row['reducere'];
                            $pret = $row['pret'];
                            $pret_redus = $pret - (($red/100)*$pret);
                            $pret_redus =number_format( $pret_redus ,2);
                            $pret = number_format( $row['pret'] ,2);
                            $error_img = 'onerror="this.onerror=null;'. "this.src='./images/alternative.jpg'" . '"';
                            echo "<div class='produs' >
                                <div class='img_list'>
                                    <a href='./product-page.php?id=$id&nume=$nm'><img  class='img_p imagine' src='./img_p/".$numar_p."/".$numar_p."_2.jpg' ".$error_img."</img></a>
                                    <a href='./product-page.php?id=$id&nume=$nm'><img  class='img_p imagine img_ontop' src='./img_p/".$numar_p."/".$numar_p."_1.jpg' ></img></a>
                                </div>
                                <a href='./product-page.php?id=$id'><h2>".$row['nume']."</h2></a>";
                                if($red>0){
                                    echo "<p>Preț: <del>". $pret ." ron.</del>(-".$red."%)</p>
                                        <h3>Preț: ".$pret_redus." ron.</h3>";
                                    }
                                else{ echo"<p><br></p><h3>Preț: ". $pret ." ron.</h3>"; }
                                ;
                            if($stoc=='suficient' or $stoc=='')
                            {
                                echo "<p style='border: 1px solid #1A1A1A;color:green;' >În stoc</p></div>";
                            }
                            else if($stoc=='insuficient')
                            {
                                echo "<p style='border: 1px solid #1A1A1A;color:red;'>Nu este în stoc</p></div>";
                            }
                            else if($stoc=='limitat')
                            {
                                echo "<p style='border: 1px solid #1A1A1A;color:orange;'>Doar câteva produse rămase</p></div>";
                            }

                        ;}
                    ;}
                    else {echo "<p>Din păcate nu sunt produse.";}
            
        ?>
        </div>
        <?php
            if(!(isset($_GET['q']))){
                echo "<div class='change_page'>
                <img src='./images/miniarrow.png' alt='previous' style='transform: rotate(180deg);' onclick='antpage()'>
                <p id='nr_pagina'></p>
                <p id='nr_pagina' style='cursor:pointer; background-color: white; color: #1A1A1A;' onclick='nextpage()' >2</p>
                <img src='./images/miniarrow.png' alt='next' onclick='nextpage()' >
        </div>";
            }
        ?>
    <br><br>
    </div>
    </div>
    <div class="bottom-tag">
            <div class='bottom-box'>
                <ul>
                    <li><a href='./index.php'>Acasă</a></li>
                    <li><a href='./shop.php'>Magazin</a></li>
                    <li><a href='./info-page.php'>Informații</a></li>
                    <li><a href='./info-page.php'>Termeni și condiții</a></li>
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
            <p>Copyright © 2019 belissimadesign.com. Toate drepturile rezervate.</p>
            <p>Web design by <a href='https://www.facebook.com/ianos.calin'>Ianoș Călin</a></p>
    </div>
    <script>
        var page=document.getElementById('page');
        var xhr = new XMLHttpRequest();
        var page_nr = 1;
        // pentru filtre
        function act_search(){
            window.scrollTo(0,300);
            search_v = document.getElementById('search_input').value;
            xhr.open('GET','change_page.php?search=' +  search_v + '&q='+ page_nr ,true);
            xhr.onload = function() {
                if(this.status == 200) 
                {
                    output = this.responseText;
                    var page = document.getElementById('page');
                    page.innerHTML = output;
                }
            }
            xhr.send();
        }
        window.addEventListener('keypress', function (e) {
            if (e.keyCode === 13) {
                    console.log('ceva face');
                    act_search();
            }
        }, false);
        function act_filtre(){
            window.scrollTo(0,300);
            var filtru_2 = document.getElementById('filtru2').value;
            var filtru_1 = document.getElementById('filtru1').value;
            var search_v = document.getElementById('search_input').value;
            if(search_v != '')
            {
                xhr.open('GET','change_page.php?search=' + search_v + '&filtru1='+ filtru_1 + '&filtru2='+ filtru_2 + '&q=' + page_nr ,true);
            }
            else {
                xhr.open('GET','change_page.php?filtru1='+ filtru_1 + '&filtru2='+filtru_2 + '&q=' + page_nr ,true);
            }
            xhr.onload = function() {
                if(this.status == 200) 
                {
                    output = this.responseText;
                    var page = document.getElementById('page');
                    page.innerHTML = output;
                }
            }
            xhr.send();
            
        }
        //pentru schimbare pagina
        function show_page() {
            document.getElementById('nr_pagina').innerHTML = page_nr;
        }
        function nextpage() {
            window.scrollTo(0,50);
            var output = '';
            page_nr = page_nr + 1;
            var filtru_2 = document.getElementById('filtru2').value;
            var filtru_1 = document.getElementById('filtru1').value;
            var search_v = document.getElementById('search_input').value;
            if(search_v != '')
            {
                xhr.open('GET','change_page.php?search=' + search_v + '&filtru1='+ filtru_1 + '&filtru2='+ filtru_2 + '&q=' + page_nr ,true);
            }
            else {
                xhr.open('GET','change_page.php?filtru1='+ filtru_1 + '&filtru2='+filtru_2 + '&q=' + page_nr ,true);
            }
            xhr.onload = function() {
                if(this.status == 200) 
                {
                    output = this.responseText;
                    var page = document.getElementById('page');
                    page.innerHTML = output;
                }
            }
            xhr.send();
        }
        function antpage() {
            window.scrollTo(0,50);
            var output= '';
            if ( page_nr >1 )
            {
                page_nr=page_nr -1;
                search_v = document.getElementById('search_input').value;
                var filtru_2 = document.getElementById('filtru2').value;
                var filtru_1 = document.getElementById('filtru1').value;
                var search_v = document.getElementById('search_input').value;
                if(search_v != '')
                {
                xhr.open('GET','change_page.php?search=' + search_v + '&filtru1='+ filtru_1 + '&filtru2='+ filtru_2 + '&q=' + page_nr ,true);
                }
                else {
                    xhr.open('GET','change_page.php?filtru1='+ filtru_1 + '&filtru2='+filtru_2 + '&q=' + page_nr ,true);
                }
                xhr.onload = function(){
                    if(this.status == 200 )
                    {
                        output= this.responseText;
                        var page = document.getElementById('page');
                        page.innerHTML = output;
                    }
                }
                xhr.send();
            }
            
        }   
    </script>
    <script type="text/javascript" src="./JS/menu.js"></script>
    </body>
</html>
