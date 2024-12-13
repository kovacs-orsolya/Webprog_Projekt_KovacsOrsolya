<?php
class UserService{

    # Felhasználó lekérése id szerint
    public static function getUserById(int $id){
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT id, name, email FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $user = new User($id, $result["name"], $result["email"]); 
        $stmt->close();
        $conn->close();
        return $user;
    }

    # Felhasználó bejelentkezése
    public static function loginUser(string $email, string $password){
        $conn = Database::connect();
        $stmt = $conn->prepare('SELECT id, password FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $result = $result->fetch_assoc();
            if ($password === $result["password"]) {

                $_SESSION['loggedin'] = TRUE;

                $_SESSION['userId'] = $result["id"];
                header("Location: index.php");
                exit();
            } else {
                echo '<p>Incorrect username and/or password!</p>';
                echo '<p>Or would you like to register?</p>';
                echo '<a href="registration.php">Registration</a>';
            }
        }else{
            echo '<p>Incorrect username and/or password!</p>';
            echo '<p>Or would you like to register?</p>';
            echo '<a href="registration.php">Registration</a>';
        }
        $stmt->close();
        $conn->close();     
    }

    # Felhasználó regisztrálása
    public static function RegisterUser(string $name, string $email, string $password, string $passwordAgain)
    {
        $conn = Database::connect();
        
        # Ellenőrizzuk, hogy az email benne van már az adatbázisba
        $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        # Csak akkor regisztrálhat ha még nem regisztrált az emaillel
        if ($result->num_rows > 0){
            return "User already exists!";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           return "Hibás email!";
          }
        if ($password !== $passwordAgain){
            return "Wrong password!";
        }

        $stmt = $conn->prepare("INSERT INTO users (name, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $password, $email);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return "Success!";
    }
}

?>