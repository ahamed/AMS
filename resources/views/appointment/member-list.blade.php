@extends('layouts.app')
@section('title','Dashboard | Smart Appointment')
@section('content')
    <div class="container">
        <div class="row" >
            <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-title">
                            Members at <span id="comp"></span>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <select name="institute" id="ins" class="form-control select2">
                                <option value="">Select a company</option>
                                @foreach($institutes as $ins)
                                    <option value="{{$ins->institute}}">{{$ins->institute}}</option>
                                @endforeach
                            </select>
                        </div>
                        <table class="table table-bordered" id="my-table">
                            <thead>
                                <tr id="heading">

                                </tr>
                            </thead>
                            <tbody id="tbd">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')
   {{-- <script>
        $(document).ready(function(){

        });
    </script>--}}
   <script>
       $(document).ready(function(){

           $('.select2').select2({
               theme: "bootstrap",
               allowClear: true,
               tags: true,
               maximumSelectionLength: 5,
               width: '100%'
           });
           $('#ins').on('change',function(e){
               e.preventDefault();

               var ins = $(this).val();
               $('#comp').text(ins);
               var i = 0;
               $.ajax({
                   type: 'GET',
                   url: '/deo-member-list/'+ins,
                   dataType: 'json',
                   success : function(data){
                       console.log(data);
                       if(Object.keys(data).length > 0){
                           $("#heading").append($('<th>',{
                               text: '#'
                           }));
                           $("#heading").append($('<th>',{
                               text: 'Name'
                           }));
                           $("#heading").append($('<th>',{
                               text: 'Mobile'
                           }));
                           $("#heading").append($('<th>',{
                               text: 'Email'
                           }));

                           for( i = 0; i < Object.keys(data).length; i++){
                               var tr = $('#tbd').append($('<tr>'));
                               tr.append($('<td>',{
                                   text: (i+1)
                               }));
                               tr.append($('<td>',{
                                   text: data[i].name
                               }));
                               tr.append($('<td>',{
                                   text: data[i].mobile
                               }));
                               tr.append($('<td>',{
                                   text: data[i].email
                               }));
                           }
                       }

                    $('#my-table').DataTable();
                   }
               });

           });

       });
   </script>
@endsection
