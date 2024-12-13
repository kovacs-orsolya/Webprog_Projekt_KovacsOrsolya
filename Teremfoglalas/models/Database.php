<?php
# Kapcsolódás az adatbázishoz
class Database{
    private static string $servername = "localhost";
    private static string $username = "root";
    private static string $password = "";
    private static string $dbname = "hallbooking";
    public static function connect(){
        $conn = new mysqli(self::$servername,self::$username,self::$password,self::$dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}