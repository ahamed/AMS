@extends('layouts.app')
@section('title','Dashboard | Smart Appointment')
@section('styles')
    <style>
        .ac{
            cursor: pointer;
        }
    </style>
    

@endsection
@section('content')
    <div class="container">
        <div class="row" >
            <div class="col-sm-10 col-md-10 col-sm-offset-1 col-sm-offset-1">
                <div class="box box-danger">
                    <div class="box-header">
                        <div class="box-title">Appointments today</div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered" id="my-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Visitor</th>
                                <th>Appointee</th>
                                <th>Reference</th>
                                <th>Agenda</th>
                                <th>Address</th>
                                <th>Appointment Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $d)
                                <tr>
                                    <td>{{($key+1)}}</td>
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->memname}}</td>
                                    <td>{{$d->reference}}</td>
                                    <td>{{$d->agendas}}</td>
                                    <td>{{$d->address}}</td>
                                    <td>{{Carbon\Carbon::parse($d->starts)->format('h:i A')}} to {{Carbon\Carbon::parse($d->ends)->format('h:i A')}}</td>
                                    @if($d->status == "pending")
                                        <td class="alert alert-warning">{{$d->status}}</td>
                                    @elseif($d->status == "rejected")
                                        <td class="alert alert-danger">{{$d->status}}</td>
                                    @elseif($d->status == "accepted")
                                        <td class="alert alert-success">{{$d->status}}</td>
                                    @endif
                                    @if($d->status == "pending")
                                        <td><a href="{{url('set-accept')}}/{{$d->id}}"><span class="fa fa-check text-green fa-2x center ac"></span></a> <a href="{{url('set-reject')}}/{{$d->id}}"> <span class="fa fa-times text-red fa-2x center ac"></span></a></td>
                                    @endif
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#my-table').DataTable();
        });
    </script>

@endsection