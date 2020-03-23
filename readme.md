SIMPLIGPS API BACKEND

Some details are missing in this documentation!

Prerequisites
- docker
- docker compose

How to install

Using docker
https://laradock.io/getting-started/#B

You must follow the instructions on how to install laradock on multiple projects
You will have laradock directory side by side to the simpligps-api directory, then you must change
the configuration on laradock.

After that you only need to UP the following services.
Inside the laradock directory excecute 
```docker-compose up -d nginx mysql```

Then enter to the bash to excecute the proper installation 
Enter the bash with ```docker-compose exec workspace bash```
you will end in a `/var/www` inside the container. 
Execute ```composer install``` to install the third party libraries
`php artisan storage:link`
Copy the .env.docker as .env and then ```php artisan migrate --seed``` 

At the end you should see a big word with some general information in your localhost


Post Install and more documentation resources change the base url

- Endpoints for sysadmin
http://api.simpligps.test/storage/docs/admin/

- Endpoints for user
http://api.simpligps.test/storage/docs/user/ 

- PHP Objects and methods documentation
http://api.simpligps.test/storage/docs/php/
