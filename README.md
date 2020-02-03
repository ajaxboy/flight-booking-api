
![alt tag](https://raw.githubusercontent.com/ajaxboy/flight-booking-api/master/postman.png)


I am Cj -  This is a simply, yet ellegant and functional Restful API project I created, using laravel framework.

This is an API for a flight system that allows to book reservations. The idea is simple, and the code straight forward. 

With 21 endpoints, you can change and consume the data however you want. That is the point of this project, as the same concept can be used in other projects for simple clean API consumption.
Just to reiterate I don't intend to build a whole product here. It's just an implementation.

The idea is - we have various RESTFUL Endpoints that handle the creation, updating, storing, partially storing and deletion of data.
These various types of data are regarding Bookings, Flights, and Reservations - but like said, the same idea can be applied.


Here is a list of things I used to develop this API:
`
- Migrations <small><i>`database/migrations/*`</i></small>
- Database Seeding / Factories <small><i>`database/factories/*`</i></small></li>
- Tinker
- Resources/Collections <small><i>`app/Http/Resources/*`</i></small>
- Controllers <small><i>`app/Http/Controllers/*`</i></small>
- Request Validation <small><i>`app/Http/Requests/*`</i></small>
- Dependency Injection
- Resource Routing <small>`routes/api.php`</small>
- Full Unit Test Coverage <small><i>`tests/Feature/*`</i></small>
- Eloquent ORM / Models <small><i>`app/Model/*`</i></small>
- Events/Listeners

`factory(App\User::class)->create()` will result in New User, New Booking, New Reservation and a new Flight (Event/Listener `app/Events/UserCreated.php` triggers the additional factory creations) The trigger of the event happens in User Factory (`database/factories/UserFactory` `->afterCreating()` event.

#### Get it running

You will need a new database, and to run a few commands in the terminal.

- Create a database and update file .env with this new database informaiton.
- copy `.env.example` into `.env` and update DATABASE CONSTANTS with the database info you created.

Commands:

    $ git clone https://github.com/ajaxboy/flight-booking-api.git  api
    $ cd api
    $ composer install
    $ php artisan migrate
    $ php artisan db:seed
    $ php artisan key:generate
    $ php artisan serve

This will populate the database with random testing data. When you are done you should have 50 flights, 50 bookings, 50 reservations and 50 users in the database.

This will also run the app on port 8000, hence you should be able to run it by going to:  http://127.0.0.1:8000 (or whatever domain you use to host the project)

When you go to http://127.0.0.1:8000, the front facing page will show you the 'GET' methods only, additional methods will only
be able to be tested by making request with an API program such as [Postman](https://www.getpostman.com/) or through API consumption.

#### Unit Testing

For `tests` the same database settings will be used as per your `.env` file;  you can change that by
creating a brand new database and updating file `phpunit.xml`

 phpunit.xml
    `<env name="DB_DATABASE" value="laravel" />`

 Run tests:
    `$ vendor/bin/phpunit`

If you do run the tests in the same database; the database will be whipped once the tests are completed.
To restore data run this:

    $ php artisan db:seed


Here is a list of ENDPOINTS (if you uploaded to a domain, just replace 127.0.0.1 for that domain)

### Endpoint GET METHODS SAMPLES

Get list of items

    GET http://127.0.0.1:8000/api/reservations
    GET http://127.0.0.1:8000/api/bookings
    GET http://127.0.0.1:8000/api/flights

GET specific item based on ID (you can put 1 to 50 as id)

    GET http://127.0.0.1:8000/api/reservations/1
    GET http://127.0.0.1:8000/api/bookings/1
    GET http://127.0.0.1:8000/api/flights/1


### Endpoint POST METHODS SAMPLES
 Idempotent / Sample Fields/Data

You can use these various methods to add, update or delete items

POST http://127.0.0.1:8000/api/flights

    flight_number:400
    airline:SouthWest
    origin:DFW
    destination:STI
    boarding_time:2020-01-16 17:30:15
    arrival_time:2020-01-16 20:30:15
    
POST http://127.0.0.1:8000:/api/reservations

    user_id:400
    booking_id:10
    flight_id:10
    passenger_name:CJ Galindo
    passenger_email:test@test.com
    reservation_code:
    origin:DFW
    destination:STI
    airline:SouthWest
    status:active
    seat:20C
    price↵:0.0
    tax:0
    assigned_flight_id:0

POST http://127.0.0.1:8000/api/bookings

    user_id:20
    flight_number:1500
    airline:American
    origin:LAX
    destination:DFW
    flight_id:2020-01-16 17:30:15
    arrival_time:2020-01-16 20:30:15
    name:CJ Galindo
    seat:20C
    email:test@test.com
    passengers:1
    price:340
    tax:20
   
### Endpoint PUT METHODS

PUT http://127.0.0.1:8000/api/flights/1

    flight_number:99993
    airline: Frontier
    origin: LAS
    destination: ZVE
    boarding_time: 2020-03-08 13:28:44
    arrival_time: 2020-03-09 18:30:20

PUT http://127.0.0.1:8000/api/reservations/10

    user_id:3
    booking_id:11
    flight_id:11
    passenger_name:CJ Galindo
    passenger_email:test@test.com
    reservation_code:
    origin:DFW
    destination:STI
    airline:SouthWest
    status:active
    seat:20C
    price:0.0
    tax:0
    assigned_flight_id:0
    
PUT http://127.0.0.1:8000/api/booking/10

    user_id:7
    flight_number:300
    airline:Spirit
    origin:LAX
    destination:MIA
    flight_id:2020-01-16 17:30:15
    arrival_time:2020-01-16 20:30:15
    name:CJ Galindo
    seat:20C
    email:test@test.com
    passengers:1
    price:340
    tax:20
    
    
### Endpoint PATCH METHODS

PATCH http://127.0.0.1:8000/api/flights/1

    flight_number:21
    
PATCH http://127.0.0.1:8000/api/reservations/1

    status:cancelled
    
PATCH http://127.0.0.1:8000/api/booking/1

    email:test@test.com
    
### Endpoint Delete METHODS

    DELETE http://127.0.0.1:8000/api/flights/1
    DELETE http://127.0.0.1:8000/api/reservations/1
    DELETE http://127.0.0.1:8000/api/booking/1

OPTIONS

    OPTIONS http://http://127.0.0.1:8000/api/reservations
    OPTIONS http://http://127.0.0.1:8000/api/flights
    OPTIONS http://http://127.0.0.1:8000/api/booking

### EndPoints

The endpoints are not meant to be tested on regular browsers (only the 'GET' methods will work)
The reason being that  API Endpoints are meant for program consumption.
You may need a special app like [Postman](https://www.getpostman.com/)



