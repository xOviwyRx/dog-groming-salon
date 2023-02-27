<?php
declare(strict_types=1);
namespace classes;

class Booking {
    private $id, $user_id, $date, $time, $description, $service_id;
    
    public function setDescription(string $description) : void {
        $description = trim($description);
        $this->description = htmlspecialchars($description);
    }
    
    function __construct(string $date, string $time, int $service_id, int $user_id){
        $date = date_parse($date);
        if (sizeof($date['errors']) > 0 || !checkdate($date['month'], $date['day'], $date['year'])){
            throw new \Exception("Please, provide correct date");
        }
        
        if (!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $time)){
            error_log($time);
            throw new \Exception("Please provide correct time");
        }
        
        $this->date = $date;
        $this->time = $time;
        $this->service_id = $service_id;
        $this->user_id = $user_id;
    }
}


