<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <title>TEST MAIL</title>
</head>

<body>
    <h2>Kontaktný formulár</h2>
    <p>Dobrý deň, <br>bla bla bla bla bla bla bla bla bla bla <br>bla bla bla bla</p><br>
    <h3>zadané dáta z formulára</h3>
    <p>Meno a priezvisko: {{ $mailData['nameSurname'] }}</p>
    <p>Telefón: {{ $mailData['phone'] }}</p>
    <p>Email: {{ $mailData['email'] }}</p>
    <p>Správa: {{ $mailData['message'] }}</p>
</body>

</html>
