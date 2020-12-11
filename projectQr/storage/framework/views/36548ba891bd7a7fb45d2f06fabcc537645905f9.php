<?php $__env->startSection('content'); ?>
<div id="wrapper">
    <div id="page" class="container">
        <div id="content">
            <div class="title">
                <h2><?php echo e($qrgenerator->generatedUrl); ?></h2>
            </div>
            <?php echo e($qrgenerator->redirectionUrl); ?>

            <p>

            </p>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>')
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/Adrian/Desktop/qrApp/projectQr/resources/views/qrpages/show.blade.php ENDPATH**/ ?>