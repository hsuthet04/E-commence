<?php $__env->startSection("title"."Cafe"); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h2>Most Popular Items</h2>
    <div class="row">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header" style="background-color:#BCB88A;"><?php echo e($product->name); ?></div>
                <div class="card-block">
                    <img src="<?php echo e($product->image); ?>" alt="" style="width:100%; max-height:300px;">
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <button class="btn btn-sm" style="border:none;  background-color:#BCB88A;">
                            <i class="fa fa-eye"></i>
                        </button>
                        <span><?php echo e($product->price); ?>Ks</span>
                        <button class="btn btn-sm" style="border:none;  background-color:#BCB88A;" onclick="addToCart('<?php echo e($product->id); ?>')">
                            <i class="fa fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row justify-content-center">
        <?php echo $pages; ?>

    </div>

    <h2>Featured</h2>
    <div class="row">
        <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header" style="background-color:#BCB88A;"><?php echo e($product->name); ?></div>
                <div class="card-block">
                    <img src="<?php echo e($product->image); ?>" alt="" style="width:100%; max-height:300px;">
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <button class="btn btn-sm" style="border:none;  background-color:#BCB88A;">
                            <i class="fa fa-eye"></i>
                        </button>
                        <span><?php echo e($product->price); ?>Ks</span>
                        <button class="btn btn-sm" style="border:none;  background-color:#BCB88A;" onclick="addToCart('<?php echo e($product->id); ?>')">
                            <i class="fa fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("layout.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>