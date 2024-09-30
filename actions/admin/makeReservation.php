<?php
if(isset($_POST["date"]) && isset($_POST["timeStart"])
&& isset($_POST["timeEnd"]) && isset($_POST["track"])
&& isset($_POST["firstName"]) && isset($_POST["lastName"])
&& isset($_POST["email"])) {
    $date = $_POST["date"];
    $dateObj = new DateTime($date);
    $timeStart = $_POST["timeStart"];
    $timeEnd = $_POST["timeEnd"];
    $track = $_POST["track"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $time = date('Y-m-d H:i:s');

    $start = new DateTime($timeStart);
    $end = new DateTime($timeEnd);
    if ($end <= $start) {
        $end->modify('+1 day');
    }
    $interval = new DateInterval('PT30M'); //interval 30 minut
    $intervalCount = 0;
    while ($start < $end) {
        $start->add($interval);
        if ($start <= $end) {
            $intervalCount++;
        }
    }
    $pricePerHalfHour = 70;
    $totalPrice = $intervalCount * $pricePerHalfHour;

    $db  = Database::getInstance();
    $columns = ["datetime", "timeStart", "timeEnd", "track", "firstName", "lastName", "email", "price", "status", "created"];
    $values = [$date, $timeStart, $timeEnd, $track, $firstName, $lastName, $email, $totalPrice, "AKTIVNÍ", $time];
    $db->insert(DB_PREFIX."_reservations", $columns, $values);
    header("location: /admin/reservations");
}
exit();