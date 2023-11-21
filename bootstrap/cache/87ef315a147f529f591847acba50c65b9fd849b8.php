<?php $__env->startSection("title"."Dear"); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h2>Featured</h2>
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-3">
                <img src="<?php echo e($product->image); ?>" style="width:100%; max-height:300px;" alt="">
            </div>
            <div class="col-md-9">
                <h3><?php echo e($product->name); ?></h3>
                <p><?php echo e($product->description); ?></p>
                <button class="btn btn-sm rounded-0" style="border:none;  background-color:#BCB88A; padding:10px;"><?php echo e($product->price); ?>Ks</button>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layout.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>