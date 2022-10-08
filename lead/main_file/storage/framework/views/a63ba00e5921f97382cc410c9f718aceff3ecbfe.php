<?php
    $logo=asset(Storage::url('logo/'));
    $company_logo=Utility::get_superadmin_logo();
    $setting = App\Models\Utility::settings();
?>



    <nav class="dash-sidebar light-sidebar <?php echo e(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on' ? 'transprent-bg' : ''); ?>">
    <div class="navbar-wrapper">
      <div class="m-header main-logo">
        <a href="<?php echo e(route('home')); ?>" class="b-brand">
          <!-- ========   change your logo hear   ============ -->
          <img src="<?php echo e($logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo-dark.png')); ?>" alt="<?php echo e(config('app.name', 'LeadGo')); ?>"  class="logo logo-lg">
          
        </a>
      </div>
      <div class="navbar-content">
        <ul class="dash-navbar">
            <li class="dash-item  <?php echo e((Request::route()->getName() == 'home') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('home')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-home"></i></span><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span></a>
            </li>

            <?php if(Gate::check('Manage Users') || Gate::check('Manage Clients') || Gate::check('Manage Roles') || Gate::check('Manage Permissions')): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Users')): ?>
                    <li class="dash-item  <?php echo e(request()->is('users*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('users')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-users"></i></span><span class="dash-mtext"><?php echo e(__('Users')); ?></span></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Clients')): ?>
                    <li class="dash-item <?php echo e(request()->is('clients*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('clients.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-user"></i></span><span class="dash-mtext"><?php echo e(__('Clients')); ?></span></a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Roles')): ?>
                    <li class="dash-item  <?php echo e((Request::route()->getName() == 'roles.index') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('roles.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-user-x"></i></span><span class="dash-mtext"><?php echo e(__('Roles')); ?></span></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Leads')): ?>
                <li class="dash-item  <?php echo e(request()->is('leads*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('leads.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-3d-cube-sphere"></i></span><span class="dash-mtext"><?php echo e(__('Leads')); ?></span></a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Deals')): ?>
                <li class="dash-item  <?php echo e(request()->is('deals*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('deals.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-rocket"></i></span><span class="dash-mtext"><?php echo e(__('Deals')); ?></span></a>
                </li>
            <?php endif; ?>

            <?php if(Gate::check('Manage Products')): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Products')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'products.index') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('products.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-plane-departure"></i></span><span class="dash-mtext"><?php echo e(__('Products & Services')); ?></span></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Estimations')): ?>
                <li class="dash-item <?php echo e((Request::route()->getName() == 'estimations.index' || Request::route()->getName() == 'estimations.show') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('estimations.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-shopping-cart-plus"></i></span><span class="dash-mtext"><?php echo e(__('Estimations')); ?></span></a>
                </li>
            <?php endif; ?>


            <?php if(Gate::check('Manage Expenses') || Gate::check('Manage Invoices')): ?>
                 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Invoices')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'invoices.index' || Request::route()->getName() == 'invoices.show') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('invoices.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-file-invoice"></i></span><span class="dash-mtext"><?php echo e(__('Invoices')); ?></span></a>
                    </li>
                 <?php endif; ?>
                 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Expenses')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'expenses.index' || Request::route()->getName() == 'expenses.show') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('expenses.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-cash"></i></span><span class="dash-mtext"><?php echo e(__('Expenses')); ?></span></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Invoice Payments')): ?>
                <li class="dash-item <?php echo e((Request::route()->getName() == 'invoices.payments') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('invoices.payments')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-report-money"></i></span><span class="dash-mtext"><?php echo e(__('Payments')); ?></span></a>
                </li>
            <?php endif; ?>

            <?php if(Auth::user()->type == 'Owner'): ?>
                <li class="dash-item <?php echo e(request()->is('form_builder*') || request()->is('form_response*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('form_builder.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-notebook"></i></span><span class="dash-mtext"><?php echo e(__('Form Builder')); ?></span></a>
                </li>
            <?php endif; ?>

            <?php if(Gate::check('Manage MDFs') && \App\Models\Utility::checkPermissionExist('Manage MDFs') != 0): ?>
                <li class="dash-item <?php echo e((Request::route()->getName() == 'mdf.index' || Request::route()->getName() == 'mdf.show') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('mdf.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-cash-banknote"></i></span><span class="dash-mtext"><?php echo e(__('MDF')); ?></span></a>
                </li>
            <?php endif; ?>

            
            <?php if(Auth::user()->type != 'Super Admin' && Auth::user()->type != 'Client'): ?>
                <li class="dash-item <?php echo e((Request::route()->getName() == 'chats') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('chats')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-messages"></i></span><span class="dash-mtext"><?php echo e(__('Messenger')); ?></span></a>
                </li>
            <?php endif; ?>

            <?php if(\Auth::user()->type=='Owner' || \Auth::user()->type=='Client'): ?>
            
            <li class="dash-item <?php echo e((Request::route()->getName() == 'contract.index' || Request::route()->getName() == 'contract.show') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('contract.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-device-floppy"></i></span><span class="dash-mtext"><?php echo e(__('Contracts')); ?></span></a>
            </li>
            
            <?php endif; ?>  


            <?php if(Auth::user()->type != 'Super Admin'): ?>
                <li class="dash-item <?php echo e(request()->is('zoommeeting*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('zoommeeting.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-video"></i></span><span class="dash-mtext"><?php echo e(__('Zoom Meeting')); ?></span></a>
                </li>
            <?php endif; ?>

            <?php if(Gate::check('Manage Email Templates')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'email_template.index' || Request::segment(1) == 'email_template_lang'  || Request::route()->getName() == 'manageemail.lang') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('email_template.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-mail"></i></span><span class="dash-mtext"><?php echo e(__('Email Templates')); ?></span></a>
                    </li>
                <?php endif; ?>
                
            <?php if(Gate::check('Manage Coupons')): ?>
                <li class="dash-item <?php echo e((Request::route()->getName() == 'coupons.index' || Request::route()->getName() == 'coupons.show') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('coupons.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-gift"></i></span><span class="dash-mtext"><?php echo e(__('Coupons')); ?></span></a>
                </li>
            <?php endif; ?>


            


            <?php if(Gate::check('System Settings') || Gate::check('Manage Pipelines') || Gate::check('Manage Sources') || Gate::check('Manage Payments') || Gate::check('Manage Expense Categories') || Gate::check('Manage Stages') || Gate::check('Manage Labels') || Gate::check('Manage Custom Fields') || Gate::check('Manage Contract Types') || Gate::check('Manage Email Templates')): ?>
                <?php if(Gate::check('Manage Pipelines')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e((Request::route()->getName() == 'pipelines.index' || Request::route()->getName() == 'sources.index' || Request::route()->getName() == 'payments.index' || Request::route()->getName() == 'expense_categories.index' || Request::route()->getName() == 'stages.index' || Request::route()->getName() == 'labels.index' || Request::route()->getName() == 'custom_fields.index'  || Request::route()->getName() == 'contract_type.index'  || Request::route()->getName() == 'lead_stages.index' || Request::route()->getName()
                    == 'email_template.index' || Request::route()->getName() == 'mdf_status.index' || Request::route()->getName() == 'mdf_type.index' || Request::route()->getName() == 'mdf_sub_type.index') ? '' : ''); ?> ">
                    <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-layout-2"></i></span><span
                            class="dash-mtext"><?php echo e(('Setup')); ?></span><span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="dash-submenu <?php echo e((Request::route()->getName() == 'pipelines.index' || Request::route()->getName() == 'sources.index' || Request::route()->getName() == 'payments.index' || Request::route()->getName() == 'expense_categories.index' || Request::route()->getName() == 'stages.index' || Request::route()->getName() == 'labels.index' || Request::route()->getName() == 'custom_fields.index'  || Request::route()->getName() == 'contract_type.index'  || Request::route()->getName() == 'lead_stages.index' || Request::route()->getName()
                    == 'email_template.index' || Request::route()->getName() == 'mdf_status.index' || Request::route()->getName() == 'mdf_type.index' || Request::route()->getName() == 'mdf_sub_type.index') ? 'show' : ''); ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Pipelines')): ?>
                            <li class="dash-item <?php echo e((Request::route()->getName() == 'pipelines.index') ? 'active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('pipelines.index')); ?>"><?php echo e(__('Pipelines')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Stages')): ?>
                            <li class="dash-item <?php echo e((Request::route()->getName() == 'stages.index') ? 'active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('stages.index')); ?>"><?php echo e(__('Deal Stages')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Lead Stages')): ?>
                            <li class="dash-item <?php echo e((Request::route()->getName() == 'lead_stages.index') ? 'active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('lead_stages.index')); ?>"><?php echo e(__('Lead Stages')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Labels')): ?>
                            <li class="dash-item <?php echo e((Request::route()->getName() == 'labels.index') ? 'active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('labels.index')); ?>"><?php echo e(__('Labels')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Sources')): ?>
                            <li class="dash-item <?php echo e((Request::route()->getName() == 'sources.index') ? 'active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('sources.index')); ?>"><?php echo e(__('Sources')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payments')): ?>
                            <li class="dash-item <?php echo e((Request::route()->getName() == 'payments.index') ? 'active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('payments.index')); ?>"><?php echo e(__('Payment Methods')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Expense Categories')): ?>
                            <li class="dash-item <?php echo e((Request::route()->getName() == 'expense_categories.index') ? 'active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('expense_categories.index')); ?>"><?php echo e(__('Expense Categories')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Contract Types')): ?>
                            <li class="dash-item <?php echo e((Request::route()->getName() == 'contract_type.index') ? 'active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('contract_type.index')); ?>"><?php echo e(__('Contract Type')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Taxes')): ?>
                            <li class="dash-item <?php echo e((Request::route()->getName() == 'taxes.index') ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('taxes.index')); ?>" class="dash-link"><?php echo e(__('Tax Rates')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Custom Fields')): ?>
                            <li class="dash-item <?php echo e((Request::route()->getName() == 'custom_fields.index') ? 'active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('custom_fields.index')); ?>"><?php echo e(__('Custom Fields')); ?></a>
                            </li>
                        <?php endif; ?>
                        <!-- <?php if(\Auth::user()->type !== 'Super Admin'): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Email Templates')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'email_template.index') ? 'active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('email_template.index')); ?>"><?php echo e(__('Email Notification')); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?> -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage MDF Status')): ?>
                            <li class="dash-item <?php echo e((Request::route()->getName() == 'mdf_status.index') ? 'active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('mdf_status.index')); ?>"><?php echo e(__('MDF Status')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage MDF Types')): ?>
                            <li class="dash-item <?php echo e((Request::route()->getName() == 'mdf_type.index') ? 'active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('mdf_type.index')); ?>"><?php echo e(__('MDF Type')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage MDF Sub Types')): ?>
                            <li class="dash-item <?php echo e((Request::route()->getName() == 'mdf_sub_type.index') ? 'active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('mdf_sub_type.index')); ?>"><?php echo e(__('MDF Sub Type')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                  </li>
                <?php endif; ?>
            <?php endif; ?>
                  
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('System Settings')): ?>
                <li class="dash-item <?php echo e((Request::route()->getName() == 'settings') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('settings')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-settings"></i></span><span class="dash-mtext"><?php echo e(__('System Settings')); ?></span></a>
                </li>
            <?php endif; ?>
                
        </ul>
    </div>

          
        </ul>
        <div class="card bg-primary">
          <div class="card-body">
            <h2 class="text-white">Need help?</h2>
            <p class="text-white"><i>Please check our docs.</i></p>
            <div class="d-grid">
              <button class="btn btn-light">Documentation</button>
            </div>
            <img
              src="<?php echo e(asset('assets/images/sidebar-card.svg')); ?>"
              alt=""
              class="img-sidebar-card"
            />
          </div>
        </div>
      </div>
    </div>
  </nav>
<?php /**PATH /home/shadecrm/giftsociety.shadecrm.com/lead/main_file/resources/views/partials/admin/navbar.blade.php ENDPATH**/ ?>