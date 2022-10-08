<?php $__env->startSection('title'); ?>
    <?php echo e(__('Login')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('language-bar'); ?>

        <div class="btn-group align-items-center">
            <select name="language" id="language" class="btn  btn-primary dropdown-toggle" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                <?php $__currentLoopData = Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option class="login_lang" <?php if($lang == $language): ?> selected <?php endif; ?> value="<?php echo e(route('login',$language)); ?>"><?php echo e(Str::upper($language)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="col-xl-6">

        <div class="card-body">
            <div class="">
                <h2 class="mb-3 f-w-600"><?php echo e(('Login')); ?></h2>
            </div>
            <form method="POST" action="<?php echo e(route('login')); ?>" id="form_data" class="needs-validation" novalidate="">
            <?php echo csrf_field(); ?>
                <div class="">
                    <div class="form-group mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <label class="form-label"><?php echo e(__('Email')); ?></label>
                            </div>
                        </div>
                        <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <small><?php echo e($message); ?></small>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <label class="form-label"><?php echo e(__('Password')); ?></label>
                                </div>

                        </div>

                        <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required>
                         <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <small><?php echo e($message); ?></small>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group mb-4">
                        <div class="mb-3">
                            <div class="text-left">

                                    <a href="<?php echo e(route('password.request',$lang)); ?>" class="small text-muted text-underline--dashed border-primary">
                                        <?php echo e(__('Forgot your password?')); ?>

                                    </a>

                            </div>
                        </div>

                    </div>

                    <?php if(env('RECAPTCHA_MODULE') == 'yes'): ?>
                        <div class="form-group mb-3">
                            <?php echo NoCaptcha::display(); ?>

                            <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="small text-danger" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    <?php endif; ?>


                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block mt-2" id="login_button"><?php echo e(__('Login')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>
<script src="<?php echo e(asset('custom/libs/jquery/dist/jquery.min.js')); ?>"></script>
<script>
$(document).ready(function () {
  $("#form_data").submit(function (e) {
      $("#login_button").attr("disabled", true);
      return true;
  });
});
</script>
<?php if(env('RECAPTCHA_MODULE') == 'yes'): ?>
        <?php echo NoCaptcha::renderJs(); ?>

<?php endif; ?>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/shadecrm/giftsociety.shadecrm.com/lead/main_file/resources/views/auth/login.blade.php ENDPATH**/ ?>