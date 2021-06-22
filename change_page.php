<?php
    include 'db_connect.php'
? >
<?php
    $sql = 'SELECT * FROM produse';
    //echo $_GET['search'];
    if(isset($_GET['search']))
    {
        $search_v = $_GET['search'];
        $sql .=" WHERE nume LIKE '%".$search_v."%'";
    }
    if((isset($_GET['filtru1'])) && (isset($_GET['filtru2'])))
    {
        $sql = 'SELECT * FROM produse';
        $filtru1 = $_GET['filtru1'];
        $filtru2 = $_GET['filtru2'];
        if(($filtru1!='După preț') and ($filtru2 !='După tip'))
            {
                if(isset($search_v))
                {
                    $sql .=" AND  tip='$filtru2' ORDER BY pret $filtru1";
                }
                else {$sql .=" WHERE tip='$filtru2' ORDER BY pret $filtru1";}
            }
        else if ($filtru2!='După tip')
            {
                if(isset($search_v))
                {
                    $sql .=" AND tip='$filtru2'";
                }
                else {$sql .=" WHERE tip='$filtru2'";}
            }
        else if ($filtru1 !='După preț') {
                $sql .=" ORDER BY pret $filtru1";
            }
    }
    
    
    $nr_page = $_GET['q'];
    $start = 8 * ($nr_page -1);
    // Pentru filtre si search
    $sql .= ' LIMIT  '.$start.' , 8;';
    //echo $sql;
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
                        $stoc=$row['stoc'];
                        $stoc=strtolower($stoc);
                        $red=$row['reducere'];
                        $pret = $row['pret'];
                        $pret_redus = $pret - (($red/100)*$pret);
                        $pret = number_format( $row['pret'] ,2);
                        $error_img = 'onerror="this.onerror=null;'. "this.src='./images/alternative.jpg'" . '"';
                        echo "<div class='produs' >
                            <div class='img_list'>
                                <a href='./product-page.php?id=$id&nume=$nm'><img  class='img_p imagine' src='./img_p/".$numar_p."/".$numar_p."_2.jpg'  ".$error_img."></img></a>
                                <a href='./product-page.php?id=$id&nume=$nm'><img  class='img_p imagine img_ontop' src='./img_p/".$numar_p."/".$numar_p."_1.jpg' ></img></a>
                            </div>
                            <a href='./product-page.php?id=$id'><h2>".$row['nume']."</h2></a>";
                            if($red>0){
                                echo "<p>Pret: <del>". $pret ." ron.</del>(-".$red."%)</p>
                                    <h3>Pret: ".$pret_redus." ron.</h3>";
                                }
                            else{ echo"<p><br></p><h3>Pret: ". $pret ." ron.</h3>"; }
                            if($stoc=='suficient' or $stoc=='')
                            {
                                echo "<p style='border: 1px solid #1A1A1A;color:green;' >În stoc</p></div>";
                            }
                            else if($stoc=='insuficient')
                            {
                                echo "<p style='border: 1px solid #1A1A1A;color:red;'>Nu este in stoc</p></div>";
                            }
                            else if($stoc=='limitat')
                            {
                                echo "<p style='border: 1px solid #1A1A1A;color:orange;'>Doar câteva produse rămase</p></div>";
                            }
                    ;}
                ;}
                else { echo "<p>Nu sunt rezultate pentru aceasta pagina!</p></div>";}   
             ? >
        </div>
        <div class='change_page'>
                <img src="./images/miniarrow.png" alt="previous" style='transform: rotate(180deg);' onclick='antpage()'>
                <?php
                if($nr_page>1){
                    $pag_ant=$nr_page-1;
                    echo "<p id='nr_pagina'style='cursor:pointer; background-color: white; color: #1A1A1A;' onclick='antpage()'>". $pag_ant ."</p>";
                }        
                ? >
                <p id='nr_pagina'><?php echo $nr_page ?></p>
                <p id='nr_pagina'style='cursor:pointer; background-color: white; color: #1A1A1A;' onclick='nextpage()'><?php echo $nr_page+1 ?></p>
                <img src="./images/miniarrow.png" alt="next" onclick='nextpage()' >
        </div>