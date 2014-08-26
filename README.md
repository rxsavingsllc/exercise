###Rx Savings Solutions Software Engineer Exercise
<br />
Please do the following before getting started:

 - Fork this repository to your own Github account.
 - Make sure you have some sort  of local testing environment like WAMP/MAMP or a virtual machine.
 - Read this Readme for what the exercise is and what we expect from our candidates

This exercise is focused solely on your understanding what a RESTful API is and how you communicate with it. We are hosting this on Github so we can make sure you are able to work in our environment and understand the basics of working with Git/hub.

Once you have forked this repository and cloned your own account's copy, please read below for the following required tools you will need:

 - Composer
 - IDE of your choice or Sublime/Notepad++
 - Working understanding of the Laravel framework

Our repo has the standard Laravel project, which includes the standard .gitignore. This means you will need to install composer and use the `composer install` command in the root of your cloned directory. We also have some basic artisan commands you will need to run as well. We created one database migration and one table seed, so you will need to run those.

After this, you should have a working copy on your machine. If you migrated and seeded you should have a database, a table called "users" with 3 members in it. Now we'll begin the exercises:

----

####Exercise #1
Create a new database migration for a new schema called "comments". This following schema is needed: a unique primary key, auto incremented, an integer that references the id of the author, a string with 255 characters max length for the comment itself, and a updated and created datetime field. Use Laravel's migrations to create these.
<br />
<br />
####Exercise #2
Create a RESTful route that uses the CommentsController controller. Look at the given controller and make sure your route uses only those methods. Using `php artisan routes` you should only see the proper methods, routes, and request methods.
<br />
<br />
####Exercise #3
Create a Comments model and using the `index` method in CommentsController, create a JSON response that displays all comments using the Comments model. Introduce the ability to include a parameter to show only a certain comment as well.
<br />
<br />
####Exercise #4
Using the Comments model, User model and CommentsController's appropriate method to do the following:
 - Take a normal POST request data using Laravel's Input facade.
 - Authenticate the user with the `secret_key` column.
 - Insert a new comment with the authenticated user.

----

###Expectations
<br />
We are expecting the ability to use Postman or PHPStorm's RESTful API debugging tool to send a request to the application and receive the proper data. If we request all comments, we expect a JSON object of all comments. If we request a single comment, we expect a JSON object of that comment. If we request to insert a comment, we expect a JSON response with a success/failure message.

The basic requirements are the following:
 - Forked this repository to your own Github account and cloned it to your own working environment
 - Has a comments migration
 - Routes follow the RESTful pattern and exludes routing for un-used requests
 - Has a comments model
 - Displays JSON for all responses
 - Works properly in Postman or PHPStorm Web Service Tools
 - Created a proper Pull Request to this repository for any changes.

Some extra credit will be assigned if you do any of the following:
 - Import a 3rd Party package such as barryvdh/debugbar or way/generators.
 - Commented properly using the standard DocBlock format.
 - Any continuing work that would add the following features: delete comment, edit comment, like comment.
 - Any work that involves paging the JSON object for better response.
