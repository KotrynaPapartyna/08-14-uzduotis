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
            font-style: oblique;
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

    //if (isset($_COOKIE["prisijungta"])) {
        //header ("Location:index.php");
   // }

//mes pagal ID turetume isvesti visus duomenis i input apie klienta
//ir naujus duomenis per UPDATE sukelti i duomenu baze

if(isset($_GET["ID"])) {
    $id = $_GET["ID"];
    $sql = "SELECT * FROM imones WHERE ID = $id";

   
    $result = $conn->query($sql);

    if($result->num_rows == 1) {
      
        $client = mysqli_fetch_array($result);
        $hideForm = false;
    
    } else {
        $hideForm = true;
    }
}

if(isset($_GET["submit"])) {
    
    if(isset($_GET["pavadinimas"]) && isset($_GET["aprasymas"]) 
    && isset($_GET["tipas_id"]) 
    
    && !empty($_GET["pavadinimas"]) 
    && !empty($_GET["aprasymas"]) && !empty($_GET["tipas_id"])) {
        
        $id = $_GET["ID"];
        $pavadinimas = $_GET["pavadinimas"];
        $aprasymas = $_GET["aprasymas"];
        $tipas_id = intval($_GET["tipas_id"]);
        //$aprasymas = $_GET["aprasymas"];

        $sql = "UPDATE `imones` SET `pavadinimas`='$pavadinimas',
        `aprasymas`='$aprasymas',`tipas_id`=$tipas_id WHERE ID = $id";

        if(mysqli_query($conn, $sql)) {
            $message =  "Įmonė $pavadinimas redaguota sėkmingai";
            $class = "success";
        } else {
            $message =  "Kažkas įvyko negerai";
            $class = "danger";
        }
    } else {
        $id = $client["ID"];
        $pavadinimas = $client["pavadinimas"];
        $aprasymas = $client["aprasymas"];
        $tipas_id = intval($client["tipas_id"]);

        $sql = "UPDATE `imones` SET `pavadinimas`='$pavadinimas',
        `aprasymas`='$aprasymas',`tipas_id`=$tipas_id WHERE ID = $id";

        if(mysqli_query($conn, $sql)) {
            $message =  "Įmonė redaguotas sėkmingai";
            $class = "success";
        } else {
            $message =  "Kažkas įvyko negerai";
            $class = "danger";
        }
    }
}
?>

<div class="container">
    <h1>Imonės redagavimas</h1>
    <?php if($hideForm == false) { ?>
        <form action="imoniuRedagavimas.php" method="get">
                
        <input class="hide" type="text" name="ID" value ="<?php echo $client["ID"]; ?>" />

        <div class="form-group">
            <label for="pavadinimas">Pavadinimas</label>
            <input class="form-control" type="text" name="pavadinimas" value="<?php echo $client["pavadinimas"]; ?>"/>
        </div>

        <div class="form-group">
            <label for="aprasymas">Aprašymas</label>
            <input class="form-control" type="text" name="aprasymas" value="<?php echo $client["aprasymas"]; ?>"/>
        </div>

        
        <div class="form-group">
            <label for="tipas_id">Teisės</label>
        <!--<input class="form-control" type="text" name="Teises_ID" value="<?php echo $client["tipas_id"]; ?>"/>-->
        
                          

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

                <div class="row">
                        <div class="col-lg-12">
                            <label for="aprasymas">Aprašymas</label>
                            <textarea class="form-control" id="aprasymas" name="aprasymas"></textarea>
                        </div>
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
            <h2> Tokio imones nėra </h2>
            <a href="imones.php">Atgal</a>
        <?php }?>    
    </div>
</body>
</html>