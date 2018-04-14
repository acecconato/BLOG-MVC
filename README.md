# Personal blog - Anthony Cecconato

This is my project number 5 of the OpenClassrooms course. The goal was to create a blog with a system of articles, comments and administration. The code had to be made in object-oriented PHP with an MVC architecture and it was forbidden to use external resources without using Composer.

## Requirements

- At least **PHP 7.1**
- **Web server** (Apache + PHP + SQL)
- **Composer** ([Download here](https://getcomposer.org/))

## Installation

_I will not explain step by step how to do on all operating system, but overall it remains the same._
_If you are not sure about the web server, you can use [XAMPP](https://www.apachefriends.org/index.html) which is compatible on all OS._

 1. Clone or download the repository
 2. Place content in your web server
 3. Go to the project directory and run the command : `composer install`
 4. Import the `_SQL/database_skeleton.sql` file into your database
 5. Import the `_SQL/example_data_set.sql` file into your database
 6. Open the file `App/Config/config.yaml` then configure the connection to the database
 7. Everything should be good !

### If you have any problems

- If the directory is not at the root of your server, try creating a subdomain or virtual host
- Check that `mod_rewrite` is enabled on your server for `.htaccess`
