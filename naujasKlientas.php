<?php require_once("connection.php");?>
 
<?php require_once("linkai.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naujo kliento pridėjimas</title>
    
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
    if(isset($_GET["vardas"]) && isset($_GET["pavarde"]) 
    && isset($_GET["teises_id"]) 

    && !empty($_GET["vardas"]) && !empty($_GET["pavarde"]) 
    && !empty($_GET["teises_id"])) {
        // $id = $_GET["ID"];

        $vardas = $_GET["vardas"];
        $pavarde = $_GET["pavarde"];
        $teises_id = intval($_GET["teises_id"]);
        //$aprasymas=$_GET["aprasymas"];
        //$prisijungimo_data=getdate(); 
        //$imones_id=intval($_GET["imones_id"]);

    
    $sql = "INSERT INTO `klientai`(`vardas`, `pavarde`, `teises_id`) 
            VALUES ($vardas, $pavarde, $teises_id)"; 

        if(mysqli_query($conn, $sql)) {
            $message =  "Vartotojas pridetas sėkmingai";
            $class = "success";
        } else {
            $message = "Prašome užpildyti visus laukelius";
            $class = "danger";
        }
    }
}

?>

<div class="container">
    <h1>Kliento sukūrimas</h1>
    
        <form action="naujasKlientas.php" method="get">
                
        <div class="form-group">
            <label for="vardas">Vardas</label>
            <input class="form-control" type="text" name="vardas" placeholder="vardas"/>
        </div>

        <div class="form-group">
            <label for="pavarde">Pavardė</label>
            <input class="form-control" type="text" name="pavarde" placeholder="pavarde"/>
        </div>

        <div class="form-group">
                    <label for="teises_id">Teisės</label>
                    <select class="form-control" name="teises_id">
                        <?php 
                         $sql = "SELECT * FROM klientai_teises";
                         $result = $conn->query($sql);
                        
                         while($clientRights = mysqli_fetch_array($result)) {
                            echo "<option value='".$clientRights["reiksme"]."'>";
                                echo $clientRights["pavadinimas"];
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>


                <div class="row">
                        <div class="col-lg-12">
                            <textarea class="form-control" id="aprasymas" name="aprasymas"></textarea>
                        </div>
                    </div>   
                               

                <a href="klientai.php">Atgal</a><br>
                <button class="btn btn-primary" type="submit" name="submit">Naujas klientas</button>
            </form>

            <?php if(isset($message)) { ?>
                <div class="alert alert-<?php echo $class; ?>" role="alert">
                <?php echo $message; ?>
                </div>
            <?php } ?>
        
              
    </div>
</body>
</html>