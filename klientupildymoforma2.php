<?php
require_once("connect.php")
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klientu pildymo forma</title>
</head>
<body>

    <form action="klientupildymoforma2.php" method="get">
        <input type="text" value="test" name="vardas"/>
        <input type="text" value="test" name="pavarde"/>
        <input type="text" value="5" name="teises_id"/>

        <button type="submit" name="prideti">Prideti nauja klienta</button>

    </form>

<?php

if(isset($_GET["prideti"])) {
    if(isset($_GET["vardas"]) && !empty($_GET["vardas"]) 
    && isset($_GET["pavarde"]) && !empty($_GET["pavarde"]) 
    && isset($_GET["teises_id"]) && !empty($_GET["teises_id"])) {
        $vardas = $_GET["vardas"];
        $pavarde = $_GET["pavarde"];
        $teises_id = $_GET["teises_id"];

    
        
    if(mysqli_query($prisijungimas, $sql)) {
                echo "Klientas pridetas"; 
        } else {
                echo "kazkas negerai"; 
        } 
 
    }
}

?>
    
</body>
</html>



