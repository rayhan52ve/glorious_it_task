
@extends('layouts.app')

@section('page_title','Info List')

@section('content')
<div class="container-fluid m-4">
    <div class="row justify-content-center">
        
        <div class="col-xl-8 col-md-8">
            <div class="card m-2" style="width: 55rem;">
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <h3><i class="fa-regular fa-calendar-days"></i> Info Table</h3>
                    <a class="btn btn-sm btn-success m-2 " href="{{route('info.create')}}">Add</a>
                  </div>
                </div>
                    <div class="card-body">
                      {{-- @if(session()->has('msg'))
                        <div class="alert alert-{{session('cls')}}">
                          {{session('msg')}}
                        </div>
                      @endif --}}
                      <table class="table table-sm">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $sl=1 @endphp
                          @foreach ($infos as $info)
                          <tr>
                            
                            <td>{{$sl++}}</td>
                            <td><b>{{$info->name}}<b></td>
                            <td>{{$info->email}}</td>
                            <td>{{$info->phone}}</td>
                            <td>{{$info->address}}</td>
                            <td><img src="{{$info->photo}}" class="img-thumbnail" width="200px" alt="thumbnail"> </td>
                            <td>{{$info->created_at->format('d-m-y h:i A') }}</td>
                            <td>{{$info->created_at != $info->updated_at ?  $info->updated_at->format('d-m-y h:i A'):'Not Updated' }}</td>
                            <td>
                                <a href="{{route('info.edit', $info)}}" class="btn btn-outline-success btn-sm ml-1 mt-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form id="{{'form_'.$info->id}}" action="{{route('info.destroy',$info)}}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button data-id="{{$info->id}}" class="delete btn btn-outline-danger btn-sm ml-1 mt-1" type="submit" ><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>                       
                    </div>
                
            </div>
        </div> 
</div> 

@if(session()->has('msg'))
@push('js')
  <script>
     Swal.fire({
        position: 'top-end',
        icon: '{{session('cls')}}',
        toast: 'true',
        title: '{{session('msg')}}',
        showConfirmButton: false,
        timer: 3000
      })
  </script>
@endpush
@endif


@push('js')
  <script>
    $('.delete').on('click',function(){
      let id = $(this).attr('data-id')
      // console.log(id)

        Swal.fire({
          title: 'Are you sure you want to delete?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $(`#form_${id}`).submit()

          }
        })
      })


      
  </script>
@endpush

@endsection

