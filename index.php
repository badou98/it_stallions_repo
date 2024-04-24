<?php 

session_start();

//https://536f-197-243-106-5.ngrok-free.app/it_stallions_repo/index.php

include_once 'Menu.php';

include_once 'conn.php';

error_reporting(0);
$sessionId = $_POST['sessionId'];
$phoneNumber = $_POST['phoneNumber'];
$serviceCode = $_POST['serviceCode'];
$text = $_POST['text'];

$select = $pdo->prepare("SELECT * FROM registration WHERE telephone=?");

$select->execute([$phoneNumber]);



if($select->rowCount()>0){
    $userData = $select->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user_id'] = $userData['user_id'];
    $isRegistered = true;
}

$menu = new Menu($text, $sessionId);

if ($text == "" && $isRegistered) {
    
    $menu->mainMenuRegistered();
} 

elseif ($text == "" && !$isRegistered) { 
   
    $menu->mainMenuUnregistered();
} 

elseif (!$isRegistered) {
    
    $textArray = explode("*", $text);
    switch ($textArray[0]) {
        case '1': 
            $menu->MenuRegistered($textArray); 
            break;
        default:
            echo "END Invalid Option, Retry";
    }
} else {
   
    $textArray = explode("*", $text);
    switch ($textArray[0]) {
        case '1': 
            $menu->menuDeposit($textArray);
            break;
        case '2': 
            $menu->menuCheckBalance($textArray); 
            break;
        case '3': 
            $menu->menuTransactionHistory($_SESSION['user_id']); 
            break;
        default:
            echo "END Invalid Choice\n";
    }
}
?>
