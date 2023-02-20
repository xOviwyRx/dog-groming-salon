<?php
session_start();
require_once '../classes/autoload.php';
include_once '../config/config.php';
$database = new classes\Database();
$account = new classes\Account;

if ($_POST['password'] !== $_POST['password2']){
    echo json_encode(['code'=>'500', 'msg'=>"Please input equal passwords"]);
    die();
}

try
{
	$account->addAccount($_POST['name'], $_POST['password'], $database);
        echo json_encode(['code'=>'200', 'msg'=>"Account was created. Please login now."]);
}
catch (Exception $e)
{
        echo json_encode(['code'=>'500', 'msg'=>$e->getMessage()]);
	die();
}