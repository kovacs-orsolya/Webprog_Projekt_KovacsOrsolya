<?php
session_start();
if(!isset($_SESSION["loggedin"])){
    header("Location: login.php");
    exit();
}
include_once("loader.php");

# Dátum ellenőrzése
if (!isset($_GET['date'])) {
    $date = date('Y-m-d'); 
} else {
    $date = $_GET['date'];
    if (!strtotime($date) || $date < date('Y-m-d')) {
        die("Invalid date");
    }
}
if ($date === date('Y-m-d')) {
    $disabled = "disabled";
}else{
    $disabled = "";
}

$user = UserService::getUserById($_SESSION["userId"]);

$hall = HallService::GetHallById((int)$_GET["halls_id"]);

$bookings = BookingService::getBookings($hall->getId(), $date);

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
                <h1><?php echo $hall->getName(); ?></h1>
                <div class="menu">
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a> <!-- Logout icon -->
                    <a href="index.php"><i class="fa-solid fa-house"></i></a> <!-- Home icon -->
                </div>
            </header>
            <main>
                <div class="calendar">

                    <div class="header">
                        
                        <!-- Balra muató nyíl -->
                        <a href='<?php echo "hall.php?halls_id=".$hall->getId()."&date=".date('Y-m-d', strtotime('-1 day', strtotime($date)));?>' 
                            class="button fa-solid fa-angles-left <?php echo $disabled ?>">
                        </a>

                        <div class="date">
                        <!-- Dátum megjelenítése -->
                        <p class="date-num"><?php echo date("Y, m, d",strtotime($date)); ?></p>
                        <!-- Nap megjelenítése -->
                        <p class="date-day">
                            <?php
                                switch (date("D",strtotime($date))){
                                    case "Mon": 
                                        echo "Hétfő";
                                        break;
                                    case "Tue":
                                        echo "Kedd";
                                        break;
                                    case "Wed":
                                        echo "Szerda";
                                        break;
                                    case "Thu":
                                        echo "Csütörtök";
                                        break;
                                    case "Fri":
                                        echo "Péntek";
                                        break;
                                    case "Sat":
                                        echo "Szombat";
                                        break;
                                    case "Sun":
                                        echo "Vasárnap";
                                        break;
                                }?>
                        </p>
                        </div>

                        <!-- Jobbra mutató nyíl -->
                        <a href='<?php echo "hall.php?halls_id=".$hall->getId()."&date=".date('Y-m-d', strtotime('+1 day', strtotime($date)));?>' 
                            class="button fa-solid fa-angles-right">
                        </a>
                    </div>

                        <div class="spacer"></div> <!-- Üres hely -->
                        <div class="days">
                            <div class="timeline">
                            <?php for ($i = 8; $i <= 16; $i++){ ?>
                            <div class="time-marker">
            
                                    <span class="time"><?php echo $i . ":00";?></span> <!-- Időpont -->
                                    <?php if (isset($bookings[strtotime("$i:00")])) { ?>
                                        <div class="booked">
                                                                        <!-- Lefoglalva: foglaló neve 	esemény neve -->
                                            <p><?php echo "Lefoglalva: " . $bookings[strtotime("$i:00")]->getPersonName() . " &nbsp; " . $bookings[strtotime("$i:00")]->getEvent();?></p>
                                                
                                                <!-- Ha a lefoglaló megegyezik a felhasználóval akkor megjelenik a törlési lehetőség -->
                                                <?php if($bookings[strtotime("$i:00")]->getPersonId() == $user->getId()){?>
                                                <a href="delete.php?halls_id=<?php echo $hall->getId();?>&id=<?php echo $bookings[strtotime($i.':00')]->getId();?>">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                                <?php } ?>

                                        </div>

                                    <?php } else { ?>
                                        <div class="unbooked"><a href =<?php echo "booking.php?halls_id={$hall->getId()}&date={$date}&time={$i}"?>>Foglald le</a></div>
                                    <?php }
                                    ?>

                            </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </Body> 
</html>