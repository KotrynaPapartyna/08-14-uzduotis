<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klientai</title>

    <?php require_once("linkai.php"); ?>

</head>
<body>
    <div class="container">  
     

<?php 

if(!isset($_COOKIE["prisijungta"])) { 
    header("Location: index.php"); 

} else {
    echo "Sveikas prisijunges";
    echo "<form action='klientai.php' method ='get'>";
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
    $sql = "DELETE FROM `klientai` WHERE ID = $id";
    if(mysqli_query($conn, $sql)) {
        $message = "Klientas sėkmingai ištrintas";
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


<!-- paieskos mygtuko paspaudimas-->
<?php if(isset($_GET["search"]) && !empty($_GET["search"])) { ?>
    <a class="btn btn-primary" href="klientai.php"> Išvalyti paiešką</a>
<?php } ?>


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
    
if(isset($_GET["rikiavimas_id"]) && !empty($_GET["rikiavimas_id"])) {
        $rikiavimas = $_GET["rikiavimas_id"];
    } else {
        $rikiavimas = "DESC"; // nuo didziausio 
    }

    $sql = "SELECT * FROM `klientai` ORDER BY `ID` $rikiavimas"; 

    if(isset($_GET["search"]) && !empty($_GET["search"])) {
        $search = $_GET["search"];
        $sql = "SELECT * FROM `klientai` WHERE `vardas` LIKE '%".$search."%' OR `pavarde` LIKE '%".$search."%' ORDER BY `ID` $rikiavimas";
    }
    $result = $conn->query($sql); 
    
    while($clients = mysqli_fetch_array($result)) {
        echo "<tr>";
            echo "<td>". $clients["ID"]."</td>";
            echo "<td>". $clients["vardas"]."</td>";
            echo "<td>". $clients["pavarde"]."</td>";

            
                $teises_id=$clients["teises_id"];
                $sql="SELECT * FROM klientai_teises WHERE reiksme=$teises_id"; 
            
                $result_teises = $conn->query($sql); 
           

                if ($result_teises->num_rows==1) {
                    $rights=mysqli_fetch_array($result_teises); 
                    echo "<td>";
                        echo $rights["pavadinimas"]; 
                    echo "</td>";
                } else {
                    echo "<td>Nepatvirtintas klientas</td>";
                }
          
            echo "<td>";
                echo "<a href='klientai.php?ID=".$clients["ID"]."'>Trinti</a><br>";
                echo "<a href='redagavimas.php?ID=".$clients["ID"]."'>Redaguoti</a>";
            echo "</td>";
        echo "</tr>";
    }
    
    ?>
  </tbody>
</table>
    </div>
</body>
</html>