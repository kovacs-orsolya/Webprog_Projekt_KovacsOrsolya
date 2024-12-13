<?php
class HallService{

    # Terem lekérése id szerint
    public static function GetHallById(int $id){
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT name, size FROM halls WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result(); 
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
        }else{
            die("Hall not found.");
        }
        $hall = new Hall($id, $row["name"], $row["size"]); 
        $stmt->close();
        $conn->close(); 
        return $hall;
    }

    # Összes terem lekérése
    public static function GetHalls(){
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT * FROM halls");
        $stmt->execute();
        $result = $stmt->get_result(); 
        $halls = [];
        if($result->num_rows >0){ 
            while($row=$result->fetch_assoc()){
                array_push($halls, new Hall($row["id"], $row["name"], $row["size"]));
            }
        }
        $stmt->close();
        $conn->close(); 
        return $halls;
    }
}

?>