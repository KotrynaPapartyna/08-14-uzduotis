<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imones</title>
    
    <style>
        
    </style>

    <?php require_once("linkai.php"); ?>
</head>


<body>
    <div class="container">
    
    <?php require_once("includes/imoniuMeniu.php");?>  

<?php 

// imones, prisijungus matosi. 
// rikiavimas veikia
// imone issitrina sekmingai 


if(!isset($_COOKIE["prisijungta"])) { 
    header("Location: index.php"); 

} else {
    echo "Sveiki prisijunge";
    echo "<form action='imones.php' method ='get'>";
    echo "<button class='btn btn-primary' type='submit' name='logout'>Atsijungti</button>";
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
    $sql = "DELETE FROM `imones` WHERE ID = $id";
    
    if(mysqli_query($conn, $sql)) {
        $message = "Imone sekmingai istrinta";
        $class="success";
    } else {
        $message = "Kazkas ivyko negerai";
        $class="danger";
    }
}
?>

<?php if(isset($message)) { ?> <!--isvedama zinute-->
    <div class="alert alert-<?php echo $class; ?>" role="alert">
        <?php echo $message; ?>
    </div>
<?php } ?>


<!-- paieskos mygtuko paspaudimas-->
<?php if(isset($_GET["search"]) && !empty($_GET["search"])) { ?>
    <a class="btn btn-primary" href="imones.php"> Išvalyti paiešką</a>
<?php } ?>

<!-- rusiavimo nustatymo forma-->
<form action="imones.php" method="get">

    <div class="form-group">
        <select class="form-control" name="rikiavimas_id">
            <option value="DESC"> Nuo didžiausio iki mažiausio</option>
            <option value="ASC"> Nuo mažiausio iki didžiausio</option>
        </select>
        <button class="btn btn-primary" name="rikiuoti" type="submit">Rikiuoti</button>
    </div>

</form>     


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Pavadinimas</th>
      <th scope="col">Tipas</th>
      
    </tr>
  </thead>
  <tbody>


<?php 
    
if(isset($_GET["rikiavimas_id"]) && !empty($_GET["rikiavimas_id"])) {
        $rikiavimas = $_GET["rikiavimas_id"];
    } else {
        $rikiavimas = "DESC"; // nuo didziausio 
    }
    

    $sql = "SELECT * FROM `imones` ORDER BY `ID` $rikiavimas"; 

        if(isset($_GET["search"]) && !empty($_GET["search"])) {
            $search = $_GET["search"];
            $sql = "SELECT * FROM `imones` 
            WHERE `pavadinimas` LIKE '%".$search."%' 
            OR `tipas_id` LIKE '%".$search."% ' 
            ORDER BY `ID` $rikiavimas";
        }
    $result = $conn->query($sql); 
    
    while($imones = mysqli_fetch_array($result)) {
        echo "<tr>";
            echo "<td>". $imones["ID"]."</td>";
            echo "<td>". $imones["pavadinimas"]."</td>";
            echo "<td>". $imones["aprasymas"]."</td>";

            //vykdoma uzklausa is duomenu bazes pagal teises_id
                $teises_id=$imones["tipas_id"];
                $sql="SELECT * FROM imones_tipas WHERE ID=$teises_id"; 
            // gausime 1 irasa 
                $result_teises = $conn->query($sql); // vykdoma uzklausa 
            

                if ($result_teises->num_rows==1) {
                    $rights=mysqli_fetch_array($result_teises); 
                    echo "<td>";
                        echo $rights["pavadinimas"]; 
                    echo "</td>";
                } else {
                    echo "<td>nepatvirtinta imone</td>";
                }


            
            echo "<td>";
                echo "<a href='imones.php?ID=".$imones["ID"]."'>Trinti</a><br>";
                echo "<a href='imoniuredagavimas.php?ID=".$imones["ID"]."'>Redaguoti</a>";
            echo "</td>";
        echo "</tr>";
    }
    
    ?>
            </tbody>
        </table>

    </div>
</body>
</html>