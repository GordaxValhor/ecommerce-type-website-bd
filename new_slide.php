    <?php
        include 'db_connect.php';
        //session_start();
    ?>
    
    <?php
                if(isset($_GET['q']))
                {
                    $slide_nr = $_GET['q'];
                }
                $start = $slide_nr * 3;
                $sql = "SELECT * FROM produse limit ".$start.",3;" ;
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
    ?>