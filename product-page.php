<?php
    include 'db_connect.php';
    session_start();
? >
<?php
    //incep sesiunea odata ce intru in pagina produsului
    //session_start();
    //verificam daca deja s-a adaugat un produs din pagina unde suntem
if(isset($_POST['id']))
    {
        $exista= 0;
        $name = $_POST['nume'];
        $numar = $_POST['numar'];
        $id =  $_POST['id'];
        $price = $_POST['pret'];
        $descriere= $_POST['descriere'];
        $cantitate= $_POST['cantitate'];
        $marime= $_POST['marime'];
        $imagine= $_POST['img'];
        //aici creem array-ul pt shopping cart indiferent daca avem sau nu unul deja
        //asociem fiecare data cu un camp din array
        $cartArray = array(
            $id=>array(
            'nume'=>$name,
            'id'=>$id,
            'numar'=>$numar,
            'pret'=>$price,
            'descriere'=>$descriere,
            'cantitate'=>$cantitate,
            'marime'=>$marime,
            'imagine'=>$imagine));
    //verificam daca avem ceva in array de sesiune
    if(empty($_SESSION["shopping_cart"])) {
            $_SESSION["shopping_cart"] = $cartArray;
            //echo "<p class='msg'>Produs adaugat in cos!</p>";
    }
    else
    { 
        //verificam fiecare element al array-ului si daca avem un element la fel ca si cel pe care vrem 
            //sa il adaugam aratam un mesaj ca deja exista acel produs
        foreach($_SESSION['shopping_cart'] as $produs => $value)
        {
            if($value['marime']==$marime && $value['id']==$id)
            {
                echo "";
                $exista = 1;
            }  
        }
        if($exista==0)
        {
            $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
            echo "";
        }
          
    }
}
    
