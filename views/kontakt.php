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
<body>
<?php include_once("components/header.php"); ?>
<main>
    <section>
        <div class="w100">
            <h1>Kontakt</h1>
    </section>
    <section>
        <div class="w50 tacen">
            <img width="300px" alt="Strike Master" title="Logo" src="/resources/logo.png">
        </div>
        <div class="w50">
            <h2>Matyáš Schuller</h2>
            <p><span class="bold">E-mail</span>: mattas7 seznam.cz</p>
            <p><span class="bold">Telefon</span>: +420 123 654 789</p>
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