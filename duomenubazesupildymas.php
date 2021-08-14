
<?php
require_once("klientupildymoforma2.php")
?>

<?php
//1. Sukurti dokumentą duomenubazesupildymas.php. +
//Šis dokumentas turi sukurti 200 įrašų Klientai lentelėje.
//2. Papildyti dokumentą klientupildymoforma.php.
//*Po kliento pridėjimo, turi parodyti informaciją apie klientą.
//*Tikrinti,ar teises_id laukelyje yra įvestas skaičius.
//3. Sukurti dokumentą, klientai.php. 
//Jame turi būti atvaizduojami visi klientai esantys duomenų bazėje.
//4. Paspaudus ant kliento, turi būti įmanoma redaguoti jo duomenis ir išsaugoti.
//5. Kiekvieną klientą turi būti galimybė ištrinti iš duomenų bazės.

class Klientai {
    public $vardas;
    public $pavarde;
    public $teises_id; 

    function __construct($vardas,$pavarde,$teises_id) {
        $this->vardas=$vardas;
        $this->pavarde=$pavarde;
        $this->teises_id=$teises_id;
    }
}

$klientai=array(); 


$sql = "SELECT * FROM `klientai`";
$rezultatas=$prisijungimas->query($sql);

for($i=1; $i<200; $i++) {
    
    $sql= "INSERT INTO `klientai`(`KlientoVardas`, `KlientoPavarde`, `Teises_ID`) 
    VALUES ('KlientoVardas$i','KlientoPavarde$i','Teises_ID')"; 
}

   if(mysqli_query($prisijungimas, $sql)) {
        echo "Klientas pridetas"; 
    } else {
        echo "kazkas negerai"; 
    }   

?>
