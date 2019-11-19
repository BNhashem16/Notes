1. composer require maatwebsite/excel
2. 'providers' => [
 ....

 Maatwebsite\Excel\ExcelServiceProvider::class,

],

'aliases' => [

 ....

 'Excel' => Maatwebsite\Excel\Facades\Excel::class,

],

3. php artisan vendor:publish
4. php artisan queue:table
5. php artisan migrate
6. php artisan make:job Jop_Name
7. php artisan make:import ImportEmployee --model=Empolyee
8. php artisan queue:work

<!-- Export Data -->
php artisan make:export ImportEmployee --model=Empolyee
<!-- FeedBack -->
https://www.webslesson.info/2019/06/how-to-import-export-csv-file-data-in-laravel-58.html
https://docs.laravel-excel.com/3.1/getting-started/