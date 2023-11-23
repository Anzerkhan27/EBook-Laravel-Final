@extends('layouts.app')


@inject('carbon', 'Carbon\Carbon')
@section('title', 'Showing ' . $book->title)

{{--
* This template is adapted from a Bootsrap
* https://getbootstrap.com/
* Displays the Book details
--}}
@section('content')
<div class="container d-flex justify-content-center m-5" >
<?php 

use Carbon\Carbon;
$date = Carbon::now(); 
$date = Carbon::parse($date)->toDateString();
?>
@if(auth()->user()->getExpirydate($book->id) <= $date)

<div class="card p-4" style="background: hsla(0, 10%, 88%, 0.895)">
<p class="text-grey h3">You are overdue!<br><span class="h6">Extend your loan period or Return the book</span></p>
<p class="text-danger h3"><span class="h6">You will be charged {{number_format($book->credit_price/3,2)}} credits </span></p>
<a class="btn  btn-sm btn-danger" href="{{route('books.show', $book->id)}}">Return or Extend</a>
@else



<embed src="/assets/{{$book->file}}" width="1000" height="700" alt="pdf" />

</div>

@endif
@endsection