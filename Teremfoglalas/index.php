<?php
session_start();
if(!isset($_SESSION["loggedin"])){
    header("Location: login.php");
    exit();
}
include_once("loader.php");

$halls = HallService::GetHalls();

?>

<!doctype html>
<html lang="hu">
    <head>
        <title>Teremfoglalás</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link type="text/css" rel="stylesheet" href="css/style.css" />

    </head>
    <Body>
        <div class="page">
            <header>
                <h1>Termek</h1>
                <div class="menu">
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
                    <a href="index.php"><i class="fa-solid fa-house"></i></a>
                </div>
            </header>
            <main>
                <div class="halls">
                    <?php foreach($halls as $hall){?>
                                <div class="hall">
                                <a href='hall.php?halls_id=<?php echo $hall->getId(); ?>'>
                                    <h4><?php echo $hall->getName(); ?></h4>
                                    <p><?php echo $hall->getSize(); ?> &#x33A1; <!-- négyzetméter --> </p>
                                </a>
                               </div>
                               <?php } ?>

                </div>
            </main>
        </div>
    </Body> 
</html>