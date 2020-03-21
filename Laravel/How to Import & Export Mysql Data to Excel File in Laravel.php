1. composer require maatwebsite/excel
2. 'providers' => [
 ....

 Maatwebsite\Excel\ExcelServiceProvider::class,

],

'aliases' => [

 ....

 'Excel' => Maatwebsite\Excel\Facades\Excel::class,

],

3. php artisan vendor:publish	=> 8
4. php artisan queue:table
5. php artisan migrate
6. php artisan make:import ImportEmployee --model=Empolyee
	use Illuminate\Contracts\Queue\ShouldQueue;
	use Maatwebsite\Excel\Concerns\Importable;
	use Maatwebsite\Excel\Concerns\WithChunkReading;


		class ImportSales implements ToModel, WithChunkReading, ShouldQueue
	{
	    use Importable;
	    /**
	    * @param array $row
	    *
	    * @return \Illuminate\Database\Eloquent\Model|null
	    */
	    public function model(array $row)
	    {
	        return new Sale([
	            //
	        ]);
	    }
	}



7. php artisan make:job Jop_Name
	use Maatwebsite\Excel\Concerns\ToModel;
	use Maatwebsite\Excel\Concerns\WithChunkReading;
	use Maatwebsite\Excel\Facades\Excel;
	use Maatwebsite\Excel\Concerns\Importable;

	class Jop_Name implements ToModel , WithChunkReading, ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels , Importable;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        Excel::import(new ImportEmployee, request()->file('file'));
    }

    public function model(array $row)
    {
        return new Empolyee([
            'name'     => $row[0],
            'email'    => $row[1],
            'age'      => $row[2],
            'phone'    => $row[3],
        ]);
    }

    public function chunkSize(): int
    {
        return 10;
    }
}






<!-- Export Data -->
php artisan make:export ExportSale --model=Sale

<!-- Web.php -->
	#Import Route
		Route::get('import', 'ExelController@index');
		Route::post('import/file', 'ExelController@import')->name('import');
	#Export Route
		Route::get('export', 'ExelController@export')->name('export');

<!-- Controller -->
	--> Import
use App\Empolyee;
use App\Exports\ImportEmployee;
use App\Jobs\EmployeeJop;
use Maatwebsite\Excel\Facades\Excel;


    public function index()
    {
        $data = Empolyee::paginate();
        return view('exel')->with('data', $data );
    }

    public function import()
    {
        (new EmployeeJop)->queue('D:\empolyee.xlsx');
        return back();
    }

	--> Export
	use Maatwebsite\Excel\Facades\Excel;
	use App\Exports\ImportEmployee;

	    public function export()
    {
        return Excel::download(new ImportEmployee, 'empolyee.xlsx');
    }

    <!-- In View -->
			<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" accept=".xlsx">
                <br>
                <button class="btn btn-success">Import User Data</button>
                <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>
            </form>

    <!-- In Model -->
        protected $fillable = [
        '....', '...', '...'];
8. php artisan queue:work
<!-- FeedBack -->
https://www.webslesson.info/2019/06/how-to-import-export-csv-file-data-in-laravel-58.html
https://docs.laravel-excel.com/3.1/getting-started/