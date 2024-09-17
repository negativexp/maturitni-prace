<?php
if($_POST["day"] && $_POST["month"]) {
    $day = $_POST["day"];
    $month = $_POST["month"];
    $message = json_encode(["message" => "ok"]);
    echo $message;
}
exit();