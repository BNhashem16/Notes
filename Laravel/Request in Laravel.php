    public function store(Request $request)
    {
        $name = $request->input('name');

        //
    }


<!-- Request Path & Method -->
$uri = $request->path();
$url = $request->fullUrl();
$method = $request->method();

<!-- Retrieving Input -->
You may also retrieve all of the input data as an array using the all method:
$input = $request->all();
--------------------------------
the input method may be used to retrieve user inpu
$model->name = $request->input('name');
$model->name = $request->name;
--------------------------------
You may pass a default value as the second argument to the input method. 
$model->name = $request->input('name', 'Sally');
--------------------------------
When working with forms that contain array inputs
$name = $request->input('products.0.name');
$names = $request->input('products.*.name');
--------------------------------
Retrieving JSON Input Values
$name = $request->input('user.name');
--------------------------------
Retrieving A Portion Of The Input Data
$input = $request->only(['username', 'password']);

$input = $request->only('username', 'password');

$input = $request->except(['credit_card']);

$input = $request->except('credit_card');