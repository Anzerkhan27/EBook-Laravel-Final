@extends('layouts.app')



@section('title', 'Showing ' . $book->title)

{{--
* This template is adapted from a Bootsrap
* https://getbootstrap.com/
* Displays the Book details
--}}



@section('content')
@if(session()->has('message'))
<p class="alert alert-success"> {{ session()->get('message') }}</p>
@endif



<div class="row my-2 mx-2">
<div class="col-lg-4">
<div class="card mb-4">
<div class="card-body text-center">
  <img src="https://www.bootdey.com/img/Content/icons/64/PNG/64/bookshelf.png" alt="avatar"
    class="rounded-circle img-fluid" style="width: 150px;">
  <h5 class="my-3 h3">{{$book->title}}</h5>
  @auth
  @if(auth()->user()->booksBorrowed->contains($book->id))
  <a class="btn btn-lg btn-outline-success btn-block" href="{{url('/books/view', $book->id)}}">Read Book</a>
  @endif
  @endauth
  
</div>
</div>
</div>

<div class="col-lg-8">
  <div class="card mb-4">
    <div class="card-body">
  <div class="card" >
    <div class="card-body">
      <h5 class="card-title h4">{{ $book->title }}</h5>
      <p class="card-text h5">{{$book->description}}.</p>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item d-flex h5">
      <p style ="margin-right: 5rem">Genre:  {{$book->genre }} </p>
      @if(empty($book->writtenBy))
      <p style ="margin-right: 5rem">Author: Anonymous </p>
      @else
      <p style ="margin-right: 5rem">Author:  {{$book->writtenBy['name'] }} </p>
      @endIf
      <p> Current Borrowers: {{ $book->borrowedBy->count() }}</p>
      </li>
      <li class="list-group-item  d-flex">
        @if($book->status == 'availiable')
        <p  style ="margin-right: 5rem" class="text-success h4 " >{{$book->status}}<p> 
        @elseif($book->status == 'unavailiable')
        <p  style ="margin-right: 5rem"class="text-danger h4" >{{$book->status}}<p>  
        @endIf 
        @auth 
        @if(auth()->user()->role == 'admin')
        <form action="{{ route('books.status', $book->id) }}"
          method="POST">
          @csrf
          @if($book->status == 'availiable')
          <button type="submit" class="btn btn-outline-danger btn-sm">Make unavailiable</button>
          @else
          <button type="submit" class="btn btn-outline-success btn-sm ">Make availiable</button>
          @endif
        </form>
      </li>
      <li  class="list-group-item ">
        <form action="{{ route('books.upload', $book->id) }}" method="POST" role="form" enctype="multipart/form-data">
          @csrf
          <div class="form-group row">
              <label for="file" class="col-md-6 col-form-label ">Select a file to upload</label>
              <div class="col-md-6">
                  <input id="file"  accept="application/pdf" type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}">
                  @error('file')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
          <button type="submit" class="btn btn-primary btn-sm">Upload File</button>
        </li>
      </form>

         @endIf
         @endauth
      
      
    </ul>
    <div class="card-body d-flex ">
      <div>
        <p  class="h4" style ="margin-right: 5rem">Credits:  {{$book->credit_price}} </p>
      </div>
      <div>
      <form  action="{{ route('books.borrow', $book->id) }}"
        method="POST">
        @csrf

        @if($book->status == 'availiable')
        <button type="submit" style="background-color: blueviolet"  class=" btn  mx-4  text-white">Borrow for: {{$book->credit_price}} credits</button>
        @else
        <button type="submit" style="background-color: blueviolet"  class=" btn  mx-4 text-white" disabled>Borrow for: {{$book->credit_price}} credits</button>
        @endif
      </form>
    </div>
    @auth
    @if(auth()->user()->booksBorrowed->contains($book->id))
    <div>
      <form  action="{{ route('books.extend', $book->id) }}"
        method="POST">
        @csrf
        @if($book->status == 'availiable')
        <button type="submit" class="btn btn btn-warning mx-4  text-white">Extend: {{number_format($book->credit_price/3,2)}} credits  </button>
        @else
        <button type="submit" class="btn btn-warning btn btn-info mx-4 text-white" disabled>Extend</button>
        @endif
      </form> 
    @endif
    @if(auth()->user()->role == 'admin')
    <div>
      <a class="btn btn-success btn-lg btn-success mx-4 " href="{{ route('books.edit', $book->id) }}">Edit</a>
    </div>
    <div>
      <form action="{{ route('books.destroy', $book->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-lg btn-info mx-4">Delete</button>
      </form>
    </div>
  @endif
  </div>
 @endauth
  </div>
</div>
</div>
</div>
</div>
</div>
@endsection
