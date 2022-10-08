<?php
    $unseenCounter = App\Models\ChMessage::where('to_id', Auth::user()->id)->where('seen', 0)->count();
    $setting = App\Models\Utility::settings();
?>



    <header class="dash-header  <?php echo e(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on' ? 'transprent-bg' : ''); ?>">

    <div class="header-wrapper"><div class="me-auto dash-mob-drp">
      <ul class="list-unstyled">
        <li class="dash-h-item mob-hamburger">
          <a href="#!" class="dash-head-link" id="mobile-collapse">
            <div class="hamburger hamburger--arrowturn">
              <div class="hamburger-box">
                <div class="hamburger-inner"></div>
              </div>
            </div>
          </a>
        </li>
        <?php if(\Auth::user()->type != 'Super Admin'): ?>

        <li class="dropdown dash-h-item">
          <a
            class="dash-head-link dropdown-toggle arrow-none ms-0"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="false"
            aria-expanded="false"
            data-action="omnisearch-open" data-target="#omnisearch"
          >
            <i class="ti ti-search"></i>
          </a>
          <div id="omnisearch" class="dropdown-menu dash-h-dropdown drp-search omnisearch drp-search-custom">
            <form class="px-3">
              <div class="form-group mb-0 d-flex align-items-center">
                <i data-feather="search"></i>
                <input
                  type="text"
                  class="form-control border-0 shadow-none search_keyword"
                  placeholder="Search here. . ."
                />
              </div>
              <div class="search-output">
              </div>
            </form>
          </div>
        </li>
         <?php endif; ?>
        <li class="dropdown dash-h-item drp-company">
          <a
            class="dash-head-link dropdown-toggle arrow-none me-0"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="false"
            aria-expanded="false"
          >
            <span class="theme-avtar"><img
                    src="<?php if(Auth::user()->avatar): ?> <?php echo e(asset('/storage/avatars/'.Auth::user()->avatar)); ?> <?php else: ?> <?php echo e(asset('custom/img/avatar/avatar-1.png')); ?> <?php endif; ?>"
                    alt="user-image"
                    class="user-avtar ms-2"
                  /></span>
            <span class="hide-mob ms-2"><?php echo e(__('Hi,')); ?><?php echo e(Auth::user()->name); ?>!</span>
            <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
          </a>
          <div class="dropdown-menu dash-h-dropdown">
            <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
              <i class="ti ti-user"></i>
              <span><?php echo e(__('My Profile')); ?></span>
            </a>
            <a href="<?php echo e(route('logout')); ?>" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="ti ti-power"></i>
              <span><?php echo e(__('Logout')); ?></span>
            </a>
             <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                  <?php echo csrf_field(); ?>
              </form>
          </div>
        </li>
      </ul>
    </div>
    <div class="ms-auto">
      <ul class="list-unstyled">
        <?php if(Auth::user()->type != 'Super Admin' && Auth::user()->type != 'Client' && env('CHAT_MODULE')=='yes'): ?>
          <li class="dash-h-item">
            <a
              class="dash-head-link me-0"
              href="<?php echo e(url('chats')); ?>"
            >
              <i class="ti ti-message-2"></i>
              <span class="bg-danger dash-h-badge message-toggle-msg message-counter custom_messanger_counter "
                ><?php echo e($unseenCounter); ?><span class="sr-only"></span
              ></span>
            </a>
          </li>
        <?php endif; ?>
        <?php if(\Auth::user()->type != 'Super Admin'): ?>
          <li class="dropdown dash-h-item drp-notification">
            <a
              class="dash-head-link dropdown-toggle arrow-none me-0"
              data-bs-toggle="dropdown"
              href="#"
              role="button"
              aria-haspopup="false"
              aria-expanded="false"
            >
             <?php
                $notifications = \Auth::user()->notifications();
            ?>
              <i class="ti ti-bell"></i>
              <span class="bg-danger dash-h-badge <?php if(count($notifications)): ?>dots <?php endif; ?> "
                ><span class="sr-only"></span
              ></span>
            </a>
            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
              <div class="noti-header">
                <h5 class="m-0"><?php echo e(__('Notifications')); ?></h5>
                <a href="#" class="dash-head-link mark_all_as_read">Clear All</a>
              </div>
              <div class="noti-body">


                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php echo $notification->toHtml(); ?>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </li>
        <?php endif; ?>

        <?php
          $currantLang = basename(\App::getLocale())
        ?>
        <li class="dropdown dash-h-item drp-language">
          <a
            class="dash-head-link dropdown-toggle arrow-none me-0"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="false"
            aria-expanded="false"
          >
            <i class="ti ti-world nocolor"></i>
            <span class="drp-text hide-mob"><?php echo e(Str::upper($currantLang)); ?></span>
            <i class="ti ti-chevron-down drp-arrow nocolor"></i>
          </a>
          <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
            <?php $__currentLoopData = Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <a href="<?php echo e(route('lang.change',$lang)); ?>" class="dropdown-item <?php echo e((basename(App::getLocale()) == $lang) ? 'text-primary' : ''); ?>">
              <span><?php echo e(Str::upper($lang)); ?></span>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Languages')): ?>
                <div class="dropdown-divider m-0"></div>
                <a href="<?php echo e(route('lang',basename(App::getLocale()))); ?>" class="dropdown-item text-primary"><?php echo e(__('Manage Language')); ?></a>
            <?php endif; ?>
          </div>
        </li>
      </ul>
    </div>
    </div>
  </header>
<?php /**PATH /home/shadecrm/giftsociety.shadecrm.com/lead/main_file/resources/views/partials/admin/topbar.blade.php ENDPATH**/ ?>