var db = require('../Dbconnection');

var Transaction={
	// getAllTransaction:function(callback){
	// 	return db.query("Select * from sinhvien",callback);
	// },
	// getTransactionById:function(id,callback){
	// 	return db.query("select * from sinhvien where Id=?",[id],callback);
	// },
	// addTransaction:function(sinhvien,callback){
	// 	return db.query("Insert into sinhvien(name,class,dob) values(?,?,?)",[sinhvien.name,sinhvien.class,sinhvien.dob],callback);
	// },
	// deleteTransaction:function(id,callback){
	// 	return db.query("delete from sinhvien where Id=?",[id],callback);
	// },
	// updateTransaction:function(id,sinhvien,callback){
	// 	return db.query("update sinhvien set name=?,class=?,dob=? where Id=?",[sinhvien.name,sinhvien.class,sinhvien.dob,id],callback);
	// }
	getAllTransaction:function(callback){
		return db.query("SELECT * FROM payments",callback);
	},
	getTransactionById:function(id,callback){
		return db.query("SELECT * FROM payments WHERE id_pay_member=? OR id_collect_member=?",[id,id],callback);
	},
	checkServiceStaff:function(service,callback){
		return db.query("SELECT * FROM cards JOIN members ON cards.id_member = members.id_member WHERE cards.id_Card = ? AND members.is_service_staff = 'yes'",[service],callback);
	},
	checkUser:function(card,callback){
		return db.query("SELECT * FROM cards JOIN members ON cards.id_member = members.id_member WHERE id_Card = ?",[card],callback);
	},
	getBalance:function(member,callback){
		return db.query("SELECT * FROM members WHERE id_member = ?",[member],callback);
	},
	addTransaction:function(transaction,callback){
		return db.query("INSERT INTO payments(id_pay_member,id_collect_member,amountofmoney,type_payment) VALUES(?,?,?,?)",[transaction.id_pay_member,transaction.id_collect_member,transaction.amountofmoney,transaction.type_payment],callback);
	},
	updateBalance:function(id,balance,callback){
		return db.query("UPDATE members SET balance = ? WHERE id_member = ?",[balance,id],callback);
	}
};
 module.exports=Transaction;
