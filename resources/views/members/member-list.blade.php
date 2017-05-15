@extends('layouts.app')
@section('title','Dashboard | Smart Appointment')
@section('content')
    <div class="container">
        <div class="row" >
            <div class="col-md-10 col-sm-10">
                <div class="box box-danger">
                    <div class="box-header">
                        <div class="box-title">Members List</div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover" id="my-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Designation</th>
                                <th>Address</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->mobile }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->designation }}</td>
                                    <td>{{ $member->address }}</td>
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
            $('#my-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false
            });
        });
    </script>

@endsection
