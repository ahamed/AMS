@extends('layouts.app')
@section('title','Dashboard | Smart Appointment')
@section('styles')
    <style>
        .filter-option{
            color: black;
            font-size: 15px;
        }
        .text{
            color: black;
            font-size: 13px;
        }
    </style>

@endsection
@section('content')
    <div class="container">
        <div class="row" >
            <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-title">
                            Reports
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <select name="reports" id="reports" class="form-control  criteria">
                                        <option value="">Select a criteria</option>
                                        <option value="daily" data-icon="fa fa-circle-o text-green"> Daily</option>
                                        <option value="monthly" data-icon="fa fa-circle-o text-red">Monthly</option>
                                        <option value="yearly" data-icon="fa fa-circle-o text-yellow"> Yearly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group month" style="display: none;">
                                    <select name="month" id="month" class="form-control ">
                                        <option value="" >Select a month</option>
                                        <option value="1" data-icon="fa fa-circle-o text-green" >January</option>
                                        <option value="2" data-icon="fa fa-circle-o text-green">February</option>
                                        <option value="3" data-icon="fa fa-circle-o text-green">March</option>
                                        <option value="4" data-icon="fa fa-circle-o text-green">April</option>
                                        <option value="5" data-icon="fa fa-circle-o text-green">May</option>
                                        <option value="6" data-icon="fa fa-circle-o text-green">June</option>
                                        <option value="7" data-icon="fa fa-circle-o text-green">July</option>
                                        <option value="8" data-icon="fa fa-circle-o text-green">August</option>
                                        <option value="9" data-icon="fa fa-circle-o text-green">September</option>
                                        <option value="10" data-icon="fa fa-circle-o text-green">October</option>
                                        <option value="11" data-icon="fa fa-circle-o text-green">November</option>
                                        <option value="12" data-icon="fa fa-circle-o text-green">December</option>
                                    </select>
                                </div>
                                <div class="form-group year" style="display: none;">

                                    <select name="year" id="year" class="form-control ">
                                        <option value="">Select a year</option>
                                        @for($i = \Carbon\Carbon::now()->year; $i >= \Carbon\Carbon::now()->year - 50; $i--)
                                            <option value="{{$i}}" data-icon="fa fa-circle-o text-red">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group status" style="display: none;">

                                    <select name="status" id="mystatus" class="form-control">
                                        <option value="">Select a filter</option>
                                        <option value="all" selected>All</option>
                                        <option value="pending" >Pending</option>
                                        <option value="accepted" >Accepted</option>
                                        <option value="rejected" >Rejected</option>
                                    </select>
                                </div>
                            </div>
                        </div>




                        {{--Table--}}
                        <table class="table table bordered" id="my-table">
                            <thead id="thd">
                            <tr id="hd">

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
    <script id="deo" data-addrs="appointee-report" src="{{ asset('js/selector.js') }}"></script>
@endsection
