<?php
// Connect to the database and return the database object
function connect() {
  $hostname = 'localhost';
  $dbname = 'salon';
  $username = 'salon';
  $password = 'saloon';

  $dsn = "mysql:host=$hostname;dbname=$dbname";

  try {
    return new PDO($dsn, $username, $password);
  } catch (Exception $e) {
    echo($e->getMessage());
  }
}
