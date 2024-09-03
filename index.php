<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculateur de Monnaie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="button"]:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Calculateur de Monnaie</h1>
    <label for="montantTotal">Montant donné :</label>
    <input type="number" id="montantTotal" step="0.01" required>

    <label for="montantDu">Montant dû :</label>
    <input type="number" id="montantDu" step="0.01" required>

    <input type="button" value="Calculer" onclick="calculerMonnaie()">

    <div id="result" class="result"></div>
</div>

<script>
function calculerMonnaie() {
    var montantTotal = parseFloat(document.getElementById('montantTotal').value);
    var montantDu = parseFloat(document.getElementById('montantDu').value);

    var pieces = [
        { nom: '100$', valeur: 10000 },
        { nom: '50$', valeur: 5000 },
        { nom: '20$', valeur: 2000 },
        { nom: '10$', valeur: 1000 },
        { nom: '5$', valeur: 500 },
        { nom: '2$', valeur: 200 },
        { nom: '1$', valeur: 100 },
        { nom: '25¢', valeur: 25 },
        { nom: '10¢', valeur: 10 },
        { nom: '5¢', valeur: 5 },
    ];

    var montantARendre = Math.round((montantTotal - montantDu) * 100);
    var rendu = [];

    for (var i = 0; i < pieces.length; i++) {
        var piece = pieces[i];
        if (montantARendre >= piece.valeur) {
            var nombreDePieces = Math.floor(montantARendre / piece.valeur);
            montantARendre %= piece.valeur;
            rendu.push(`${nombreDePieces} x ${piece.nom}`);
        }
    }

    document.getElementById('result').innerHTML = '<h2>Monnaie à rendre :</h2>' + rendu.join('<br>');
}
</script>

</body>
</html>