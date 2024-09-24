<?php
if(isset($_GET['id'])) {
    $db = Database::getInstance();
    $id = $_GET['id'];
    $db->update(DB_PREFIX."_reservations", ["status"], ["AKTIVNÍ"], "id = ?", [$id]);
    header("location: /?potvrzeno");
}
exit();