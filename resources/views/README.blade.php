@extends('layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
        <h3 class="card-header bg-info">
            Booj Reading List
        </h3>

        <div class="card-body">
            <h4 class="card-title">
                A technical assessment completed by Jeff Martin on 2/17/2020
            </h4>

            <h2 id="task">Task</h2>
            <p>Compose a site using the <a href="https://laravel.com/">Laravel</a> or Vue framework that allows the user to create a list of books they would like to read. Users should be able to perform the following actions:</p>

            <blockquote>
            <p>
                Use of the word <em>"user"</em> above made me think of authenticated users, so I used Laravel's built in auth feature to register and login users. I created a demo account with username 'demo@boojybooks.com' and password 'boojybooks' if you want to bypass the registration process.
            </p>
            </blockquote>

            <ul>
            <li>Create Postman collection and Vue app OR Laravel App</li>
            </ul>
            <blockquote>
            <p>I chose the <em>Laravel</em> framework, since I have more experience with it</p>
            </blockquote>
            <ul>
            <li>Connect to a publically available API</li>
            </ul>
            <blockquote>
            <p>openlibrary.org showed up first in a Google search, so I chose to use it</p>
            <p>There was no metion in the project specification of how the user discovered books to add to their list, so I decided to start with a search page.</p>
            <p>It turns out there is a lot of information about a book, and open library returns a varying number of data points about the them. I am not an expert in ISBNs and the like, so I chose isbn_13 as my unique identifier for a book, as it seems be pretty consistently returned.</p>
            </blockquote>
            <ul>
            <li>Add or remove items from the list</li>
            <li>Change the order of the items in the list</li>
            </ul>
            <blockquote>
            <p>I took this to mean that the list has a rank for each book, and books can be moved up or down in rank. The rank is separate from sorting on the other data points.</p>
            </blockquote>
            <ul>
            <li>Sort the list of items</li>
            </ul>
            <blockquote>
            <p>I chose to do this on the front end using datatables. I also assumed that sorting the books by the various data points did not change their rank. The sorting functionality was merely for visual presentation.</p>
            </blockquote>
            <ul>
            <li>Display a detail page with at least 3 points of data to display</li>
            </ul>
            <blockquote>
            <p>The data points returned by openlibrary vary by book, so I tried to display as many of them as possible to make sure most books have at least three displable data points.</p>
            </blockquote>
            <ul>
            <li>Include unit tests</li>
            </ul>
            <blockquote>
            <p>I have used unit testing only sparsely in the past, so instead of including embarassing unit tests with this project, I spent some time learning more about phpUnit. I look forward to adding the skill to my set.</p>
            </blockquote>
            <ul>
            <li>Deploy it on the cloud - be prepared to describe your process on deployment</li>
            </ul>
            <h2 id="deployment">Deployment</h2>
            <h4 id="i-have-a-shared-hosting-server-with-a-few-domains-on-it-so-chose-to-deploy-to-that-server-">I have a shared hosting server with a few domains on it, so chose to deploy to that server.</h4>
            <ul>
            <li>ssh into server</li>
            <li>clone the github repository</li>
            <li>composer install</li>
            <li>My cloud server has this cool feature where it doesn&#39;t run node, so the repository includes the compiled js and css. Sounds like a great reason to use docker, but the server has this other cool feature where it won&#39;t let me run docker. Also, docker is one of the technologies I am learning and experimenting with this year.</li>
            <li>create a symlink to the public directory of the laravel app</li>
            <li>the server has phpMyAdmin on it, so I created the database using it</li>
            <li>run artisan migrate</li>
            <li>the github repository does not include the .env file, so I uploaded that in my ssh session</li>
            <li>I then editted the .env to have the correct db credentials</li>
            <li>and just like that, I was able to discover books and add them to my long reading list</li>
            </ul>
            <h2 id="editted-local-bash-history-for-this-project">Editted local bash history for this project</h2>
            <ul>
            <li>composer create-project --prefer-dist laravel/laravel boojybooks</li>
            <li>composer install</li>
            <li>composer require guzzlehttp/guzzle</li>
            <li>composer require laravel/ui --dev</li>
            <li>php artisan ui vue --auth</li>
            <li>npm install</li>
            <li>npm run dev</li>
            <li>php artisan migrate</li>
            <li>git init</li>
            <li>git remote origin <a href="https://github.com/marallyn/boojybooks.git">https://github.com/marallyn/boojybooks.git</a></li>
            <li>git push<blockquote>
            <p>I setup the cloud server here, to make sure that it and I were on the same page. (this would be a good place for a docker ad)</p>
            </blockquote>
            </li>
            <li>various artisan make:model Model -mrc commands</li>
            <li>various artisan migrate commands</li>
            <li>npm run prod</li>
            <li>another git push</li>
            </ul>
            <h2 id="editted-remote-bash-history-for-this-project">Editted remote bash history for this project</h2>
            <ul>
            <li>git clone <a href="https://github.com/marallyn/boojybooks.git">https://github.com/marallyn/boojybooks.git</a></li>
            <li>composer install</li>
            <li>ln -s /path/to/public/dir boojybooks</li>
            </ul>
        </div>
    </div>
</div>
@endsection
