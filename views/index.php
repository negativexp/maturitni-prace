<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/resources/style.css">
    <title>StrikeMaster</title>
</head>
<body>
<header>
    <div class="wrapper">
        logo
        <nav>
            <a>Rezervace</a>
            <a>Kontakt</a>
            <a>Admin</a>
        </nav>
    </div>
</header>
<main>
    <section>
        <div class="w50">
            <h1>Strike Master</h1>
            <p>Vítejte v našem moderním bowlingovém centru, které nabízí víc než jen hru. Spojte radost ze hry s vynikajícím jídlem a pitím v naší stylové restauraci. Ať už hledáte místo pro rodinný výlet, večer s přáteli nebo firemní akci, StrikeMaster je ideální destinací. Přijďte si užít atmosféru plnou soutěžení, smíchu a skvělých zážitků!</p>
        </div>
        <div class="w50">
            <img src="/resources/kuzelky.png">
        </div>
    </section>
    <section>
        <div class="w100">
            <h2>Vytvořte si u Nás rezervaci!</h2>
            <div class="reservation">
                <div class="arrow" onclick="previousSlide()">
                    <img src="/resources/arrowleft.svg">
                </div>
                <form>
                    <div class="personal w100">
                        <h3>Personální informace</h3>
                        <label><span>Vaše jméno</span><input name="firstName" type="text"></label>
                        <label><span>Vaše příjmení</span><input name="lastName" type="text"></label>
                        <label><span>E-mail</span><input name="email" type="email"></label>
                    </div>
                    <div class="time w100 hide">
                        <h3>Čas</h3>
                        <label><span>Datum</span><input id="date" name="date" type="date"></label>
                        <label><span>Od</span><input id="time" name="timeFrom" type="time"></label>
                        <label><span>Do</span><input id="time" name="timeTo" type="time"></label>
                        <div class="info">
                            <p class="warning">V tenhle moment není ani jedna dráha volná, nejpozději od 99:99</p>
                        </div>
                    </div>
                    <div class="track w100 hide">
                        <h3>Dráhy</h3>
                        <div class="tracks">
                            <label><span>Dráha 1</span><input name="time" type="radio"><img src="/resources/bowling.webp"></label>
                            <label><span>Dráha 2</span><input name="time" type="radio"><img src="/resources/bowling.webp"></label>
                            <label><span>Dráha 3</span><input name="time" type="radio"><img src="/resources/bowling.webp"></label>
                        </div>
                    </div>
                    <div class="captcha w100 hide">
                        ...
                    </div>
                </form>
                <div class="arrow" onclick="nextSlide()">
                    <img src="/resources/arrowright.svg">
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    reservaitionForm = document.querySelector(".reservation form")
    personalDiv = document.querySelector(".reservation .personal")
    timeDiv = document.querySelector(".reservation .time")
    trackDiv = document.querySelector(".reservation .track")
    captchaDiv = document.querySelector(".reservation .captcha")
    const reservationDivs = [personalDiv, timeDiv, trackDiv, captchaDiv]

    var currentContent = 0

    function nextSlide() {
        if(currentContent < 3) {
            currentContent++
            displaySlide()
        }
    }
    function previousSlide() {
        if(currentContent > 0) {
            currentContent--
            displaySlide()
        }
    }
    function displaySlide() {
        console.log(currentContent)
        reservationDivs.forEach((div, _count) => {
            if(currentContent === _count) {
                div.classList.remove("hide")
            } else div.classList.add("hide")
        })
    }
</script>
</body>
</html>