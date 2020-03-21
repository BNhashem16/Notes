<!-- Generate Application Key -->
php artisan key:generate
php artisan config:cache
<!-- In Controller -->
use Validator;
use Redirect;
use Response;

public function store(Request $request)
    {  
        request()->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required'
        ]);
        
        $data = $request->all();
        $result = Contact::insert($data);
        $arr = array('msg' => 'Something went wrong. Please try again!', 'status' => false);
        if($result){ 
        	$arr = array('msg' => 'Contact Added Successfully!', 'status' => true);
        }
        return Response()->json($arr);
      
    }
<!-- In blade.php -->
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Laravel 5.8 Ajax Form Submit with Validation - W3Adda</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
  <style>
   .error{ color:red; } 
  </style>
</head>
 
<body>
 
<div class="container">
    <h2 style="margin-top: 10px;">Laravel 5.8 Ajax Form Submit with Validation - W3Adda</h2>
    <br>
    <br>
   
    <form id="contact_us" method="post" action="javascript:void(0)">
        <div class="alert alert-success d-none" id="msg_div">
              <span id="res_message"></span>
         </div>
      
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Please enter name">
        <span class="text-danger">{{ $errors->first('name') }}</span>
      </div>
      <div class="form-group">
        <label for="email">Email Id</label>
        <input type="text" name="email" class="form-control" id="email" placeholder="Please enter email id">
        <span class="text-danger">{{ $errors->first('email') }}</span>
      </div>      
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" class="form-control" id="phone" placeholder="Please enter mobile number" maxlength="10">
        <span class="text-danger">{{ $errors->first('phone') }}</span>
      </div>
      <div class="form-group">
       <button type="submit" id="send_form" class="btn btn-success">Submit</button>
      </div>
    </form>
 
</div>
<script>
   if ($("#contact_us").length > 0) {
    $("#contact_us").validate({
     
    rules: {
      name: {
        required: true,
        maxlength: 50
      },
 
       phone: {
            required: true,
            digits:true,
            minlength: 10,
            maxlength:12,
        },
        email: {
                required: true,
                maxlength: 50,
                email: true,
            },    
    },
    messages: {
       
      name: {
        required: "Please enter name",
        maxlength: "Name should be 50 characters long."
      },
      phone: {
        required: "Please enter contact number",
        minlength: "The contact number should be 10 digits",
        digits: "Please enter only numbers",
        maxlength: "The contact number should be 12 digits",
      },
      email: {
          required: "Please enter valid email",
          email: "Please enter valid email",
          maxlength: "The email name should less than or equal to 50 characters",
        },
        
    },
    submitHandler: function(form) {
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $('#send_form').html('Sending..');
      $.ajax({
        url: "{{ url('jquery-ajax-form-submit-validation')}}" ,
        type: "POST",
        data: $('#contact_us').serialize(),
        success: function( response ) {
            $('#send_form').html('Submit');
            $('#res_message').show();
            $('#res_message').html(response.msg);
            $('#msg_div').removeClass('d-none');

            document.getElementById("contact_us").reset(); 
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },10000);
        }
      });
    }
  })
}
</script>
</body>
</html>




https://www.w3adda.com/blog/laravel-5-8-jquery-ajax-form-submit-with-validation