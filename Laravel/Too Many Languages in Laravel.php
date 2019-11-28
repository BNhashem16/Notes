1. Create A Model With migration
	php artisan make:model Language -m 
2. In Migration File
	$table->bigIncrements('id');
    $table->string('name');
    $table->string('short_code');
    $table->string('image')->nullable();
    $table->string('active')->default('0');
    $table->integer('created_by')->nullable();
    $table->integer('updated_by')->nullable();

3. In Model File
	class Language extends Model
{
    protected $fillable = ['name', 'active', 'short_code', 'created_by', 'updated_by'];

}

4. Create A New Controller
	php artisan make:controller LanguageController --resorce

5. In LanguageController
    public function store(Request $request)
    {
      try {
          $lang = new Language;
          $lang->name = $request->input('name');
          $lang->short_code = $request->input('short_code');
          $lang->active = $request->input('active');
          $lang->updated_by = Auth::user()->id;
          $lang->save();
          Session::flash('success', 'Language Updated Successfully');
          return Redirect::to('dashboard/lang');
      } catch (\Exception $e) {
          Session::flash('error', 'Language Not Updated');
          return Redirect::back();
      }

    }

    public function update(Request $request, $id)
    {
        try {
            $lang = Language::where('id',$id)->first();
            $lang->name = $request->input('name');
            $lang->short_code = $request->input('short_code');
            $lang->active = $request->input('status');
            $lang->updated_by = Auth::user()->id;
            $lang->save();
            Session::flash('success', 'Language Updated Successfully');
            return Redirect::to('dashboard/lang');
        } catch (\Exception $e) {
            Session::flash('error', 'Language Not Updated');
            return Redirect::back();
        }
    }

    public function destroy(Language $lang){
      $lang->delete();
      return Session::flash('success' ,'Record deleted successfully!');
    }

6. Make A New Middleware
	php artisan make:middleware Lang

7. In Lang Middleware
    public function handle($request, Closure $next)
    {
      if ($request->lang <> '') {
            app()->setLocale($request->lang);
        }else{
            app()->setLocale('en');
        }
        return $next($request);
    }

8. In Kernal File 
    protected $routeMiddleware = [
        'Lang' => \App\Http\Middleware\Lang::class,
    ];

9. In Route File "Web.php"
Default Page
Route::get('/',function(){ return redirect()->to('/en'); });
============ Create Prefix ======================
Route::group(['prefix'=>'{lang?}','middleware' => 'Lang'] , function() {
	<!-- Route::get('news', 'frontend\NewsController@index'); -->
});

10. In Front End Controllers 
--> in Any Function , we Will Put
    public function sub_news($lang) {
      return view('frontend.sub_news')->with('news' , $news);
    }

11. In View 
	$app->getLocale()


	          <li class="lihasdropdown drop-left">
                        <a href="">
                         @if(app()->getLocale() == 'ar') <img src="{{url('frontend/assets/images/egy.jpg')}}" width="20">
                         @else <img src="{{url('frontend/assets/images/us.jpg')}}" width="20">
                         @endif
                          </a>
                          <ul class="menu-dropdown">
                            @foreach( App\Language::where('active' , 1)->get() as $lan)
                              @if($lan->short_code != app()->getLocale())
                                <li>
                                  <a class="flg_a" title="{{$lan->short_code}}" href="{{url('/'.$lan->short_code)}}">
                                    <img src="{{url($lan->image)}}">
                                  </a>
                                </li>
                              @endif
                            @endforeach
                          </ul>
                      </li>