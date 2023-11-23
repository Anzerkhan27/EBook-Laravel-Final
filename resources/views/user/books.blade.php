
@extends('layouts.app')

@section('content')
@if(session()->has('message'))
<p class="alert alert-success"> {{ session()->get('message') }}</p>
@endif

<div class="container py-5 mx-auto" style="width: 1000px;">
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <p class="mb-4 h3"><span class="text-info font-italic h3 me-1">Books</span> borrowed
          </p>
          @if($user->booksBorrowed()->count() == 0)
          <h3 class="text-grey  text-center">0 books added<h3>
               @else
          <table class="table table-borderless mb-0">
            <thead>
              <tr>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Return Date</th>
                <th scope="col">Details</th>
                <th scope="col">Return</th>
              </tr>
            </thead>
            <tbody>
              <tr>
  @foreach($user->booksBorrowed as $book)
  <td  class="h6" >{{$book->title}}</td>
  @if(empty($book->writtenBy))
  <td style ="margin-right: 5rem">Anonymous </td>
  @else
  <td style ="margin-right: 5rem">{{$book->writtenBy['name'] }} </td>
  @endIf
  <td class="h6">{{auth()->user()->getExpirydate($book->id)}}  </td>
  <td>
      <a href="{{ route('books.show', $book->id) }}" type="button"  class="btn btn-warning btn-sm px-3">
        Show
      </a>
    </td> 
    <td>
<form action="{{ route('books.return', $book->id) }}"
    method="POST">
    @csrf
    <button class="btn btn-success btn-sm px-3"  type="submit" class="btn">Return</a>
    </form>
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
@endsection