# Smart Campus Laravel Backend
In this project i'm working with laravel 5.6

:heavy_exclamation_mark: :heavy_exclamation_mark: :heavy_exclamation_mark: All API's CAN be accessed without the token (all API's with this :closed_lock_with_key: symbol) for test purpose, please ignore this section (for as long this warning is in the readme)
 in this readme :heavy_exclamation_mark: :heavy_exclamation_mark: :heavy_exclamation_mark:

Specs and guides can be found on following link:    
https://laravel.com/docs/5.6

#### Server Requirements

* PHP >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Ctype PHP Extension
* JSON PHP Extension

### Installing laravel from scratch
If you want to install laravel from scratch follow the readme of this repository:    
**https://github.com/Trapn/laravelframeworktesting** (there is a little tutorial for laravel blade templating and presetting react)

# Using Eloquent ORM
If you want to use mySQL create a database called: `smartcampus`

Run this command in powershell to create the database tables:    
```php artisan migrate```
The output should look like this:  
![Alt Text](/images/migrations.PNG)
# Using Database: Seeding
To "seed" (or fill) the database with dummy info:      
```php artisan db:seed```  
The output should look like this:  
![Alt Text](/images/seeds.PNG)
ONLY if you did something wrong with adding info to the database run this before seeding:      
```php artisan migrate:fresh``` (this will delete all tables and make them again)

# App link:

### Backend:

**https://projectwerk2.herokuapp.com/**  
  
Or can be found on:  
**https://backend.vives-smart-campus.be/** ( :heavy_exclamation_mark: i don't own this server so it's not always up to date)  
  
If you run this local you can start the server by:
```php artisan serve``` 
The app can be found on:
```http://localhost:8000/``` 
  
### Frontend:
**https://vives-smart-campus.be/** ( :heavy_exclamation_mark: i don't own this server so it's not always up to date, also not my work)

## API Routes:

If the api is indicated with a  :closed_lock_with_key: you need an account to use the api (see register and login down below how to acces thes api routes)

### Listener:

* **/api/listener** (POST REQUEST to post multiple measurements)

the format should look like this:

There's a dummy device in the database with dev-eui `00E4F052209EE8A5` the json should look like this:  
```json
{
    "dev_eui": "00E4F052209EE8A5",
    "temperature": 5,
    "humidity": 20,
    "movement": 8
}
```

to check if the measurements are added you can check:

**api/measurements** (GET REQUEST)

### Locations:

* **/api/locations/{id}**
* **/api/locations** (GET REQUEST returns all locations)  
* **/api/locations**  :closed_lock_with_key: (POST REQUEST posts a new locations) 

the format for postings should look like this:

```json
{
    "name": "theNameOffTheClassroom",
    "roomnumber": "theNumberOfftheClassroom(the datatype is a string)",
    "description": "theDescriptionOffTheClassroom"
}
```
##### Getting data on location
  
* **/api/locations/room/{roomnumber}** (GET REQUEST returns all temperature, humidity, movement measured on location, latest first)
* **/api/locations/room/{roomnumber}/temperature** (GET REQUEST returns all temperature measured on location, latest first)
* **/api/locations/room/{roomnumber}/humidity** (GET REQUEST returns all humidity measured on location, latest first)
* **/api/locations/room/{roomnumber}/movement** (GET REQUEST returns all movement measured on location, latest first)

### Devices:

* **/api/devices/{id}**
* **/api/devices** (GET REQUEST returns all devices)  
* **/api/devices**  :closed_lock_with_key: (POST REQUEST posts a new devices) 

the format for postings should look like this:

```json
{
    "name": "theNameOffTheDevice",
    "dev-eui": "theDev-euiOffTheDevice",
    "location_id": "PKoffTheLocationWhereTheDeviceIsLocated"
}
```
### Sensors:

* **/api/sensors/{id}**
* **/api/sensors** (GET REQUEST returns all sensors)  
* **/api/sensors** :closed_lock_with_key: (POST REQUEST posts a new sensors) 

the format for postings should look like this:

```json
{
    "name": "theNameOffThesensor",
    "measurement_unit": "theUnitTheSensorIsMeasuring",
    "device_id": "PKoffTheDeviceWhereTheSensorIsInstalled"
}
```
# Register and login
### JSON Web Tokens (JWT)
JSON Web Token (JWT) is an open standard (RFC 7519) that defines a compact and self-contained way for securely transmitting information between parties as a JSON object. This information can be verified and trusted because it is digitally signed. JWTs can be signed using a secret (with the HMAC algorithm) or a public/private key pair using RSA.  

![Alt Text](/images/authSchema.png)
## Example
This is an example to register or login with a user to access the :closed_lock_with_key: API's. In this example i'm using POSTMAN you can download it here:  
https://www.getpostman.com/
### Register 
To register you can simply add some Params to you're request:
* **/api/register** 
![Alt Text](/images/register.PNG)
### Register 
After registering you can get the token by logging in:
* **/api/login** 
![Alt Text](/images/login.PNG)
### Accessing the :closed_lock_with_key: API's
When done the previous steps you have to add some things to you're request
#### 1. Set authentication type to "Bearer Token" and fill in you're recived token
![Alt Text](/images/addtokentorequest.PNG)
#### 2. Add these two values to the header:
![Alt Text](/images/addheaders.PNG)
#### 3. Normally you should be able now to access following API's with a POST request:
* **/api/locations**  :unlock:
* **/api/devices**  :unlock:
* **/api/sensors**  :unlock:
* **/api/measurements**  :unlock:  
Make sure the Foreign key(if adding devices, sensors, measurements) of the other table exists.  
You should get something like this when sending the post request:
![Alt Text](/images/postlocation.PNG)

## Database

### Database UML
![Alt Text](/images/database_uml.PNG)

## Heroku

#### Running commands on heroku
You can run all artisan commands on heroku:
```heroku run php /app/artisan migrate```  

