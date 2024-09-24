<?php
$db = Database::getInstance();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/resources/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>StrikeMaster</title>
</head>
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
                <img src="/resources/logo.png" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
                <img src="/resources/logo.png" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
                <img src="/resources/logo.png" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
                <img src="/resources/logo.png" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
                <img src="/resources/logo.png" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
                <img src="/resources/logo.png" alt="Fotky Galerie StrikeMaster" title="Fotky Galerie StrikeMaster">
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
            <p><span class="bold">Sobota</span>: 16:00 - 1:00</p>
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
                            <form method="post" action="/make-reservation">
                                <input type="hidden" name="day" id="dayInput">
                                <input type="hidden" name="month" id="monthInput">
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
                                        <label>
                                            <span>Dráha 4</span>
                                            <input type="radio" value="4" name="track" onchange="Reservation.getTimeSlots(event)" required>
                                        </label>
                                    </div>
                                    <label class="hidden">
                                        <span>Od <span class="warning">*</span></span>
                                        <select id="timeStart" name="timeStart" onclick="Reservation.updateTimeEndSlots(event)" required>
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
                                        <p><span class="bold">Cena</span>: <span id="finalCost">...</span></p>
                                    </label>
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
                            <p>Zabrané místa / Volné místa</p>
                        </div>
                        <div class="w33 red">
                            <p>Středa/Neděle ZAVŘENO nebo PLNO</p>
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
        formData: new FormData(),
        month: document.getElementById("month"),
        monthLeft: document.getElementById("monthLeft"),
        monthRight: document.getElementById("monthRight"),
        daysContainer: document.getElementById("daysContainer"),
        timeStartSelect: document.getElementById("timeStart"),
        timeEndSelect: document.getElementById("timeEnd"),
        dayInput: document.getElementById("dayInput"),
        monthInput: document.getElementById("monthInput"),
        timeEndOptions: null,
        currentDate: new Date(),
        init() {
            this.updateMonth()
            this.generateDays()
        },
        updateMonth() {
            this.month.innerText = this.currentDate.toLocaleString('cs-CZ', { month: 'long', year: 'numeric' })
            this.formData.append("month", this.currentDate.getMonth() + 1)
        },
        nextMonth() {
            this.currentDate.setMonth(this.currentDate.getMonth() + 1)
            this.updateMonth()
            this.generateDays()
            this.monthRight.classList.toggle("hidden")
            this.monthLeft.classList.toggle("hidden")
        },
        previousMonth() {
            this.currentDate.setMonth(this.currentDate.getMonth() - 1)
            this.updateMonth()
            this.generateDays()
            this.monthLeft.classList.toggle("hidden")
            this.monthRight.classList.toggle("hidden")
        },
        generateDays() {
            const month = this.currentDate.getMonth() + 1;
            this.monthInput.value = month
            const year = this.currentDate.getFullYear();
            this.daysContainer.innerHTML = '';
            const numberOfDays = new Date(year, month, 0).getDate();
            for (let i = 1; i <= numberOfDays; i++) {
                const weekday = new Date(year, month - 1, i).getDay();
                const dayNamesCzech = [
                    'Neděle',
                    'Pondělí',
                    'Úterý',
                    'Středa',
                    'Čtvrtek',
                    'Pátek',
                    'Sobota'
                ];

                const dayElement = document.createElement('div');

                <?php
                $reservations = $db->select("dpp_reservations", ["month", "day"], null, null);
                $reservationDays = [];
                foreach ($reservations as $reservation) {
                    $reservationDays[] = [
                        'month' => $reservation['month'],
                        'day' => $reservation['day']
                    ];
                }
                ?>
                const reservedDays = <?php echo json_encode($reservationDays); ?>;
                const isReserved = reservedDays.some(reservation =>
                    reservation.month === month && reservation.day === i
                );
                if (weekday === 3 || weekday === 0) {
                    dayElement.className = 'red';
                } else if (isReserved) {
                    dayElement.className = 'yellow';
                    dayElement.onclick = () => this.dayClick(i);
                } else {
                    dayElement.className = 'green';
                    dayElement.innerText = `${i}: Volné`;
                    dayElement.onclick = () => this.dayClick(i);
                }
                dayElement.innerText = dayNamesCzech[weekday] + ` (${i}.${month})`;
                this.daysContainer.appendChild(dayElement);
            }
        },
        dayClick(number) {
            this.formData.append("day", number)
            this.dayInput.value = number
            console.log(number)
            document.querySelector(".reservationForm .page:nth-of-type(1)").classList.toggle("hide")
            document.querySelector(".reservationForm .page:nth-of-type(2)").classList.toggle("hide")
        },
        updateTimeEndSlots() {
            const options = document.querySelectorAll("#timeStart option:not(:disabled)")
            if(options.length === 0) {
                const y = document.querySelector(".reservationForm .page:nth-of-type(2) .column > label:nth-of-type(2)")
                y.classList.add("hidden")
                return false
            }
            if (this.timeEndOptions === null) {
                this.timeEndOptions = Array.from(this.timeStartSelect.options)
            }

            let temp = this.timeEndOptions.map((option, index) => {
                return {
                    text: option.innerText,
                    value: option.value.split(" ")[0],
                    disabled: option.disabled,
                    index: index
                }
            })

            this.timeEndSelect.innerHTML = ""
            const startTime = this.timeStartSelect.value.split(" ")[0]
            const startIndex = temp.findIndex(option => option.value === startTime)
            for (let i = startIndex+1; i < startIndex+11; i++) {
                const option = document.createElement("option")
                if (temp[i].disabled) {
                    temp[i].disabled = false
                    option.value = temp[i].value
                    option.innerText = temp[i].text
                    this.timeEndSelect.appendChild(option)
                    break
                }
                option.innerText = temp[i].text
                option.value = temp[i].value
                option.disabled = temp[i].disabled
                this.timeEndSelect.appendChild(option)
            }
            const y = document.querySelector(".reservationForm .page:nth-of-type(2) .column > label:nth-of-type(2)")
            y.classList.remove("hidden")
            this.updateCost()
        },
        updateCost() {
            const costPerHalfHour = 70
            var finalCost = 0
            const startTime = this.timeStartSelect.value
            const endTime = this.timeEndSelect.value

            const startIndex = this.timeEndOptions.findIndex(option => option.value === startTime)
            for (let i = startIndex+1; i < startIndex+11; i++) {
                if (this.timeEndOptions[i].value === endTime) {
                    console.log("break")
                    finalCost += 70
                    break
                } else {
                    console.log("rmdko")
                    finalCost += 70
                }
            }
            document.getElementById("finalCost").innerText = finalCost+",- CZK"
            console.log(startTime, endTime)
        },
        getTimeSlots(event) {

            let xhr = new XMLHttpRequest();
            let url = '/get-times';
            xhr.open("POST", url, true);
            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const json = JSON.parse(xhr.response)
                    this.timeStartSelect.innerHTML = json.startOptions
                    this.timeEndOptions = Array.from(this.timeStartSelect.options)
                }
            };
            this.formData.append("track", event.target.value)
            xhr.send(this.formData);

            const x = document.querySelector(".reservationForm .page:nth-of-type(2) .column > label:nth-of-type(1)")
            x.classList.remove("hidden")
            this.updateTimeEndSlots()
        },
        Back() {
            document.querySelector(".reservationForm .page:nth-of-type(1)").classList.toggle("hide")
            document.querySelector(".reservationForm .page:nth-of-type(2)").classList.toggle("hide")
            this.restartOptions()
        },
        restartOptions() {
            document.querySelectorAll(".reservationForm .page:nth-of-type(2) .column input[type='radio']").forEach(radio => radio.checked = false)
            document.querySelector(".reservationForm .page:nth-of-type(2) .column > label:nth-of-type(1)").classList.add("hidden")
            document.querySelector(".reservationForm .page:nth-of-type(2) .column > label:nth-of-type(2)").classList.add("hidden")
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        Reservation.init()
    })

</script>
</body>
</html>