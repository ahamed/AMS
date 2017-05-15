@extends('layouts.app')
@section('title','Dashboard | Smart Appointment')
@section('content')
    <div class="container">
        <div class="row" >
            <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-title">
                            Visitors at {{Auth::user()->institute}}
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered" id="my-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Profession</th>
                                <th>Address</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($visitors as $key => $visitor)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $visitor->name }}</td>
                                    <td>{{ $visitor->mobile }}</td>
                                    <td>{{ $visitor->email == "" ? "N/A" : $visitor->email }}</td>
                                    <td>{{ $visitor->profession == "" ? "N/A" : $visitor->profession }}</td>
                                    <td>{{ $visitor->address == "" ? "N/A" : $visitor->address }}</td>
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
