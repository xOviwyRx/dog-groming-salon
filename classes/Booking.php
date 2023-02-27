<?php

namespace classes;

class Booking {
    private $id, $user_id, $date, $time, $description, $service_id;
    
    private function checkDate($date) : bool {
        $date = date_parse($date);
        return checkdate($date['month'], $date['day'], $date['year']);
    }
    function __construct($date, $time, $service_id){
        if (!checkDate($date)){
            throw new \Exception("Please, provide correct date");
        }
        if (!checkTime($time)){
            throw new \Exception("Please provide correct time");
        }
        
        $this->date = $date;
        $this->time = $time;
        $this->service_id = $service_id;
    }
}


