<!-- 1. Make Middleware -->
php artisan make:middleware Lang

<!-- 2. In Lang Middleware -->
if ($request->lang <> '') {
            app()->setLocale($request->lang);
        }else{
            app()->setLocale('ar');
        }


<!-- 3. In File Kernal.php -->
'Lang' => \App\Http\Middleware\Lang::class,

<!-- In File Web.php -->
Route::group(['prefix'=>'/{lang}','middleware' => 'Lang'] , function() {
  Route::get('/' ,'HomeController@lang');
  Route::get('/', 'HomeController@index')->name('home');
  

});

<!-- 5. In Controller File  -->
    public function lang($lang) {
        if (isset($lang) && !empty($lang)) {
            Session::put('lang' , $lang);
        } else {
            Session::put('lang' , 'en');
        }
        return back();
    }
