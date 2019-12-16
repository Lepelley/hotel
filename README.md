# Hotel

## Configure
- rename config_rename.php to config.php and set your databases
- you can change the port but you should impact it on the command line to run the server

## Run the server
Type on a terminal : 
php -S localhost:8000 -t public

## Commands
Run PHP Code Sniffer :
vendor/bin/phpcs

Run PHP Code Beautifier and Fixer :
vendor/bin/phpcbf

Add a administrator (update the add_admin.php file) and execute it using on the folder project : 
php add_admin.php
