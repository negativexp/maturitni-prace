<!DOCTYPE html>
<html lang="en">
<?php include_once("components/head.php"); ?>
<body>
<?php include_once("components/sidepanel.php"); ?>
<?php
$db = Database::getInstance();
?>
<main>
    <header>
        <h1>Rezervace</h1>
        <div class="options">
            <a class="button">Vytvořit rezervaci</a>
        </div>
    </header>
    <section>
        <table>
            <thead>
                <th>id</th>
                <th>Datum</th>
                <th>Čas</th>
                <th>Dráha</th>
                <th>Jméno</th>
                <th>Příjmení</th>
                <th>Email</th>
                <th>Status</th>
            </thead>
            <tbody>
            <?php
            $reservations = $db->select(DB_PREFIX."_reservations", ["*"], null, null);
            foreach ($reservations as $reservation) {
                echo "<tr>";
                echo "<td>{$reservation["id"]}</td>";
                echo "<td>{$reservation["day"]}.{$reservation["month"]}</td>";
                echo "<td>{$reservation["timeStart"]} - {$reservation["timeEnd"]}</td>";
                echo "<td>{$reservation["track"]}</td>";
                echo "<td>{$reservation["firstName"]}</td>";
                echo "<td>{$reservation["lastName"]}</td>";
                echo "<td>{$reservation["email"]}</td>";
                echo "<td>...</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </section>
</main>
</body>
</html>