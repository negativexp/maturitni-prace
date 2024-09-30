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
            <a class="button" onclick="openForm('formPopupAddReservation')">Vytvořit rezervaci</a>
        </div>
    </header>
    <section>
        <table>
            <thead>
                <th>Datum Vytvoření</th>
                <th>Datum</th>
                <th>Čas</th>
                <th>Dráha</th>
                <th>Jméno</th>
                <th>Příjmení</th>
                <th>Email</th>
                <th>Celková cena</th>
                <th>Status</th>
                <th>Možnosti</th>
            </thead>
            <tbody>
            <?php
            $reservations = $db->select(DB_PREFIX."_reservations", ["*"], null, null);
            $year = date("Y");
            foreach ($reservations as $reservation) {
                $timestart = substr($reservation["timeStart"], 0, -3);
                $timeend = substr($reservation["timeEnd"], 0, -3);
                echo "<tr>";
                $created = $reservation["created"];
                $date = new DateTime($created);

                $datetime = (new DateTime($reservation["datetime"]))->format('d.m.Y');

                echo "<input type='hidden' value='{$reservation["id"]}'>";
                echo "<td>" . $date->format('d.m.Y H:i:s') . "</td>";
                echo "<td>{$datetime}</td>";
                echo "<td>{$timestart} - {$timeend}</td>";
                echo "<td>{$reservation["track"]}</td>";
                echo "<td>{$reservation["firstName"]}</td>";
                echo "<td>{$reservation["lastName"]}</td>";
                echo "<td>{$reservation["email"]}</td>";
                echo "<td>{$reservation["price"]},- Kč</td>";
                echo "<td>{$reservation["status"]}</td>";
                echo "<td class='options'><a class='button' onclick='openForm(\"formPopupEditReservation\"); formPopupEditReservation(this.parentNode.parentNode)'>Upravit</a><a class='button' onclick='showWarning(\"Vážně si přejete smazat rezervaci {$reservation['email']}?\", \"{$reservation['email']}\", \"/admin/reservations/delete\", { id: {$reservation['id']} })'>Smazat</a></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </section>

    <div class="form-popup" id="formPopupAddReservation" style="display:none;">
        <div class="wrapper">
            <h2>Přidat rezervaci</h2>
            <form method="post" action="/admin/reservations/add">
                <label>
                    <span>Datum</span>
                    <input type="date" name="date" required>
                </label>
                <label>
                    <span>Od</span>
                    <input type="time" name="timeStart" required>
                </label>
                <label>
                    <span>Do</span>
                    <input type="time" name="timeEnd" required>
                </label>
                <label>
                    <span>Dráha</span>
                    <input type="number" min="1" max="3" name="track" required>
                </label>
                <label>
                    <span>Jméno</span>
                    <input type="text" name="firstName" required>
                </label>
                <label>
                    <span>Příjmení</span>
                    <input type="text" name="lastName" required>
                </label>
                <input type="hidden" name="email" value="RUČNĚ ZADANÝ" required>
                <input type="hidden" name="status" value="RUČNĚ ZADANÝ" required>
                <div class="options">
                    <input type="submit" name="submit" class="button" value="Přidat" />
                    <a class="button" onclick="closeForm('formPopupAddReservation')">Zrušit</a>
                </div>
            </form>
        </div>
    </div>

    <div class="form-popup" id="formPopupEditReservation" style="display:none;">
        <div class="wrapper">
            <h2>Upravit route</h2>
            <form method="post" action="/admin/reservations/edit">
                <input id="formEditIdValue" type="hidden" name="id">
                <label>
                    <span>Datum</span>
                    <input type="date" name="date" required>
                </label>
                <label>
                    <span>Od</span>
                    <input type="time" name="timeStart" required>
                </label>
                <label>
                    <span>Do</span>
                    <input type="time" name="timeEnd" required>
                </label>
                <label>
                    <span>Dráha</span>
                    <input type="number" min="1" max="3" name="track" required>
                </label>
                <label>
                    <span>Jméno</span>
                    <input type="text" name="firstName" required>
                </label>
                <label>
                    <span>Příjmení</span>
                    <input type="text" name="lastName" required>
                </label>
                <input type="hidden" name="email" value="RUČNĚ ZADANÝ" required>
                <input type="hidden" name="status" value="RUČNĚ ZADANÝ" required>
                <div class="options">
                    <input type="submit" name="submit" class="button" value="Upravit" />
                    <a class="button" onclick="closeForm('formPopupEditReservation')">Zrušit</a>
                </div>
            </form>
        </div>
    </div>
</main>
<script>
    function formPopupEditReservation(row) {
        const cells = row.getElementsByTagName('td');
        const reservationDate = cells[1].innerText;
        const timeRange = cells[2].innerText.split(' - ');
        const track = cells[3].innerText;
        const firstName = cells[4].innerText;
        const lastName = cells[5].innerText;
        const email = cells[6].innerText;
        const status = cells[7].innerText;
        const [day, month, year] = reservationDate.split('.');
        const formattedDay = day.padStart(2, '0');
        const formattedMonth = month.padStart(2, '0');
        const formattedDate = `${year}-${formattedMonth}-${formattedDay}`;
        const form = document.getElementById('formPopupEditReservation');
        form.querySelector('input[name="date"]').value = formattedDate;
        form.querySelector('input[name="timeStart"]').value = timeRange[0];
        form.querySelector('input[name="timeEnd"]').value = timeRange[1];
        form.querySelector('input[name="track"]').value = track;
        form.querySelector('input[name="firstName"]').value = firstName;
        form.querySelector('input[name="lastName"]').value = lastName;
        form.querySelector('input[name="email"]').value = email;
        form.querySelector('input[name="status"]').value = status;
        form.querySelector('#formEditIdValue').value = row.querySelector("input").value;
    }
</script>
</body>
</html>