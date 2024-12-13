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
                <div class="login">
                    <h1>Bejelentkezés</h1>
                    <form action="authenticate.php" method="post">
                        <div>
                            <label for="email">
                                <i class="fa-solid fa-envelope"></i>
                            </label>
                            <input type="text" name="email" placeholder="Email" id="email" required>
                        </div>
                        <div>
                            <label for="password">
                                <i class="fas fa-lock"></i>
                            </label>
                            <input type="password" name="password" placeholder="Jelszó" id="password" required>
                        </div>
                            <input type="submit" value="Bejelentkezés"> 
                            
                    </form>
                    <a class="registrate" href="registration.php">Regisztrálás</a>
                </div>
            </main>
        </div>
    </Body> 
</html>