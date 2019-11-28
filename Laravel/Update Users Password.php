<!-- 1. Create Custom Validation Rule -->
php artisan make:rule MatchOldPassword
<!-- 2. app/Rules/MatchOldPassword.php -->
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

    public function passes($attribute, $value)
    {
        return Hash::check($value, auth()->user()->password);
    }

    public function message()
    {
        return 'The :attribute is Not match with old password.';
    }

<!--3. Create Routes -->
Route::resource('/users/change-password' , 'backend\ChangePasswordController');

4.Create New Controller ChangePasswordController

<!-- 5. In app/Http/Controllers/ChangePasswordController.php -->
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;


    public function edit($id)
    {
        $users = User::find($id);
        return view('backend.users.changePassword')->with('users' , $users);
    }

        public function update(Request $request, $id)
    {
        $users = User::find($id);
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        $users->password = Hash::make($request->input('new_password'));
        $users->save();
        Session::flash('success' , 'Password Changed Successfully');
        return Redirect::to('admin/users');
    }

<!-- 6. -->
@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('users.index')}}">Users</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Edit</span>
                    </li>
                </ul>
            </div>
            <h3 class="page-title">Edit User</h3>
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light form-fit bordered">
                        <div class="portlet-body form">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error) <li style="list-style: none;"> {{ $error }} </li> @endforeach
                                    </ul>
                                </div>
                            @endif
                        <!-- BEGIN FORM-->
                            {!! Form::model($users , ['route' => ['change-password.update',$users->id] , 'method' => 'PATCH' , 'files'=>true ,'class' => 'form-horizontal']) !!}
                                <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Current Password</label>
                                    <div class="col-md-4">
                                        <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">New Password</label>
                                        <div class="col-md-4">
                                            <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Confirm New Password</label>
                                        <div class="col-md-4">
                                            <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                        </div>
                                    </div>


                                </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">

                                            <button type="submit" class="btn btn-circle green">Submit</button>
                                            <a href="{{route('users.index')}}" class="btn btn-circle btn btn-outline grey-salsa">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            {!! Form::Close() !!}
                            <!-- END FORM-->
                            </div>
                        </div>
                        <!-- END PORTLET-->
                    </div>
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
        @endsection
        @extends('backend.layouts.app')
