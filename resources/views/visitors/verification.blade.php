@extends('layouts.app')
@section('title','Varification | Smart Appointment')
@section('content')
    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-8 col-md-offset-2 col-sm-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title">Verification</div>
                    </div>
                    <div class="box-body">
                        @if(Session::get('errMsg') != '')
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Error!</strong> {{Session::pull('errMsg','')}}
                            </div>
                        @endif
                        <form action="{{url('setVerify')}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="vcode" class="control-label col-sm-4 col-md-4">Enter 6 digit Verification Code sent on {{$mobile}}</label>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" name="vcode" class="form-control">
                                    <input type="hidden" name="mobile" value="{{$mobile}}">
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <input type="submit" class="btn btn-success" value="Verify">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function(){

        });
    </script>

@endsection