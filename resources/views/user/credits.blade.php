@extends('layouts.app')





{{--
* This template is adapted from a Bootsrap
* https://getbootstrap.com/
* Displays the Book details
--}}
@section('content')
@if(session()->has('message'))
<p class="alert alert-success"> {{ session()->get('message') }}</p>
@endif
<div class="container m-5">
<div class="card p-4" style="background: hsla(0, 10%, 88%, 0.895)">
    <p class="text-grey h2">Buy Credits<br><span class="h4">You can buy credits here and start reading</span></p>
    <p class="text-success h2"><span class="h4">You will be charged £20 for 100 credits </span></p>
    <p class="text-success h2"><span class="h4">Your credits: {{$user->credits}} </span></p>
    <div class="col-md-6 d-flex ">
    <a class=" btn  btn-lg btn-success" href="{{route('user.buyCredits', $user->id)}}">Buy 100 credits</a>
    </div>
</div>

@endsection