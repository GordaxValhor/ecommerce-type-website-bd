<?php
    include 'db_connect.php';
    if((isset($_POST['pwd'])))
    {
        if(($_POST['pwd'])=="croitorie16")
        {
            echo ("<div class='log'><h3>Mesaj:</h3><p>Acces permis</p></div>");
        }
        else {
            header("Location:  https://belissimadesign.com/admin/logto_Apage.php?code=yeah");
        }
    }
    else {
            if(isset($_GET['status'])){
                if($_GET['status']=='produs_sters')
                {
                    if((isset($_POST['adaug'])))
                    {
                        include 'db_connect.php';
                        //faza cu numarul 
                        $query = "SELECT * FROM produse ORDER BY id DESC LIMIT 1";
                                    $results=mysqli_query($conn,$query);
                                    $numResults = mysqli_num_rows($results);
                                            if ($numResults > 0) 
                                            {
                                                while($row = mysqli_fetch_assoc($results))
                                                {
                                                    $numar_p=$row['numar']+1;
                                                }
                                            }
                        
                        $nume = $_POST['nume'];
                        $desc = $_POST['descriere'];
                        $pret = $_POST['pret'];
                        $tip = $_POST['tip'];
                        $tip = strtolower($tip);
                        $marimi= $_POST['marimi'];
                        $cate_m=count($marimi);
                        $str_marimi="";
                        for($i=0;$i<$cate_m;$i++){
                            {
                                $str_marimi=$str_marimi . $marimi[$i] . ',';
                            }
                        }                   
                        $stoc= trim($_POST['stoc']);
                        $red  = $_POST['reducere'];
                        if(!(is_dir("../img_p/$numar_p"))){
                            mkdir("../img_p/$numar_p");
                        }
                        $query="INSERT INTO produse(numar,nume,descriere,pret,tip,marime,stoc,reducere) VALUES ($numar_p,'$nume','$desc',$pret,'$tip','$str_marimi','$stoc',$red);";
                        //echo($query);
                        $result=mysqli_query($conn,$query);
                            if($result)
                            {
                                header("Location: https://belissimadesign.com/admin/admin_page.php?status=produs_adaugat");
                                //echo("<br>");
                            }
                    }
                    else {echo ("<div class='log'><h3>Mesaj:</h3><p>Un produs a fost sters</p></div>");}
                    
                }
            else if($_GET['status']=='produs_adaugat')
                {
                    if((isset($_POST['adaug'])))
                    {
                        include 'db_connect.php';
                        //faza cu numarul 
                        $query = "SELECT * FROM produse ORDER BY id DESC LIMIT 1";
                                    $results=mysqli_query($conn,$query);
                                    $numResults = mysqli_num_rows($results);
                                            if ($numResults > 0) 
                                            {
                                                while($row = mysqli_fetch_assoc($results))
                                                {
                                                    $numar_p=$row['numar']+1;
                                                }
                                            }
                        
                        $nume = $_POST['nume'];
                        $desc = $_POST['descriere'];
                        $pret = $_POST['pret'];
                        $tip = $_POST['tip'];
                        $tip = strtolower($tip);
                        $marimi= $_POST['marimi'];
                        $cate_m=count($marimi);
                        $str_marimi="";
                        for($i=0;$i<$cate_m;$i++){
                            {
                                $str_marimi=$str_marimi . $marimi[$i] . ',';
                            }
                        }                   
                        $stoc= trim($_POST['stoc']);
                        $red  = $_POST['reducere'];
                        if(!(is_dir("../img_p/$numar_p"))){
                            mkdir("../img_p/$numar_p");
                        }
                        $query="INSERT INTO produse(numar,nume,descriere,pret,tip,marime,stoc,reducere) VALUES ($numar_p,'$nume','$desc',$pret,'$tip','$str_marimi','$stoc',$red);";
                        //echo($query);
                        $result=mysqli_query($conn,$query);
                            if($result)
                            {
                                header("Location: https://belissimadesign.com/admin/admin_page.php?status=produs_adaugat");
                                //echo("<br>");
                            }
                        }
                    else{ echo "<div class='log'><h3>Mesaj:</h3><p>Un produs a fost adaugat</p></div>";}
                    
                }
                
            }
            else {
                header("Location: https://belissimadesign.com/index.php");
            }     
    }

? >
<?php
    if(!(isset($_GET['status']))){
        if((isset($_POST['adaug'])))
            {
            //faza cu numarul 
            $query = "SELECT * FROM produse ORDER BY id DESC LIMIT 1";
                        $results=mysqli_query($conn,$query);
                        $numResults = mysqli_num_rows($results);
                                if ($numResults > 0) 
                                {
                                    while($row = mysqli_fetch_assoc($results))
                                    {
                                        $numar_p=$row['numar']+1;
                                    }
                                }
            
            $nume = $_POST['nume'];
            $desc = $_POST['descriere'];
            $pret = $_POST['pret'];
            $tip = strtolower($tip);
            $tip = $_POST['tip'];
            $marimi = $_POST['marimi'];
            $cate_m = count($marimi);
            $str_marimi="";
            for($i=0; $i< $cate_m;$i++){
                {
                    $str_marimi=$str_marimi . $marimi[$i] . ',';
                }
            }                   
            $stoc= trim($_POST['stoc']);
            $red = $_POST['reducere'];
            if(!(is_dir("../img_p/$numar_p"))){
                mkdir("../img_p/$numar_p");
            }
            $query="INSERT INTO produse(numar,nume,descriere,pret,tip,marime,stoc,reducere) VALUES ($numar_p,'$nume','$desc',$pret,'$tip','$str_marimi','$stoc',$red);";
            //echo($query);
            $result=mysqli_query($conn,$query);
                if($result)
                {
                    header("Location: https://belissimadesign.com/admin/admin_page.php?status=produs_adaugat");
                    //echo("<br>");
                }
            }
    }
     
