# serverREST


# Query
## Check Service Staff
* SELECT id_member as id_service FROM cards JOIN members ON cards.id_member = members.id_member WHERE id_Card = 'service' AND is_Service_staff = 'yes';

## Check Members & Money
* SELECT id_member as id_user, balance FROM cards JOIN members ON cards.id_member = members.id_member WHERE id_Card = 'card';

## Add Transaction
* INSERT INTO payments (id_pay_member, id_collect_member, amountofmoney, type_payment) VALUES ('id_service','id_user',money,-);

## Example
### Requiment: User 'student' pay '1000VND' for service staff 'Service'. student card = 01234 , service staff card = 12345
### URI: http://ipaddress:10110/transaction/add
### Client: Postman
### JSON Request:
* {
	"id_pay_member":"01234",
	"id_collect_member":"12345",
	"amountofmoney":"1000"
}
### JSON Response:
* {
    "id_pay_member": "student",
    "id_collect_member": "service",
    "amountofmoney": "1000",
    "type_payment": "-",
    "message": "Done"
}
### Commanpromt Response:
* C:\xampp\htdocs\serverREST>node server.js
* Server listening on port 10110
* Connected!
* Receiced
* { id_pay_member: 'student',
  id_collect_member: 'service',
  amountofmoney: '1000',
  type_payment: '-' }
{ message: 'Update balance successfully' }


# References
* Client POSTMAN: https://www.getpostman.com/
* Database online: http://db4free.net/
