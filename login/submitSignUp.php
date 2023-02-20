<?php
session_start();
require_once '../classes/autoload.php';
include_once '../config/config.php';
$database = new classes\Database();
$account = new classes\Account;
try
{
	$newId = $account->addAccount($_POST['name'], $_POST['password'], $database);
}
catch (Exception $e)
{
	/* Something went wrong: echo the exception message and die */
	echo $e->getMessage();
	die();
}
echo 'The new account ID is ' . $newId;