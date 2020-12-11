<?php $__env->startSection('indexContent'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card prof">
                <?php $__currentLoopData = $qrgenerator; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($gen->generatedUrl); ?></p>
                <p><?php echo e($gen->redirectionUrl); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/Adrian/Desktop/qrApp/projectQr/resources/views/qrpages/index.blade.php ENDPATH**/ ?>