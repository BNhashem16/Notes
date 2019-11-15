<!-- Create A new Project -->
composer create-project --prefer-dist laravel/laravel Project_Name
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
