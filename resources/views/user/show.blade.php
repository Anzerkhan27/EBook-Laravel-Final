
@extends('layouts.app')

@section('content')
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
            <h3 class="my-3 ">{{$user->username}}</h3>
            <h4 class="text-muted mb-3">{{$user->role}}</h4>
            <div class="d-flex justify-content-center mb-2">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0 h5">Full Name</p>
              </div>
              <div class="col-sm-9 ">
                <p class="text-muted mb-0 h5">{{$user->name}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0 h5">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0 h5">{{$user->email}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0 h5">Books Borrowed</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0 h5">{{$user->booksBorrowed()->count()}}</p>
              </div>
            </div>
            <hr>  
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0 h5">Credits</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0 h5">{{$user->credits}}</p>
              </div>
              
            </div>
            <hr>         
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection