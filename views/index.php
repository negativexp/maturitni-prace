<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StrikeMaster</title>
</head>
<body>
<h1>StrikeMaster</h1>
<h2>Formulář pro rezervaci drahy</h2>
<form>
    <label>Vaše jméno<input name="firstName" type="text"></label>
    <label>Vaše příjmení<input name="lastName" type="text"></label>
    <label>E-mail (pro ověření)<input name="email" type="email"></label>
    <label>čas<input id="time" name="time" type="datetime-local"></label>
    <label>Dráha 1<input name="time" type="radio"></label>
    <label>Dráha 2<input name="time" type="radio"></label>
    <label>Dráha 3<input name="time" type="radio"></label>
    <input type="submit">
</form>

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