<?php
namespace classes;

class Service{
  private $name, $price, $description, $id;
  public function __construct(string $name, string $price, string $description, string $id){
    $this->setName($name);
    $this->setPrice($price);
    $this->setDescription($description);
    $this->id = (int)$id;
  }
  public function getDescription(){
    return explode(',', $this->description);
  }
  public function getName(){
    return $this->name;
  }
  public function getId(){
    return $this->id;
  }
  public function getPrice(){
    return $this->price;
  }
  public function setName($raw_name) : void {
     $name = trim(htmlspecialchars($raw_name));
     if (empty($name)){
       throw new \Exception("Name can't be empty");
     } else {
         $this->name = $name;
     }
  }
  
  public function setPrice($raw_price) : void {
     if (!preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $raw_price)){
            throw new \Exception("Incorrect price format");
        } else {
            $this->price = $raw_price;
        }
  }
  
  public function setDescription($raw_description){
     $description = trim(htmlspecialchars($raw_description));
     if (empty($description)){
       throw new \Exception("Name can't be empty");
     } else {
         $this->description = $description;
     }
  }
  
  public function getStringDescription(){
    return $this->description;
  }
  static public function getAllServicesFromDB(Database $db) : array{
    $records = $db->fetchAllServicesFromDB();
    $services = array();
    foreach ($records as $record){
      $services[] = new Service($record['name'], $record['price'], $record['description'], $record['id']);
    }
    return $services;
  }
  
  static public function getServiceById(int $id, Database $db) : Service{
    $query = "SELECT * FROM services WHERE id = :id";
    $values = ['id' => $id];
    $row = $db->fetchPrepared($query, $values);
    if ($row){
        return new Service($row['name'], $row['price'], $row['description'], $row['id']);
    } else {
        throw new \Exception("Service not found in the database");
    }
  }
  
  public function updateServiceInDB(Database $db){
    $query = "UPDATE services SET name = :name, price = :price, description = :description WHERE id = :id;";
    $values = ['name' => $this->name, 'price' => $this->price, 'description' => $this->description, 'id' => $this->id];
    return $db->executePrepared($query, $values);
  }
}
