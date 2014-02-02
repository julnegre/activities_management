-- DESCRIPTION --

Manage your business activities. Useful for example when you have to give a monthly report to your client.

-- SPECIFICATIONS --

html5, responsive, multi-user support
based on symfony 2.4.1 with FOSUser Bundle
minimalistic theme (cf. http://purecss.io)
CRUD activities, tasks, customers, business and activity storage
export to webcal (see yours activities automatically in your google agenda)
export to xls with a defined template
see a countdown for activities started
see your activities monthly and select the period you want
see through a pie chart your daily, monthly or yearly activities
-- TODO --

administration panel
upload your own xls template
-- INSTALL --

cd /var/www/

sudo apt-get install curl

curl -s https://getcomposer.org/installer | php

git clone https://github.com/julnegre/activities_management.git

cd activities_management

rm -rf app/cache/*

rm -rf app/logs/*

sudo setfacl -R -m u:www-data:rwx -m u:whoami:rwx app/cache app/logs

sudo setfacl -dR -m u:www-data:rwx -m u:whoami:rwx app/cache app/logs

php composer.phar update

php app/console doctrine:database:create

php app/console doctrine:schema:update --force