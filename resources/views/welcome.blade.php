@extends('layouts.app')


@section('title', 'Welcome')


@section('content')


    
{{-- 
  This template is adapted from a post from Deyson on Free Boostrap snippets and examples here:
  https://www.bootdey.com/snippets/view/bs4-search-Bar
  --}}

	<div style="background: grey" class="row justify-content-center py-5">
        <div class="div col-12 col-md-10 col-lg-8  text-center text-white mt-2 mb-5"><h1>Welcome to EBOOK<h1></div>
                        <div class="col-12 col-md-10 col-lg-8">
                            <form class="card card-sm"  action="{{ route('books.index') }}" method="GET" role="search" >
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-search h4 text-body"></i>
                                    </div>
                                    <!--end of col-->
                                    <div class="col">
                                        <input    class="form-control form-control-lg form-control-borderless" name="term" placeholder="Search books" id="term" >
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-warning" type="submit" title="Search Book"  >Search</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        </div>
                        <!--end of col-->
</div>
{{--
<form action="{{ route('books.return', $book->id) }}"
    method="POST">
    @csrf
    <button class="btn btn-outline-danger"  type="submit" class="btn">Return</a>
    </form>

--}}
@endsection
