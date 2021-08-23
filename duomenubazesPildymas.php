
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klientu generavimas</title>
</head>
<body>
    <form action="duomenubazesPildymas.php" method="get">
        <button type="submit" name="submit">Sukurti klientus</button>
    </form>
<?php 

// 1. Sukurti dokumentą duomenubazesupildymas.php. +
// Šis dokumentas turi sukurti 200 įrašų Klientai lentelėje.+
// 2. Papildyti dokumentą klientupildymoforma.php.+
//* Po kliento pridėjimo, turi parodyti informaciją apie klientą+
// *Tikrinti,ar teises_id laukelyje yra įvestas skaičius.-?
// 3. Sukurti dokumentą, klientai.php. +
// Jame turi būti atvaizduojami visi klientai esantys duomenų bazėje.+
// 4. Paspaudus ant kliento, turi būti įmanoma redaguoti jo duomenis ir išsaugoti.+
// 5. Kiekvieną klientą turi būti galimybė ištrinti iš duomenų bazės.+




    require_once("connection.php");

    if(isset($_GET["submit"])) {
        for ($i=0; $i<200; $i++) {

            $vardas = "vardas".$i;
            $pavarde = "pavarde".$i;
            $teises_id = rand(0, 5);

        $sql = "INSERT INTO `klientai`(`vardas`, `pavarde`, `teises_id`) 
            VALUES ('$vardas','$pavarde','$teises_id')";

            if(mysqli_query($conn, $sql)) {
                echo "Vartotojas sukurtas sekmingai";
                echo "<br>";
            } else {
                echo "Kazkas ivyko negerai";
                echo "<br>";
            }
        }
    }

?>
</body>
</html>
