@extends('layouts.app')



@section('content')


@if(session()->has('message'))
<p class="alert alert-success"> {{ session()->get('message') }}</p>
@endif
<div class="row justify-content-center m-3 ">
  <div class="col-12 col-md-10 col-lg-8">
    <form class="card card-sm" action="{{ route('users.index') }}" method="GET" role="search">
      <div class="card-body row no-gutters align-items-center">
        <div class="col-auto">
          <i class="fas fa-search  text-body"></i>
        </div>
        <!--end of col-->
        <div class="col">
          <input class="form-control  form-control-borderless" name="term" placeholder="Search users" id="term">
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
* This template is adapted from a post from Deyson on Free Boostrap snippets and examples here:
* https://www.bootdey.com/snippets/view/bs4-search-Bar
* Search bar to allow users to make a search for their user
--}}

<section  style = "background: hsla(0, 10%, 88%, 0.895); margin-right: 3rem; margin-left: 3rem; padding:3em;">
  <h3 class="dark-color">User<span class="text-info"> List</span></h3>
 {{--
      * If the search word matches no users
      * Display this
      --}}

@if($users->count() == 0)
<h1 class="text-white  text-center">There are 0 results for your search<h1>
    @else
    <div class="container">
      @foreach ($users as $user)
      {{--
      * This template is adapted from a Bootsrap
      * https://getbootstrap.com/
      * Displays the users matching the search word
      --}}

      <ul class="list-group list-group-light">
        <li class="list-group-item my-2  d-flex justify-content-between align-items-center">
          <div>
            <div class="fw-bold">{{$user->name}}</div>
            <div class="text-muted">{{$user->email}}</div>
          </div>
          <div class="fw-bold">{{$user->role}} account</div>
          <div class="d-flex justify-content-between  align-items-center">
            <form action="{{ route('user.makeAdmin', $user->id) }}"
              method="POST">
              @csrf
              @if($user->role == 'user')
              <button type="submit" class="btn btn-outline-danger btn-sm">Make admin</button>
              @endif
            </form>
          </div>
        </li>
      </ul>

      @endforeach

    </div>

  </section>


    @endif
    @endsection