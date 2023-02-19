<?php

namespace classes;

class Database{
  private $pdo;

  private function connect() {
    $hostname = 'localhost';
    $dbname = 'salon';
    $username = 'salon';
    $password = 'saloon';

    $dsn = "mysql:host=$hostname;dbname=$dbname";

    try {
      return new \PDO($dsn, $username, $password);
    } catch (Exception $e) {
      echo($e->getMessage());
    }
  }

  function __construct(){
    $this->pdo = $this->connect();
  }

  function __destruct(){
    $this->pdo = NULL;
  }

  public function getServiceFromDB($service_name){
    $service_query = $this->pdo->query("SELECT price, description FROM services WHERE name = '$service_name'");
    $service_result = $service_query->fetch(\PDO::FETCH_ASSOC);
    return new Service($service_result['name'], $service_result['price'], $service_result['description']);
  }
}