? >
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="./icon.png"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css"  href="https://belissimadesign.com/CSS/general-style.css">
    <link rel="stylesheet" href="https://belissimadesign.com/CSS/a_page.css">
    <title>Admin page</title>
</head>
<body>
    <br>
    <p style='margin-left: 5px;'><a href="https://belissimadesign.com/index.php">Acasa</a></p>
    <p style='margin-left: 5px;'><a href="./teste.php">Pagina teste</a></p>
    <p style='margin-left: 5px;'><a href="http://manager.euplatesc.ro/v2/admin/" target='_blank'>Manager plati si comenzi euPLATESC.ro ( username: belissimadesign pwd: croitorie16)</a></p>
    <h1>Pagina Administrator</h1>
    <div class="adaugare_p">
        <h3>Adaugare produs nou</h3>
        <form action='' method='POST'>
                <div class="row">
                    <p>Nume:</p>
                    <input type='text' name='nume' placeholder='' value='' required>
                </div>
                <div class="row">
                    <p>Descriere:</p>
                    <textarea rows='4' cols='50' name='descriere' placeholder='' required></textarea>
                </div>
                <div class="row">
                    <p>Pret:</p>
                    <input type='text' name='pret' placeholder='' value='' required>
                </div>
                <div class="row">
                    <p>Tip:</p>
                    <input type='text' name='tip' placeholder='' value='' required><br>
                </div>
                <div class="row">
                    <p>Marimi:</p>
                    <div class="column">
                        <div class="row" >
                            <input  type="checkbox"  name="marimi[]" value="xs">
                            <label for="marimi[]">XS</label><br>
                        </div>
                        <div class="row" >
                            <input  type="checkbox"  name="marimi[]" value="s">
                            <label for="marimi[]">S</label><br>
                        </div>
                        <div class="row" >
                            <input  type="checkbox"  name="marimi[]" value="m">
                            <label for="marimi[]">M</label><br>
                        </div>
                        <div class="row" >
                            <input type="checkbox"  name="marimi[]" value="l">
                            <label for="marimi[]">L</label><br>
                        </div>
                        <div class="row" >
                            <input type="checkbox"  name="marimi[]" value="xl">
                            <label for="marimi[]">XL</label><br>
                        </div>
                        <div class="row" >
                            <input type="checkbox"  name="marimi[]" value="xxl">
                            <label for="marimi[]">XXL</label><br>
                        </div>
                        <div class="row" >
                            <input type="checkbox"  name="marimi[]" value="xxxl">
                            <label for="marimi[]">XXXL</label><br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <p>Stoc:</p>
                    <select name='stoc' required>
                        <option  value="suficient">Suficient</option>
                        <option  value="insuficient">Insuficient</option>
                        <option value="limitat">Limitat</option>
                    </select>
                </div>
                <p>*(stoc: suficient,insuficient sau limitat)</p>
                <div class="row">
                    <p>Reducere:</p>
                    <input type='text' name='reducere' placeholder='' value='' required><br>
                </div>
                <div class="row">
                    <p>Link imagine:(./img_p/id/nrProdus_nrImagine.png)</p><br>
                </div>
                <input type='submit' value='Adauga produsul' name='adaug'>                 
        </form>
    </div>
    <div class="open_tabele">
        <p onclick="tab_p()">Tabel produse </p>
        <p onclick="tab_c()">Tabel comenzi</p>
    </div>
    <div class="container">
        
        <form>
            <input id='search_input' type='search'  placeholder='Cauta' name='search' >
            <button type='button' onclick='act_search()'>Cauta</button>
        </form>
        <div class="tabel_container">
        </div>
    </div>
    </div>
    <script>
        function act_search(){
            var xhr = new XMLHttpRequest();
            var search= document.getElementById('search_input');
            var tip_tab = document.getElementById('tip_tab');
            if(search)
            {
                console.log('ceva');
                if (tip_tab.innerHTML=='Tabel produse:'){
                    console.log('cevas');
                    xhr.open('GET','admin_c_page.php?q=produse&s='+search.value,true);
                }
                else if (tip_tab.innerHTML=='Tabel comenzi:'){
                    xhr.open('GET','admin_c_page.php?q=comenzi&s='+search.value,true);
                }
                else {
                    xhr.open('GET','admin_c_page.php?q=produse',true);
                }   
            }
            xhr.onload = function() {
                if(this.status == 200) 
                {
                    output = this.responseText;
                    var page = document.querySelector('.tabel_container');
                    page.innerHTML = output;
                }
            }
            xhr.send();
        }
        function tab_p() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET','admin_c_page.php?q=produse',true);
            xhr.onload = function() {
                if(this.status == 200) 
                {
                    output = this.responseText;
                    var page = document.querySelector('.tabel_container');
                    page.innerHTML = output;
                }
            }
            xhr.send();
        }
        function tab_c() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET','admin_c_page.php?q=comenzi',true);
            xhr.onload = function() {
                if(this.status == 200) 
                {
                    output = this.responseText;
                    var page = document.querySelector('.tabel_container');
                    page.innerHTML = output;
                }
            }
            xhr.send();
            
        }
    </script>
</body>
</html>