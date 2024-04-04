<?php 

session_start();

//https://1ce0-197-243-106-207.ngrok-free.app/ussd_demo/it_stallions_repo/index.php

include_once 'Menu.php';

include_once 'conn.php';

error_reporting(0);
$sessionId = $_POST['sessionId'];
$phoneNumber = $_POST['phoneNumber'];
$serviceCode = $_POST['serviceCode']; // Corrected assignment
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
    // Do something
    $menu->mainMenuRegistered();
} elseif ($text == "" && !$isRegistered) { // Adjusted condition
    // Do something
    $menu->mainMenuUnregistered();
} elseif (!$isRegistered) {
    // Do something
    $textArray = explode("*", $text);
    switch ($textArray[0]) {
        case '1': // Corrected string comparison
            $menu->MenuRegistered($textArray); // Corrected method name
            break;
        default:
            echo "END Invalid Option, Retry";
    }
} else {
    // Do something
    $textArray = explode("*", $text);
    switch ($textArray[0]) {
        case '1': // Corrected string comparison
            $menu->menuDeposit($textArray); // Corrected method name
            break;
        case '2': // Corrected string comparison
            $menu->menuCheckBalance($textArray); // Corrected method name
            break;
        case '3': // Corrected string comparison
            $menu->menuTransactionHistory($_SESSION['user_id']); // Corrected method name
            break;
        default:
            echo "END Invalid Choice\n";
    }
}
?>
