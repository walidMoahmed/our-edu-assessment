## You must follow this instructions to run the project 
    1 - git clone 'https://github.com/walidMoahmed/our-edu-assessment' 
    2- create database 
    3- change database config in file .env like this :

        DB_CONNECTION=mysql 
        DB_HOST=127.0.0.1 
        DB_PORT=3306 
        DB_DATABASE=edu 
        DB_USERNAME=root 
        DB_PASSWORD= 

    4- run this command lines 
        1- composer update 
        2- php artisan migrate 
        3- php artisan db:seed 
        4- php artisan serve 
    5- use postman collection to login email: admin@edu.com password: 1234567890 
    

### {{base_url}} is 'http://127.0.0.1:8000/api'

## if need to add it in your postman 
    1- go on Environments Tab
    2- then click on + icon 
    3- change name 'New Environment' to the name you need it
    4- in variable write 'base_url' 
    5- initial value is 'http://127.0.0.1:8000/api'
