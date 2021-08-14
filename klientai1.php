<?php

// NEBAIGTA

require_once("connect.php");


$sql = "SELECT * FROM `klientai`";
$rezultatas=$prisijungimas->query($sql);


while ($klientai=mysqli_fetch_array($rezultatas)) {
    echo "<br>";
    echo $klientai["ID"];
    echo " ";
    echo $klientai["Vardas"];
    echo " ";
    echo $klientai["Pavarde"];
    echo " ";
    echo $klientai["Teises_ID"];
    echo "<br>";
}

$klientai=mysqli_fetch_array($rezultatas); 



$sql="INSERT INTO `klientai`(`Vardas`, `Pavarde`, `Teises_ID`) 
VALUES ('phpVardas','phpPavade',50)";

if(mysqli_query($prisijungimas, $sql)) {
    echo "irasas pridetas"; 
} else {
    echo "kazkas negerai"; 
}


mysqli_close($prisijungimas); 


?>