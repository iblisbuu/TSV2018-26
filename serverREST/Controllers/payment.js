var express = require('express');
var router = express.Router();
var Transaction = require('../Models/Transaction');
router.get('/:id?',function(req,res,next){
    if(req.params.id){
        Transaction.getTransactionById(req.params.id,function(err,rows){
            if(err){
                res.json(err);
            }
            else{
              if(rows.length > 0){
                res.json(rows);
              }
              else{
                res.json({'message':'Chua co giao dich'});
              }
            }
        });
    }else{
        Transaction.getAllTransaction(function(err,rows){
            if(err){
                res.json(err);
            } else {
              if(rows.length > 0){
                res.json(rows);
              }
              else{
                res.json({'message':'Chua co giao dich'});
              }
            }
        });
    }
});

router.post('/add',function(req,res,next){
  var received = req.body;

  if(received){
    console.log('Da nhan');
  }

  var amountofmoney = parseInt(received.amountofmoney);
  var type_payment = '-'; // default subtract

  Transaction.checkUser(received.id_pay_member,function(err,rows){
    if(err){
      res.json(err);
    } else{
      if(rows.length > 0){
        id_user = rows[0]['id_member'];
        Transaction.getBalance(id_user,function(err,rows){
          if(err){
            res.json(err);
          } else{
            balance_user = rows[0]['balance'];
            balance_user = parseInt(balance_user);
            if(balance_user >= amountofmoney){
              Transaction.checkServiceStaff(received.id_collect_member,function(err,rows){
                if(err){
                  res.json(err);
                } else{
                  if(rows.length > 0){
                    id_service = rows[0]['id_member'];
                    Transaction.getBalance(id_user,function(err,rows){
                      if(err){
                        res.json(err);
                      } else{
                        balance_service = rows[0]['balance'];
                        balance_service = parseInt(balance_service);

                        // balance_service_after_transaction = balance_service + amountofmoney;
                        balance_user_after_transaction = balance_user - amountofmoney;

                        // if(balance_service_after_transaction && balance_user_after_transaction) {
                        if(balance_user_after_transaction) {
                          var pay = '{"id_pay_member":"' + id_user + '","id_collect_member":"' + id_service + '","amountofmoney":"' + amountofmoney + '","type_payment":"' + type_payment + '"}';
                          datapay = JSON.parse(pay);
                          Transaction.addTransaction(datapay,function(err,rows){
                            if(err){
                              res.json(err);
                            } else{
                              res.json(datapay);
                              console.log(datapay);
                              // Transaction.updateBalance(id_service,balance_service_after_transaction,function(err,rows){
                              //   if(err){
                              //     res.json(err);
                              //   } else{
                              //     console.log('Update thanh cong: nguoi nhan tien');
                              //   }
                              // });
                              Transaction.updateBalance(id_user,balance_user_after_transaction,function(err,rows){
                                if(err){
                                  res.json(err);
                                } else{
                                  console.log('Update thanh cong: nguoi thanh toan');
                                }
                              });
                            }
                          })
                        }
                      }
                    });
                  } else{
                    res.json({"message":"Khong ton tai nguoi nhan nay!"});
                  }
                }
              });
            } else{
              res.json({"message":"Khong du so du de thuc hien giao dich!"});
            }
          }
        });
      } else{
        res.json({"message":"Khong ton tai nguoi thanh toan nay!"});
      }
    }
  });
});
module.exports=router;