? >
<html>
    <head>
        <?php
        $id=$_GET['id'];

        $sql = "SELECT * FROM produse WHERE id=$id;" ;
        $results =  mysqli_query($conn,$sql);  
        $numResults = mysqli_num_rows($results);
        if ($numResults > 0) 
        {
            if($row = mysqli_fetch_assoc($results))
            {
                echo "
                <title>".$row['nume']."-Belissima Design</title>
                <meta name='title' content='".$row['nume']."-Belissima Design'>
                <meta name='description' content='".$row['descriere']."'>
                <meta name='robots' content='index, follow'>";
            }
        }
        ? >
        <link rel="shortcut icon" href="./icon.ico">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css"  href="./CSS/menu_bar-style.css">
        <link rel="stylesheet" type="text/css"  href="./CSS/general-style.css">
        <link rel="stylesheet" type="text/css"  href="./CSS/p-page.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=yes"/>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body onload="reSize()" onresize="reSize()">
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
            ? >
    </div>
    <div>
        <!--Imagine produs-->
        <!--<div class='img_p zoom' onmousemove='zoom(event)' style='background-image: '>-->
    </div>
        <!--Informati produs-->
        <?php
            $id=$_GET['id'];
        ? >
        <?php
        $sql = "SELECT * FROM produse WHERE id=$id;" ;
        $results =  mysqli_query($conn,$sql);  
        $numResults = mysqli_num_rows($results);
        ? >
        <div class="container">
            <div class="img_container">
                    <?php
                    if ($numResults > 0) 
                    {
                        if($row = mysqli_fetch_assoc($results))
                        {
                            $id=$row['id'];
                            $numar_p = $row['numar'];
                            $nume = $row['nume'];
                            $pret = $row['pret'];
                            $desc = $row['descriere'];
                            $img = $row['imagini'];
                            $stoc= $row['stoc'];
                            $red=$row['reducere'];
                            $pret = $row['pret'];
                            $pret_redus = $pret - (($red/100)*$pret);
                            $pret = number_format( $row['pret'] ,2);
                            $error_img = 'onerror="this.onerror=null;'. "this.src='./images/alternative.jpg'" . '"';
                            echo "
                                    <div class='image-slider'>
                                        <div class='slider'>
                                                <div class='img_p zoom current-slide' onmousemove='zoom(event)' style='background-image:url(https://belissimadesign.com/img_p/".$numar_p."/".$numar_p."_1.jpg);'>
                                                    <img class='img_p ' src='./img_p/".$numar_p."/".$numar_p."_1.jpg' ></img>
                                                </div>
                                                <div class='img_p zoom' onmousemove='zoom(event)' style='background-image:url(https://belissimadesign.com/img_p/".$numar_p."/".$numar_p."_2.jpg);'>
                                                    <img class='img_p' src='./img_p/".$numar_p."/".$numar_p."_2.jpg' ".$error_img." ></img>
                                                </div>
                                                <div class='img_p zoom' onmousemove='zoom(event)' style='background-image:url(https://belissimadesign.com/img_p/".$numar_p."/".$numar_p."_3.jpg);'>
                                                    <img class='img_p' src='./img_p/".$numar_p."/".$numar_p."_3.jpg' ".$error_img." ></img>
                                                </div>
                                        </div>
                                    </div>
                            ";
                            echo " <div class='arrows'>
                                        <div class='move_arrow prev-button'>
                                            <img src='./images/arrow@2x.png'>
                                        </div>
                                    <div class='move_arrow arrow2 next-button'>
                                            <img src='./images/arrow@2x.png'>
                                        </div>
                                </div>
                            </div>";
                            echo "<div class='produs'>
                                    <div class=d_produs>
                                    <h2>".$row['nume']."</h2>
                                    <p>Descriere:<br>".$row['descriere']."</p>";
                            if($stoc=='suficient' or $stoc=='')
                            {
                                echo "<p>Stoc magazin: <span style='color:green;'>in stoc</span></p>";
                            }
                            else if($stoc=='insuficient')
                            {
                                echo "<p>Stoc magazin: <span style='color:red;'>nu este in stoc</span></p>";
                            }
                            else if($stoc=='limitat')
                            {
                                echo "<p>Stoc magazin: <span style='color:orange;'>doar cateva produse rămase</span></p>";
                            }
                            echo "<p>Dacă vă plac produsele si serviciile noastre scrieți-vă părerea pe pagina noastră de Facebook : <a target='_blank' href='https://www.facebook.com/pg/croitoriecomada'><span style='text-decoration: underline;'>Belissima Design</span></a></p>";
                            //echo "<span><h3>Pret: ".$pret." ron</h3></span>";
                            if($red>0){
                                echo "<span><p>Preț: <del>". $pret ." ron.</del>(-".$red."%)</p>
                                    <h3>Preț: ".$pret_redus." ron.</h3></span></div>";
                                }
                            else{ echo"<span><p><br></p><h3>Preț: ". $pret ." ron.</h3></span></div>"; }
                           //faza cu stocul
                        ;}
                    ;}
                ? >
                
                <div class="f_produs">
                <!--Shop produs-->
                <!--aici avem un form prin care cu php de sus adaugam un nou produs arrayuli shooping cart-->
                    <form  method="POST" action="">
                        <input type='hidden' name='id' value='<?php echo $id ?>' />
                        <input type='hidden' name='nume'  value='<?php echo $nume ?>'>
                        <input type='hidden' name='numar'  value='<?php echo $numar_p ?>'>
                        <input type='hidden' name='pret'  value='<?php echo $pret_redus ?>'>
                        <input type='hidden' name='img'  value='<?php echo $img ?>'>
                        <input type='hidden' name='descriere'  value='<?php echo $desc ?>'>
                            <div class='f_block'><p>Mărime:</p><select name="marime" required >
                                <option value="">Alege</option>
                                <?php 
                                        if(strpos($row['marime'], 'xs,') !== false){
                                            echo "<option value='XS'>XS</option>";
                                        }
                                        if(strpos($row['marime'], 's,') !== false){
                                            echo "<option value='S'>S</option>";
                                        }
                                        if(strpos($row['marime'], 'm,') !== false){
                                            echo "<option value='M'>M</option>";
                                        }
                                        if(strpos($row['marime'], 'l,') !== false){
                                            echo "<option value='L'>L</option>";
                                        }
                                        if(strpos($row['marime'], 'xl,') !== false){
                                            echo "<option value='XL'>XL</option>";
                                        }
                                        if(strpos($row['marime'], 'xxl,') !== false){
                                            echo "<option value='XXL'>XXL</option>";
                                        }
                                        if(strpos($row['marime'], 'xxxl,') !== false){
                                            echo "<option value='XXXL'>XXXL</option>";
                                        }
                                ? >
                            </select></div> 
                        <br>
                        <div class='f_block'><p>Cantitate:</p><input type="number" value="1" name="cantitate"><br></div>
                        <hr>
                        <?php 
                            if($stoc=='suficient' or $stoc=='' or $stoc=='limitat')
                            {
                                echo "<input type='submit' name='submit' value='Adauga in coș'>";
                            }
                            else if($stoc=='insuficient')
                            {
                                echo "";
                            }
                        ? >
                        
                    </form>
                    
                </div>
                
                </div>
           
        </div>
        <hr style="width: 95%; margin-bottom: 50px;margin-top: 50px;">
    <div class='backtoshop'>
        <a href='./shop.php'>Inapoi la magazin</a>
    </div>
    <div class="text">
        <p>-Acest produs o să ajungă la dumneavoastră in 3-5 zile lucrătoare de la plasarea comenzii.</p>
        <p>-Costul transportului va fi platit de client.</p>
    </div>
    <div class="marimi">
            <h2>Tabel cu marimi:</h2>
            <p>Produsele sunt confecționate dupa mărimile și măsurile standard din croitorie.</p>
            <p>.</p>
            <img  src="./images/tab_marimi.svg" alt="da" >
    </div>
    <div class="bottom-tag">
            <div class='bottom-box'>
                <ul>
                    <li><a href='./index.php'>Acasa</a></li>
                    <li><a href='./shop.php'>Magazin</a></li>
                    <li><a href='./info-page.php'>Informatii</a></li>
                    <li><a href='./info-page.php'>Termeni si condiții</a></li>
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
            <p>Copyright © 2019 belissimadesign.com. Toate drepturile rezervate.</p>
            <p>Web design by <a href='https://www.facebook.com/ianos.calin'>Ianoș Călin</a></p>
        </div>
        
    <script>
            //var w = document.documentElement.clientWidth;
            var tabel = document.querySelector('.marimi');
            
            function reSize() {
                var w = document.documentElement.clientWidth;
                if(w <= 800) {
                    console.log('da');
                    tabel.innerHTML = "<h2>Tabel cu marimi:</h2><p>Produsele sunt confecționate după mărimile și măsurile standard din croitorie.</p><img style='display: block;height: 270px; margin-left:auto; margin-right:auto ;margin-bottom: 15px;'src='./images/body_mic.svg' alt='da'><img  src='./images/tabel_mic4.svg' alt='da'>";
                }
                else {
                    console.log('mare');
                    tabel.innerHTML = "<h2>Tabel cu marimi:</h2><p>Produsele sunt confecționate după mărimile și măsurile standard din croitorie.</p><img  src='./images/tab_marimi.svg' alt='da'>";
                }
            }
            function zoom(e){
                var zoomer = e.currentTarget;
                e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
                e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
                x = offsetX/zoomer.offsetWidth*100
                y = offsetY/zoomer.offsetHeight*100
                zoomer.style.backgroundPosition = x + '% ' + y + '%';
            }
    </script>
    <script type="text/javascript"  src="./JS/img_slideChange.js"></script>
    <script type="text/javascript" src="./JS/menu.js"></script>
    </body>
    </body>
</html>