<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="Shortcut icon" href="<?php echo e(asset("images/PetCafelogo.jpg")); ?>">
    <link rel="stylesheet" href="<?php echo e(asset("css/app.css")); ?>">
    <link rel="stylesheet" href="<?php echo e(asset("css/custom.css")); ?>">
</head>

<body>

    <?php echo $__env->make('layout.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- <div class="d-flex">
        <img src="<?php echo e(asset("images/home2.jpg")); ?>" alt="" style="width: 100%;">
        <img src="<?php echo e(asset("images/home3.jpg")); ?>" alt="" style="width: 100%;">
    </div> -->
    <?php echo $__env->yieldContent('content'); ?>
    <script src="<?php echo e(asset("js/app.js")); ?>"></script>
    <script src="https://kit.fontawesome.com/47655717bb.js" crossorigin="anonymous"></script>
    <?php echo $__env->yieldContent("script"); ?>
</body>

</html>