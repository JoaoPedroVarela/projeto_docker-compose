const express = require('express');
const mysql = require('mysql2');

const app = express();

const connection = mysql.createConnection({
    host: 'mysql-container',
    user: 'root',
    password: '123456',
    database: 'bancoJP'
});

connection.connect();

app.get('/jogos', function(req, res) {
    connection.query('SELECT * FROM jogos', function(erro, results) {
        if (erro) {
            console.error('Erro ao buscar dados:', erro);
            res.status(500).send('Erro ao buscar dados no banco de dados');
            return;
        }

        res.send(results.map(item => ({
            nome: item.nome,
            nota: item.nota,
            data_lancamento: item.data_lancamento
        })));
    });
});

app.listen(9001, '0.0.0.0', function() {
    console.log('Listening on port 9001');
});