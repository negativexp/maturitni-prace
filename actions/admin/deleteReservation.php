<?php
if(isset($_POST["id"])) {
    $id = $_POST["id"];
    $db = Database::getInstance();
    $db->delete(DB_PREFIX."_reservations", "id = ?", [$id]);
    header("location: /admin/reservations");
}
exit();