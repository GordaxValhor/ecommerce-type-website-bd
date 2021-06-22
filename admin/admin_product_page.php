
<?php
    if(!(isset($_GET['id'])))
    {
        header("Location: https://belissimadesign.com/index.php");
    }
? >
<?php
    include 'db_connect.php';
    $sql="SELECT * from produse where id=".$_GET['id'];
    $results=mysqli_query($conn,$sql);
    $num_results=mysqli_num_rows($results);
?>
<?php
    if(isset($_POST['modifica']))
    {
        $nume=$_POST['nume'];
        $desc=$_POST['descriere'];
        $pret = $_POST['pret'];
        $tip = $_POST['tip'];
        $marimi= $_POST['marimi'];
        $cate_m=count($marimi);
        $str_marimi="";
        for($i=0;$i<$cate_m;$i++){
            {
                $str_marimi=$str_marimi . $marimi[$i] . ',';
            }
        }
        $stoc = trim($_POST['stoc']);
        $red  = $_POST['reducere'];
        $query="UPDATE produse SET nume='".$nume."',descriere='".$desc."',tip='".$tip."',marime='".$str_marimi."',pret=".$pret.",stoc='".$stoc."',reducere=".$red."  WHERE id=".$_GET['id'].";";
        $result=mysqli_query($conn,$query);
        if($result)
        {
            header("Location: https://belissimadesign.com/admin/admin_product_page.php?id=".$_GET['id']."&status=modificat");
        }
    }
    if(isset($_GET['status']))
    {
        echo("<p>Produsul a fost modificat!</p>");
    }
    //pentru stergerea produsului
    if(isset($_POST['sterge_p']))
    {
        //delet de img_p folder
        $numar_p=$_POST['numar_p'];
        $dirname = "../img_p/".$numar_p;
        function delete_directory($dirname) {
            if (is_dir($dirname))
              $dir_handle = opendir($dirname);
        if (!$dir_handle)
             return false;
        while($file = readdir($dir_handle)) {
              if ($file != "." && $file != "..") {
                   if (!is_dir($dirname."/".$file))
                        unlink($dirname."/".$file);
                   else
                        delete_directory($dirname.'/'.$file);
              }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
        }
        delete_directory($dirname);
        $query="DELETE FROM produse WHERE id=".$_GET['id'].";";
        //echo($query);
        $result=mysqli_query($conn,$query);
        if($result)
        {
            header("Location: https://belissimadesign.com/admin/admin_page.php?status=produs_sters");
        }
    }
    if(isset($_POST['uploadImg'])){
        $file = $_FILES["img"];
        $fileName = $_FILES["img"]['name'];
        $fileTmploc= $_FILES["img"]['tmp_name'];
        $fileExt = explode(".", $fileName);
        $fileActExt = strtolower(end($fileExt));
        $fileActExt = "jpg";

        $nr_p=$_POST['nr_p'];
        //numara cate file sunt in folder
        $directory = "../img_p/".$nr_p."/";
        $filecount = 0;
        $files = glob($directory . "*");
        if ($files){
         $filecount = count($files);
        }
        //echo "There were $filecount files";
        $nr_img= $filecount +1;
        $fileNewName = $nr_p."_".$nr_img.".".$fileActExt;
        $fileLoc = "../img_p/".$nr_p."/".$fileNewName;
        if(move_uploaded_file($fileTmploc,$fileLoc)){
            echo "Imagine adaugata cu succes";
        }

    }
    //Pentru deleta la imagini
    if(isset($_POST['DeleteImg'])){
            $nr_p=$_POST['numar_p'];
            $files = glob("/home4/florentina/public_html/img_p/".$nr_p.'/*');
            print_r(glob("/home4/florentina/public_html/img_p/".$nr_p.'/*'));
            foreach($files as $file)
            {
                if(is_file($file)){
                    unlink($file); // delete file
                }
            }
        echo "Imaginile produsului au fost sterse";
    }
    
? >
<html>
<head>
    <title>Modificare produs-Admin</title>
    <link rel="shortcut icon" type="image/png" href="./icon.png"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css"  href="https://belissimadesign.com/CSS/general-style.css">
    <link rel="stylesheet" type="text/css"  href="https://belissimadesign.com/CSS/ap_page.css">
    <title>Document</title>
</head>
<body>
    <!--<a href="http://localhost/site/admin_page.php">Inapoi la tabel</a>-->
    <h1>Pagina produs:</h1>
    <?php
        if($num_results > 0)
        {
            while($row = mysqli_fetch_assoc($results))
            {
                echo "
                    <div class='container'>
                        <div class='images'>
                            <div class='box'>
                                <p>Imagini produs:</p>
                                <img src='https://belissimadesign.com/img_p/".$row['numar']."/".$row['numar']."_1.jpg' alt=''>
                                <img src='https://belissimadesign.com/img_p/".$row['numar']."/".$row['numar']."_2.jpg' alt=''>
                                <img src='https://belissimadesign.com/img_p/".$row['numar']."/".$row['numar']."_3.jpg' alt=''>
                            </div>
                        </div>
                        <div class='change_produs'>
                            <form action='' method='POST'>
                                <p>Numar produs:".$row['numar']."</p>
                                <p>Nume:</p>
                                <input type='text' name='nume' required placeholder='".$row['nume']."' value='".$row['nume']."'>
                                <p>Descriere:</p>
                                <textarea rows='4' cols='40' name='descriere' required placeholder='".$row['descriere']."'>".$row['descriere']."</textarea>
                                <p style='font-size: 13px;max-width:300px;'>-Daca vrei sa incepi un rand nou scrie '&lt;/br&gt;' la inceput de rand ca de ex: 'gasesti tot ce vrei.
                                &lt;/br&gt;dorim sa va invitam', 'dorim sa va invitam' va fi pe un rand nou.
                                Iar daca vrei spatiu intre randuri pune doua &lt;/br&gt;</p>
                                <p>Pret:</p>
                                <input type='text' name='pret' required placeholder='".$row['pret']." lei' value='".$row['pret']."'>
                                <p>Tip:</p>
                                <input type='text' name='tip' required placeholder='".$row['tip']."' value='".$row['tip']."'><br>
                                <br>";?>
                                <div>
                                    <p>Modifica marimile:</p>
                                    <input  type='checkbox'  name='marimi[]' value='xs' <?php 
                                        if(strpos($row['marime'], 'xs,') !== false){
                                            echo " checked ";
                                        }
                                    ?>>
                                    <label for='marimi[]'>XS</label><br>
                                    <input  type='checkbox'  name='marimi[]' value='s' <?php 
                                        if(strpos($row['marime'], 's,') !== false){
                                            echo " checked ";
                                        }
                                    ?>>
                                    <label for='marimi[]'>S</label><br>
                                    <input  type='checkbox'  name='marimi[]' value='m'<?php 
                                        if(strpos($row['marime'], 'm,') !== false){
                                            echo " checked ";
                                        }
                                    ?>>
                                    <label for='marimi[]'>M</label><br>
                                    <input  type='checkbox'  name='marimi[]' value='l'<?php 
                                        if(strpos($row['marime'], 'l,') !== false){
                                            echo " checked ";
                                        }
                                    ?>>
                                    <label for='marimi[]'>L</label><br>
                                    <input  type='checkbox'  name='marimi[]' value='xl'<?php 
                                        if(strpos($row['marime'], 'xl,') !== false){
                                            echo " checked ";
                                        }
                                    ?>>
                                    <label for='marimi[]'>XL</label><br>
                                    <input  type='checkbox'  name='marimi[]' value='xxl'<?php 
                                        if(strpos($row['marime'], 'xxl,') !== false){
                                            echo " checked ";
                                        }
                                    ?>>
                                    <label for='marimi[]'>XXL</label><br>
                                    <input  type='checkbox'  name='marimi[]' value='xxxl'<?php 
                                        if(strpos($row['marime'], 'xxxl,') !== false){
                                            echo " checked ";
                                        }
                                    ?>>
                                    <label for='marimi[]'>XXXL</label><br>
                                </div>
                                <?php
                                $aux_stoc = trim($row['stoc']);
                                echo"
                                <p>Stoc curent : <b>".$aux_stoc."</b></p>
                                <p>Modifica stoc:</p>
                                <select name='stoc' required>
                                    <option  value='suficient'>Suficient</option>
                                    <option  value='insuficient'>Insuficient</option>
                                    <option value='limitat'>Limitat</option>
                                </select>
                                <p>Reducere:(%)</p>
                                <input type='number' name='reducere' required placeholder='".$row['reducere']."' value='".$row['reducere']."'><br>
                                <br><input type='submit' value='Modifica' name='modifica'>
                            </form>
                            <hr>
                            <form action='' method='post' enctype='multipart/form-data'>
                                <input type='hidden' name='nr_p' value=".$row['numar'].">
                                <input type='file' name='img'>
                                <input type='submit' value='Adauga imagine' name='uploadImg'>
                            </form>
                            <hr>
                            <br><br>
                            <form action='' method='POST'>
                                <input type='hidden' name='numar_p' value=".$row['numar'].">
                                <input type='submit' value='Sterge pozele produsului' name='DeleteImg'>
                            </form>
                            <br><br><br>
                            <form action='' method='POST'>
                                <input type='hidden' name='numar_p' value=".$row['numar'].">
                                <input type='submit' name='sterge_p' value='STERGE PRODUSUL'>
                            </form>
                        </div>
                        
                    </div>";
            }
        }
    ? >
    <br>
</body>
</html>