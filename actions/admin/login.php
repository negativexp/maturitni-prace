<?php
if(isset($_POST["username"]) && isset($_POST["password"])) {
    $db = Database::getInstance();
    $result = $db->select(DB_PREFIX."_users", ["*"],
        "BINARY username = ? AND password = ?", [$_POST["username"],hash("sha256", $_POST["password"])], true);
    if($result) {
        session_start();
        $_SESSION["admin"] = ["username" => "admin"];
        header("location: /admin");
    } else {
        header("location: /admin/login?error=false-creds");
    }
} else {
    header("location: /admin/login?error=missing-data");
}
exit();
