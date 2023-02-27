<?php
require '../classes/autoload.php';
require '../config/config.php';
$database = new classes\Database();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    try {
        $booking = new classes\Booking($_POST['date'], $_POST['time'], $_POST['service_id'], $_POST['user_id']);
        echo json_encode(['code'=>'200']);
    } catch (Exception $ex) {
        echo json_encode(['code'=>'500', 'msg'=>$ex->getMessage()]);
    }
}



