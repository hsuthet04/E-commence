@extends('layout.master')

@section('title','Category Create')

@section('content')

<div class="container my-5">
    <h1 class="text-center text-dark">create category</h1>
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
                    <button type="submit" class="btn-primary btn-sm" style="border:none;  background-color:#BCB88A;">Create</button>
                </div>

            </form>
            <!-- form end -->

            <!-- category list start -->
            <ul class="list-group mt-5">
                @foreach($cats as $cat)
                <li class="list-group-item">
                    <a href="/admin/category/all" style="color: #513B1C;">{{$cat->name}}</a>
                    <span class="float-right">
                        <i class="fa fa-plus" style="cursor: pointer;" onclick="showSubCatModel('{{$cat->name}}','{{$cat->id}}')"></i>
                        <i class="fa fa-edit" onclick="fun('{{$cat->name}}','{{$cat->id}}')" id="edit-cat"></i>
                        <a href="/admin/category/{{$cat->id}}/delete">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
                    </span>
                </li>
                @endforeach
            </ul>
            <div class="mt-2 offset-md-5">
                {!! $pages !!}
            </div>
            <!-- category list end -->

            <!-- sub category list start -->
            <ul class="list-group mt-5">
                @foreach($sub_cats as $cat)
                <li class="list-group-item">
                    <a href="/admin/category/all" style="color: #513B1C;">{{$cat->name}}</a>
                    <span class="float-right">
                        <i class="fa fa-edit" onclick="subCatEdit('{{$cat->name}}','{{$cat->id}}')" id="edit-cat"></i>
                        <a href="/admin/subcategory/{{$cat->id}}/delete">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
                    </span>
                </li>
                @endforeach
            </ul>
            <div class="mt-2 offset-md-5">
                {!! $sub_pages !!}
            </div>
            <!-- sub category list end -->
        </div>
    </div>
</div>
<!-- sub model start -->
<div class="modal" tabindex="-1" role="dialog" id="SubCategoryCreateModel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Sub Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name">Parent Category</label>
                        <input type="text" class="form-control rounded-0" id="parent-cat-name">
                    </div>
                    <div class="form-group">
                        <label for="name">Sub Category</label>
                        <input type="text" class="form-control rounded-0" id="sub-cat-name">
                    </div>
                    <input type="hidden" id="subcat-token" value="{{\App\Classes\CSRFToken::_token()}}">
                    <input type="hidden" id="parent-cat-id">
                    <div class="row justify-content-end no-gutters mt-3">
                        <button class="btn-primary btn-sm" onclick="createSubCategory(event)" style="border:none;  background-color:#BCB88A;">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- sub model end -->

<!-- category update model start -->
<div class="modal" tabindex="-1" role="dialog" id="CategoryUpdateModel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form>
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control rounded-0" id="edit-name">
                    </div>
                    <input type="hidden" id="sub-cat-edit-token" value="{{\App\Classes\CSRFToken::_token()}}">
                    <input type="hidden" id="sub-cat-edit-id">
                    <div class="row justify-content-end no-gutters mt-3">
                        <button class="btn-primary btn-sm" onclick="startEdit(event)" style="border:none;  background-color:#BCB88A;">Update</button>
                    </div>
                </form>
                <!-- form end -->
            </div>
        </div>
    </div>
</div>
<!-- category update model end -->

<!-- sub edit model start -->
<div class="modal" tabindex="-1" role="dialog" id="SubCategoryEditModel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sub Category Edit title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name">SubCategory Name</label>
                        <input type="text" class="form-control rounded-0" id="sub-cat-edit-name">
                    </div>

                    <input type="hidden" id="edit-token" value="{{\App\Classes\CSRFToken::_token()}}">
                    <input type="hidden" id="edit-id">
                    <div class="row justify-content-end no-gutters mt-3">
                        <button class="btn-primary btn-sm" onclick="subCatUpdateStart(event)" style="border:none;  background-color:#BCB88A;">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- sub edit model end -->
@endsection
@section("script")
<script>
    function fun(name, id) {
        $("#edit-name").val(name);
        $("#edit-id").val(id);
        $("#CategoryUpdateModel").modal("show");
    }

    function startEdit(e) {
        e.preventDefault();
        name = $("#edit-name").val();
        token = $("#edit-token").val();
        id = $("#edit-id").val();
        //console.log("Name is " + name + "<br>Token is " + token + "<br>Id is" + id);
        $("#CategoryUpdateModel").modal("hide");

        $.ajax({
            type: 'POST',
            url: '/admin/category/' + id + '/update',
            data: {
                name: name,
                token: token,
                id: id
            },
            success: function(result) {
                window.location.href = "/admin/category/create";
            },
            error: function(response) {
                var str = "";
                var resp = (JSON.parse(response.responseText));
                alert(resp.name);

            }
        });
    }

    function showSubCatModel(name, id) {
        $('#parent-cat-name').val(name);
        $('#parent-cat-id').val(id);
        $('#SubCategoryCreateModel').modal('show');
    }

    function createSubCategory($e) {
        $e.preventDefault();

        var name = $('#sub-cat-name').val();
        var token = $('#subcat-token').val();
        var parent_cat_id = $('#parent-cat-id').val();
        $('#SubCategoryCreateModel').modal('hide');
        //alert("name is" + name);
        $.ajax({
            type: 'POST',
            url: '/admin/subcategory/create',
            data: {
                name: name,
                token: token,
                parent_cat_id: parent_cat_id
            },
            success: function(result) {
                window.location.href = "/admin/category/create";
            },
            error: function(response) {
                var str = "";
                var resp = (JSON.parse(response.responseText));
                alert(resp.name);

            }
        });
    }

    function subCatEdit(name, id) {
        $("#sub-cat-edit-name").val(name);
        $("#sub-cat-edit-id").val(id);
        $('#SubCategoryEditModel').modal('show');
    }

    function subCatUpdateStart($e) {
        $e.preventDefault();
        let name = $("#sub-cat-edit-name").val();
        let id = $("#sub-cat-edit-id").val();
        let token = $("#sub-cat-edit-token").val();

        $('#SubCategoryEditModel').modal('hide');

        $.ajax({
            type: 'POST',
            url: '/admin/subcategory/update',
            data: {
                name: name,
                token: token,
                id: id
            },
            success: function(result) {
                window.location.href = "/admin/category/create";
                //console.log(result);
            },
            error: function(response) {
                var str = "";
                var resp = (JSON.parse(response.responseText));
                alert(resp.name);

            }
        });
    }
</script>

@endsection