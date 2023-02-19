<?php
namespace classes;

class Service{
  private $name, $price, $description;
  public function __construct($name, $price, $description){
    $this->name = $name;
    $this->price = $price;
    $this->description = $description;
  }
  public function getDescription(){
    return explode(',', $this->description);
  }
  public function getName(){
    return $this->name;
  }
  public function getPrice(){
    return $this->price;
  }
  static public function getAllServicesFromDB($db){
    $records = $db->fetchAllServicesFromDB();
    $services = array();
    foreach ($records as $record){
      $services[] = new Service($record['name'], $record['price'], $record['description']);
    }
    return $services;
  }
}
