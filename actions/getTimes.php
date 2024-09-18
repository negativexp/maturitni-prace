<?php
if($_POST["day"] && $_POST["month"]) {
    $db = Database::getInstance();
    $day = $_POST["day"];
    $month = $_POST["month"];
    $times = $db->select("dpp_reservations", ["timeStart", "timeEnd"], "month = ? AND day = ?", [$month, $day]);
    $json = [
        'message' => 'ok',
        'data' => $times
    ];
    echo json_encode($json);
}
exit();