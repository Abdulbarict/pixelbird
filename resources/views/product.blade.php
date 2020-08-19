@extends('layouts.app')

@section('content')
<section class="container-fluid">
    @if(Session::has('success'))
     <div class="alert alert-primary" role="alert">{{ Session::get('success') }}</div>
    @endif
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group">
              <li class="list-group-item"><a href="{{route('categories.index')}}" >Categories</a></li>
              <li class="list-group-item active"><a href="{{route('categories.index')}}" >Products</a></li>
             
            </ul>
        </div>
        <div class="col-md-8">
            <div class="container">
               
                <button class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Create</button>
                <div class="collapse mt-3" id="collapseExample">
                  <div class="card card-body">
                        <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product</label>
                                        <input type="text" class="form-control @error('product') is-invalid @enderror" name="product" id="product" placeholder="Product">
                                            @if ($errors->has('product'))
                                                <span class="text-danger">{{ $errors->first('product') }}</span>
                                            @endif
                                    </div>
                                </div> 
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Price</label>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="name" placeholder="Price">
                                            @if ($errors->has('price'))
                                                <span class="text-danger">{{ $errors->first('price') }}</span>
                                            @endif
                                    </div>
                                </div>   
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Category</label>
                                         <select name="category" class="form-control @error('category') is-invalid @enderror" id="exampleFormControlSelect1">
                                              <option value="" disabled="">Select Category</option>
                                            @foreach($categories as $category)
                                              <option value="{{$category->id}}">{{$category->name}}</option>

                                            @endforeach

                                        </select>
                                            @if ($errors->has('category'))
                                                <span class="text-danger">{{ $errors->first('category') }}</span>
                                            @endif
                                    </div>
                                </div> 
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="name" placeholder="image">
                                            @if ($errors->has('image'))
                                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                            @endif
                                    </div>
                                </div>   
                            </div>
                         
                            <button class="btn btn-primary">Save</button>
                        </form>
                  </div>
                </div>

               
                <div class="row mt-5">
                    <table class="table table-striped datatable" id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        </div>
    </div>
</section>
@endsection
@section('extrascript')
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax:"{{ur('api/products')}}",
        },
         columns: [
                  { data: 'product' },
                  { data: 'price' },
                  { data: 'category_name' },
                  { data: 'created_at'}
               ]
        });
    
</script>

@endsection