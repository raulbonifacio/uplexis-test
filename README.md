# Article capturer

A test created an anonyous startup.



### How to run it?

After downloading it is necessary to install 
the dependencies using composer:

    $ composer install


In the current state the application does not have an enviroment file. So, let's created it:

    $ cp .env.example .env

The next step is insert the database credentials into the .env file:

> DB_DATABASE=database  
> DB_USERNAME=username  
> DB_PASSWORD=password 

Generate the key:

    $ php artisan key:generate

And run the migrations:

    $ php artisan migrate

This command will create the necessary databases and create an admin user with the following credentials:

> email: admin@email.com  
> password: password

The last step is start the application:

    $ php artisan serve

The application is now served in the address **localhost:8000**.

Now, just log in!
