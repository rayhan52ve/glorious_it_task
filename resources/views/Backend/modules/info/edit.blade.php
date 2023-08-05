
@extends('layouts.app')

@section('page_title','Edit-info')

@section('content')
<div class="container-fluid col-xl-5 col-md-3 mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="">
            <div class="card" style="width: 30rem;">
                <div class="card-header">
                  <h3>Edit Info</h3>
                </div>
                    <div class="card-body">
                      
                      @if($errors->any())
                        <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                          </ul>
                        </div>
                      @endif

                         <form class="form" method="POST" action="{{route('info.update',$info)}}" enctype="multipart/form-data">
                          @method('PUT')
                          @csrf
                          <label class="control-label" for="name">Info Name</label>  
                          <input name="name" type="text" placeholder="Category Name" class="form-control" value="{{$info->name}}">

                          <label class="control-label" for="slug">Email</label>  
                        <input name="email" type="email" placeholder="Enter Email" class="form-control" value="{{$info->email}}">

                        <label class="control-label" for="order_by">Phone</label>  
                        <input name="phone" type="number" placeholder="Enter Phone number" class="form-control" value="{{$info->phone}}">

                        <label class="control-label" for="order_by">Address</label>  
                        <input name="address" type="text" placeholder="Enter Address" class="form-control" value="{{$info->address}}">

                        <label class="control-label mt-2" for="order_by">Photo</label>  
                        <input name="photo" type="file" placeholder="Select a file" class="form-control" value="{{$info->photo}}">
                        <img src="{{asset($info->photo)}}" width="150px" class="img-thumbnail mt-2" alt="thumbnail">

                            <div class="card-footer mt-3">
                                <input class="btn btn-outline-success form-control" type="submit" value="Update Info">
                                
                            </div>
                            </form> 
                    </div>
                
            </div>
        </div>
        
    </div>
</div>  
@endsection

