<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imones redagavimas</title>

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
        header ("Location:index.php");
    }

//mes pagal ID turetume isvesti visus duomenis i input apie klienta
//ir naujus duomenis per UPDATE sukelti i duomenu baze

if(isset($_GET["ID"])) {
    $id = $_GET["ID"];
    $sql = "SELECT * FROM imones WHERE ID = $id";

   
    $result = $conn->query($sql);

    if($result->num_rows == 1) {
      
        $imone = mysqli_fetch_array($result);
        $hideForm = false;
    
    } else {
        $hideForm = true;
    }
}

if(isset($_GET["submit"])) {
    
    if(isset($_GET["ID"]) 
    && isset($_GET["pavadinimas"]) 
    && isset($_GET["tipas_id"]) 

    && !empty($_GET["ID"]) 
    && !empty($_GET["pavadinimas"]) 
    && !empty($_GET["tipas_id"])) {

        $ID = $_GET["ID"];
        $pavadinimas = $_GET["pavadinimas"];
        $tipas_id = intval($_GET["tipas_id"]);

        $sql = "UPDATE `imones` SET `ID`='$ID',
        `pavadinimas`='$pavadinimas',`tipas_id`=$tipas_id WHERE ID = $id";

        if(mysqli_query($conn, $sql)) {
            $message =  "Imone redaguota sėkmingai";
            $class = "success";
        } else {
            $message =  "Kažkas įvyko negerai";
            $class = "danger";
        }
    } else {
        $id = $imone["ID"];
        $pavadinimas = $imone["pavadinimas"];
        $tipas_id = intval($imone["tipas_id"]);

        $sql = "UPDATE `imones` SET `pavadinimas`='$pavadinimas',`tipas_id`=$tipas_id WHERE ID = $id";

        if(mysqli_query($conn, $sql)) {
            $message =  "Imone $pavadinimas redaguota sėkmingai";
            $class = "success";
        } else {
            $message =  "Kazkas ivyko negerai";
            $class = "danger";
        }
    }
}
?>

<div class="container">
    <h1>Imones redagavimas</h1>
    <?php if($hideForm == false) { ?>
        <form action="imoniuredagavimas.php" method="get">
                
        <input class="hide" type="text" name="ID" value ="<?php echo $imone["ID"]; ?>" />

        <div class="form-group">
            <label for="pavadinimas">Pavadinimas</label>
            <input class="form-control" type="text" name="pavadinimas" value="<?php echo $imone["pavadinimas"]; ?>"/>
        </div>

               
        <div class="form-group">
            <label for="tipas_id">Tipas</label>
        <!--<input class="form-control" type="text" name="Teises_ID" value="<?php echo $imone["tipas_id"]; ?>"/>-->
        
                          

        <select class="form-control" name="tipas_id">
            <?php 
                $sql = "SELECT * FROM imones_tipas";
                $result = $conn->query($sql);
                        
                while($clientRights = mysqli_fetch_array($result)) {

                    if($client["tipas_id"] == $clientRights["reiksme"] ) {
                        echo "<option value='".$clientRights["reiksme"]."' selected='true'>";
                        }  else {
                        echo "<option value='".$clientRights["reiksme"]."'>";
                        }  
                                
                        echo $clientRights["pavadinimas"];
                        echo "</option>";
                        }
                        ?>
                    </select>
                </div>

        <a href="imones.php">Atgal</a><br>
        <button class="btn btn-primary" type="submit" name="submit">Redaguoti</button>
    
    </form>
        
            <?php if(isset($message)) { ?>
                <div class="alert alert-<?php echo $class; ?>" role="alert">
                <?php echo $message; ?>
                </div>
            <?php } ?>
        <?php } else { ?>
            <h2> Tokios imones nėra </h2>
            <a href="imones.php">Atgal</a>
        <?php }?>    
    </div>
</body>
</html>