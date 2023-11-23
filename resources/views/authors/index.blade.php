@extends('layouts.app')
@section('title', 'All of our authors')
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
<div class="row justify-content-center  m-3">
<div class="col-12 col-md-10 col-lg-8">
<form class="card card-sm" action="{{ route('authors.index') }}" method="GET" role="search">
<div class="card-body row no-gutters align-items-center">
<div class="col-auto">
<i class="fas fa-search  text-body"></i>
</div>
 <!--end of col-->
<div class="col">
<input class="form-control  form-control-borderless" name="term" placeholder="Search for Authors" id="term">
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
<section  style = "background: hsla(0, 10%, 88%, 0.895); margin-right: 3rem; margin-left: 3rem; padding:3em;">
  <h3 class="text-info">Author List</span></h3>
<div class="container">
@if($authors->count() == 0)
<h1 class="text-dark  text-center">No authors to show<h1>  
@else
@foreach ($authors as $author)
<ul class="list-group list-group-light">
<li class="list-group-item my-2  d-flex justify-content-between align-items-center">  
<div>  
<div class="fw-bold">{{ $author->name }}</a></div>
</div>
<a class="btn btn-blue" href="{{ route('authors.show', $author->id) }}">Details</a>
</li>
</ul>
@endforeach
@endIf
</div>
</section>
@endsection