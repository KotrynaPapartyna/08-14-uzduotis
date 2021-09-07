<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Įmonės</title>

    <?php require_once("linkai.php"); ?>
</head>
<body>
    <div class="container">
        <?php require_once("includes/imoniuMeniu.php"); ?>

        <?php 
        //Prisijungimo tikrinima
        if(!isset($_COOKIE["prisijungta"])) { 
            header("Location: index.php");    
        } else {
            echo "Sveikas prisijunges";
            echo "<form action='clients.php' method ='get'>";
            echo "<button class='btn btn-primary' type='submit' name='logout'>Logout</button>";
            echo "</form>";
            if(isset($_GET["logout"])) {
                setcookie("prisijungta", "", time() - 3600, "/");
                header("Location: index.php");
            }
        }    
        ?>

        <!-- paieskos mygtuko paspaudimas-->
        <?php if(isset($_GET["search"]) && !empty($_GET["search"])) { ?>
            <a class="btn btn-primary" href="imones.php"> Išvalyti paiešką</a>
        <?php } ?>


        <?php 
        // istrynimas
            if(isset($_GET["ID"])) {
                $id = $_GET["ID"];
                $sql = "DELETE FROM `imones` WHERE ID = $id";
                
                if(mysqli_query($conn, $sql)) {
                    $message = "Imonė sėkmingai ištrinta";
                    $class="success";
                } else {
                    $message = "Kažkas įvyko negerai";
                    $class="danger";
                }
            }
        ?>

        <?php if(isset($message)) { ?> <!--isvedama zinute-->
            <div class="alert alert-<?php echo $class; ?>" role="alert">
                <?php echo $message; ?>
            </div>
        <?php } ?>
    
        <!-- rusiavimo nustatymo forma-->
        <!--<form action="imones.php" method="get">

            <div class="form-group">
                <select class="form-control" name="rikiavimas_id">
                    <option value="DESC"> Nuo didžiausio iki mažiausio</option>
                    <option value="ASC"> Nuo mažiausio iki didžiausio</option>
                </select>
                <button class="btn btn-primary" name="rikiuoti" type="submit">Rikiuoti</button>
            </div>
         </form> 
        -->    
     
    <tbody>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Įmonės pavadinimas</th>
                <th scope="col">Įmonės aprašymas</th>
                <th scope="col">Imonės tipas</th>
                <th scope="col">Imonės tipo aprašymas</th>
                <th scope="col">Veiksmai</th>
                </tr>
            </thead>
            <tbody>
        
            

            <?php 
    
            //Imoniu atvaizdavimas
            $sql = "SELECT imones.ID, imones.pavadinimas AS imones_pavadinimas, imones.aprasymas AS imones_aprasymas, imones_tipas.pavadinimas AS tipo_pavadinimas, imones_tipas.aprasymas AS tipo_aprasymas 
            FROM `imones` LEFT JOIN imones_tipas ON imones.tipas_ID = imones_tipas.ID WHERE 1
            ";

            $result = $conn->query($sql); // vykdoma uzklausa
            // daugiau nei viena

            while($imones = mysqli_fetch_array($result)) {
                echo "<tr>";
                    echo "<td>". $imones["ID"]."</td>";
                    echo "<td>". $imones["imones_pavadinimas"]."</td>";
                    echo "<td>". $imones["imones_aprasymas"]."</td>";
                    echo "<td>". $imones["tipo_pavadinimas"]."</td>";
                    echo "<td>". $imones["tipo_aprasymas"]."</td>";
                    
                    
                    
                    echo "<td>";
                    echo "<a href='imones.php?ID=".$imones["ID"]."'>Trinti</a><br>";
                    echo "<a href='imoniuRedagavimas.php?ID=".$imones["ID"]."'>Redaguoti</a>";
                    echo "</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
        </table>
    </div>
        
       
        
        

        

        

</body>
</html>