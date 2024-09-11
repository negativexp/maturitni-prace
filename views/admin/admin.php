<!DOCTYPE html>
<html lang="en">
<?php include_once("components/head.php"); ?>
<body>
<?php include_once("components/sidepanel.php"); ?>
<?php
$db = Database::getInstance();
$logsCount = $db->select(DB_PREFIX."_logs", ["COUNT(*)"], null,null,true)["COUNT(*)"];
$pagesCount = $db->select(DB_PREFIX."_pagination", ["COUNT(*)"], null,null,true)["COUNT(*)"];
?>



<main>
    <header>
        <h1>Přehled</h1>
        <div class="options">
            <a class="button" onclick="window.location.href = '/'">Zobrazit web</a>
        </div>
    </header>
    <section>
        <article>
            <div class="section-header">
                <img height="40px" src="../../resources/admin/imgs/dashboard.svg">
                <h2>Návštěvnost</h2>
            </div>
            <h3 style="text-align: center">...</h3>
        </article>
        <article>
            <div class="section-header">
                <img height="40px" src="../../resources/admin/imgs/logs.svg">
                <h2>Operace</h2>
            </div>
            <h3 style="text-align: center"><?= $logsCount ?></h3>
        </article>
        <article>
            <div class="section-header">
                <img height="40px" src="../../resources/admin/imgs/file.svg">
                <h2>Stránky</h2>
            </div>
            <h3 style="text-align: center"><?= $pagesCount ?></h3>
        </article>
    </section>
</main>
</body>
</html>