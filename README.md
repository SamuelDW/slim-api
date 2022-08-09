# slim-api

Goal:
To create an API matching the specification laid out.

Disclaimer: I have no prior experience of using Slim, I have used Symfony, CakePHP and Node to create APIs/Websites so I am going in blind. However, I hope by using this technology I can show the ability to learn quickly.

## Setting up:
Download Repo
In PhpMyAdmin, run the script 'setup.sql' to create the database.


## Database Schema
I planned out the database before creating it, looking at ways to improve queries, so that it would not be as complex.
I split out users and their data into four:
1. The user information
2. Photos that the user has uploaded
3. User statistics, so that more can be added
4. User dislikes, to show who has rejected who to prevent showing them the user

## Routes
I listed out the routes that would be needed, to keep track of them
1. /user/create [Post] (/user/{id} [Delete]) if there is time
2. /profiles/{id} [Get] Also exclude users already swiped on
3. /swipe [Post]
4. /login [Post]
5. /user/gallery

## Filters
1. /profiles?age=18,43&gender=x,y,z
2. /profiles?location=New_York
3. /profiles?attractive_upper=100&attract_lower=50
