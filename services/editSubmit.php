<?php
session_start();
require_once '../classes/autoload.php';
include_once '../config/config.php';
$database = new classes\Database();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
        $service = new classes\Service($_POST['name'], $_POST['price'], $_POST['description'], $_POST['id']);
        $service->updateServiceInDB($database);
        echo json_encode(['code'=>'200', 'location'=>'index.php']);
    } catch(\Exception $e) {
        echo json_encode(['code'=>'500', 'msg'=>$e->getMessage()]);
    }
}

