@extends('layouts.app')



@section('content')


@if ($message = Session::get('success'))

<div class="alert alert-success">

  <p>{{ $message }}</p>

</div>

@endif

{{--
* This template is adapted from a post from Deyson on Free Boostrap snippets and examples here:
* https://www.bootdey.com/snippets/view/bs4-search-Bar
* Search bar to allow users to make a search for their book
--}}


<div class="row justify-content-center  m-3">
  <div class="col-12 col-md-10 col-lg-8">
    <form class="card card-sm" action="{{ route('books.index') }}" method="GET" role="search">
      <div class="card-body row no-gutters align-items-center">
        <div class="col-auto">
          <i class="fas fa-search  text-body"></i>
        </div>
        <!--end of col-->
        <div class="col">
          <input class="form-control  form-control-borderless" name="term" placeholder="Search books" id="term">
        </div>
        <!--end of col-->
        <div class="col-auto">
          <button class="btn  btn-success" type="submit" title="Search projects">Search</button>
        </div>
        <!--end of col-->
      </div>
    </form>
  </div>
  <!--end of col-->
</div>

 {{--
      * If the search word matches no books
      * Display this
      --}}

 <section  style = "background: hsla(0, 10%, 88%, 0.895); margin-right: 3rem; margin-left: 3rem; padding:3em;">
  <h3 class="text-info">Book List</span></h3>
@if($books->count() == 0)


    @else

    <div class="container">

      @foreach ($books as $book)
      {{--
      * This template is adapted from a Bootsrap
      * https://getbootstrap.com/
      * Displays the books matching the search word
      --}}

      <ul class="list-group list-group-light">
        <li class="list-group-item my-2  d-flex justify-content-between align-items-center">
          <div>
            <div class="fw-bold">{{$book->title}}</div>
            @if(empty($book->writtenBy))
            <div style ="margin-right: 5rem">written by: Anonymous </div>
            @else
            <div style ="margin-right: 5rem">written by:  {{$book->writtenBy['name'] }} </div>
            @endIf
          </div>

          <div class="d-flex justify-content-between  align-items-center">
            <a class="btn btn-outline-primary  " href="{{ route('books.show', $book->id) }}">Show</a>
          </div>
        </li>
      </ul>

      @endforeach

    </div>

    {{ $books->links() }}

    </section>
        
 

    @endif
    @endsection