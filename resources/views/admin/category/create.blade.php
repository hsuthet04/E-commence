@extends('layout.master')

@section('title','Category Create')

@section('content')



<div class="container my-5">
    <h1 class="text-primary text-center">create category</h1>
    <!-- @if(\App\Classes\Session::has("error"))
         {{\App\Classes\Session::flash("error")}}  
    @endif -->
    <div class="row">

        <div class="col-md-4">
            @include("layout.admin_sidebar")
        </div>
        <div class="col-md-8">
            @include("layout.report_message")
            @if(\App\Classes\Session::has("delete_success"))
            {{App\Classes\Session::flash("delete_success")}}
            @endif
            @if(\App\Classes\Session::has("delete_fail"))
            {{App\Classes\Session::flash("delete_fail")}}
            @endif
            <!-- form start -->
            <form action="/admin/category/create" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                <div class="row justify-content-end no-gutters mt-3">
                    <button type="submit" class="btn-primary btn-sm">Create</button>
                </div>
            </form>
            <!-- form end -->
            <ul class="list-group mt-5">
                @foreach($cats as $cat)
                <li class="list-group-item">
                    <a href="/admin/category/all" style="color: #513B1C;">{{$cat["name"]}}</a>
                    <span class="float-right">
                        <i class="fa fa-edit"></i>
                        <a href="/admin/category/{{$cat["id"]}}/delete">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
                    </span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection