<!-- 1. Install consoletvs/charts  package in Laravel 5.7 -->
composer require consoletvs/charts:6.*
<!-- 2.Open config/app.php  -->
'providers' => [
	....
	ConsoleTVs\Charts\ChartsServiceProvider::class,
],
'aliases' => [
	....
	'Charts' => ConsoleTVs\Charts\Facades\Charts::class,
],


3. php artisan vendor:publish --tag=charts_config


<!-- 4. In Web.php -->
Route::get('chart', 'ChartController@index')
<!-- 5. Create A Controller -->
php artisan make:controller ChartContoller
<!-- 6. In Controller -->
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Charts;
use App\User;
use DB;

class ChartController extends Controller
{
    //
    public function index()
    {
    	$users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
    				->get();
        $chart = Charts::database($users, 'bar', 'highcharts')
			      ->title("Monthly new Register Users")
			      ->elementLabel("Total Users")
			      ->dimensions(1000, 500)
			      ->responsive(false)
			      ->groupByMonth(date('Y'), true);
        return view('chart',compact('chart'));
    }
}
// 7 create a new view

// FeedBack
https://charts.erik.cat/installation.html#composer