<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klientai</title>

    <?php require_once("linkai.php"); ?>
</head>
<body>
    <div class="container">
        <?php require_once("includes/meniu.php"); ?>
<?php 

if(!isset($_COOKIE["prisijungta"])) { 
    header("Location: index.php");    
} else {
    echo "Sveikas prisijunges";
    echo "<form action='klientai.php' method ='get'>";
    echo "<button class='btn btn-primary' type='submit' name='logout'>Logout</button>";
    echo "</form>";
    if(isset($_GET["logout"])) {
        setcookie("prisijungta", "", time() - 3600, "/");
        header("Location: index.php");
    }
}    
?>

<?php 

if(isset($_GET["ID"])) {
    $id = $_GET["ID"];
    $sql = "DELETE FROM `klientai` WHERE ID = $id";
    if(mysqli_query($conn, $sql)) {
        $message = "Klientas sekmingai istrintas";
        $class="success";
    } else {
        $message = "Kazkas ivyko negerai";
        $class="danger";
    }
}

?>
<?php if(isset($message)) { ?>
    <div class="alert alert-<?php echo $class; ?>" role="alert">
        <?php echo $message; ?>
    </div>
<?php } ?>

<?php if(isset($_GET["search"]) && !empty($_GET["search"])) { ?>
    <a class="btn btn-primary" href="klientai.php"> Išvalyti paiešką</a>
<?php } ?>


<div class="row">
    <div class="col-lg-12 col-md-12">
        <h3>Filtravimas ir rikiaviamas</h3>
        <form action="klientai.php" method="get">

        <select class="form-control" name="rikiuoti_pagal">
            <?php 
                $sql = "SELECT * FROM `klientai_rikiavimas`";

                $result = $conn->query($sql); //vykdoma uzklausa

                $rikiavimo_stulpelis = array();
                
                $skaitiklis = 1;


        while($sortColumns = mysqli_fetch_array($result)) {

            if($skaitiklis == 1) {
                $numatytoji_reiksme = $sortColumns["ID"]; 
                }
                    
                    
            if(isset($_GET["rikiuoti_pagal"]) && $_GET["rikiuoti_pagal"] == $sortColumns["ID"]) {
                echo "<option value='".$sortColumns["ID"]."' selected='true'>".$sortColumns["rikiavimo_pavadinimas"]."</option>";
                } else {
                echo "<option value='".$sortColumns["ID"]."'>".$sortColumns["rikiavimo_pavadinimas"]."</option>";    
                }
                    
                $rikiavimo_stulpelis[$sortColumns["ID"]] =  $sortColumns["rikiavimo_stulpelis"];
                    
                $skaitiklis++;
                }

                // var_dump($rikiavimo_stulpelis);
            ?>
        </select>

        <select class="form-control" name="rikiavimas_id">
                    <?php if((isset($_GET["rikiavimas_id"]) && $_GET["rikiavimas_id"] == "DESC") || !isset($_GET["rikiavimas_id"]) ) {  ?>
                        <option value="DESC" selected="true"> Nuo didžiausio iki mažiausio</option>
                        <option value="ASC"> Nuo mažiausio iki didžiausio</option>
                    <?php } else {?>
                        <option value="DESC"> Nuo didžiausio iki mažiausio</option>
                        <option value="ASC" selected="true"> Nuo mažiausio iki didžiausio</option>
                    <?php } ?>    
        </select>


        <select class="form-control" name="filtravimas_id">

            <?php if(isset($_GET["filtravimas_id"]) && !empty($_GET["filtravimas_id"]) && $_GET["filtravimas_id"] != "default") {?>
                            <option value="default">Rodyti visus</option>
            <?php } else {?>
                            <option value="default" selected="true">Rodyti visus</option>
            <?php } ?>    

                <?php 
                    $sql = "SELECT * FROM klientai_teises";
                    $result = $conn->query($sql);

                    while($clientRights = mysqli_fetch_array($result)) {
                        if(isset($_GET["filtravimas_id"]) && $_GET["filtravimas_id"] == $clientRights["reiksme"] ) {
                            echo "<option value='".$clientRights["reiksme"]."' selected='true'>";
                            } else  {
                                echo "<option value='".$clientRights["reiksme"]."'>";
                            }
                                echo $clientRights["pavadinimas"];
                            echo "</option>";
                        }
                        ?>
                    </select>
                <button class="btn btn-primary" name="filtruoti" type="submit">Vykdyti</button>            
        </form>

        <?php   if(isset($_GET["filtravimas_id"]) && !empty($_GET["filtravimas_id"]) && $_GET["filtravimas_id"] != "default") { ?>
            <a class="btn btn-primary" href="klientai.php">Išvalyti filtrą</a>
        <?php } ?>
    </div>
