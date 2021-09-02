<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klientu pildymo forma</title>

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


if(!isset($_COOKIE["prisijungta"])) { 
    header("Location: index.php");    
}


if(isset($_GET["submit"])) {
    if(isset($_GET["vardas"]) && isset($_GET["pavarde"]) 
    && isset($_GET["teises_id"]) 
    && isset($_GET["aprasymas"])
    && isset($_GET["imones_id"])
    

    && !empty($_GET["vardas"]) && !empty($_GET["pavarde"]) 
    && !empty($_GET["teises_id"]) 
    && !empty($_GET["aprasymas"]) 
    && !empty($_GET["imones_id"])) {

        $vardas = $_GET["vardas"];
        $pavarde = $_GET["pavarde"];
        $teises_id = intval($_GET["teises_id"]);
        $aprasymas = $_GET["aprasymas"];
        $imones_id = $_GET["imones_id"];

        //$today = getdate();
       // $formatas = "Y-m-d";
        //$pridejimo_data = date($formatas, $today[0]);
       // $pridejimo_data = $_GET["pridejimo_data"];
        $now_date = date("Y-m-d");
        
        $sql = "INSERT INTO `klientai`(`vardas`, `pavarde`, `teises_id`, 
        `aprasymas`, `imones_id`, `prisijungimo_data`=$now_date) 
        VALUES ('$vardas', '$pavarde', '$teises_id', '$aprasymas', '$imones_id', '$now_date')";

        if(mysqli_query($conn, $sql)) {
            $message =  "Vartotojas:  $vardas  $pavarde, pridėtas sėkmingai";
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
        <h1>Naujo kliento pridėjimas</h1>
            <form action="klientupildymoforma.php" method="get">

                <div class="form-group">
                    <label for="vardas">Vardas</label>
                    <input class="form-control" type="text" name="vardas" placeholder="Vardas" />
                </div>
                <div class="form-group">
                    <label for="pavarde">Pavardė</label>
                    <input class="form-control" type="text" name="pavarde" placeholder="Pavarde" />
                </div>

                <div class="form-group">
                    <label for="teises_id">Teisės</label>
                    <select class="form-control" name="teises_id" id="teises_id">
                        <option value="1">Naujas klientas</option>
                        <option value="2">Ilgalaikis klientas</option>
                        <option value="3">Lojalus klientas</option>
                        <option value="4">Nemokus klientas</option>
                        <option value="5">Ne EU klientas</option>
                        <option value="6">EU klientas</option>
                        <option value="4">Atsakingas klientas</option>
                        <option value="5">Azijos klientas</option>
                        <option value="6">Kinijos klientas</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="aprasymas">Aprašymas</label>
                    <input class="form-control" type="text" name="aprasymas" placeholder="aprasymas" />
                </div>

                <div class="form-group">
                    <label for="imones_id">ĮmonėsID</label>
                    <input class="form-control" type="text" name="imones_id" placeholder="imones_id" />
                </div>

                
                <a href="klientai.php">Atgal</a><br>
                <button class="btn btn-primary" type="submit" name="submit">Pridėti naują klientą</button>
            </form>

            <?php if(isset($message)) { ?>
                <div class="alert alert-<?php echo $class; ?>" role="alert">
                <?php echo $message; ?>
                </div>
            <?php } ?>
        
              
    </div>
</body>
</html>


