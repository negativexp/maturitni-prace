<?php
$parsedURL = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
function active($url): string {
    global $parsedURL;
    if($url === $parsedURL) {
        return "active";
    }
    return "";
}
?>
<nav>
    <div class="logo">
        <h1>MS Web</h1>
    </div>
    <div class="links">
        <a class="button <?= $parsedURL === "/admin" ? "active" : ""?>" href="/admin"><img src="/resources/admin/imgs/dashboard.svg">Přehled</a>
        <a class="button " href="/admin/reservations"><img src="/resources/admin/imgs/file.svg">Rezervace</a>
    </div>
    <div class="profile">
        <a class="button" href="/admin/logout"><img src="/resources/admin/imgs/logout.svg">Odhlásit se</a>
    </div>
</nav>