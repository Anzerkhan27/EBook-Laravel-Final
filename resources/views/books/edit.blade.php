@extends('layouts.app')



@section('title', 'Edit signing')



@section('content')






<div class="container">
        <div class=" text-center mt-5 ">

            <h1 class="text-white">Edit Book</h1>
                
            
        </div>

    
    <div class="row ">
      <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">
            <div class="card-body bg-light">
       
            <div class = "container">
            <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf

@method('PUT')
            

            <div class="controls">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">title:</label>
                           <input  class="form-control" type="text" name="title" id="title" value="{{ $book->title }}" class=" p-2 bg-gray-200 @error('title') is-invalid @enderror" />
                      
@error('title')

<div class="alert alert-danger">{{ $message }}</div>

@enderror
                     </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="genre">Genre:</label>
                      <input  class="form-control"  value="{{ $book->genre }}"   name="genre" id="genre" row="5" class=" p-2 bg-gray-200 @error('genre') is-invalid @enderror"></input>
                      @error('genre')

<div class="alert alert-danger">{{ $message }}</div>

@enderror
                    
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="credit_price">Credit Price:</label>
                  <input type="number"  class="form-control"  value="{{ $book->credit_price }}"   name="credit_price" id="credit_price" row="5" class=" p-2 bg-gray-200 @error('credit_price') is-invalid @enderror"></input>
                  @error('credit_price')

<div class="alert alert-danger">{{ $message }}</div>

@enderror
                
                 </div>
            </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="description">Description:</label>

                  <textarea  class="form-control" name="description" id="description" row="5" class=" p-2 bg-gray-200 @error('description') is-invalid @enderror"> {{ $book->description }}</textarea>
                            
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


