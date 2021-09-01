<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imoniu pildymo forma</title>

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


//if(!isset($_COOKIE["prisijungta"])) { 
    //header("Location: index.php");    
//}


if(isset($_GET["submit"])) {
    if //(isset($_GET["ID"]) 
    (isset($_GET["pavadinimas"]) 
    && isset($_GET["tipas_id"])
    && isset($_GET["aprasymas"])
    

    //&& !empty($_GET["ID"]) 
    && !empty($_GET["pavadinimas"])
    && !empty($_GET["tipas_id"])
    && !empty($_GET["aprasymas"])) 
    {

        //$ID = $_GET["ID"];
        $pavadinimas = $_GET["pavadinimas"];
        $aprasymas = $_GET["aprasymas"];
        $tipas_id = $_GET["tipas_id"];

        
    $sql = "INSERT INTO `imones`(`pavadinimas`, 'tipas_id', `aprasymas`) 
            VALUES ($pavadinimas, $tipas_id, $aprasymas)";
    
    if(mysqli_query($conn, $sql)) {
            $message =  "Imone:  $pavadinimas, pridėta sėkmingai";
            $class = "success";
        } else {
            $message =  "Kažkas įvyko negerai";
            $class = "danger";
        }
    } else {
        $message =  "Užpildykite visus laukelius";
        $class = "danger";
    }
}

?>

<div class="container">
        <h1>Naujos imones pridėjimas</h1>
            <form action="imonespildymoforma.php" method="get">

                <!--<div class="form-group">
                    <label for="ID">ID</label>
                    <input class="form-control" type="text" name="ID" placeholder="ID" />
                </div>
                -->

                <div class="form-group">
                    <label for="pavadinimas">Pavadinimas</label>
                    <input class="form-control" type="text" name="pavadinimas" placeholder="Pavadinimas"/>
                </div>

                <div class="form-group">
                    <label for="tipas_id">Tipas</label>
                    <select class="form-control" name="tipas_id" id="tipas_id">
                       
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        
                    </select>
                </div>

                <div class="form-group">
                    <label for="aprasymas">Aprasymas</label>
                    <select class="form-control" name="aprasymas" id="aprasymas">
                       
                        <option value="Maza imone">Maza imone</option>
                        <option value="Vidutine imone">Vidutine imone</option>
                        <option value="Didele imone">Didele imone</option>
                        
                    </select>
                </div>

                <a href="imones.php">Atgal</a><br>
                <button class="btn btn-primary" type="submit" name="submit">Pridėti naują imonę</button>
            </form>

            <?php if(isset($message)) { ?>
                <div class="alert alert-<?php echo $class; ?>" role="alert">
                <?php echo $message; ?>
                </div>
            <?php } ?>
        
              
    </div>
</body>
</html>
