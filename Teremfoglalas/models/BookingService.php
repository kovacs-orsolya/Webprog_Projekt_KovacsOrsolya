<?php
class BookingService
{   

    # Az összes foglalás lekérése egy adott teremhez
    public static function getBookings(int $halls_id, string $date){
        $conn = Database::connect();

        $stmt = $conn->prepare("SELECT bookings.id, bookings.users_id, users.name, bookings.bookedDate, bookings.bookedTime, bookings.event
                                FROM users INNER JOIN bookings ON users.id=users_id 
                                WHERE bookings.halls_id = ? AND bookings.bookedDate = ?");
        $stmt->bind_param("is", $halls_id, $date); 
        $stmt->execute();
        $result = $stmt->get_result(); 
        $bookings = [];

        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $personId = $row["users_id"];
            $personName = $row["name"];
            $bookedDate = $row["bookedDate"];
            $bookedTime =  $row["bookedTime"];
            $event = $row["event"];
            # Időpontok szerint tesszük be a listába
            $bookings[strtotime(date("G:i", strtotime($row["bookedTime"])))] = new Booking($id, $personId, $personName, $bookedDate, $bookedTime,$event);
        }

        $stmt->close();
        $conn->close();
        return $bookings;
    }

    # Ellenőrizzuk, hogy van-e már foglalás  arra az időpontra
    public static function checkBooking(int $halls_id, string $date, string $time){
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT * FROM bookings WHERE halls_id = ? AND bookedDate = ? AND bookedTime = ?;");
        $stmt->bind_param("iss", $halls_id,$date, $time);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $stmt->close();
        $conn->close();
        if($result->num_rows > 0){
            die("This appointment is already booked.");
        }
    }

    #Foglalás
    public static function toBook(int $halls_id, string $date, string $time, string $event){
        $conn = Database::connect(); 

        self::checkBooking($halls_id, $date, $time);

        $stmt = $conn->prepare("INSERT INTO bookings (halls_id, users_id, bookedDate, bookedTime, event) VALUES (?,?,?,?,?);");
        $stmt->bind_param("iisss", $halls_id, $_SESSION["userId"], $date, $time, $event);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
    #Foglalás törlése
    public static function deleteBooking(int $halls_id, int $id){
        $conn = Database::connect();
        $stmt = $conn->prepare("DELETE FROM bookings WHERE users_id = ? AND halls_id = ? AND id = ?;");
        $stmt->bind_param("iii",$_SESSION["userId"], $halls_id, $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}
?>