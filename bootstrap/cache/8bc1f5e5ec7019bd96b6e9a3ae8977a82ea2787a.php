<?php $__env->startSection('title','Category Create'); ?>

<?php $__env->startSection('content'); ?>



<div class="container my-5">
    <h1 class="text-primary text-center">create category</h1>
    <?php echo e(App\Classes\Session::flash("error")); ?>

    <div class="col-md-8 offset-md-2">
        <!-- form start -->
        <form action="/admin/category/create" method="post" enctype="multipart/form-data" >
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="file">File</label>
                <input type="file" class="form-control" id="file" name="file">
            </div>
            <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>" >
            <div class="row justify-content-end no-gutters mt-3">
                <button type="submit" class="btn-primary btn-sm">Create</button>
            </div>
        </form>
        <!-- form end -->
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>