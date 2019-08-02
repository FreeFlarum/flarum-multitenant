<?php $__env->startSection('content'); ?>
  <p>
    <?php echo e($message); ?>

  </p>
  <p>
    <a href="<?php echo e($app->url()); ?>">
      <?php echo e($translator->trans('core.views.error.404_return_link', ['{forum}' => $settings->get('forum_title')])); ?>

    </a>
  </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('flarum.forum::layouts.basic', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>