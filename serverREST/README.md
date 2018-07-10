# serverREST
Testing TSV2018-26

# Query
## Check Service Staff
* SELECT id_member as id_service FROM cards JOIN members ON cards.id_member = members.id_member WHERE id_Card = 'service' AND isService = '1';

## Check Members & Money
* SELECT id_member as id_user, balance FROM cards JOIN members ON cards.id_member = members.id_member WHERE id_Card = 'card';

## Add Transaction
* INSERT INTO payments (id_pay_member, id_collect_member, amountofmoney, type_payment) VALUES ('id_service','id_user',money,add/subtract);

## Example
### Requiment: User B1400702 add 20000VND from service 002555
### URI: http://ipaddress:10110/transaction/add
### Client: Postman
### JSON Request:
* {"id_pay_member":"0070158406","id_collect_member":"0070151006","amountofmoney":20000}
### JSON Response:
* {
    "id_pay_member": "B1400702",
    "id_collect_member": "002555",
    "amountofmoney": "20000",
    "type_payment": "+"
}
### Commanpromt Response:
* F:\Dropbox\NodeJS\serverREST>node server.js
* Server listening on port 10110
* Connected!
* Da nhan
* { id_pay_member: 'B1400702',
  id_collect_member: '002555',
  amountofmoney: '20000',
  type_payment: '-' }
* Update thanh cong: nguoi nhan tien
* Update thanh cong: nguoi thanh toan

# References
* Client POSTMAN: https://www.getpostman.com/
* Database online: http://db4free.net/
