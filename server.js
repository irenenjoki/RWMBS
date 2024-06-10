const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const app = express();
const port = 3000;

app.use(bodyParser.json());

// MySQL connection
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root', // default user in XAMPP
    password: 'password', // default is no password
    database: 'water management'
});

connection.connect(err => {
    if (err) throw err;
    console.log('Database connected!');
});

// Retrieve billing information
app.get('/billing', (req, res) => {
    connection.query('SELECT * FROM billing', (err, results) => {
        if (err) throw err;
        res.json(results);
    });
});

// Handle payments
app.post('/payment', (req, res) => {
    const payment = req.body;
    connection.query('INSERT INTO payments SET ?', payment, (err, result) => {
        if (err) throw err;
        res.send('Payment processed!');
    });
});

app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
