@extends("layout.master")

@section("title"."Dear")

@section('content')
<div class="container my-5">
    <h2>Most Popular Items</h2>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header" style="background-color:#BCB88A;">{{$product->name}}</div>
                <div class="card-block">
                    <img src="{{$product->image}}" alt="" style="width:100%; max-height:300px;">
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <a href="/product/{{$product->id}}/detail" class="btn btn-sm" style="border:none;  background-color:#BCB88A;">
                            <i class="fa fa-eye"></i>
                        </a>
                        <span>{{$product->price}}Ks</span>
                        <button class="btn btn-sm" style="border:none;  background-color:#BCB88A;" onclick="addToCart('{{$product->id}}')">
                            <i class="fa fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        {!! $pages !!}
    </div>

    <h2>Featured</h2>
    <div class="row">
        @foreach($featured as $product)
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header" style="background-color:#BCB88A;">{{$product->name}}</div>
                <div class="card-block">
                    <img src="{{$product->image}}" alt="" style="width:100%; max-height:300px;">
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <a href="/product/{{$product->id}}/detail" class="btn btn-sm" style="border:none;  background-color:#BCB88A;">
                            <i class="fa fa-eye"></i>
                        </a>
                        <span>{{$product->price}}Ks</span>
                        <button class="btn btn-sm" style="border:none;  background-color:#BCB88A;" onclick="addToCart('{{$product->id}}')">
                            <i class="fa fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection