<?php
$message = "...";
if(isset($_POST["date"]) && isset($_POST["timeStart"]) && isset($_POST["timeEnd"])) {
    $date = $_POST["date"];
    $timeStart = $_POST["timeStart"];
    $timeEnd = (int)$_POST["timeEnd"];
    if($timeEnd === 1) {
        $message = "není volno";
    } else {
        $message = "ok";
    }
} else {
    $message = "Prosím doplňte všechny údaje!";
}
header('Content-Type: application/json');
echo json_encode(["message" => $message]);
exit();
