# Car-Rental-CRUD
API CRUD feita em PHP, JS e MySQL para controle de uma locadora de carros

Manual de utilização:

    Sistema Operacional: Ubuntu 20.04 LTS
  
    1. Instale o Apache2, PHP, MySQL-Server, MySQL-Workbench e suas respectivas dependências.
    2. Faça o download do CarRentalDb.sql e importe ele pelo MySQL-Workbench.
    3. Faça o download do resto dos arquivos e mova-os para /var/www/html.
    4. Acesse o localhost (127.0.0.1) e controle a API por lá.

Instruções de uso pelo Postman:

    URL: 127.0.0.1/api/<endpoint>/<operation>
  
  Endpoints:
  
    Clients
    Cars
    Rents
    
  Operations:
  
    read.php (GET)
    single_read.php/?id=<id> (GET)
    create.php (POST)*
    delete.php (DELETE)*
    update.php (POST)*
  
    *: Requer envio de JSON.

Observações:

    1. Falta o retorno do MySQL error em quase todas as querys sem sucesso.
