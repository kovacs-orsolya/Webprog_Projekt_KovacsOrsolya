<?php
class Booking{
    private int $id;
    private int $personId;
    private string $personName;
    private string $bookedDate;
    private string $bookedTime;
    private string $event;

    public function __construct(int $id, int $personId, string $personName, string $bookedDate, string $bookedTime, string $event)
    {
        $this->id = $id;
        $this->personId = $personId;
        $this->personName = $personName;
        $this->bookedDate = $bookedDate;
        $this->bookedTime = $bookedTime;
        $this->event = $event;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getPersonId()
    {
        return $this->personId;
    }
    public function getPersonName()
    {
        return $this->personName;
    }
    public function getBookedDate()
    {
        return $this->bookedDate;
    }
    public function getbookedTime()
    {
        return $this->bookedTime;
    }
    public function getEvent(){
        return $this->event;
    }
    
}

?>