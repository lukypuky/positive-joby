<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <title>TEST MAIL</title>
</head>

<body>
    <h1>Kontaktný formulár</h1>
    <p>Meno a priezvisko: {{ $mailData['nameSurname'] }}</p><br>
    <p>Meno a priezvisko: {{ $mailData['phone'] }}</p><br>
    <p>Meno a priezvisko: {{ $mailData['email'] }}</p><br>
    <p>Meno a priezvisko: {{ $mailData['message'] }}</p>
</body>

</html>
