# slim-api

Goal:
To create an API matching the specification laid out.

Disclaimer: I have no prior experience of using Slim, I have used Symfony, CakePHP and Node to create APIs/Websites so I am going in blind. However, I hope by using this technology I can show the ability to learn quickly.

When looking at the documentation for Slim, I noticed a lot of similarities between Slim and a recent Node project in how they are set up. Rather than use CakePHP, I thought it may be helpful to my application to Muzz to show that I can quickly grasp the concepts of a new tool, and use it effectively.

Why I didn't choose CakePHP or Symfony. I had heard of Slim before, so a chance to create something to a small specification to understand Slim in a more professional capacity was great, taking a look back at basics such as PDO, whereas CakePHP and Symfony have their own ORM, which, whilst very useful, and would have made certain parts of this easier, would have added bloat. Benefits would have included pulling in associated data in one go, rather than inner joins in the queries themselves. (CakePHP ORM does this very well)

Aimed to provide a small example of more component based architecture, (Uncle Bob). This isn't the best example, I would perhaps plan this out much longer given the time. But split it out into a users section, so this theoretically can be pulled out and used elsewhere. Same with Auth. Matcher and Profiles are a bit more tightly coupled, and perhaps could be written together to remove this tighter coupling, as they are both doing things with matches in a very similar manner. This may help keep the code DRY.

Some of the downsides of using this is perhaps that I may not be able to show off as many skills than with a framework I am familiar with, and that I am not currently able to get some of these working. However, I hope that I can demonstrate the knowledge behind concepts.

## Requirements
- Postman
- Composer
- Git
- PHPMyAdmin or something similar

## Setting up:
Download Repo and run `composer install` to install dependencies
In PhpMyAdmin, import the scripts in the following order
1. create-database.sql
2. create-tables.sql
3. populate-tables.sql

Run the command `composer start` to start the local web server.

## Database Schema
I planned out the database before creating it, looking at ways to improve queries, so that it would not be as complex.
I split out users and their data into five:
1. The user information
2. Photos that the user has uploaded
3. User statistics, so that more can be added in the future
4. User matches, to show who has rejected who to prevent showing them the user
5. User sessions, a very rudimentary token based auth system. (You did say write your own logic)

## Routes
I listed out the routes that would be needed, to keep track of them, as well as the possible drivers on the front end.
1. /user/create [Post] a registration form
2. /profiles/{id} [Get] Also exclude users already swiped on
3. /swipe [Post] a simple card based left or right or thumbs up thumbs down button
4. /login [Post] A simple login form on the front end
5. /user/gallery [Post] This one would on the frontend be driven by a form where users upload their photos
As a very quick demo
6. (/user/{id} [Delete]) would be a button on the users account (this one would need token)

## Filters
1. /profiles?age=18,43&gender=x,y,z
2. /profiles?location=New_York
3. /profiles?attractive_upper=100&attract_lower=50


## JSON Data to send
1. /user/create
```json
{
    "email": "test43@test.com",
    "password": "123456789",
    "name": "test",
    "gender": "male",
    "age": 18
}
```

2. /swipe
```json
{
    "user_id": 101,
    "match_id": 2,
    "swipe_direction": "NO"
}
```

3. /login
```json
{
    "email": "test@test.com",
    "password": "test"
}
```

## JSON Responses
Documented is the layout of the JSON Responses
```json
{
    "apiVersion": "1.0.0",
    "method": "GET",
    "params": "original request data",
    "data": {

    }
}
```

## Filtering profiles
I added the following filters to narrow profiles down
1. ?age=20, will look for users with this age (please note, the dummy data really sparsely populated the ages, so 20 should provide the most)
2. ?gender=  will look for users with the specific gender (Male, Female, Other)
2. ?attractiveness to the first point in this section, and arrange according to this value
3. location will sort users by distance to you

## Files to note
Please see isUserAuthenticated to see how i attempted to provide token. As I have not had any experience with Slim, I was unaware i needed to register this one as Middleware (A bit too much node where middleware is written as normal functions).

## Issues
1. Image uploads never seemed to work (Showed how I would implement the file uploads however)

### Additions if there was time
1. Add a user preferences table so that matches can be much more tailored to the user
2. Add a way to get users close to the user, I could begin the query to get by users
3. Make use of repository constructors or constructors more to reduce bloat.
4. Tests
5. Make authentication more robust and secure and actually a piece of middleware
6. Better handling of errors
7. Event listeners, update tables if an action is done without needing to declare it in the action/controller
6. More efficient Repos, perhaps making a base search and adding to that with methods in the repository.
7. Much more refined filtering, and perhaps much wider range of options, such as choosing between numbers or upper and lower bounds (i.e age=21,30 for users between these two ages)
8. docker to setup
9. GitHub Actions for CI/CD
