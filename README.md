Artur Butov Simple shop application
========================

Deployment instructions:

1. Update database parameters in app/config/parameters.yml
2. Go to application directory using command line
3. Copy 'php composer.phar update' to terminal to install required dependencies for application to run
4. Copy 'php bin/console doctrine:database:create' to terminal to create database
5. Copy 'php bin/console doctrine:schema:update --force' to terminal to create tables in newly created database
6. Run SQL queries on your database located in data.sql to insert dummy data
7. Copy 'php bin/console server:run' to run application
8. Enjoy!