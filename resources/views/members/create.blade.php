@extends('layouts.app')

@section('title','Create Member')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/required-field.css')}}">
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1 col-sm-8 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h2 class="box-title">Create Member <strong class="text-orange">({{ ucfirst(Auth::user()->institute) }})</strong></h2>
                    </div>
                    <form action="{{ url('set-member') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group required-field-block" id="mb">
                                <label for="mobile" class="col-sm-2 control-label">Mobile</label>
                                <div class="col-sm-10">
                                    <input pattern="[0-9]{11}" type="text" name="mobile" class="form-control" id="mobile" required>
                                    <div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
                                    <span id="alert-msg" style="color: red; display: none;"> &times; The mobile number only allowed digits from 0-9</span>
                                </div>

                            </div>
                            <div class="form-group required-field-block">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="name" required>
                                    <div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
                                </div>


                            </div>


                            <div class="form-group">
                                <label for="designation" class="col-sm-2 control-label">Designation</label>
                                <div class="col-sm-10 required-field-block">
                                    <input type="text" name="designation" class="form-control" id="designation" required>
                                    <div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group required-field-block">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="email">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Address" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea name="address" id="address" class="form-control" cols="30" rows="6"></textarea>

                                </div>

                            </div>
                            <div class="form-group">
                                <label for="image_link" class="col-sm-2 control-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image_link" class="form-control" id="image_link">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="institute" class="col-sm-2 control-label"></label>
                                <div class="col-sm-3">
                                    <input type="submit" name="save" class="btn btn-success btn-block" id="save" value="Create">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection


@section('scripts')
    <script>
        $(function() {
            $('.required-icon').tooltip({
                placement: 'left',
                title: 'Required field'
            });

            $('#mobile').on('keyup',function(e){
               e.preventDefault();
               var reg = "^[0-9]*$";
               var mobile = $(this).val();
               if(!mobile.match(reg)){

                   $('#alert-msg').show('slow');
                   $('#mb').addClass('has-error');
               }else{

                   $('#alert-msg').hide('slow');
                   $('#mb').removeClass('has-error');
               }

               if(mobile.length == 11){
                   $.ajax({
                       type: 'GET',
                       url : '/get-member/'+mobile,
                       dataType : 'json',
                       success : function(data){
                           console.log(data);
                           if(data != null){
                               //console.log(data.name);
                               $('#name').val(data.name);
                               $('#designation').val(data.designation);
                               $('#email').val(data.email);
                               $('#address').val(data.address);
                           }else{
                               $('#name').val("");
                               $('#designation').val("");
                               $('#email').val("");
                               $('#address').val('');
                           }
                       }
                   });
               }else{
                   $('#name').val("");
                   $('#designation').val("");
                   $('#email').val("");
                   $('#address').val('');
               }

            });
        });

    </script>

@endsection