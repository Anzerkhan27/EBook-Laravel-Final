@extends('layouts.app')



@section('title', 'Edit signing')



@section('content')






<div class="container">
        <div class=" text-center mt-5 ">

            <h1 class="text-white">Edit Author</h1>
                
            
        </div>

    
    <div class="row ">
      <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">
            <div class="card-body bg-light">
       
            <div class = "container">
            <form action="{{ route('authors.update', $author->id) }}" method="POST">
            @csrf

@method('PUT')
            
            <div class="controls">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name:</label>
                           <input  class="form-control" type="text" name="name" id="name" value="{{ $author->name }}" class=" p-2 bg-gray-200 @error('title') is-invalid @enderror" />
                      
@error('title')

<div class="alert alert-danger">{{ $message }}</div>

@enderror
                     </div>
                    </div>



            
                
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="bio">Description:</label>

                  <textarea  class="form-control" name="bio" id="bio" row="5" class=" p-2 bg-gray-200 @error('description') is-invalid @enderror"> {{ $author->bio }}</textarea>
                            
                  @error('description')

<div class="alert alert-danger">{{ $message }}</div>

@enderror
                </div>

                        </div>


                    <div class="col-md-12">
                        
                        <input type="submit" class="btn btn-success btn-send mt-2 pt-2 btn-block
                            " value="Update" >
                    
                </div>
          
                </div>


        </div>
         </form>
        </div>
            </div>


    </div>

@endsection


