<?php
echo json_encode($_POST);
die();
exit();
if(isset($_POST["day"]) && isset($_POST["month"]) && isset($_POST["bruh"])) {
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
    $timeEndSlots = [];
    $timeEndSlots[0]["free"] = false;
    $timeStartSlots[count($timeEndSlots) - 1]["free"] = false;

    //zajisiti casy od
    foreach($times as $time) {
        $timeStart = $time["timeStart"];
        $timeEnd = $time["timeEnd"];
        $startTimeStamp = strtotime($timeStart);
        $endTimeStamp = strtotime($timeEnd);
    }

    foreach($times as $time) {
        $timeStart = $time["timeStart"];
        $timeEnd = $time["timeEnd"];
        $startTimeStamp = strtotime($timeStart);
        $endTimeStamp = strtotime($timeEnd);

        foreach($hours as $hourKey => $details) {
            if(count($timeStartSlots[$hourKey]["tracks"]) > 3) {
                break;
            } else {
                $hourTimeStamp = strtotime($details["time"]);
                if($startTimeStamp > $hourTimeStamp) {
                    $timeEndSlots[] = $hours[$hourKey];
                }
            }
        }
    }
    $test = end($timeStartSlots);
    $json = [
        'message' => 'ok',
        'timeStartSlots' => $timeStartSlots,
        'timeEndSlots' => $timeEndSlots,
        'test' => $track,
        'track' => $track
    ];
    echo json_encode($json);
}
exit();