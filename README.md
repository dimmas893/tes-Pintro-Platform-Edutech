<img src="/gambar1.jpg" width="100%">
<img src="/gambar2.jpg" width="100%">
<img src="/gambar3.jpg" width="100%">
yang saya lingkari adalah grouping

instalasi

-composer update

-copy .env.example menjjadi .env

-php artisan key:generate

-php artisan migrate:fresh --seed atau bisa juga import database

untuk database sql nya saya taroh sejajar dengan foldedr app

    Admin
        username = admin
        pass = sercret


    Employee
        user = employee
        pass = secret
