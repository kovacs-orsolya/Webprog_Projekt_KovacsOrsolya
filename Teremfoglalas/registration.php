<?php
include_once("loader.php");
$message = "";
if(isset($_POST["submit"])){
    $message = UserService::RegisterUser($_POST["name"], $_POST["email"],$_POST["password"], $_POST["passwordAgain"]);
}
?>
<!DOCTYPE html>
<html lang="hu">
    <HEAD>
        <title>Teremfoglalás</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <style>

        </style>
    </HEAD>
    <Body>
        <div class="page">
            
            <main>
                <div class="registration">
                    <h1>Regisztrálás</h1>
                    <!-- Üzenet kiiratása -->
                    <p><?php echo $message; ?></p>
                    <form action="" method="post">
                    <div>
                        <label for="email">
                            Név: 
                        </label>
                        <input type="text" name="name" placeholder="Név" id="name" required>
                        </div>
                        <div>
                            <label for="email">
                                Email: 
                            </label>
                            <input type="text" name="email" placeholder="Email" id="email" required>
                        </div>
                        <div>
                            <label for="password">
                                Jelszó: 
                            </label>
                            <input type="password" name="password" placeholder="Jelszó" id="password" required>
                        </div>
                        <div>
                            <label for="passwordAgain">
                                Jelszó újra: 
                            </label>
                            <input type="password" name="passwordAgain" placeholder="Jelszó" id="passwordAgain" required>
                        </div>
                            <input type="submit" name="submit" value="Regisztrálás"> 
                            
                    </form>
                </div>
            </main>
        </div>
    </Body> 
</html>