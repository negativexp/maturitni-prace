<?php
$db = Database::getInstance();
?>
<!doctype html>
<html lang="en">
<?php include_once("components/head.php"); ?>
<body class="hp">
<main>
    <?php include_once("components/header.php"); ?>
    <?php
    if(isset($_GET["dekujeme"])) {
        echo "<div class='notification'>
                <h3>Děkujeme za rezervaci!</h3>
                <p class='warning'>Rezervace bude platná až po potvrzení emailem z důvodu spamu. Do 10 minut rezervace bude smazána a nebude plaťit!</p>
                <p>Prosíme, zkontrolujte svůj email (včetně složky spam) pro potvrzovací zprávu.</p>
                </div>";
    }
    if(isset($_GET["potvrzeno"])) {
        echo "<div class='notification'>
                <h3>Děkujeme za rezervaci!</h3>
                <p>Vaše rezervace je platná a budem očekávat váš příchod, Děkujeme!</p>
                </div>";
    }
    if(isset($_GET["rezervace-neexistuje"])) {
        echo "<div class='notification'>
                <h3>Váš čas na potvrzení vypršel!</h3>
                <p>Pokud máte problém s vytváření rezervace, zkuste se obraťit na nás telefonicky!</p>
                </div>";
    }
    ?>
    <section>
        <div class="w50">
            <h1>Strike Master</h1>
            <p>Vítejte v našem moderním bowlingovém centru, které nabízí víc než jen hru. Spojte radost ze hry s vynikajícím jídlem a pitím v naší stylové restauraci. Ať už hledáte místo pro rodinný výlet, večer s přáteli nebo firemní akci, StrikeMaster je ideální destinací. Přijďte si užít atmosféru plnou soutěžení, smíchu a skvělých zážitků!</p>
            <nav>
                <a class="button" href="/#rezervace" title="Rezervace">Rezervace</a>
                <a class="button" href="/kontakt" title="Kontakt">Kontakt</a>
            </nav>
        </div>
        <div class="w50">
            <img alt="Strike Master" title="Logo" src="/resources/logo.png">
        </div>
    </section>
    <section>
        <div class="w60">
            <div class="gallery">
                <img src="/resources/galerie1.jpg" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
                <img src="/resources/galerie2.jpg" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
                <img src="/resources/galerie4.jpg" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
                <img src="/resources/galerie4.jpg" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
                <img src="/resources/galerie1.jpg" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
                <img src="/resources/galerie2.jpg" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
                <img src="/resources/galerie2.jpg" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
                <img src="/resources/galerie4.jpg" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
                <img src="/resources/galerie1.jpg" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
            </div>
        </div>
        <div class="w40">
            <h2>Otevírací doba</h2>
            <hr>
            <p><span class="bold">Pondělí</span>: 8:00 - 19:00</p>
            <hr>
            <p><span class="bold">Úterý</span>: 8:00 - 19:00</p>
            <hr>
            <p><span class="bold">Středa</span>: ZAVŘENO</p>
            <hr>
            <p><span class="bold">Čtvrtek</span>: 8:00 - 19:00</p>
            <hr>
            <p><span class="bold">Pátek</span>: 8:00 - 19:00</p>
            <hr>
            <p><span class="bold">Sobota</span>: 8:00 - 19:00</p>
            <hr>
            <p><span class="bold">Neděle</span>: ZAVŘENO</p>
        </div>
    </section>
    <section>
        <div class="w100">
            <hr>
        </div>
    </section>
    <section id="rezervace">
        <div class="reservationForm w100">
            <h2>Rezervujte si místo u nás!</h2>
            <div class="wrapper">
                <div class="pages">
                    <div class="page">
                        <div class="header">
                            <?php
                            $formatter = new IntlDateFormatter('cs_CZ', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                            $formatter->setPattern('MMMM YYYY');
                            echo "<h3 id='month'>{$formatter->format(new DateTime())}</h3>";
                            ?>
                            <div class="options">
                                <a id="monthLeft" class="button hidden" onclick="Reservation.previousMonth()"><img src="/resources/arrowleft.svg" title="Šipka doleva StrikeMaster" alt="Šipka doleva StrikeMaster"></a>
                                <a id="monthRight" class="button" onclick="Reservation.nextMonth()"><img src="/resources/arrowright.svg" title="Šipka doprava StrikeMaster" alt="Šipka doprava StrikeMaster"></a>
                            </div>
                        </div>
                        <div class="days" id="daysContainer">
                        </div>
                    </div>
                    <div class="page hide">
                        <div class="header">
                            <h3>Údaje & Čas</h3>
                            <div class="options">
                                <a id="back" class="button" onclick="Reservation.Back()">Zpátky</a>
                            </div>
                        </div>
                        <div class="times">
                            <form method="post" action="/make-reservation" id="finalForm">
                                <input type="hidden" name="datetime" id="datetimeInput">
                                <div class="column">
                                    <div class="radios" style="display: flex">
                                        <label>
                                            <span>Dráha 1</span>
                                            <input type="radio" value="1" name="track" onchange="Reservation.getTimeSlots(event)" required>
                                        </label>
                                        <label>
                                            <span>Dráha 2</span>
                                            <input type="radio" value="2" name="track" onchange="Reservation.getTimeSlots(event)" required>
                                        </label>
                                        <label>
                                            <span>Dráha 3</span>
                                            <input type="radio" value="3" name="track" onchange="Reservation.getTimeSlots(event)" required>
                                        </label>
                                    </div>
                                    <label class="hidden">
                                        <span>Od <span class="warning">*</span></span>
                                        <select id="timeStart" name="timeStart" onchange="Reservation.updateTimeEndSlots(event)" required>
                                        </select>
                                    </label>
                                    <label class="hidden">
                                        <span>Do <span class="warning">*</span></span>
                                        <select id="timeEnd" name="timeEnd" required onclick="Reservation.updateCost()">
                                        </select>
                                    </label>
                                </div>
                                <div class="column">
                                    <label>
                                        <span>Jméno <span class="warning">*</span></span>
                                        <input type="text" name="firstName" required/>
                                    </label>
                                    <label>
                                        <span>Příjmení <span class="warning">*</span></span>
                                        <input type="text" name="lastName" required/>
                                    </label>
                                    <label>
                                        <span>E-mail <span class="warning">*</span></span>
                                        <input type="email" name="email" required/>
                                    </label>
                                    <label>
                                        <p><span class="bold">Cena</span>: <span id="finalCost"></span></p>
                                    </label>
                                    <div class="g-recaptcha" data-sitekey="6LdPkVAqAAAAAOh4eDokLVMsD0meC_XCeYOYIGY-"></div>
                                    <label>
                                        <input class="button" type="submit">
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="w100 legends">
                    <h3>Legenda</h3>
                    <div class="wrapper">
                        <div class="w33 green">
                            <p>Volné místa</p>
                        </div>
                        <div class="w33 yellow">
                            <p>Menší kapacita volných míst</p>
                        </div>
                        <div class="w33 red">
                            <p>ZAVŘENO</p>
                        </div>
                    </div>
                    <p><span class="bold">Každá hodina</span>: 140,- Kč</p>
                    <p><span class="bold">Každá půl hodina</span>: 70,- Kč</p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="w100">
            <hr>
        </div>
    </section>
    <section>
        <div class="w50">
            <h2>Jídelní lístek</h2>
            <h3>Předkrmy</h3>
            <ul>
                <li>Česnekové topinky s rajčatovou salsou – 89 Kč</li>
                <li>Křupavé kuřecí křidélka s BBQ omáčkou – 129 Kč</li>
            </ul>
            <hr>
            <h3>Hlavní jídla</h3>
            <ul>
                <li>Domácí burger Strike Master s hranolky – 199 Kč</li>
                <li>Pikantní kuřecí křídla s dipem – 149 Kč</li>
                <li>Pizza Margherita s čerstvými rajčaty a bazalkou – 169 Kč</li>
            </ul>
            <hr>
            <h3>Dezerty</h3>
            <ul>
                <li>Domácí cheesecake s ovocnou omáčkou – 89 Kč</li>
                <li>Čokoládový fondant s vanilkovou zmrzlinou – 99 Kč</li>
            </ul>
            <hr>
            <h3>Nápoje</h3>
            <ul>
                <li>Točené pivo – 45 Kč</li>
                <li>Domácí limonáda – 39 Kč</li>
                <li>Káva espresso – 35 Kč</li>
            </ul>
        </div>
        <div class="w50">
            <h2>Proč Strike Master?</h2>
            <ul>
                <li>
                    <h3>Zábava pro všechny generace</h3>
                    <p>Strike Master je místo, kde se skvěle baví jak děti, tak dospělí. Naše moderní bowlingové dráhy jsou ideální pro rodinné výlety, oslavy narozenin nebo jen tak na večer s přáteli. Ať už jste začátečník nebo zkušený hráč, u nás si užijete hru na maximum.</p>
                </li>
                <li>
                    <h3>Stylové prostředí</h3>
                    <p>Naše centrum vás okouzlí svým moderním a útulným designem. Po hře si můžete odpočinout v pohodlném prostředí naší restaurace nebo baru, kde si vychutnáte výborné jídlo a nápoje.</p>
                </li>
                <li>
                    <h3>Vynikající kuchyně</h3>
                    <p>Kromě skvělé hry nabízíme i lahodné občerstvení. V naší restauraci najdete vše od drobných předkrmů po výtečné hlavní chody a domácí dezerty. Nezáleží na tom, jestli máte chuť na burger, salát nebo něco sladkého – u nás si vybere každý.</p>
                </li>
                <li>
                    <h3>Perfektní místo pro oslavy a akce</h3>
                    <p>Hledáte místo pro narozeninovou oslavu, firemní večírek nebo přátelský turnaj? Strike Master je ideálním místem pro jakoukoliv společenskou událost. Rádi vám připravíme speciální balíčky, které zahrnují hru, občerstvení i zábavu na míru.</p>
                </li>
                <li>
                    <h3>Dlouhé hodiny zábavy</h3>
                    <p>U nás se nudit nebudete! Pokud plánujete strávit na bowlingové dráze více než 5 hodin, je třeba se předem domluvit s majitelem, aby bylo zajištěno, že vám nic nebrání v tom užít si celou dobu plnou zábavy a soutěžení.</p>
                </li>
            </ul>
        </div>
    </section>
    <section>
        <div class="w100">
            <hr>
        </div>
    </section>
    <section>
        <div class="w100">
            <h2>Zábava pro každého</h2>
            <p>Strike Master je víc než jen obyčejné bowlingové centrum – je to místo, kde se každý stává šampionem a kde každá návštěva znamená nové zážitky. Ať už přicházíte s rodinou, přáteli nebo kolegy z práce, u nás si užijete skvělý čas plný smíchu a soutěžení. Naše moderní bowlingové dráhy zaručují skvělou hru pro hráče všech úrovní, zatímco naše restaurace nabízí delikátní pokrmy, které vás potěší po každém vítězném hodu.</p>
            <p>&nbsp;</p>
            <p>Nezapomeňte, pokud máte v plánu strávit na bowlingové dráze <span class="bold">více než 5 hodin</span>, je nutné se předem <span class="bold">domluvit</span> s <span class="bold">majitelem</span>. Chceme, aby každý host měl možnost si svůj čas u nás maximálně užít!</p>
            <p>&nbsp;</p>
            <p>Strike Master je také skvělým místem pro pořádání narozeninových oslav, firemních akcí nebo přátelských turnajů. Máme pro vás připravené speciální balíčky, které kombinují hru, občerstvení a mnoho zábavy v jednom.</p>
        </div>
    </section>
</main>
<?php include_once("components/footer.php"); ?>

<script>
    const Reservation = {
        month: document.getElementById("month"),
        monthLeft: document.getElementById("monthLeft"),
        monthRight: document.getElementById("monthRight"),
        daysContainer: document.getElementById("daysContainer"),
        timeStartSelect: document.getElementById("timeStart"),
        timeEndSelect: document.getElementById("timeEnd"),
        datetime: document.getElementById("datetimeInput"),
        timeEndOptions: null,
        currentDate: new Date(),

        init() {
            this.updateMonth();
            this.generateDays();
        },

        updateMonth() {
            this.month.innerText = this.currentDate.toLocaleString('cs-CZ', { month: 'long', year: 'numeric' });
        },

        nextMonth() {
            this.currentDate.setMonth(this.currentDate.getMonth() + 1);
            this.updateMonth();
            this.generateDays();
            this.toggleArrows();
        },

        previousMonth() {
            this.currentDate.setMonth(this.currentDate.getMonth() - 1);
            this.updateMonth();
            this.generateDays();
            this.toggleArrows();
        },

        toggleArrows() {
            const today = new Date();
            if(this.currentDate.getMonth() > today.getMonth()) {
                this.monthRight.classList.add("hidden");
                this.monthLeft.classList.remove("hidden");
            }
            if(this.currentDate.getMonth() === today.getMonth()) {
                this.monthRight.classList.remove("hidden");
                this.monthLeft.classList.add("hidden");
            }
        },

        generateDays() {
            const month = this.currentDate.getMonth();
            const year = this.currentDate.getFullYear();
            this.daysContainer.innerHTML = '';
            const numberOfDays = new Date(year, month + 1, 0).getDate(); // Last day of the month
            const startDay = this.currentDate.getMonth() === (new Date).getMonth() ? (new Date).getDate() : 1;

            <?php
            $db = Database::getInstance();
            $reservations = $db->select(DB_PREFIX . "_reservations", ["timeStart", "timeEnd", "track", "datetime"], "MONTH(datetime) = ?", [date('m')]);

            $reservationDays = [];
            foreach ($reservations as $reservation) {
                $dateTime = new DateTime($reservation['datetime']);
                $dateKey = $dateTime->format('Y-m-d');
                if (!isset($reservationDays[$dateKey])) {
                    $reservationDays[$dateKey] = [];
                }
                $reservationDays[$dateKey][] = $reservation;
            }
            ?>
            const reservations = <?php echo json_encode($reservationDays); ?>; // Pass reservation data from PHP
            console.log(reservations);

            for (let i = startDay; i <= numberOfDays; i++) {
                const dateKey = `${year}-${(month + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;
                const dailyReservations = reservations[dateKey] || [];
                console.log(`Daily Reservations for ${dateKey}:`, dailyReservations); // Log daily reservations

                const weekday = new Date(year, month, i).getDay();
                const dayNamesCzech = ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'];
                const dayElement = document.createElement('div');

                // Initialize an array to hold the number of free slots for each track
                const freeSlotsByTrack = [0, 0, 0]; // [track1, track2, track3]

                const hours = weekday === 6 ? // Determine available hours based on the day
                    [
                        "18:00", "18:30", "19:00", "19:30", "20:00", "20:30", "21:00", "21:30",
                        "22:00", "22:30", "23:00", "23:30", "00:00", "00:30", "01:00"
                    ] :
                    [
                        "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30",
                        "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30",
                        "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00"
                    ];

                // Check each track and each hour slot for reservations
                hours.forEach(hour => {
                    [1, 2, 3].forEach(track => {
                        const isReserved = dailyReservations.some(reservation => {
                            const startTime = reservation['timeStart'];
                            const endTime = reservation['timeEnd'];
                            const reservedTrack = reservation['track'];

                            // Check if the hour is reserved for the current track
                            return reservedTrack == track && hour >= startTime && hour < endTime;
                        });

                        // If the time slot is not reserved, increment the count for the current track
                        if (!isReserved) {
                            freeSlotsByTrack[track - 1]++; // track-1 to map to array index
                        }
                    });
                });

                // Calculate total available slots across all tracks
                const totalFreeSlots = freeSlotsByTrack.reduce((sum, slots) => sum + slots, 0);
                console.log(`Free slots count for ${dateKey} (Track 1: ${freeSlotsByTrack[0]}, Track 2: ${freeSlotsByTrack[1]}, Track 3: ${freeSlotsByTrack[2]}): ${totalFreeSlots}`);

                // Determine the class based on total free slots count
                if (totalFreeSlots < 10 || weekday === 0 || weekday === 3) {
                    dayElement.className = 'red'; // No free slots or less than 10 free slots
                } else if (totalFreeSlots <= 22) {
                    dayElement.className = 'yellow'; // Less than or equal to 10 free slots
                    dayElement.onclick = () => this.dayClick(i);
                } else {
                    dayElement.className = 'green'; // More than 10 free slots
                    dayElement.onclick = () => this.dayClick(i);
                }

                dayElement.innerText += `${dayNamesCzech[weekday]} - ${i}.${month + 1}`;
                this.daysContainer.appendChild(dayElement);
            }
        },

        dayClick(dayNumber) {
            this.currentDate.setDate(dayNumber)

            // Set ISO date format
            this.datetime.value = this.currentDate.toISOString().split("T")[0];

            document.querySelector(".reservationForm .page:nth-of-type(1)").classList.add("hide");
            document.querySelector(".reservationForm .page:nth-of-type(2)").classList.remove("hide");
        },

        getTimeSlots(event) {
            const xhr = new XMLHttpRequest();
            const url = '/get-times';
            xhr.open("POST", url, true);
            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const json = JSON.parse(xhr.response);
                    this.timeStartSelect.innerHTML = json.startOptions;

                    const defOption = document.createElement("option");
                    defOption.innerText = "--- VYBERTE ČAS ---";
                    defOption.defaultSelected = true;
                    defOption.disabled = true;
                    this.timeStartSelect.appendChild(defOption);

                    this.timeEndOptions = Array.from(this.timeStartSelect.options);
                    this.timeStartSelect.parentElement.classList.remove("hidden");
                    this.timeEndSelect.parentElement.classList.add("hidden");
                    document.getElementById("finalCost").innerText = "";
                }
            };
            const formData = new FormData()
            formData.append("track", event.target.value)
            formData.append("datetime", this.currentDate.toISOString().split("T")[0])
            xhr.send(formData);
        },
        updateTimeEndSlots() {
            this.timeEndSelect.parentElement.classList.remove("hidden");

            const options = document.querySelectorAll("#timeStart option:not(:disabled)");
            if (this.timeEndOptions === null) {
                this.timeEndOptions = Array.from(this.timeStartSelect.options);
            }

            const startTime = this.timeStartSelect.value.split(" ")[0];
            const temp = this.timeEndOptions.map(option => ({
                text: option.innerText,
                value: option.value.split(" ")[0],
                disabled: option.disabled
            }));

            this.timeEndSelect.innerHTML = "";
            const startIndex = temp.findIndex(option => option.value === startTime);
            for (let i = startIndex + 1; i < startIndex + 11 && i < temp.length; i++) {
                const option = document.createElement("option");
                option.innerText = temp[i].text;
                option.value = temp[i].value;
                option.disabled = temp[i].disabled;
                this.timeEndSelect.appendChild(option);
            }

            this.updateCost();
        },
        updateCost() {
            const costPerHalfHour = 70;
            let finalCost = 0;
            const startTime = this.timeStartSelect.value;
            const endTime = this.timeEndSelect.value;

            const startIndex = this.timeEndOptions.findIndex(option => option.value === startTime);
            for (let i = startIndex + 1; i < this.timeEndOptions.length; i++) {
                if (this.timeEndOptions[i].value === endTime) {
                    finalCost += costPerHalfHour;
                    break;
                } else {
                    finalCost += costPerHalfHour;
                }
            }
            document.getElementById("finalCost").innerText = `${finalCost},- CZK`;
        },
        restartOptions() {
            document.querySelectorAll(".reservationForm .page:nth-of-type(2) .column input[type='radio']").forEach(radio => radio.checked = false);
            document.querySelector(".reservationForm .page:nth-of-type(2) .column > label:nth-of-type(1)").classList.add("hidden");
            document.querySelector(".reservationForm .page:nth-of-type(2) .column > label:nth-of-type(2)").classList.add("hidden");
        },
        Back() {
            document.querySelector(".reservationForm .page:nth-of-type(1)").classList.toggle("hide");
            document.querySelector(".reservationForm .page:nth-of-type(2)").classList.toggle("hide");
            this.restartOptions();
        },
    };

    // Initialize on page load
    document.addEventListener("DOMContentLoaded", () => {
        Reservation.init();
    });
</script>

</body>
</html>
