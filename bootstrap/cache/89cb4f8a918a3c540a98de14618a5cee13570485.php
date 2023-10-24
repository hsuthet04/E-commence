<?php $__env->startSection("title"."Cafe"); ?>

<?php $__env->startSection('content'); ?>
<h1>Welcome</h1>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layout.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>