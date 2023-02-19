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

  public function fetchAllServicesFromDB(){
    $service_query = $this->pdo->query("SELECT * FROM services");
    return $service_query->fetchAll();
  }
}
