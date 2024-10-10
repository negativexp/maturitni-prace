<?php
if (isset($_POST['id'], $_POST['date'], $_POST['timeStart'], $_POST['timeEnd'], $_POST['track'], $_POST['firstName'], $_POST['lastName'], $_POST['email'])) {
    $db = Database::getInstance();
    $id = $_POST['id'];
    $date = $_POST['date'];
    $timeStart = $_POST['timeStart'];
    $timeEnd = $_POST['timeEnd'];
    $track = $_POST['track'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $existingReservation = $db->select(DB_PREFIX."_reservations", ["status"], "id = ?", [$id]);
    if ($existingReservation) {
        $originalStatus = $existingReservation[0]['status'];
    }
    $dateParts = explode('-', $date);
    $month = $dateParts[1];
    $day = $dateParts[2];
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
    $time = date('Y-m-d H:i:s');
    $columns = ["datetime", "timeStart", "timeEnd", "track", "firstName", "lastName", "email", "price", "status"];
    $values = [$date, $timeStart, $timeEnd, $track, $firstName, $lastName, $email, $totalPrice, $originalStatus];
    $condition = "id = ?";
    $params = [$id];
    $db->update(DB_PREFIX."_reservations", $columns, $values, $condition, $params);
    header("Location: /admin/reservations");
}
exit();