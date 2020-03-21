<!-- In Web.php -->
Route::delete('/sales/deleteAll', 'backend\SalesController@deleteAll')->name('deleteAll') ;

<!-- In Controller -->
    public function deleteAll(Request $request)
    {
    	use DB;
    	
        $ids = $request->ids;
        DB::table("sales")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Sales Deleted successfully."]);
    }

<!-- In View HTML Code -->
<meta name="csrf-token" content="{{ csrf_token() }}">


<button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ route('deleteAll') }}">Delete All Selected</button>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>
                <label class="mt-checkbox">
                    <input type="checkbox" id="master">
                    <span></span>
                </label>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $key=>$data)
            <tr id="tr_{{$data->id}}">
                <th>
                    <label class="mt-checkbox">
                        <input type="checkbox" class="sub_chk" data-id="{{$data->id}}">
                        <span></span>
                    </label>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
<!-- In View Ajax Code -->
 <script type="text/javascript">
        $(document).ready(function () {
            $('#master').on('click', function(e) {
                if($(this).is(':checked',true))
                {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked',false);
                }
            });

            $('.delete_all').on('click', function(e) {
                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });

                if(allVals.length <=0)
                {
                    alert("Please select row.");
                }  else {

                    var check = confirm("Are you sure you want to delete this row?");
                    if(check == true){
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });

                        $.each(allVals, function( index, value ) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });

            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.trigger('confirm');
                }
            });


            $(document).on('confirm', function (e) {
                var ele = e.target;
                e.preventDefault();


                $.ajax({
                    url: ele.href,
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        if (data['success']) {
                            $("#" + data['tr']).slideUp("slow");
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });


                return false;
            });
        });
    </script>