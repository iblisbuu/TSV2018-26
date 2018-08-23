var express = require('express');
var router = express.Router();
var Transaction = require('../Models/Transaction');



router.post('/add',function(req,res,next){
  var received = req.body;

  if(received){
    console.log('Received');
  }

  var amountofmoney = parseInt(received.amountofmoney);
  var type_payment = '-';

  // check this service staff
Transaction.checkServiceStaff(received.id_collect_member,function(err,rows){
                if(err){
                  res.json(err);
                }
                else{ // not error
                  if(rows.length > 0){ // this service staff existed
                    id_service = rows[0]['id_member'];
                    Transaction.checkUser(received.id_pay_member,function(err,rows){
                      if(err){
                      res.json(err);
                      } 
                      else{
                       if(rows.length > 0){ 
                        id_user = rows[0]['id_member'];
                        Transaction.getBalance(id_user,function(err,rows){
                            if(err){
                            res.json(err);
                            } 
                            else{  //getBlance user successfully
                              balance_user = rows[0]['balance']; 
                              balance_user = parseInt(balance_user);
                             // then compare balance and amount of money
                              if(balance_user >= amountofmoney && amountofmoney >= 0){
                                balance_user_after_transaction = balance_user - amountofmoney;
                                var pay = '{"id_pay_member":"' + id_user + '","id_collect_member":"' + id_service + '","amountofmoney":"' + amountofmoney + '","type_payment":"' + type_payment + '"}';
                                datapay = JSON.parse(pay);

                                Transaction.addTransaction(datapay,function(err,rows){
                                  if(err){
                                    res.json(err);
                                  } 
                                  else{// addTransaction successfully// addTransaction successfully
                                    //res.json(datapay);
                                    console.log(datapay);
                                    Transaction.updateBalance(id_user,balance_user_after_transaction,function(err,rows){
                                      if(err){
                                        res.json(err);
                                      }
                                      else{
                                        message = '{"id_pay_member":"' + id_user + '","id_collect_member":"' + id_service + '","amountofmoney":"' + amountofmoney + '","type_payment":"' + type_payment + '","message":"Done"}';
                                        message = JSON.parse(message);
                                        res.json(message);
                                        console.log({"message":"Update balance successfully"});
                                      }
                                    });
                                  }
                                });
                              }
                              else{
                                console.log({"message":"No enough money!"});
                                res.json({"message":"No enough money!"});
                              }
                            }
                          });
                      }
                      else{
                        console.log({"message":"The member does not exist!"});
                        res.json({"message":"The member does not exist!"});
                      }
                    }
                  });
                  }
                  else{
                    console.log({"message":"The service does not exist!"});
                    res.json({"message":"The service does not exist!"});
                  }
                }
              });
});

                                   





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
                res.json({'message':'No Transaction'});
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
                res.json({'message':'No Transaction'});
              }
            }
        });
    }
});





module.exports=router;
