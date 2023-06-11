@extends('layout')
 
@section('content')
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col">
        <form action="{{ route('inwards.store') }}" method="POST" id="form">
          @csrf
            <div class="form-group">
              <input type = "hidden" class="compareQuantity" value="1" />
                <label for="sel1">Material </label>
                
                <select class="form-control" id="material_id" name="material_id" required> 
                    <option value=""> Select Material</option>    
                    @foreach($materials as $material) 
                    <option value="{{$material->id}}"  {{ $material->id  == ($material_data->material_id ?? 0)  ? 'selected' : ''}}> {{ $material->name ?? ''}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Current balance </label>
                <input type="text" id="inward_qty_c" class="form-control disabled_field" name="inward_qty_c" value = "" >
            </div>
            <div class="form-group">
                <label>Sale / Purchase quantity </label>
                <input type="number" id="qty" class="form-control float_num" name="qty" required>
            </div>
            <div class="form-group">
                <label>date</label>
                <input type="text" id="datepicker" class="form-control" name="transaction_at" required >
            </div>
            <div class="form-group">
                  <label>Description </label>
                  <input type="text" class="form-control" name="description" required>
            </div>
            <input type="hidden" id="from_material" value="" name="from_material"/>
            <input type="hidden" id="inward_qty" class="form-control disabled_field" name="inward_qty" value = "" >
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"> 
        </form>
      </div>
  </div>

  <div class="row">
    <div class="col">
      @if(session()->has('message'))
        <div class="space20px"></div>
        <div class="alert alert-success">
          {{ session()->get('message') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="space20px"></div>
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

  <div class="row">
    <div class="col">
      <div class="space20px"></div>
      <h1> List </h1>
      @if(isset($data) && $data->count() > 0)
        <table class="table table-bordered data-table">
          <thead>
            <tr>
              <th> ID </th>
              <th>Material Name</th>
              <th>Category Name</th>
              <th>Date</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $datas)
              <tr>
                <td>{{ $datas->id ?? ''}}</td>
                <td>{{ $datas->materials->name ?? ''}}</td>
                <td>{{ $datas->categories->name ?? ''}}</td>
                <td>{{ date("d-m-Y", $datas->date) }}</td>
                <td> {{ $datas->description ?? '' }}</td>
                <td> <a class="btn btn-primary" href="{{ route('materialInwardsList',$datas->material_id) }}"> Material - Show Inward/Outward entries </a> </td>
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
@endsection



