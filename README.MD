# Pilulka.cz twitter demo application

# How to run the application
You will need webserver with PHP 8 running. Configure it to access "public" folder of the application structure.

Also you need to install composer dependencies via "composer install".


To access Twitter API, you need to have the following environment variables set (e.g. in .env file):

consumerKey=

consumerSecret=

oauthToken=

oauthTokenSecret=


You can rebuild symfony cache using "symfony console cache:clear"

# How to use the application

In browser, open localhost url and you should see index page of this application, that contains list of tweets. 

You can append ?format=json to get JSON response instead of nice user page.

# Tests

Tests are in "tests" folder. Currently, there is only one demo test, it would be better to write more tests :)

