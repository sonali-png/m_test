@extends('layout')
 
@section('content')
<div class="content">
    <div class="container">
    
    <div class="row">
        <div class="col">
            <h1> Add Category </h1>
            <form action="{{ route('category.store') }}" method="POST" id="form">
                @csrf
                <div class="form-group">
                    <label>Category name </label>
                    <input type="text" class="form-control" name="name" value = "{{ $category_data->name ?? '' }}" required>
                    <input type="hidden" class="form-control" name="id" value = "{{ $category_data->id ?? 0 }}">
                </div>
                
                <input type="submit" name="submit" value="Submit" class="btn btn-primary"> 
            </form>
        </div>
    </div>

    <div class="row">
    <div class="col">
        <div class="space10px"></div>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li> 
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="space20px"></div>

    <div class="row">
        <div class="col">
            <h1> List </h1>

            @if(isset($data) && $data->count() > 0)
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $datas)
                            <tr>
                                <td>{{ $datas->name }}</td>
                                <td>
                                    <form action = "{{ route('category.destroy',$datas->id) }}" method="POST"> 
                                        @csrf @method('DELETE')
                                        <a class="btn btn-primary" href="{{ route('category.edit',$datas->id) }}"> Edit </a>
                                        <button class="btn btn-danger deleteRecord" data-id="{{ $datas->id }}" > Delete </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="{{$data->previousPageUrl()}}">Previous</a></li>
                        @for($i=1;$i<=$data->lastPage();$i++)
                            <li class="page-item">
                                <a class="page-link" href="{{$data->url($i)}}">{{$i}}</a>
                            </li>
                        @endfor
                        <li class="page-item"><a class="page-link" href="{{$data->nextPageUrl()}}">Next</a></li>
                    </ul>
                    </nav>
                </div>  
            @else
                <p> No records found ! </p>
            @endif

            </div>
        </div>
    </div>
</div>
 
@endsection