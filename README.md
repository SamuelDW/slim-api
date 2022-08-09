# slim-api

Goal:
To create an API matching the specification laid out.

Disclaimer: I have no prior experience of using Slim, I have used Symfony, CakePHP and Node to create APIs/Websites so I am going in blind. However, I hope by using this technology I can show the ability to learn quickly.

When looking at the documentation for Slim, I noticed a lot of similarities between Slim and a recent Node project in how they are set up. Rather than use CakePHP, I thought it may be helpful to my application to Muzz to show that I can quickly grasp the concepts of a new tool, and use it effectively.

## Requirements
- Postman
- Composer
- Git

## Setting up:
Download Repo and run `composer install` to install dependencies
In PhpMyAdmin, import the scripts in the following order
1. create-database.sql
2. create-tables.sql
3. populate-tables.sql

Run the command `composer start` to start the local web server.
See [Postman Requests](#postman) for testing out locally

## Database Schema
I planned out the database before creating it, looking at ways to improve queries, so that it would not be as complex.
I split out users and their data into four:
1. The user information
2. Photos that the user has uploaded
3. User statistics, so that more can be added in the future
4. User matches, to show who has rejected who to prevent showing them the user

## Routes
I listed out the routes that would be needed, to keep track of them
1. /user/create [Post] (/user/{id} [Delete]) if there is time
2. /profiles/{id} [Get] Also exclude users already swiped on
3. /swipe [Post]
4. /login [Post]
5. /user/gallery [Post]

## Filters
1. /profiles?age=18,43&gender=x,y,z
2. /profiles?location=New_York
3. /profiles?attractive_upper=100&attract_lower=50


## JSON Data to send
1. /user/create
```json
{
    "email": "test@test.com",
    "password": "123456789",
    "name": "test",
    "gender": "male",
    "age": 18
}
```

## JSON Responses
Documented is the layout of the JSON Responses
```json
{
    "apiVersion": "1.0.0",
    "data": {

    }
}
