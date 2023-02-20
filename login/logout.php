<?php session_start(); 
require_once '../classes/autoload.php';
include_once '../config/config.php';
$db = new classes\Database;
if (isset($_SESSION['account'])){
    $account = unserialize($_SESSION['account']);
    $account->logout($db);
    $_SESSION['account'] = serialize($account);
    header("Location: ../index.php");
} else {
   throw new \Exception('Error while logout');
}

