@extends("layout.master")

@section("title","Product Home Page")

@section("content")

<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            @include("layout.admin_sidebar")
        </div>
        <div class="col-md-8">
            <h1>Letz Go Shopping!</h1>
            @if(\App\Classes\Session::has("product_insert_success"))
            {{\App\Classes\Session::flash("product_insert_success")}}
            @endif

            <!-- Table start -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <th>{{$product->id}}</th>
                        <td><img src="{{$product->image}}" alt="" style="max-width:150px; max-height:200px;"></td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>
                            <a href="/admin/product/{{$product->id}}/edit"><i class="fa fa-edit text-dark"></i></a>
                            <a href="/admin/product/{{$product->id}}/delete"><i class="fa fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tr>
                </tbody>
            </table>
            <!-- Table end -->
            <div class="mt-2 offset-md-5">
                {!! $pages !!}
            </div>
        </div>
    </div>
</div>

@endsection