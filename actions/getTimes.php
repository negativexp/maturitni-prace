<?php
if(isset($_POST["datetime"]) && isset($_POST["track"])) {
    $datetime_str = $_POST["datetime"];
    $datetime = DateTime::createFromFormat('Y-m-d', $datetime_str);
    $month = $datetime->format('m');
    $day = $datetime->format('d');
    $track = $_POST["track"];
    $db = Database::getInstance();
    $reservations = $db->select(DB_PREFIX."_reservations", ["timeStart", "timeEnd", "track"],
        "MONTH(datetime) = ? AND DAY(datetime) = ? AND track = ?", [$month, $day, $track]);
    $hours = [
        ["time" => "8:00", "free" => true],
        ["time" => "8:30", "free" => true],
        ["time" => "9:00", "free" => true],
        ["time" => "9:30", "free" => true],
        ["time" => "10:00", "free" => true],
        ["time" => "10:30", "free" => true],
        ["time" => "11:00", "free" => true],
        ["time" => "11:30", "free" => true],
        ["time" => "12:00", "free" => true],
        ["time" => "12:30", "free" => true],
        ["time" => "13:00", "free" => true],
        ["time" => "13:30", "free" => true],
        ["time" => "14:00", "free" => true],
        ["time" => "14:30", "free" => true],
        ["time" => "15:00", "free" => true],
        ["time" => "15:30", "free" => true],
        ["time" => "16:00", "free" => true],
        ["time" => "16:30", "free" => true],
        ["time" => "17:00", "free" => true],
        ["time" => "17:30", "free" => true],
        ["time" => "18:00", "free" => true],
        ["time" => "18:30", "free" => true],
        ["time" => "19:00", "free" => true],
    ];
    $timeStartSlots = $hours;
    $timeEndSlots = $hours;
    foreach($reservations as $reservation) {
        $startTimeStamp = strtotime($reservation["timeStart"]);
        $endTimeStamp = strtotime($reservation["timeEnd"]);
        foreach($hours as $hourKey => $details) {
            $hourTimeStamp = strtotime($details["time"]);
            if ($hourTimeStamp >= $startTimeStamp && $hourTimeStamp < $endTimeStamp) {
                $timeStartSlots[$hourKey]["free"] = false;
            }
            if ($hourTimeStamp > $startTimeStamp && $hourTimeStamp <= $endTimeStamp) {
                $timeEndSlots[$hourKey]["free"] = false;
            }
        }
    }
    $timeStartOptions = "";
    $timeEndOptions = "";
    foreach ($timeStartSlots as $hour) {
        if ($hour["time"] === "19:00") {
            $disabled = "disabled";
        } else {
            $disabled = $hour["free"] ? "" : "disabled";
        }
        $timeStartOptions .= "<option value='{$hour["time"]}' $disabled>{$hour["time"]}</option>";
    }
    foreach($timeEndSlots as $hour) {
        $disabled = $hour["free"] ? "" : "disabled";
        $timeEndOptions .= "<option value='{$hour["time"]}' $disabled>{$hour["time"]}</option>";
    }
    echo json_encode(["startOptions" => $timeStartOptions, "endOptions" => $timeEndOptions]);
}
exit();
