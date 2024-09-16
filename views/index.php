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
<?php include_once("components/header.php"); ?>
<main>
    <section>
        <div class="w50">
            <h1>Strike Master</h1>
            <p>Vítejte v našem moderním bowlingovém centru, které nabízí víc než jen hru. Spojte radost ze hry s vynikajícím jídlem a pitím v naší stylové restauraci. Ať už hledáte místo pro rodinný výlet, večer s přáteli nebo firemní akci, StrikeMaster je ideální destinací. Přijďte si užít atmosféru plnou soutěžení, smíchu a skvělých zážitků!</p>
        </div>
        <div class="w50">
            <img alt="Strike Master" title="Logo" src="/resources/logo.png">
        </div>
    </section>
    <section>
        <div class="w60">
            <div class="gallery">
                <img src="/resources/logo.png">
                <img src="/resources/logo.png">
                <img src="/resources/logo.png">
                <img src="/resources/logo.png">
                <img src="/resources/logo.png">
                <img src="/resources/logo.png">
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
        <div class="w100 tacen">
            <h2>Vytvořte si rezervaci</h2>
            <form>
                <div class="page" id="time">
                    <div class="input">
                        <label for="date">Vyberte datum:</label>
                        <input type="date" id="date" name="date" required>
                    </div>

                    <div class="input">
                        <label for="time">Vyberte čas od:</label>
                        <input id="timeStart" type="time" name="timeStart">
                    </div>

                    <div class="input">
                        <label for="time">Vyberte čas do:</label>
                        <select id="timeEnd" name="timeEnd" required>
                        </select>
                    </div>

                    <div class="info">
                        <p class="warning">V tenhle den a čas nejsou dostupné volné dráhy, nejpozději od xx:xx</p>
                        <p class="warning">V tenhle den a čas nejsou dostupné volné dráhy, nejpozději od xx:xx do yy:yy.</p>
                        <p class="warning">V tenhle den nejsou volné žádné dráhy, zkuste si vybrat jinej den.</p>
                    </div>
                </div>

                <div class="page hide" id="tracks">
                    <div class="tracks">
                        <div class="input">
                            <input type="radio" id="lane1" name="lane" value="1" />
                            <label for="lane1">Dráha 1<img src="/resources/bowling.webp"></label>
                        </div>
                        <div class="input">
                            <input type="radio" id="lane2" name="lane" value="2" />
                            <label for="lane2">Dráha 2<img src="/resources/bowling.webp"></label>
                        </div>
                        <div class="input">
                            <input type="radio" id="lane3" name="lane" value="3" />
                            <label for="lane3">Dráha 3<img src="/resources/bowling.webp"></label>
                        </div>
                        <div class="input">
                            <input type="radio" id="lane4" name="lane" value="4" />
                            <label for="lane4">Dráha 4<img src="/resources/bowling.webp"></label>
                        </div>
                    </div>
                </div>

                <div class="page hide" id="personal">
                    <div class="input">
                        <label for="name">Jméno:</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="input">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="input">
                        <label for="phone">Telefon:</label>
                        <input type="tel" id="phone" name="phone">
                    </div>

                    <div class="input">
                        <label for="people">Počet osob:</label>
                        <input type="number" id="people" name="people" min="1" max="10" required>
                    </div>
                </div>

                <div class="page hide" id="check">
                    <div class="input">
                        <label>
                            <input type="checkbox" name="terms" required>
                            Souhlasím s podmínkami rezervace.
                        </label>
                    </div>
                    <p>tohle stoji 70 czk</p>
                    <div id="calculation">
                        <p id="price">Cena: 120 Kč</p>
                    </div>
                    <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY"></div>
                    <button type="submit">Odeslat rezervaci</button>
                </div>
                <div class="arrows">
                    <div class="arrow" onclick="Slider.previous()">
                        <img src="/resources/arrowleft.svg">
                    </div>
                    <div class="arrow" onclick="Slider.next()">
                        <img src="/resources/arrowright.svg">
                    </div>
                </div>
            </form>
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
    const Slider = {
        position: 0,
        pages: [document.getElementById("time"),document.getElementById("tracks"),document.getElementById("personal"),document.getElementById("check")],
        next() {
            if(this.position < 3) {
                this.position++
                this.displaySlide()
            }
        },
        previous() {
            if(this.position > 0) {
                this.position--
                this.displaySlide()
            }
        },
        displaySlide() {
            this.pages.forEach((page, count) => {
                if(count === this.position) {
                    page.classList.remove("hide")
                } else {
                    page.classList.add("hide")
                }
            })
        }
    }

    document.getElementById('timeStart').addEventListener('change', function() {
        let timeStart = document.getElementById('timeStart').value
        let timeEndSelect = document.getElementById('timeEnd')
        timeEndSelect.innerHTML = ''

        if (timeStart) {
            let startTime = new Date(`1970-01-01T${timeStart}:00`)

            for (let i = 1; i <= 5; i++) {
                let newTime = new Date(startTime.getTime() + i * 60 * 60 * 1000)
                let hours = newTime.getHours().toString().padStart(2, '0')
                let minutes = newTime.getMinutes().toString().padStart(2, '0')
                let option = document.createElement('option')
                let price = 250 * i
                option.value = i
                if(i === 1) {
                    option.textContent = `${hours}:${minutes} - ${i} Hodina (${price},- Kč)`
                } else {
                    option.textContent = `${hours}:${minutes} - ${i} Hodiny (${price},- Kč)`
                }
                timeEndSelect.appendChild(option)
            }
        }
    })
</script>
</body>
</html>