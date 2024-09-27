<?php
if(isset($_GET['id'])) {
    $db = Database::getInstance();
    $id = $_GET['id'];
    $exists = $db->select(DB_PREFIX."_reservations", ["id"], null, null, true)['id'];
    if(isset($exists)) {
        $db->update(DB_PREFIX."_reservations", ["status"], ["AKTIVNÍ"], "id = ?", [$id]);
        header("location: /?potvrzeno");
    } else {
        header("location: /?rezervace-neexistuje");
    }
    exit();
}
exit();