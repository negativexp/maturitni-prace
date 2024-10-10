<?php
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_POST["datetime"]) && isset($_POST["track"])
    && isset($_POST["timeStart"]) && isset($_POST["timeEnd"])
&& isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"])) {
    require_once(__DIR__ . '/../PHPMailer/PHPMailer.php');
    setlocale(LC_TIME, 'cs_CZ.UTF-8');
    date_default_timezone_set('Europe/Prague');
    $db = Database::getInstance();
    $datetime_str = $_POST["datetime"];
    $datetime = DateTime::createFromFormat('Y-m-d', $datetime_str);
    $track = $_POST["track"];
    $timeStart = $_POST["timeStart"];
    $timeEnd = $_POST["timeEnd"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $start = new DateTime($timeStart);
    $end = new DateTime($timeEnd);
    if ($end <= $start) {
        $end->modify('+1 day');
    }
    $interval = new DateInterval('PT30M'); //interval 30 minut
    $intervalCount = 0;
    while ($start < $end) {
        $start->add($interval);
        if ($start <= $end) {
            $intervalCount++;
        }
    }
    $pricePerHalfHour = 70;
    $totalPrice = $intervalCount * $pricePerHalfHour;

    $time = date('Y-m-d H:i:s');
    $columns = ["datetime", "timeStart", "timeEnd", "track", "firstName", "lastName", "email", "price", "status", "created"];
    $values = [$datetime->format("Y-m-d H:i:s"), $timeStart, $timeEnd, $track, $firstName, $lastName, $email, $totalPrice, "NEOVĚŘENO", $time];
    $db->insert(DB_PREFIX."_reservations", $columns, $values);
    $lastId = $db->getLastInsertedId();
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->Host       = "smtp.seznam.cz";
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = "ssl";
    $mail->Port       = 465;
    $mail->Username   = "strikemaster@email.cz";
    $mail->Password   = "sTRIKEmASTER321";
    $mail->setFrom($mail->Username);
    $mail->addAddress($email);
    $mail->isHTML(true);                       // Set email format to HTML
    $mail->Subject = 'StrikeMaster - prosím potvrďte rezervaci!';
    $year = date("Y");
    $monthName = $datetime->format("m");
    $day = $datetime->format("d");
$html = "
        <header style='padding: 100px 25px; position: relative; background-color: #f3f8ff; display: flex; justify-content: center;'>
        <h1 style='color:black ; z-index: 1; text-transform: uppercase;'>Strike Master</h1>
    </header>
    <main style='background-color: #1d78fa;'>
        <section>
            <div class='w100' style='display: flex; flex-flow: column; align-items: flex-start; gap: 20px; padding: 50px 25px;'>
                <h2>Potvrzení Rezervace</h2>
                <p>Děkujeme za vaši rezervaci v StrikeMaster! Velice si vážíme, že jste si pro svou událost vybrali právě naše bowlingové centrum. Věříme, že si užijete nezapomenutelný čas plný soutěžení, skvělého jídla a zábavy. Pokud máte nějaký obavy, neváhejte nás kontaktovat. Těšíme se na vaši návštěvu! <span style='color: red;'>Pro potrvzení rezervace, prosím klikněte</span></p>
                <a class='button' href='https://pixee.cz/aktivovat-rezervaci?id={$lastId}' style='border-radius: 7px; background: #aa7ab9; transition: background .2s ease; padding: 14px 28px; text-decoration: none; color: white;'>Zde</a>
            </div>
        </section>
        <section>
            <div class='w100' style='display: flex; flex-flow: column; align-items: flex-start; gap: 20px; padding: 50px 25px;'>
                <h2>Detaily Rezervace</h2>
                <p><strong>Datum:</strong> {$day}. {$monthName}. {$year}</p>
                <p><strong>Čas:</strong> {$timeStart} - {$timeEnd}</p>
                <p><strong>Jméno:</strong> {$firstName}</p>
                <p><strong>Příjmení:</strong> {$lastName}</p>
                <p><strong>Dráha:</strong> {$track}</p>
                <p><strong>Celková cena:</strong> {$totalPrice},- CZK</p>
            </div>
        </section>
    </main>
    <footer style='text-align: center; position: relative; padding: 100px 0;'>
        <p style='color: black'>Strike Master &copy; 2024, Matyáš Schuller</p>
    </footer>
    ";
    $mail->Body = $html;
    try{
        $mail->send();
    }catch(Exception $e){
        header("location: /?chyba-zasilani");
        exit();
    }
    header("location: /?dekujeme");
}
exit();
