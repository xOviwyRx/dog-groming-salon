<?php
session_start();
require_once '../classes/autoload.php';
include_once '../config/config.php';
$database = new classes\Database();
$account = new classes\Account;
$login = $account->login($_POST['name'], $_POST['password'], $database);
if ($login){
    $_SESSION['account'] = serialize($account);
    echo json_encode(['code'=>'200', 'location'=>'../index.php']);
} else {
    echo json_encode(['code'=>'500', 'msg'=>"Username or password is incorrect. Please try again."]);
}


