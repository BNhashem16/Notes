<!-- In app\Providers\AppServiceProvider.php -->
use Illuminate\Support\Facades\Schema;


public function boot() {
  Schema::defaultStringLength(191);
}
<!-- In app\Providers\BroadcastServiceProvider.php -->
use Illuminate\Support\Facades\Schema;


public function boot() {
  Schema::defaultStringLength(191);
}
