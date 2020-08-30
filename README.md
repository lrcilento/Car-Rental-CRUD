# Car-Rental-CRUD
API CRUD feita em PHP, JS e MySQL para controle de uma locadora de carros

Manual de utilização:

    Sistema Operacional: Ubuntu 20.04 LTS
  
    1. Instale o Apache2, PHP, MySQL-Server, MySQL-Workbench e suas respectivas dependências.
    2. Faça o download do CarRentalDb.sql e importe ele pelo MySQL-Workbench.
    3. Faça o download do resto dos arquivos e mova-os para /var/www/html.
    4. Apague o "index.html" caso ele exista no diretório.
    5. Acesse o localhost (127.0.0.1) e controle a API por lá.

Instruções de uso pelo Postman:

    URL: 127.0.0.1/api/<endpoint>/<operation>
  
  Endpoints:
  
    Clients:
        string cpf
        string name
        string address
    
    Cars:
        string plate
        string model
        int year
        string color
        float dailyRate
        boolean rentStatus
    
    Rents:
        int id
        string client_cpf
        string car_plate
        string startDate
        string endDate
        float totalPrice
        boolean rentStatus
    
  Operations:
  
    read.php (GET)
    single_read.php/?id=<id> (GET)**
    create.php (POST)*
    delete.php (DELETE)*
    update.php (POST)*
  
    *: Requer envio de JSON.
    **: Substitua "id" por "plate" ou "cpf" dependendo do endpoint.
  
  Exemplos:
  
    127.0.0.1/api/Rents/read.php
    127.0.0.1/api/Clients/single_read.php/?cpf=99999999999
    127.0.0.1/api/Cars/delete.php
        {
            "plate": "AAA1111"
        }
    127.0.0.1/api/Clients/create.php
        {
            "cpf": "99999999999",
            "name": "John",
            "address": "XYZ Street, 123"
        }
    127.0.0.1/api/Cars/update.php
        {
            "plate": "AAA1111",
            "model": "Uno",
            "year": "2015",
            "color": "Red",
            "dailyRate": "20",
            "rentStatus": "0"
        }
 
Observações:

    1. Falta o retorno do MySQL error em quase todas as querys sem sucesso.
    2. Não sei o processo de instalação específico para o Windows, mas deve ser similar.
    3. O dashboard não fica em "index.php" para facilitar o gerencimento dos meus arquivos, mas é só renomear "carrental.php" para "index.php".
