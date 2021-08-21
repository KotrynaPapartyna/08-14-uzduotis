<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>

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
    </style>

</head>
<body>


<?php 
    if(isset($_GET["submit"])) { 
       
       
       $name =$_GET["name"];
       $username =$_GET["username"];
       $password =$_GET["password"];
       $repeat_password = $_GET["repeat-password"];
       $description = $_GET["description"];

       //
       $sql = "SELECT * FROM `uzsiregistrave vartotojai` WHERE slapyvardis='$username' ";
       $result = $conn->query($sql);

       $class= "danger";
       if($result->num_rows == 1) {
           $message = "Toks vartotojas duomenu bazėje jau yra";
       } else {
          if($password==$repeat_password){
            
            $sql = "INSERT INTO `uzsiregistrave vartotojai`(`vardas`, `slapyvardis`, `slaptazodis`, `teises_id`, `aprasymas`) 
            VALUES ('$name','$username','$password',1,'$description')";

            if(mysqli_query($conn, $sql)) {
                $class= "success";
                $message = "Vartotojas sukurtas sekmingai";
            } else {
                $message = "Kazkas ivyko negerai";
            }

          } else {
            $message = "Slaptažodžiai nesutampa";
          }
       }
    }
?>

<div class="container">
        <h1>Registracija</h1>
        <form action="registracija.php" method="get">
            <div class="form-group">
                <label for="name">Vardas</label>
                <input class="form-control" type="text" name="name" required="true" value="<?php 
                    if(isset($name)) {
                        echo $name;
                    } else {
                        echo "";
                    }
                ?>" />
            </div>
            <div class="form-group">
                <label for="username">Pavardė</label>
                <input class="form-control" type="text" name="username" required="true" value="<?php 
                    if(isset($username)) {
                        echo $username;
                    } else {
                        echo "";
                    }
                ?>"/>
            </div>
            <div class="form-group">
                <label for="password">Slaptažodis</label>
                <input class="form-control" type="password" name="password" required="true" />
            </div>
            <div class="form-group">
                <label for="repeat-password">Pakartokite slaptažodį</label>
                <input class="form-control" type="password" name="repeat-password" required="true" />
            </div>

            <div class="form-group">
                <label for="description">Aprašymas</label>
                <textarea class="form-control" type="password" name="description">
                    <?php 
                    if(isset($description)) {
                        echo $description;
                    } else {
                        echo "";
                    }
                ?>
                </textarea>
            </div>

            <?php if(isset($message)) { ?>
                <div class="alert alert-<?php echo $class; ?>" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <a href="index.php">Prisijungti</a><br>
            <button class="btn btn-primary" type="submit" name="submit">Registracija</button>
        </form>
    </div>
</body>
</html>