<?php
if($_POST["day"] && $_POST["month"]) {
    $db = Database::getInstance();
    $month = $_POST["month"];
    $day = $_POST["day"];
    $times = $db->select("dpp_reservations", ["timeStart", "timeEnd", "track"], "month = ? AND day = ?", [$month, $day]);
    $year = date('Y');
    $dayofweek = date('w', strtotime("{$year}-{$month}-{$day}"));
    if($dayofweek == 6) {
        $hours = [
            ["time" => "16:00", "free" => true, "tracks" => []],
            ["time" => "16:30", "free" => true, "tracks" => []],
            ["time" => "17:00", "free" => true, "tracks" => []],
            ["time" => "17:30", "free" => true, "tracks" => []],
            ["time" => "18:00", "free" => true, "tracks" => []],
            ["time" => "18:30", "free" => true, "tracks" => []],
            ["time" => "19:00", "free" => true, "tracks" => []],
            ["time" => "19:30", "free" => true, "tracks" => []],
            ["time" => "20:00", "free" => true, "tracks" => []],
            ["time" => "20:30", "free" => true, "tracks" => []],
            ["time" => "21:00", "free" => true, "tracks" => []],
            ["time" => "21:30", "free" => true, "tracks" => []],
            ["time" => "22:00", "free" => true, "tracks" => []],
            ["time" => "22:30", "free" => true, "tracks" => []],
            ["time" => "23:00", "free" => true, "tracks" => []],
            ["time" => "23:30", "free" => true, "tracks" => []],
            ["time" => "00:00", "free" => true, "tracks" => []],
            ["time" => "00:30", "free" => true, "tracks" => []],
            ["time" => "01:00", "free" => true, "tracks" => []],
        ];
    } else {
        $hours = [
            ["time" => "8:00", "free" => true, "tracks" => []],
            ["time" => "8:30", "free" => true, "tracks" => []],
            ["time" => "9:00", "free" => true, "tracks" => []],
            ["time" => "9:30", "free" => true, "tracks" => []],
            ["time" => "10:00", "free" => true, "tracks" => []],
            ["time" => "10:30", "free" => true, "tracks" => []],
            ["time" => "11:00", "free" => true, "tracks" => []],
            ["time" => "11:30", "free" => true, "tracks" => []],
            ["time" => "12:00", "free" => true, "tracks" => []],
            ["time" => "12:30", "free" => true, "tracks" => []],
            ["time" => "13:00", "free" => true, "tracks" => []],
            ["time" => "13:30", "free" => true, "tracks" => []],
            ["time" => "14:00", "free" => true, "tracks" => []],
            ["time" => "14:30", "free" => true, "tracks" => []],
            ["time" => "15:00", "free" => true, "tracks" => []],
            ["time" => "15:30", "free" => true, "tracks" => []],
            ["time" => "16:00", "free" => true, "tracks" => []],
            ["time" => "16:30", "free" => true, "tracks" => []],
            ["time" => "17:00", "free" => true, "tracks" => []],
            ["time" => "17:30", "free" => true, "tracks" => []],
            ["time" => "18:00", "free" => true, "tracks" => []],
            ["time" => "18:30", "free" => true, "tracks" => []],
            ["time" => "19:00", "free" => true, "tracks" => []],
        ];
    }
    $timeStartSlots = $hours;
    $timeEndSlots = $hours;
    $timeEndSlots[0]["free"] = false;
    $timeEndSlots[count($timeEndSlots) - 1]["free"] = false;

    //ke kazde rezervaci ten den, zadej drahy
    foreach($times as $time) {
        $timeStart = $time["timeStart"];
        $timeEnd = $time["timeEnd"];
        $startTimeStamp = strtotime($timeStart);
        $endTimeStamp = strtotime($timeEnd);
        $track = $time["track"];
        foreach($hours as $hourKey => $details) {
            $hourTimeStamp = strtotime($details["time"]);
            //pokud čas je mezi začátkem a koncem rezervace označ zabrané
            if ($hourTimeStamp >= $startTimeStamp && $hourTimeStamp < $endTimeStamp) {
                $timeStartSlots[$hourKey]["tracks"][] = $track;
            }
            //pokud čas je vyšší než začátek rezervace a menší než konec rezervace, označ zabrané pro timeEndSlots
            if ($hourTimeStamp > $startTimeStamp && $hourTimeStamp < $endTimeStamp) {
                $timeEndSlots[$hourKey]["tracks"][] = $track;
            }
        }
    }

    foreach($times as $time) {
        $timeStart = $time["timeStart"];
        $timeEnd = $time["timeEnd"];
        $startTimeStamp = strtotime($timeStart);
        $endTimeStamp = strtotime($timeEnd);

        foreach($hours as $hourKey => $details) {
            if(count($timeStartSlots[$hourKey]["tracks"]) > 3) {
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
                if ($hourTimeStamp == $startTimeStamp) {
                    $timeEndSlots[$hourKey]["free"] = true;
                }
                if($details["time"] === end($timeEndSlots)["time"]) {
                    $timeStartSlots[$hourKey]["free"] = false;
                }
            }
        }
    }
    $test = end($timeStartSlots);
    $json = [
        'message' => 'ok',
        'timeStartSlots' => $timeStartSlots,
        'timeEndSlots' => $timeEndSlots,
        'test' => $times
    ];
    echo json_encode($json);
}
exit();