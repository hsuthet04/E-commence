<?php $__env->startSection('title','Category Create'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .pagination>li {
        padding: 5px 15px;
        background: #fff;
        color: #000;
        margin-right: 1px;
    }

    #edit-cat {
        cursor: pointer;
    }
</style>

<div class="container my-5">
    <h1 class="text-primary text-center">create category</h1>
    <!-- <?php if(\App\Classes\Session::has("error")): ?>
         <?php echo e(\App\Classes\Session::flash("error")); ?>  
    <?php endif; ?> -->
    <div class="row">

        <div class="col-md-4">
            <?php echo $__env->make("layout.admin_sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="col-md-8">
            <?php echo $__env->make("layout.report_message", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php if(\App\Classes\Session::has("delete_success")): ?>
            <?php echo e(App\Classes\Session::flash("delete_success")); ?>

            <?php endif; ?>
            <?php if(\App\Classes\Session::has("delete_fail")): ?>
            <?php echo e(App\Classes\Session::flash("delete_fail")); ?>

            <?php endif; ?>
            <!-- form start -->
            <form action="/admin/category/create" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                <div class="row justify-content-end no-gutters mt-3">
                    <button type="submit" class="btn-primary btn-sm">Create</button>
                </div>
            </form>
            <!-- form end -->
            <ul class="list-group mt-5">
                <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item">
                    <a href="/admin/category/all" style="color: #513B1C;"><?php echo e($cat->name); ?></a>
                    <span class="float-right">
                        <i class="fa fa-edit" onclick="fun('<?php echo e($cat->name); ?>','<?php echo e($cat->id); ?>')" id="edit-cat"></i>
                        <a href="/admin/category/<?php echo e($cat->id); ?>/delete">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
                    </span>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="mt-5">

            </div>
            <?php echo $pages; ?>

        </div>
    </div>
</div>
<!-- model start -->
<div class="modal" tabindex="-1" role="dialog" id="CategoryUpdateModel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control rounded-0" id="edit-name">
                    </div>

                    <input type="hidden" name="edit-token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                    <input type="hidden" name="edit-id">
                    <div class="row justify-content-end no-gutters mt-3">
                        <button class="btn-primary btn-sm" onclick="startEdit(event)">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- model end -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection("script"); ?>
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
        console.log("Name is " + name + "<br>Token is " + token + "<br>Id is" + id);

        $.ajax({
            type: 'POST',
            url: '/admin/category/' + id + '/update',
            data: {
                name: name,
                token: token,
                id: id
            },
            success: function(result) {
                console.log("Success is" + result);
            },
            error: function(response) {
                alert(JSON.parse(response.responseText).name);
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>