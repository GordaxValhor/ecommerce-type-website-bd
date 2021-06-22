
<?php
//daca am apasat pe tabel  ne arata comenzile sau produsele
? >
        <!-- aici o sa avem un seracj bar -->
<?php
        include 'db_connect.php';

        if($_GET['q']=='produse')
        {
            if(isset($_GET['s']))
            {
                $sql="Select * From produse WHERE nume LIKE '%".$_GET['s']."%';";
                //echo"<p>DA</p>";
            }
            else { $sql="Select * From produse"; }
            $results=mysqli_query($conn,$sql);
            $numResults = mysqli_num_rows($results);

            echo "
                <h2 id='tip_tab'>Tabel produse:</h2>
                <div class='tabel'>
                    <table>
                        <tr>
                            <th>id</th>
                            <th>numar</th>
                            <th>nume</th>
                            <th>descriere</th>
                            <th>tip</th>
                            <th>marimi</th>
                            <th>pret</th>
                            <th>imagini</th>
                            <th>stoc</th>
                            <th>reducere</th>
                        </tr>
            ";
            if($numResults > 0)
                    {
                        while($row = mysqli_fetch_assoc($results))
                        {
                            $id=$row['id'];
                            $numar_p=$row['numar'];
                            $nume = $row['nume'];
                            $pret = $row['pret'];
                            $tip = $row['tip'];
                            $marimi = $row['marime'];
                            $desc = $row['descriere'];
                            $img = $row['imagini'];
                            $stoc= $row['stoc'];
                            $red  = $row['reducere'];
                            $pret = number_format( $row['pret'] ,2);
                            $pret_redus = $pret - (($red/100)*$pret);
                            echo "  <tr>
                                    <td>".$id."</td>
                                    <td>".$numar_p."</td>
                                    <td><a href='./admin_product_page.php?id=".$id."' target='_blank'>".$nume."</a></td>
                                    <td>".$desc."</td>
                                    <td>".$tip."</td>
                                    <td>".$marimi."</td>
                                    <td>".$pret."</td>
                                    <td>".$img."</td>
                                    <td>".$stoc."</td>
                                    <td>-".$red."% (".$pret_redus." lei)</td>
                                    </tr>
                            ";
                        }
                    }
                echo "</table></div>";
        }
        else if($_GET['q']=='comenzi')
        {
            if(isset($_GET['s']))
            {
                $sql="Select * From comenzi WHERE nume_client LIKE '%".$_GET['s']."%';";
                echo"<p>DA</p>";
            }
            else { $sql="Select * From comenzi"; }
            $results=mysqli_query($conn,$sql);
            $numResults = mysqli_num_rows($results);
            echo "
                <h2 id='tip_tab'>Tabel comenzi:</h2>
                <div class='tabel'>
                    <table>
                        <tr>
                            <th>id</th>
                            <th>nr_comanda</th>
                            <th>nume_client</th>
                            <th>nume_comanda</th>
                            <th>nr_tel_client</th>
                            <th>mail_client</th>
                            <th>adresa_client</th>
                            <th>m_plata</th>
                            <th>produse</th>
                            <th>total_plata</th>
                            <th>data_comenzii</th>
                        </tr>
            ";
            if($numResults > 0)
                    {
                        while($row = mysqli_fetch_assoc($results))
                        {
                            $id=$row['id'];
                            $nr_comanda = $row['nr_comanda'];
                            $nume_client = $row['nume_client'];
                            $nume_comanda = $row['nume_comanda'];
                            $nr_tel_client = $row['nr_tel_client'];
                            $mail_client = $row['mail_client'];
                            $adresa_client = $row['adresa_client'];
                            $m_plata= $row['m_plata'];
                            $produse  = $row['produse'];
                            $total_plata  = $row['total_plata'];
                            $data_comenzii  = $row['data_comenzii'];
                            echo "  <tr>
                                    <td>".$id."</td>
                                    <td>".$nr_comanda."</td>
                                    <td>".$nume_client."</td>
                                    <td>".$nume_comanda."</td>
                                    <td>".$nr_tel_client."</td>
                                    <td>".$mail_client."</td>
                                    <td>".$adresa_client."</td>
                                    <td>";
                                    if($m_plata=='virament') {
                                        echo "<form action='./send_virament_mail.php' method='POST' target='_blank'>
                                        <input type='hidden' name='nume_client' value='".$nume_client."'>
                                        <input type='hidden' name='mail_client' value=".$mail_client.">
                                        <input type='hidden' name='nume_comanda' value='".$nume_comanda."'>
                                        <input type='submit' value=".$m_plata.">
                                        </form>";
                                    }
                            echo "</td>
                                    <td>".$produse."</td>
                                    <td>".$total_plata."</td>
                                    <td>".$data_comenzii."</td>
                                    </tr>
                                
                            ";
                        }
                    }
                    
        }
        echo "</table></div>";
    
? >
        
            
