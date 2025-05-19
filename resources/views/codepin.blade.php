<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Code PIN</title>
</head>
<body>
    <p>Bonjour {{ $user->name }},</p>

    <p>La pin de votre carte {{ substr($carte, -4) }} est :</p>

    <h2 style="color: #2d3748;"> {{ $code }}</h2>

    <p>Pour meilleure assurnace de Confidentialité veuillez supprimer ce message.</p>

    <p>Cordialement,<br>Banque XYZ</p>
</body>
</html>
