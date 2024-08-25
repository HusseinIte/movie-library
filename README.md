This project is for managing a movie library using Laravel. 
The API supports basic CRUD operations (Create, Read, Update, Delete) for movies. 
RESTful API design principles have been implemented, ensuring proper data validation, exception handling, and the incorporation of advanced features such as pagination, sorting, and filtering.

Main Features:
Add - Delete - Edit - View => Movie
Add - Delete - Edit - View => Rating
Filter movies by director or release year
Display movies in ascending or descending order
Display the final rating for a movie along with individual ratings by each user
Display ratings by each user or display ratings for each movie

API Description:
There are APIs that require authentication (login):
Add a rating to a movie
Edit a movie rating
Delete a rating
View ratings for the user

Filtering and sorting parameters for movies:
genre, director, sort_order, perPage

A Postman collection:
containing all the project APIs is attached.
It includes global variables:
auth_token, base_url
auth_token: Automatically adds the token after registration or login
base_url: The project URL

Postman Collection Link:
https://drive.google.com/file/d/1q0amFpSOsZFkvnW3qERRVVUd6aVttkBY/view?usp=drive_link

How to Run:
- open terminal 
- git clone <repository-url>
-cd <project-folder>
-composer install
-cp .env.example .env
-create database your_database_name;
-php artisan migrate
-php artisan serve
-The default URL will be http://localhost:8000.

