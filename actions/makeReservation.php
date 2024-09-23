<?php
if(isset($_POST["month"]) && isset($_POST["day"]) && isset($_POST["track"])
    && isset($_POST["timeStart"]) && isset($_POST["timeEnd"])
&& isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"])) {

    //znovu zkontroluj jak v getTimes.php pro lepší bezpečnost

    $month = $_POST["month"];
    $day = $_POST["day"];
    $track = $_POST["track"];
    $timeStart = $_POST["timeStart"];
    $timeEnd = $_POST["timeEnd"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];

    $db = Database::getInstance();
    $columns = ["month", "day", "timeStart", "timeEnd", "track", "firstName", "lastName", "email", "status"];
    $values = [$month, $day, $timeStart, $timeEnd, $track, $firstName, $lastName, $email, "NEOVĚŘENO"];
    $db->insert(DB_PREFIX."_reservations", $columns, $values);

    //zašli email


    header("location: /?dekujeme");
}
exit();