<?php
        $to      = 'owner@salon.com';
        $subject = 'Message from site visitor';
        $message = trim(htmlspecialchars($_POST['description']));
        $sender = trim(htmlspecialchars($_POST['name']));
        if (empty($message)){
            $error_description = "Please enter message.";
        }
        
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $error_description = "Please enter valid email.";
        }
        
        if (empty($sender)){
            $error_description = "Please enter your name.";
        }
        
        if (empty($error_description)){
            $headers = "From: " . $_POST['email'];
            $message .= "\n\n Sender's name: $sender";
            if (mail($to, $subject, $message, $headers)){
                echo json_encode(['code'=>'200']);
            } else {
                echo json_encode(['code'=>'500', 'msg'=>"Something went wrong. We couldn\'t send your your message"]);
            }
        } else {
            echo json_encode(['code'=>'500', 'msg'=>$error_description]);
        }

