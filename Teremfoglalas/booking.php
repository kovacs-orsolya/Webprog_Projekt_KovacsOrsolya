<?php
session_start();
include_once("loader.php");

# Ha még nem jelentkezett be akkor előbb be kell jelentkezzen
if(!isset($_SESSION["loggedin"])){
    header("Location: login.php");
    exit();
}

$date = $_GET["date"];
$d = DateTime::createFromFormat("Y-m-d", $date); 

# Dátum ellenőrzése
if(!($d && $d->format("Y-m-d") === $date)){
    die("Invalid date");
} 

# Idő ellenőrzése
if($_GET["time"] > 16 || $_GET["time"] <8){
    die("Invalid time");
} 
$time = date("G:i",strtotime($_GET["time"] . ":00:00"));

#Foglalás ellenőrzése
BookingService::checkBooking($_GET["halls_id"],$date,$time);

$hall = HallService::GetHallById($_GET["halls_id"]);
$user = UserService::getUserById($_SESSION["userId"]);

if (isset($_POST["submit"])) {
    $event = $_POST["event"];
    BookingService::toBook($hall->getId(),$date, $time,$event);
    header("Location: hall.php?halls_id={$hall->getId()}&date={$date}");
    exit();
}
?>


<!doctype html>
<html lang="hu">
    <head>
        <title>Teremfoglalás</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <style>

        </style>
    </head>
    <Body>
        <div class="page">
            <header>
                <h1>Foglalás</h1>
                <div class="menu">
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
                    <a href="index.php"><i class="fa-solid fa-house"></i></a>
                </div>
            </header>
            <main>
                <div class="to-book">
                    <p>Terem: <?php echo $hall->getName(); ?></p>
                    <p>Méret: <?php echo $hall->getSize(); ?> &#x33A1;</p>
                    <p>Foglaló neve: <?php echo $user->getName(); ?></p>
                    <p>Foglalás dátuma: <?php echo date("Y, M, d",strtotime($date)); ?></p>
                    <p>Foglalás időpontja: <?php echo $time; ?></p>
                    
                    <form action="" method="post">
                        <div class="description">
                            <label for="event">Esemény:</label>
                            <textarea name="event" id="event" rows="5" cols="50"></textarea>
                        </div>
                        <br>
                        <input type="submit" value="Foglalás" name="submit">
                    </form>
                </div>
            </main>
        </div>
    </Body> 
</html>
