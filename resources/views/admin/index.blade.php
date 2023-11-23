
@extends('layouts.app')

@section('content')
<link href="{{asset('cssfile/bodycss.css')}}" rel="stylesheet" type="text/css">
@if(session()->has('message'))
<p class="alert alert-success"> {{ session()->get('message') }}</p>
@endif


<section style="background-color:#11BBAB ;">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="https://www.bootdey.com/img/Content/avatar/avatar1.png" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">{{$user->username}}</h5>
            <p class="text-muted mb-3">{{$user->role}}</p>
            <div class="d-flex justify-content-center mb-2">
            </div>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <p class="mx-2 my-3"><span class="text-success font-italic me-5 h5">Actions</span>
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a class="card-block stretched-link text-decoration-none text-black h5" href="/authors/create">Create New Author</a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a class="card-block stretched-link text-decoration-none text-black h5" href="/authors">Add a new book to existing Author</a>
              </li>
              <?php $id = 0?>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a class="card-block stretched-link text-decoration-none text-black h5" href="{{url('/books/create/'.$id )}}" >Add a new book without author</a>
                <div class="d-flex justify-content-between">
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a class="card-block stretched-link text-decoration-none text-black h5" href="{{url('/users' )}}" >Make Admin</a>
              </li>
              
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->name}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->email}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Books Added</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->booksCreated()->count()}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Authors Added</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$user->authorsCreated()->count()}}</p>
              </div>
            </div>
            <hr>            
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-info font-italic me-1">Books</span> Created
                </p>
                @if($user->booksCreated()->count() == 0)
                <h3 class="text-grey  text-center">0 books added<h3>
                     @else
                <table class="table table-borderless mb-0">
                  <thead>
                    <tr>
                      <th scope="col">Title</th>
                      <th scope="col">Status</th>
                      <th scope="col">Details</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
        @foreach($user->booksCreated as $book)
        <td  class="h6" >{{$book->title}}</td>
        <td class="h6" >{{$book->status}}</td>
        <td>
            <a href="{{ route('books.show', $book->id) }}" type="button"  class="btn btn-warning btn-sm px-3">
              Show
            </a>
          </td> 
      </tr>
      @endforeach
    </tbody>
  </table>
  @endIf
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-info font-italic me-1">Authors</span> Created
                </p>
                @if($user->authorsCreated()->count() == 0)
                <h3 class="text-grey  text-center">0 Authors added<h3>
                     @else
                <table class="table table-borderless mb-0">
                  <thead>
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Books Written</th>
                      <th scope="col">Details</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
        @foreach($user->authorsCreated as $author)
        <td  class="h6" >{{$author->name}}</td>
        <td class="h6" >{{$author->booksWritten()->count()}}</td>
        <td>
            <a href="{{ route('authors.show', $author->id) }}" type="button"  class="btn btn-warning btn-sm px-3">
              Show
            </a>
          </td> 
      </tr>
      @endforeach
    </tbody>
  </table>
  @endIf
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection