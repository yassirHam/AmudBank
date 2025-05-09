<!DOCTYPE html>
<html>
<head>
    <title>Vérification Email - AmudBank</title>
</head>
<body>
    <h1>Bonjour {{ $name }} {{$prenom}}</h1>
    <p>Merci de vous être inscrit sur <strong>AmudBank</strong>.</p>
    <h3>Voici votre code de vérification :</h3>
    <h1>{{ $code }}</h1>
    <p>Ce code est valable pendant 5 minutes.</p>
    <p>Si vous n’avez pas créé ce compte, ignorez cet e-mail.</p>
</body>
</html>
