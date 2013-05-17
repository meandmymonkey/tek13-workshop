Example Application for php[tek] 2013
======================================

This is the application used for the workshop "An Overview of Symfony2 for Beginners" at php[tek] 2013.

Installation
------------

- Clone this repository
- In the base directory, install Composer:

    curl -s http://getcomposer.org/installer | php

- Use Composer to install vendor libraries

    php composer.phar install

- Copy app/config/parameters.yml.dist to app/config/parameters.yml
- Edit parameters.yml to add your database credentials

After that is done, load the demo data:

    php app/console doctrine:database:create
    php app/console doctrine:schema:create
    php app/console doctrine:fixtures:load

The demo code can be found in arc/Acme/ConferenceBundle. The demo app will be accessible at

    http://[localdomain]/app_dev.php/conference/

Enjoy!

