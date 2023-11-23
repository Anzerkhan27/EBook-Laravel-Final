@extends('layouts.app')

{{--
* This template is adapted from a Bootsrap
* https://getbootstrap.com/
* Displays the Book details
--}}
@section('content')
<section style = "background: hsla(0, 0%, 96%, 0.895); margin: 7rem; padding:3rem;">
<div class="container d-flex  justify-content-between mb-5">

        @auth
        <?php $role = Auth::user()->role; ?>
        <form action="{{ route('authors.destroy', $author->id) }}" method="POST">
            @if($role == 'admin')
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
            @endIf
@endauth
</div>
<section class="section about-section gray-bg" id="about">
    
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-4">
                <div class="about-text go-to">
                  
                  <h3 class="pb2 mb-2 h2">{{ $author->name }}</h5>
                    <h3 class="dark-color">About Author</h3>
                    <h6 class="theme-color lead">{{$author->bio}}</h6>
                   
                    <div class="row about-list">
                        <div class="col-md-6">
                            <div class="media">
                                <label>Books written</label>
                                <p>{{$author->booksWritten()->count()}}</p>
                            </div>
                            <div class="media">
                                <label>Total Readers</label>
                                <p>
                                    <?php $data = 0 ?>
                                  @foreach($author->booksWritten as $book)
                                    <?php 
                                    $data = $book->borrowedBy()->count() + $data;
                                    ?>
                                    @endforeach
                                  {{$data}}
                                </p>
                            </div>
                          
                            @auth
                            <?php $role = Auth::user()->role; ?>
                            @if($role == 'admin')
                            <div class="media">
                                <p><a class="btn btn-outline-primary" href={{url('/books/create/'.$author->id )}}>Add books</a></p>
                            </div>
                            <div class="media">
                                <a class="btn btn-outline-success" href="{{ route('authors.edit', $author->id) }}">Edit details</a>
                            </div>
                            @endIf
@endauth

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" title="" alt="">
                </div>
            </div>
        </div>
    </div>

    @if($author->booksWritten()->count() == 0)
    <h1 class="text-danger  text-center mt-5">There are no for books for now<h1>
    @else
    <div class="mask d-flex align-items-center mt-4 ">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                <p class="mb-4 h3 p-2"><span class="text-info font-italic h3 me-1">Books by</span>{{$author->name}} 
                </p>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                      <thead>
                        <tr>
                          <th scope="col">Title</th>
                          <th scope="col">Readers</th>
                          <th scope="col">Status</th>
                          <th scope="col">Details</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
            @foreach($author->booksWritten as $book)
            <td>{{$book->title}}</td>
            <td>{{$book->borrowedBy()->count()}}</td>
            <td>{{$book->status}}</td>
            <td>
                <a href="{{ route('books.show', $book->id) }}" type="button"  class="btn btn-info btn-sm px-3">
                  <i class="fas fa-times">Show</i>
                </a>
              </td> 
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      @endIf
</section>


@endsection