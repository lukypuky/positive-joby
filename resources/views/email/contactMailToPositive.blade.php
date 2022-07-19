<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <title>TEST MAIL</title>
</head>

<body>
    <h2>Email od používateľa:</h2>
    <p>Meno a priezvisko: {{ $mailData['nameSurname'] }}</p>
    <p>Telefón: {{ $mailData['phone'] }}</p>
    <p>Email: {{ $mailData['email'] }}</p>
    <p>Správa: {{ $mailData['message'] }}</p>

    @if (in_array('job', $mailData))
        <h2>Žiadosť na pracovnú pozíciu:</h2>
        <p>{{ $mailData['job']->position_name }}</p>
    @endif
</body>

</html>
