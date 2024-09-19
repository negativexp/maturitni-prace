<?php
if($_POST["day"] && $_POST["month"]) {
    $db = Database::getInstance();
    $month = $_POST["month"];
    $day = $_POST["day"];
    $times = $db->select("dpp_reservations", ["timeStart", "timeEnd"], "month = ? AND day = ?", [$month, $day]);
    $year = date('Y');
    $dayofweek = date('w', strtotime("{$year}-{$month}-{$day}"));
    if($dayofweek == 6) {
        $hours = [
            ["time" => "16:00", "free" => true],
            ["time" => "16:30", "free" => true],
            ["time" => "17:00", "free" => true],
            ["time" => "17:30", "free" => true],
            ["time" => "18:00", "free" => true],
            ["time" => "18:30", "free" => true],
            ["time" => "19:00", "free" => true],
            ["time" => "19:30", "free" => true],
            ["time" => "20:00", "free" => true],
            ["time" => "20:30", "free" => true],
            ["time" => "21:00", "free" => true],
            ["time" => "21:30", "free" => true],
            ["time" => "22:00", "free" => true],
            ["time" => "22:30", "free" => true],
            ["time" => "23:00", "free" => true],
            ["time" => "23:30", "free" => true],
            ["time" => "00:00", "free" => true],
            ["time" => "00:30", "free" => true],
            ["time" => "01:00", "free" => true],
        ];
    } else {
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
    }
    $timeStartSlots = $hours;
    $timeEndSlots = $hours;

    foreach($times as $time) {
        $timeStart = $time["timeStart"];
        $timeEnd = $time["timeEnd"];
        $startTimeStamp = strtotime($timeStart);
        $endTimeStamp = strtotime($timeEnd);

        foreach($hours as $hourKey => $details) {
            $hourTimeStamp = strtotime($details["time"]);
            //pokud čas je mezi začátkem a koncem rezervace označ zabrané
            if ($hourTimeStamp >= $startTimeStamp && $hourTimeStamp < $endTimeStamp) {
                $timeStartSlots[$hourKey]["free"] = false;
            }
            //pokud čas je vyšší než začátek rezervace a menší než konec rezervace, označ zabrané pro timeEndSlots
            if ($hourTimeStamp > $startTimeStamp && $hourTimeStamp < $endTimeStamp) {
                $timeEndSlots[$hourKey]["free"] = false;
            }
            //pokud čas se rovná konec rezervace, oznac zabrane pro timeEndSlot
            //a pro timeStartSlot volné
            if ($hourTimeStamp == $endTimeStamp) {
                $timeStartSlots[$hourKey]["free"] = true;
                $timeEndSlots[$hourKey]["free"] = false;
            }
            //pokud čas se rovná začátek rezervace, označ volné pro timeEndSlot
            // If the time slot matches the exact start time, it should remain free in timeEndSlots
            if ($hourTimeStamp == $startTimeStamp) {
                $timeEndSlots[$hourKey]["free"] = true;
            }
        }
    }
    $json = [
        'message' => 'ok',
        'timeStartSlots' => $timeStartSlots,
        'timeEndSlots' => $timeEndSlots,
        'test' => $times
    ];
    echo json_encode($json);
}
exit();