# Booj Reading List

#### A technical assessment completed by Jeff Martin on 2/17/2020

## Task

Compose a site using the [Laravel](https://laravel.com/) or Vue framework that allows the user to create a list of books they would like to read. Users should be able to perform the following actions:

> Use of the word "user" above made me think of authenticated users, so I used Laravel's built in auth feature to register and login users. I created a demo account with username 'demo@boojybooks.com' and password 'boojybooks' if you want to bypass the registration process.

-   Create Postman collection and Vue app OR Laravel App

> I chose the _Laravel_ framework, since I have more experience with it

-   Connect to a publically available API

> openlibrary.org showed up first in a Google search, so I chose to use it

> There was no metion in the project specification of how the user discovered books to add to their list, so I decided to start with a search page.

> It turns out there is a lot of information about a book, and open library returns a varying number of data points about the them. I am not an expert in ISBNs and the like, so I chose isbn_13 as my unique identifier for a book, as it seems be pretty consistently returned.

-   Add or remove items from the list
-   Change the order of the items in the list

> I took this to mean that the list has a rank for each book, and books can be moved up or down in rank. The rank is separate from sorting on the other data points.

-   Sort the list of items

> I chose to do this on the front end using datatables. I also assumed that sorting the books by the various data points did not change their rank. The sorting functionality was merely for visual presentation.

-   Display a detail page with at least 3 points of data to display

> The data points returned by openlibrary vary by book, so I tried to display as many of them as possible to make sure most books have at least three displable data points.

-   Include unit tests

> I have used unit testing only sparsely in the past, so instead of including embarassing unit tests with this project, I spent some time learning more about phpUnit. I look forward to adding the skill to my set.

-   Deploy it on the cloud - be prepared to describe your process on deployment

## Deployment

#### I have a shared hosting server with a few domains on it, so chose to deploy to that server.

-   ssh into server
-   clone the github repository
-   composer install
-   My cloud server has this cool feature where it doesn't run node, so the repository includes the compiled js and css. Sounds like a great reason to use docker, but the server has this other cool feature where it won't let me run docker. Also, docker is one of the technologies I am learning and experimenting with this year.
-   create a symlink to the public directory of the laravel app
-   the server has phpMyAdmin on it, so I created the database using it
-   run artisan migrate
-   the github repository does not include the .env file, so I uploaded that in my ssh session
-   I then editted the .env to have the correct db credentials
-   and just like that, I was able to discover books and add them to my long reading list

## Editted local bash history for this project

-   composer create-project --prefer-dist laravel/laravel boojybooks
-   composer install
-   composer require guzzlehttp/guzzle
-   composer require laravel/ui --dev
-   php artisan ui vue --auth
-   npm install
-   npm run dev
-   php artisan migrate
-   git init
-   git remote origin https://github.com/marallyn/boojybooks.git
-   git push
    > I setup the cloud server here, to make sure that it and I were on the same page. (this would be a good place for a docker ad)
-   various artisan make:model Model -mrc commands
-   various artisan migrate commands
-   npm run prod
-   another git push

## Editted remote bash history for this project

-   git clone https://github.com/marallyn/boojybooks.git
-   composer install
-   ln -s /path/to/public/dir boojybooks
