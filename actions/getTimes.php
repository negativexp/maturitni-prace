<?php
if(isset($_POST["month"]) && isset($_POST["day"]) && isset($_POST["track"])) {
    $month = $_POST["month"];
    $day = $_POST["day"];
    $track = $_POST["track"];
    $db = Database::getInstance();
    $reservations = $db->select(DB_PREFIX."_reservations", ["timeStart", "timeEnd", "track"], "month = ? AND day = ? AND track = ?", [$month, $day, $track]);
    $dayofweek = date('w', strtotime(date('Y')."-{$month}-{$day}"));
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
    foreach($reservations as $reservation) {
        $startTimeStamp = strtotime($reservation["timeStart"]);
        $endTimeStamp = strtotime($reservation["timeEnd"]);
        foreach($hours as $hourKey => $details) {
            $hourTimeStamp = strtotime($details["time"]);
            if($hourTimeStamp >= $startTimeStamp && $hourTimeStamp < $endTimeStamp) {
                $timeStartSlots[$hourKey]["free"] = false;
            }
            if($hourTimeStamp >= $startTimeStamp && $hourTimeStamp < $endTimeStamp) {
                $timeEndSlots[$hourKey]["free"] = false;
            }

        }
    }

    $timeStartOptions = "";
    $timeEndOptions = "";
    foreach($timeStartSlots as $hour) {
        $disbaled = $hour["free"] ? "" : "disabled";
        $timeStartOptions .= "<option value='{$hour["time"]}' $disbaled>{$hour["time"]}</option>";
    }
    foreach($timeEndSlots as $hour) {
        $disbaled = $hour["free"] ? "" : "disabled";
        $timeEndOptions .= "<option value='{$hour["time"]}' $disbaled>{$hour["time"]}</option>";
    }
    echo json_encode(["startOptions" => $timeStartOptions, "res" => $reservations]);

}
die();

if(isset($_POST["day"]) && isset($_POST["month"]) && isset($_POST["bruh"])) {
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