## Quiz App Project

This is my quiz application project that I developed using laravel and jetstream.
In this application, quizzes and questions created by people whose user type is admin are created for other users to solve. Users who solve the exam get points according to the number of correct questions and are ranked among themselves.

#### Programs that must be installed on your computer

-   WAMP Server etc.
-   Laravel
-   Composer
-   NodeJS

### How To Use?

After downloading the source codes or cloning the repostory, navigate to the relevant folder with terminal.
Example:

    cd Downloads/laravel-jetstream-quizapp

You need to specify your local database and password in the .env.example file using a code editor.

Create a database named "quizapp" on your local server.
Then run the following commands one after the other.

    npm install
    php artisan migrate --seed
    php artisan serve
    npm run watch

Your default admin email is "example@admin.com" and password is "password". After registering, you can give admin authority to your account using this information.

That is all! Now click on <a href="http://localhost:8000" target="_blank" rel="noreferrer">localhost</a> and try application.
