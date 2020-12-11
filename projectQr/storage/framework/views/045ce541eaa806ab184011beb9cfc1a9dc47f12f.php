<?php $__env->startSection('createContent'); ?>
<div class="container">
    <div class="qrContainer">
        <div id="qrcode"></div>
        <h1>QR generator</h1>
        <img class="qrImg" src="/images/blank-qr-code.jpg" alt="qr blank img" />
        <form method="POST" action="/qrpages">
            <?php echo csrf_field(); ?>
            <input type="text" value="" class="qrInput <?php $__errorArgs = ['generatedUrl'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="generatedUrl" name="generatedUrl" id="generatedUrl" />
            <?php $__errorArgs = ['generatedUrl'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="alert is-danger" role="alert">
                <strong><?php echo e($errors->first('generatedUrl')); ?></strong>
            </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <input type="text" value="" class="qrInput <?php $__errorArgs = ['redirectionUrl'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="redirectionUrl" name="redirectionUrl" id="redirectionUrl" />
            <?php $__errorArgs = ['redirectionUrl'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="alert is-danger" role="alert">
                <strong><?php echo e($errors->first('redirectionUrl')); ?></strong>
            </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <input class="qrBtn" type="submit">
            <p style="color: red" class="msg"></p>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/Adrian/Desktop/qrApp/projectQr/resources/views/qrpages/create.blade.php ENDPATH**/ ?>