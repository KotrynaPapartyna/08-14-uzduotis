<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naujos imones pridėjimas</title>

    <?php require_once("linkai.php"); ?>
    
    <style>
        h1 {
            text-align: center;
        }

        .container {
            position:absolute;
            top:50%;
            left:50%;
            transform: translateY(-50%) translateX(-50%);
        }

        .hide {
            display:none;
        }
    </style>

</head>
<body>

<?php 

if (isset($_COOKIE["prisijungta"])) {
    header("Location:index.php"); 
}

    if(isset($_GET["submit"])) {
        if(isset($_GET["ID"]) && isset($_GET["pavadinimas"]) && isset($_GET["tipas_id"]) 
        && !empty($_GET["ID"]) && !empty($_GET["pavadinimas"]) && !empty($_GET["tipas_id"])) {
        
            $ID = $_GET["ID"];
            $pavadinimas = $_GET["pavadinimas"];
            $tipas_id = intval($_GET["tipas_id"]);

    
    $sql = "INSERT INTO `imones`(`pavadinimas`, `tipas_id`) 
        VALUES ($pavadinimas, $tipas_id)"; 

        if(mysqli_query($conn, $sql)) {
            $message =  "Imone prideta sėkmingai";
            $class = "success";
        } else {
            $message = "Prašome užpildyti visus laukelius";
            $class = "danger";
        }
    }
}

?>

<div class="container">
    <h1>Naujos imones sukūrimas</h1>
    
        <form action="naujaImone.php" method="get">
                
        <div class="form-group">
            <label for="id">ID</label>
            <input class="form-control" type="text" name="ID" placeholder="ID"/>
        </div>

        <div class="form-group">
            <label for="pavadinimas">Pavadinimas</label>
            <input class="form-control" type="text" name="pavadinimas" placeholder="pavadinimas"/>
        </div>

        <div class="form-group">
                    <label for="tipas_id">Imones tipas</label>
                    <select class="form-control" name="tipas_id">
                        <?php 
                         $sql = "SELECT * FROM imones_tipas";
                         $result = $conn->query($sql);
                        
                         while($clientRights = mysqli_fetch_array($result)) {
                            echo "<option value='".$clientRights["reiksme"]."'>";
                                echo $clientRights["pavadinimas"];
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>

                <a href="imones.php">Atgal</a><br>
                <button class="btn btn-primary" type="submit" name="submit">Nauja imone</button>
            </form>

            <?php if(isset($message)) { ?>
                <div class="alert alert-<?php echo $class; ?>" role="alert">
                <?php echo $message; ?>
                </div>
            <?php } ?>
        
              
    </div>
</body>
</html>