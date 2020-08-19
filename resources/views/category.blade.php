@extends('layouts.app')

@section('content')
<section class="container-fluid">
    @if(Session::has('success'))
     <div class="alert alert-primary" role="alert">{{ Session::get('success') }}</div>
    @endif
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group">
              <li class="list-group-item active"><a href="{{route('categories.index')}}">Categories</a></li>
              <li class="list-group-item"><a href="{{route('product.index')}}" >Products</a></li>
             
            </ul>
        </div>
        <div class="col-md-8">
            <div class="container">
               
                    <button class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Create</button>
                    <div class="collapse mt-3" id="collapseExample">
                      <div class="card card-body">
                            <form action="{{route('categories.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="name" id="name" placeholder="E.g. Food..etc">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                </div>
                                <button class="btn btn-primary">Save</button>
                            </form>
                      </div>
                    </div>

               
                <div class="row mt-5">
                    <table class="table table-striped ">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Category</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach($categories as $category)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{$category->name}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
            </div>
        </div>
    </div>
</section>
@endsection