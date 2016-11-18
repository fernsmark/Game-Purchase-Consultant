CONTENTS OF THIS FILE
-------------------------
   
 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Modules/Libraries Used
 * Troubleshooting
 * FAQ
-------------------------

INTRODUCTION
---------------------

Historical prices of videogames change over time. This web page which takes the market trends into account will provide feedback to a potential retro videogame buyer on whether he/she would buy a game or not. The games are evaluated in terms of its market price every 1 month. So the price changes over time. Sometimes a game in its current market price would be a good purchase if the game has a trend of price increase. At the same time an overpriced game would not be a good purchase. A game priced near its market value but with a trend of price fall, would also not be a very wise purchase. 
The system makes recommendations based on:- 
(i) whether the collector already owns the game or not 
(ii) whether the game is sold at the market value, lower or higher than this and 
(iii) the trending price of the game based on historical data. 


REQUIREMENTS
------------

This web applicarion requires the following configuration:-
(i) Server site or the location from where the website is hosted:
Web Server: Apache, Nginx, or Microsoft IIS
Database: MySQL 5.0.15 or higher
PHP: PHP 5.2.5 or higher (5.4 or higher recommended)
Disk Space: Minimum 15 MB

To setup a windows web development environment for MySQL, PHP databases, kindly refer to and install WAMP Server (http://sourceforge.net/projects/wampserver).

(ii) Client site or the user's system requirements:
Microsoft Edge(Recomended)
Google Chrome
Opera 12 and later
Firefox 5.x and later
Internet Explorer 6.x and later

------------


INSTALLATION
------------

The WAMP installation as stated before should be A NEW installation locally before proceeding.
The project files(game-on.rar) have to be extracted in the www folder of wamp installation folder (eg.: C:\wamp\www\)
Access the website localy by visiting the following URL in the web browser (http://localhost/)

------------


CONFIGURATION
-------------

To set up the initial state of the website database, the sql file (gaming.sql) needs to be imported to the database. Go to the phpMyAdmin URL (http://localhost/phpmyadmin/sql.php). Go to Import >> File to Import >> choose gaming.sql and click 'Go'.

User Configuration
-------------
There are three types of users: Anonymous, Authenticated and Administrator.
Any unregistered visitor is considered as an Anonymous user and will only be able to browse through the games and its trends in the web application
A registered user is an Authenticated user and will be able to add games and view the pediction based on the users preference, etc.
The Administrator will be able to have complete control over the web application and will be able to accept registration request form an anonymous user and predict NULL values for missing game information in the database.

Administrator Login details:-
Username: jubinsanghvi
Password: james@786

Authenticated User login details:-
Username: markfernandes
Password: mark@123

-------------


MODULES/LIBRARIES USED 
----------------------


Drupal CMS used for website css management and design. Cron jobs scheduled within Drupal to retrieve the prices of all the games defined with the application. When the job executes, the price of the games are scraped from (http://videogames.pricecharting.com) for the current month and stored in database as historical data and future price predicting.
A PHP Simple HTML DOM Parser (http://simplehtmldom.sourceforge.net) which helps in HTML manipulation, for implementing scraping current month price.

----------------------


TROUBLESHOOTING
---------------

* If the website does not load and displays a 'Page not found' or equivalent error message, make sure that the WAMP server is application is started before visiting (http://localhost) or any other webpage of this application.


FAQ
---
Q: I am unable to view the trends graph in my game collection, what should I do?
A: You will need a working internet connection in order for the trend graph to the created on the fly.

Q: I am unable to view the calander under 'Add to your collection'
A: Make sure you check the browser requirements as stated before. It is suggested to use Google Chrome/Opera/Microsoft Edge as they support supplementary HTML5 technology.

Q: I am unable to view additional popup messages/ validation messages while operating the website.
A: Check whether JavaScript is enable in the browser that is used to access this web application.

---------------