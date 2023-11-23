@extends('layouts.app')



@section('author', 'New signing')



@section('content')


<div class="container">
    <div class=" text-center mt-5 ">       
    </div>
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
                        <form action="{{ route('authors.store') }}" method="POST">

                            @csrf

                            <div class="controls">

                                <div class="row">
                                    <p class="mb-4 h3"><span style="color:#11BBAB"  class=" font-italic h3 me-1">Create New</span> Author
                                    </p>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="h5" for="name">Name:</label>
                                            <input class="form-control" type="text" name="name" id="name"
                                                class=" p-2 bg-gray-200 @error('title') is-invalid @enderror" />
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="h5" for="bio">Short-Bio:</label>

                                            <textarea class="form-control" name="bio" id="bio" row="5"
                                                class=" p-2 bg-gray-200 @error('bio') is-invalid @enderror"></textarea>
                                            @error('bio')
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