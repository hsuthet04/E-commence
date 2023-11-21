@extends("layout.master")

@section("title"."Dear")

@section('content')
<div class="container my-5">
    <h2>Featured</h2>
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-3">
                <img src="{{$product->image}}" style="width:100%; max-height:300px;" alt="">
            </div>
            <div class="col-md-9">
                <h3>{{$product->name}}</h3>
                <p>{{$product->description}}</p>
                <button class="btn btn-sm rounded-0" style="border:none;  background-color:#BCB88A; padding:10px;">{{$product->price}}Ks</button>
                <button class="btn btn-sm rounded-0" style="border-color:#BCB88A;  padding:10px;">Add to Cart</button>
                <p class="mt-3">
                    <span>Rate :
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </span>
                </p>
                <h4>Special Offers will due in</h4>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                        style="width: 75%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection