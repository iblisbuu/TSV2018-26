var mysql=require('mysql');
var connection = mysql.createConnection({
//   host:'db4free.net',
//   user:'ngthuc',
//   password:'tsv2018_26',
//   database:'tsv2018_26'
host:'localhost',
user:'root',
 password:'',
database:'quickpayment2'
 });

//var connection = mysql.createConnection('mysql://ngthuc:tsv2018_26@db4free.net/tsv2018_26?charset=utf8_unicode_ci&timezone=Asia/Ho_Chi_Minh');
// var connection = mysql.createConnection('mysql://root:mysql@localhost/tsv2018_26?charset=utf8_unicode_ci&timezone=Asia/Ho_Chi_Minh');
module.exports=connection;
