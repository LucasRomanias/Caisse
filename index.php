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
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
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
    <form method="post">
        <label for="montantTotal">Montant donné par le client:</label>
        <input type="number" id="montantTotal" name="montantTotal" step="0.01" required>

        <label for="montantDu">Montant de la facture :</label>
        <input type="number" id="montantDu" name="montantDu" step="0.01" required>

        <input type="submit" value="Calculer">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $montantTotal = $_POST['montantTotal'];
        $montantDu = $_POST['montantDu'];

        function rendreMonnaie($montantTotal, $montantDu) {
            $pieces = [
                '100$' => 10000,
                '50$' => 5000,
                '20$' => 2000,
                '10$' => 1000,
                '5$' => 500,
                '2$' => 200,
                '1$' => 100,
                '25¢' => 25,
                '10¢' => 10,
                '5¢' => 5,
            ];

            $montantARendre = intval(round(($montantTotal - $montantDu) * 100));
            $rendu = [];

            foreach ($pieces as $piece => $valeur) {
                if ($montantARendre >= $valeur) {
                    $nombreDePieces = intdiv($montantARendre, $valeur);
                    $montantARendre %= $valeur;
                    $rendu[$piece] = $nombreDePieces;
                }
            }

            return $rendu;
        }

        $monnaieARendre = rendreMonnaie($montantTotal, $montantDu);

        echo '<div class="result"><h2>Monnaie à rendre :</h2>';
        foreach ($monnaieARendre as $piece => $nombre) {
            echo "$nombre x $piece<br>";
        }
        echo '</div>';
    }
    ?>
</div>

</body>
</html>