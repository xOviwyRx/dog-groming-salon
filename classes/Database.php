<?php

namespace classes;

class Database{
  private $pdo;

  private function connect() {
    $hostname = HOSTNAME;
    $dbname = DB_NAME;
    $username = USERNAME;
    $password = PASSWORD;

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
  
  public function executePrepared($query, $values){
    $res = $this->pdo->prepare($query);
    $success_query = $res->execute($values);
    if (!$success_query){
        throw new \PDOException('Database query error');
    }
    return $res;
  }
  
  public function insertPrepared($query, $values){
    $this->executePrepared($query, $values);
    return $this->pdo->lastInsertId();
  } 
  
  public function fetchPrepared($query, $values){
    $res = $this->executePrepared($query, $values);
    return $res->fetch(\PDO::FETCH_ASSOC);
  }
}
