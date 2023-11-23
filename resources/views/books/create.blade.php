@extends('layouts.app')



@section('author', 'New signing')



@section('content')


<div class="container mt-5">
    {{--
* This template is adapted from a Bootsrap
* https://getbootstrap.com/
* Displays the form which allows user to create a new Book
--}}
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">

                    <div class="container">
                        <form action="{{ route('books.store') }}" method="POST">

                            @csrf

                            <div class="controls">

                                <div class="row">
                                    <p class="mb-2 h3"><span style="color:#11BBAB"  class=" font-italic h3 me-1">Create New</span> Book
                                    </p>
                                    @if(!empty($author['name']))
                                    <h6>by: {{$author->name }}</h6>
                                    @endif
                                    <div class="col-md-6">
                                        
                                        <div class="form-group mt-1">
                                            <label for="title">title:</label>
                                            <input class="form-control" type="text" name="title" id="title"
                                                class=" p-2 bg-gray-200 @error('title') is-invalid @enderror" />

                                            @error('title')

                                            <div class="alert alert-danger">{{ $message }}</div>

                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-1">
                                            <label for="genre">Genre:</label>
                                            <input class="form-control" type="text" name="genre" id="genre"
                                                class=" p-2 bg-gray-200 @error('genre') is-invalid @enderror"></input>
                                            @error('genre')

                                            <div class="alert alert-danger">{{ $message }}</div>

                                            @enderror

                                        </div>
                                    </div>
                                    @if(!empty($author['name']))
                                    <input type="hidden" name="author_id" id="auhor_id" value="{{$author->id}}">
                                   @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description:</label>

                                            <textarea class="form-control" name="description" id="description" row="5"
                                                class=" p-2 bg-gray-200 @error('description') is-invalid @enderror"></textarea>

                                            @error('description')

                                            <div class="alert alert-danger">{{ $message }}</div>

                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="credit_price">Credit price:</label>
    
                                                <input type="number" class="form-control" name="credit_price" id="credit_price" row="5"
                                                    class=" p-2 bg-gray-200 @error('credit_price') is-invalid @enderror"></textarea>
    
                                                @error('credit_price')
    
                                                <div class="alert alert-danger">{{ $message }}</div>
    
                                                @enderror
                                            </div>
    
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <button style="background: #11BBAB" type="submit" class="btn text-white">Create</button>
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @endsection