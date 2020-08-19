@extends('layouts.app')

@section('content')
<section class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group">
              <li class="list-group-item"><a href="{{route('categories.index')}}" >Categories</a></li>
              <li class="list-group-item active"><a href="{{route('product.index')}}" >Products</a></li>
             
            </ul>
        </div>
        <div class="col-md-8">
            
        </div>
    </div>
</section>
@endsection
