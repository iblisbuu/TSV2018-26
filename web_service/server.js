var express = require('express');
var bodyparser = require('body-parser');

var connection = require('./Dbconnection');
var student = require('./Controllers/student');
var payment = require('./Controllers/payment');

var date = new Date();
var current_year = date.getFullYear();
var current_month = date.getMonth();
var current_day = date.getDay();
var current_hour = date.getHours();
var current_minute = date.getMinutes();
var current_second = date.getSeconds();

var app = express();
app.use(bodyparser.urlencoded({extended: true})); //support x-www-form-urlencoded
app.use(bodyparser.json());

app.use('/sinhvien',student);
app.use('/transaction',payment);

var server = app.listen(10110, function() {
  console.log('Server listening on port ' + server.address().port);
  console.log(current_year+'-'+current_month+'-'+current_day+' '+current_hour+':'+current_minute+':'+current_second);
  connection.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
  });
});

module.exports = app;
