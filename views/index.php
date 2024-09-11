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
        <h2>Vytvořte si u Nás rezervaci!</h2>
        <div class="reservation">
            <div class="arrow">

            </div>
            <div class="content">
                <form>
                    <div class="personal">
                        <label>Vaše jméno<input name="firstName" type="text"></label>
                        <label>Vaše příjmení<input name="lastName" type="text"></label>
                        <label>E-mail<input name="email" type="email"></label>
                    </div>
                    <div class="time">
                        <label>Datum<input id="date" name="date" type="date"></label>
                        <label>Čas<input id="time" name="time" type="time"></label>
                    </div>
                    <div class="captcha">
                        ...
                    </div>
                    <div class="track">
                        <label>Dráha 1<input name="time" type="radio"></label>
                        <label>Dráha 2<input name="time" type="radio"></label>
                        <label>Dráha 3<input name="time" type="radio"></label>
                    </div>
                </form>
            </div>
            <div class="arrow">

            </div>
        </div>
    </section>
</main>
<script>
    const now = new Date()
    const year = now.getFullYear()
    const month = String(now.getMonth() + 1).padStart(2, '0')
    const day = String(now.getDate()).padStart(2, '0')
    const hours = String(now.getHours()).padStart(2, '0')
    const minutes = String(now.getMinutes()).padStart(2, '0')
    const formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`
    document.getElementById('time').min = formattedDateTime
</script>
</body>
</html>