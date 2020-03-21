<!-- Create A new Project -->
composer create-project --prefer-dist laravel/laravel blog
<!-- To migrate Tables -->
php artisan migrate
<!-- Create Model & migrate it  -->
php artisan make:model Model_Name -m
<!-- Make A Controller with Functions -->
php artisan make:controller folder/NameController --resource
<!-- Show the List of Routes -->
php artisan route:list
<!-- To Refresh Database -->
php artisan make:migration refresh


php artisan cache:clear
php artisan config:clear 
php artisan queue:restart
php artisan route:clear

php artisan cache:table


php artisan queue:work