<?php 

//https://f6cf-197-157-186-192.ngrok-free.app/ussd/index.php

include_once 'Menu.php';

$sessionId = $_POST['sessionId'];
$phoneNumber = $_POST['phoneNumber'];
$serviceCode = $_POST['serviceCode']; // Corrected assignment

$text = $_POST['text'];

$isRegistered = true;

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
            $menu->menuSendmoney($textArray); // Corrected method name
            break;
        case '2': // Corrected string comparison
            $menu->menuWithdrawMoney($textArray); // Corrected method name
            break;
        case '3': // Corrected string comparison
            $menu->menuCheckBalance($textArray); // Corrected method name
            break;
        default:
            echo "END Invalid Choice\n";
    }
}
?>
