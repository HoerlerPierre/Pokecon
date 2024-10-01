const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');

const app = express();
app.use(bodyParser.json());
app.use(express.static('public'))

const db = mysql.createConnection({
    host: '82.165.50.104',
    user: 'userweb',       
    password: 'userweb',       
    database: 'PokeUsers'    
});


db.connect(err => {
    if (err) {
        console.error('Erreur de connexion à la base de données:', err);
        return;
    }
    console.log('Connecté à la base de données MySQL.');
});


app.post('/user/login', (req, res) => {
    const { username, password } = req.body;

    const query = 'SELECT * FROM User WHERE login = ? AND passwd = ?';
    db.execute(query, [username, password], (err, results) => {
        if (err) {
            return res.status(500).json({ error: 'Erreur du serveur.' });
        }

        if (results.length > 0) {
            //res.json({ token: 'fake-jwt-token' });
            res.redirect('/home');
        } else {
            res.status(401).json({ error: 'Identifiants incorrects.' });
        }
    });
});

app.get('/home', (req, res) => {
    res.sendFile(__dirname + '/home/home.html');
});

app.get('/', (req, res) => {
    res.sendFile(__dirname + '/index.html');
});

const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Serveur démarré sur le port ${PORT}`);
});