</div>   


    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Vardas</th>
            <th scope="col">Pavardė</th>
            <th scope="col">Teisės</th>
            <th scope="col">Veiksmai</th>
            </tr>
        </thead>
        <tbody>
    
    <?php

    $clients_count = 10;
    $pagination_url = "";        

    if(isset($_GET["page-limit"])) {
        $page_limit = $_GET["page-limit"] * $clients_count - $clients_count;    
    } else {
        $page_limit = 0;    
    }        

       
    if(isset($_GET["rikiuoti_pagal"]) && !empty($_GET["rikiuoti_pagal"])) {
         $rikiuoti_pagal = $rikiavimo_stulpelis[$_GET["rikiuoti_pagal"]];
         $pagination_url .= "&rikiuoti_pagal=". $_GET["rikiuoti_pagal"];
    } else {
         $rikiuoti_pagal = $rikiavimo_stulpelis[$numatytoji_reiksme];
    }

    // nustatomas filltravimas kai yra puslapiai
    if(isset($_GET["filtravimas_id"]) && !empty($_GET["filtravimas_id"]) 
            && $_GET["filtravimas_id"] != "default") {
        $filtravimas = "klientai.teises_id =" .$_GET["filtravimas_id"];
        $pagination_url .= "&filtravimas_id=". $_GET["filtravimas_id"];
    } else {
        $filtravimas = 1;
    }

    if(isset($_GET["rikiavimas_id"]) && !empty($_GET["rikiavimas_id"])) {
        $rikiavimas = $_GET["rikiavimas_id"];
        $pagination_url .= "&rikiavimas_id=". $_GET["rikiavimas_id"];
    } else {
        $rikiavimas = "DESC";
    }


        $sql = "SELECT klientai.ID, klientai.vardas, klientai.pavarde, klientai_teises.pavadinimas FROM klientai 
        LEFT JOIN klientai_teises ON klientai_teises.reiksme = klientai.teises_id 
        WHERE $filtravimas
        ORDER BY $rikiuoti_pagal $rikiavimas
        LIMIT $page_limit , $clients_count 
        ";

    if(isset($_GET["search"]) && !empty($_GET["search"])) {
        $search = $_GET["search"];

        $sql = "SELECT klientai.ID, klientai.vardas, klientai.pavarde, klientai_teises.pavadinimas FROM klientai 
        LEFT JOIN klientai_teises ON klientai_teises.reiksme = klientai.teises_id 
        
        WHERE klientai.vardas LIKE '%".$search."%' OR klientai.pavarde 
        LIKE '%".$search."%' AND $filtravimas
        ORDER BY $rikiuoti_pagal $rikiavimas
        LIMIT $page_limit , $clients_count 
        ";
     }

    $result = $conn->query($sql); // uzklausos vykdymas
    
    while($clients = mysqli_fetch_array($result)) {
        echo "<tr>";
            echo "<td>". $clients["ID"]."</td>";
            echo "<td>". $clients["vardas"]."</td>";
            echo "<td>". $clients["pavarde"]."</td>";
            echo "<td>". $clients["pavadinimas"]."</td>";
            echo "<td>";
                echo "<a href='klientai.php?ID=".$clients["ID"]."'>Trinti</a><br>";
                echo "<a href='redagavimas.php?ID=".$clients["ID"]."'>Redaguoti</a>";
            echo "</td>";
        echo "</tr>";
    }
    
    ?>
  </tbody>
</table>

<?php
        
        if(isset($_GET["search"]) && !empty($_GET["search"])) {
            $page_filtering = "klientai.vardas LIKE '%".$search."%' OR klientai.pavarde 
            LIKE '%".$search."%' AND $filtravimas";
        } else {
            $page_filtering = $filtravimas;
        }
        
        $sql = "SELECT CEILING(COUNT(ID)/$clients_count) AS puslapiu_skaicius, COUNT(ID) AS viso_klientai 
        FROM klientai
        WHERE $page_filtering
        ";
        $result = $conn->query($sql);  
        
        if($result->num_rows == 1) { 
            $clients_total_pages = mysqli_fetch_array($result);
            
            
            for($i = 1; $i <= intval($clients_total_pages["puslapiu_skaicius"]); $i++) {
                

                if(!isset($_GET["page-limit"]) && $i==1) {
                    echo "<a class='btn btn-primary active' href='klientai.php?page-limit=$i$pagination_url'>";
                } else if((isset($_GET["page-limit"]) && $_GET["page-limit"] == $i) )
                {
                    echo "<a class='btn btn-primary active' href='klientai.php?page-limit=$i$pagination_url'>";
                } else {
                    echo "<a class='btn btn-primary' href='klientai.php?page-limit=$i$pagination_url'>";
                }
                echo $i; 
                    echo " ";
                echo "</a>";
            }
            
            echo "<p>";
            echo "Is viso puslapiu: ";
            echo $clients_total_pages["puslapiu_skaicius"];
            echo "</p>";

            echo "<p>";
            if (isset($_GET["page-limit"])) {
                echo $_GET["page-limit"];
            } else {
                echo "1";
            }
            
            echo " iš ";
            echo $clients_total_pages["puslapiu_skaicius"];
            echo "</p>";

            echo "<p>";
            echo "Is viso klientu: ";
             echo $clients_total_pages["viso_klientai"];
            echo "</p>";
        }
        else {
            echo "Nepavyko suskaiciuoti klientu";
        }
    ?>

</div>


<?php mysqli_close($conn); ?>
</body>
</html>