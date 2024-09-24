<?php
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_POST["month"]) && isset($_POST["day"]) && isset($_POST["track"])
    && isset($_POST["timeStart"]) && isset($_POST["timeEnd"])
&& isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"])) {
    require_once(__DIR__ . '/../PHPMailer/PHPMailer.php');

    $month = $_POST["month"];

    $day = $_POST["day"];
    $track = $_POST["track"];
    $timeStart = $_POST["timeStart"];
    $timeEnd = $_POST["timeEnd"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];

    //znovu zkontroluj jak v getTimes.php pro lepší bezpečnost

    $db = Database::getInstance();
    $columns = ["month", "day", "timeStart", "timeEnd", "track", "firstName", "lastName", "email", "status"];
    $values = [$month, $day, $timeStart, $timeEnd, $track, $firstName, $lastName, $email, "NEOVĚŘENO"];
    $db->insert(DB_PREFIX."_reservations", $columns, $values);
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->Host       = "smtp.seznam.cz";    // SMTP server example
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "ssl";
    $mail->Port       = 465;                    // set the SMTP port for the GMAIL server
    $mail->Username   = "strikemaster@email.cz";            // SMTP account username example
    $mail->Password   = "sTRIKEmASTER321";            // SMTP account password example
    $mail->setFrom($mail->Username);
    $mail->addAddress('mattas7@seznam.cz');
    $mail->isHTML(true);                       // Set email format to HTML
    $mail->Subject = 'StrikeMaster - prosím potvrďte rezervaci!';

    setlocale(LC_TIME, 'cs_CZ.UTF-8');
    $year = date("Y");
    $dateObj = DateTime::createFromFormat('!m', $month);
    $monthName = strftime('%B', $dateObj->getTimestamp());
$html = "
        <header style='padding: 100px 25px; position: relative; background-color: #f3f8ff; display: flex; justify-content: center;'>
        <h1 style='z-index: 1; text-transform: uppercase;'>Strike Master</h1>
    </header>
    <main style='background-color: #1d78fa;'>
        <section>
            <div class='w100' style='display: flex; flex-flow: column; align-items: flex-start; gap: 20px; padding: 50px 25px;'>
                <h2>Potvrzení Rezervace</h2>
                <p>Děkujeme za vaši rezervaci v StrikeMaster! Velice si vážíme, že jste si pro svou událost vybrali právě naše bowlingové centrum. Věříme, že si užijete nezapomenutelný čas plný soutěžení, skvělého jídla a zábavy. Pokud máte nějaký obavy, neváhejte nás kontaktovat. Těšíme se na vaši návštěvu! <span style='color: red;'>Pro potrvzení rezervace, prosím klikněte</span></p>
                <a class='button' style='border-radius: 7px; background: #aa7ab9; transition: background .2s ease; padding: 14px 28px; text-decoration: none; color: white;'>Zde</a>
            </div>
        </section>
        <section>
            <div class='w100' style='display: flex; flex-flow: column; align-items: flex-start; gap: 20px; padding: 50px 25px;'>
                <h2>Detaily Rezervace</h2>
                <p><strong>Datum:</strong> {$day}. {$monthName} {$year}</p>
                <p><strong>Čas:</strong> {$timeStart} - {$timeEnd}</p>
                <p><strong>Jméno:</strong> {$firstName}</p>
                <p><strong>Příjmení:</strong> {$lastName}</p>
                <p><strong>Celková cena:</strong>...</p>
            </div>
        </section>
    </main>
    <footer style='text-align: center; position: relative; padding: 100px 0;'>
        <p>Strike Master &copy; 2024, Matyáš Schuller</p>
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