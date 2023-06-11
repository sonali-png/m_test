@extends('layout')
 
@section('content')
<div class="content">
    <div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th>Material Name</th>
                            <th>Category Name</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Inward</th>
                            <th>Outward</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($inward_details->inwards))
                            @foreach($inward_details->inwards as $key => $data)
                                <tr>
                                    <td> {{ $data->id }}</td>
                                    <td> {{ $data->materials->name }}</td>
                                    <td> {{ $data->categories->name }}</td>
                                    <td> {{ $data->transaction_at }}</td>
                                    <td> {{ $data->description ?? '' }}</td>
                                    <td> {{ $data->inward_qty }}</td>
                                    <td> {{ $data->outward_qty }}</td>
                                </tr>
                            @endforeach
                        @else
                            No records found 
                        @endif
                    </tbody>
                </table>
     
        </div>
    </div>
</div>
 
@endsection


