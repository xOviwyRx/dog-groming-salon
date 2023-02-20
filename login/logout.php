<?php session_start(); 
require_once '../classes/autoload.php';
include_once '../config/config.php';
$db = new classes\Database;
if (isset($_SESSION['account'])){
    try {
    $account = unserialize($_SESSION['account']);
    $account->logout($db);
    $_SESSION['account'] = serialize($account);
    header("Location: ../index.php"); 
    } catch(\Exception $e){
        echo $e->getMessage();
    }
} else {
    echo "No account for logout";
}

