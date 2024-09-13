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
<body class="hp">
<header>
    <div class="wrapper">
        <div class="logo">
            <img alt="Bowlingové kuželky" title="Bowlingové kuželky" src="/resources/kuzelky.png">
        </div>
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
            <form>
                <div class="page" id="track">
                    <div class="input">
                        <label for="lane">Vyberte dráhu:</label>
                        <select id="lane" name="lane" required>
                            <option value="lane1">Dráha 1</option>
                            <option value="lane2">Dráha 2</option>
                            <option value="lane3">Dráha 3</option>
                            <option value="lane4">Dráha 4</option>
                        </select>
                    </div>

                    <div class="input">
                        <label for="date">Vyberte datum:</label>
                        <input type="date" id="date" name="date" required>
                    </div>

                    <div class="input">
                        <label for="time">Vyberte čas od:</label>
                        <select id="time" name="timeFrom" required>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                        </select>
                    </div>

                    <div class="input">
                        <label for="time">Vyberte čas do:</label>
                        <select id="time" name="timeTo" required>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                        </select>
                    </div>
                </div>

                <div class="page" id="personal">
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

                <div class="page">
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
                    <button type="submit">Odeslat rezervaci</button>
                </div>
                <div class="arrows">
                    <div class="arrow">
                        doleva
                    </div>
                    <div class="arrow">
                        doprava
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
<footer>
    mrdko
</footer>
</body>
</html>