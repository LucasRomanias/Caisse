const express = require('express');
const bodyParser = require('body-parser');
const fs = require('fs');
const path = require('path');

const app = express();
const PORT = 3000;
const FILE_PATH = path.join(__dirname, 'disponibilite.json');

app.use(bodyParser.json());
app.use(express.static('public'));

app.get('/api/disponibilite', (req, res) => {
    fs.readFile(FILE_PATH, (err, data) => {
        if (err) return res.status(500).send('Erreur de lecture du fichier');
        res.json(JSON.parse(data));
    });
});

app.post('/api/disponibilite', (req, res) => {
    fs.writeFile(FILE_PATH, JSON.stringify(req.body), (err) => {
        if (err) return res.status(500).send('Erreur d\'écriture du fichier');
        res.send('Données mises à jour');
    });
});

app.listen(PORT, () => {
    console.log(`Serveur en écoute sur le port ${PORT}`);
});
