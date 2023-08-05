
@extends('layouts.app')

@section('page_title','Create-info')

@section('content')
<div class="container-fluid col-xl-8 col-md-8 mt-5">
    <div class="row justify-content-center">
        <div class="card m-4" style="width: 35rem;">
            <div class="card-header">
              <h3>Create Info</h3>
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
                    <form class="form" method="POST" action="{{route('info.store')}}" enctype='multipart/form-data'>
                      @csrf
                        <label class="control-label" for="name">Name</label>  
                        <input name="name" type="text" placeholder="Enter Name" class="form-control" value="{{old('name')}}">
                        
                        <label class="control-label" for="slug">Email</label>  
                        <input name="email" type="email" placeholder="Enter Email" class="form-control" value="{{old('email')}}">

                        <label class="control-label" for="order_by">Phone</label>  
                        <input name="phone" type="number" placeholder="Enter Phone number" class="form-control" value="{{old('phone')}}">

                        <label class="control-label" for="order_by">Address</label>  
                        <input name="address" type="text" placeholder="Enter Address" class="form-control" value="{{old('address')}}">

                        <label class="control-label mt-2" for="order_by">Photo</label>  
                        <input name="photo" type="file" placeholder="Select a file" class="form-control" value="{{old('photo')}}">

                        <div class="card-footer mt-3">
                            <input class="btn btn-outline-primary form-control" type="submit" value="Save Info">
                        </div>
                        </form> 
                </div>
            
        </div>
    </div>
        
</div>  
@endsection

