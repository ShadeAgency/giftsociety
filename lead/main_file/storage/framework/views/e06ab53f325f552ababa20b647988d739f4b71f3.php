<?php $__env->startSection('title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('head'); ?>
    <?php if($calenderTasks): ?>
        <!-- <link rel="stylesheet" href="<?php echo e(asset('custom/libs/fullcalendar/dist/fullcalendar.min.css')); ?>"> -->
    <?php endif; ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>

    <?php if($calenderTasks): ?>
         
    <?php endif; ?>
    <script>
        <?php if($calenderTasks): ?>
        (function () {
            var etitle;
            var etype;
            var etypeclass;
            var calendar = new FullCalendar.Calendar(document.getElementById('event_calendar'), {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridDay,timeGridWeek,dayGridMonth'
                },
                buttonText: {
                    timeGridDay: "<?php echo e(__('Day')); ?>",
                    timeGridWeek: "<?php echo e(__('Week')); ?>",
                    dayGridMonth: "<?php echo e(__('Month')); ?>"
                },
                themeSystem: 'bootstrap',
                initialDate: '<?php echo e($transdate); ?>',
                slotDuration: '00:10:00',
                navLinks: true,
                droppable: true,
                selectable: true,
                selectMirror: true,
                editable: true,
                dayMaxEvents: true,
                handleWindowResize: true,
                events: <?php echo json_encode($calenderTasks); ?>,
            });
            calendar.render();
        })();
        <?php endif; ?>


        $(document).on('click', '.fc-daygrid-event', function (e) {
            if (!$(this).hasClass('deal')) {
                e.preventDefault();
                var event = $(this);
                var title = $(this).find('.fc-event-title-container .fc-event-title').html();
                var size = 'md';
                var url = $(this).attr('href');
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);

                $.ajax({
                    url: url,
                    success: function (data) {
                        $('#commonModal .modal-body').html(data);
                        $("#commonModal").modal('show');
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        show_toastr('Error', data.error, 'error')
                    }
                });
            }
        });

    </script>

<script>

    (function() {
        <?php if(!empty($chartData['date'])): ?>
        var options = {
            chart: {
                height: 100,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },

            series: [{
                name: "<?php echo e(__('Invoice')); ?>",
                data:<?php echo json_encode($chartData['invoice']); ?>

            }, {
                name: "<?php echo e(__('Payment')); ?>",
                data:<?php echo json_encode($chartData['payment']); ?>

            }],

            xaxis: {
                categories: <?php echo json_encode($chartData['date']); ?>,
                // title: {
                //     text: 'Last 15 days'
                // }
            },
            colors: ['#6fd943','#2633cb'],

            grid: {
                strokeDashArray: 4,
            },
            legend: {
                show: false,
            },
            yaxis: {
                tickAmount: 3,
            }

        };
        <?php else: ?>
        var options = {
            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },

            series: [{
                name: "<?php echo e(__('Order')); ?>",
                data: <?php echo json_encode($chartData['data']); ?>

            }],

            xaxis: {
                categories: <?php echo json_encode($chartData['label']); ?>,
                // title: {
                //     text: 'Last 15 days'
                // }
            },
            colors: ['#6fd943','#2633cb'],

            grid: {
                strokeDashArray: 4,
            },
            legend: {
                show: false,
            },
            yaxis: {
                tickAmount: 6,
            }

        };
        <?php endif; ?>
        var chart = new ApexCharts(document.querySelector("#myChart"), options);
        chart.render();
    })();
</script>
<script>
    (function() {
        <?php if(!empty($chartcall['date'])): ?>
          var options = {
              chart: {
                  height: 140,
                  type: 'area',
                  toolbar: {
                      show: false,
                  },
              },
              dataLabels: {
                  enabled: false
              },
              stroke: {
                  width: 2,
                  curve: 'smooth'
              },

              series: [{
                  name: "<?php echo e(__('Deal calls by day')); ?>",
                  data:<?php echo json_encode($chartcall['dealcall']); ?>

              }, ],

              xaxis: {
                  categories:<?php echo json_encode($chartcall['date']); ?>,

              },
              colors: ['#6fd943','#2633cb'],

              grid: {
                  strokeDashArray: 4,
              },
              legend: {
                  show: false,
              },
              yaxis: {
                  tickAmount: 3,
              }

          };

          <?php endif; ?>
          var chart = new ApexCharts(document.querySelector("#callchart"), options);
          chart.render();
      })();
  </script>


<script>
    (function() {
        <?php if(!empty($dealdata['date'])): ?>
          var options = {
              chart: {
                  height: 140,
                  type: 'area',
                  toolbar: {
                      show: false,
                  },
              },
              dataLabels: {
                  enabled: false
              },
              stroke: {
                  width: 2,
                  curve: 'smooth'
              },

              series: [{
                  name: "<?php echo e(__('Won Deal by day')); ?>",
                  data:<?php echo json_encode($dealdata['deal']); ?>

              }, ],

              xaxis: {
                  categories:<?php echo json_encode($dealdata['date']); ?>,

              },
              colors: ['#6fd943','#2633cb'],

              grid: {
                  strokeDashArray: 4,
              },
              legend: {
                  show: false,
              },
              yaxis: {
                  tickAmount: 3,
              }

          };

          <?php endif; ?>
          var chart = new ApexCharts(document.querySelector("#deal_data"), options);
          chart.render();
      })();
  </script>



<script>
    var WorkedHoursChart = (function () {
        var $chart = $('#deal_stage');

        function init($this) {
            var options = {
                chart: {
                    height: 250,
                    type: 'bar',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    },
                    shadow: {
                        enabled: false,
                    },

                },
                plotOptions: {
            bar: {
                columnWidth: '30%',
                borderRadius: 10,
                dataLabels: {
                    position: 'top',
                },
            }
        },
                stroke: {
            show: true,
            width: 1,
            colors: ['#fff']
        },
                series: [{
                    name: 'Platform',
                    data: <?php echo json_encode($dealStageData); ?>,
                }],
                xaxis: {
                    labels: {
                        // format: 'MMM',
                        style: {
                            colors: '#293240',
                            fontSize: '12px',
                            fontFamily: "sans-serif",
                            cssClass: 'apexcharts-xaxis-label',
                        },
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: true,
                        borderType: 'solid',
                        color: '#f2f2f2',
                        height: 6,
                        offsetX: 0,
                        offsetY: 0
                    },
                    title: {
                        text: 'Platform'
                    },
                    categories: <?php echo json_encode($dealStageName); ?>,
                },
                yaxis: {
                    labels: {
                        style: {
                            color: '#f2f2f2',
                            fontSize: '12px',
                            fontFamily: "Open Sans",
                        },
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: true,
                        borderType: 'solid',
                        color: '#f2f2f2',
                        height: 6,
                        offsetX: 0,
                        offsetY: 0
                    }
                },
                fill: {
                    type: 'solid',
                    opacity: 1

                },
                markers: {
                    size: 4,
                    opacity: 0.7,
                    strokeColor: "#000",
                    strokeWidth: 3,
                    hover: {
                        size: 7,
                    }
                },
                grid: {
                    borderColor: '#f2f2f2',
                    strokeDashArray: 5,
                },
                dataLabels: {
                    enabled: false
                }
            }
            // Get data from data attributes
            var dataset = $this.data().dataset,
                labels = $this.data().labels,
                color = $this.data().color,
                height = $this.data().height,
                type = $this.data().type;

            // Inject synamic properties
            // options.colors = [
            //     PurposeStyle.colors.theme[color]
            // ];
            // options.markers.colors = [
            //     PurposeStyle.colors.theme[color]
            // ];
            options.chart.height = height ? height : 350;
            // Init chart
            var chart = new ApexCharts($this[0], options);
            // Draw chart
            setTimeout(function () {
                chart.render();
            }, 300);
        }

        // Events
        if ($chart.length) {
            $chart.each(function () {
                init($(this));
            });
        }
    })();
</script>

<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php if(!empty($arrErr)): ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



                <?php if(!empty($arrErr['system'])): ?>
                    <div class="alert alert-danger text-xs">
                        <?php echo e($arrErr['system']); ?> <?php echo e(__('are required in')); ?> <a href="<?php echo e(route('settings')); ?>" class=""><u> <?php echo e(__('System Setting')); ?></u></a>
                    </div>
                <?php endif; ?>
                <?php if(!empty($arrErr['user'])): ?>
                    <div class="alert alert-danger text-xs">
                        <?php echo e($arrErr['user']); ?> <a href="<?php echo e(route('users')); ?>" class=""><u><?php echo e(__('here')); ?></u></a>
                    </div>
                <?php endif; ?>
                <?php if(!empty($arrErr['role'])): ?>
                    <div class="alert alert-danger text-xs">
                        <?php echo e($arrErr['role']); ?> <a href="<?php echo e(route('roles.index')); ?>" class=""><u><?php echo e(__('here')); ?></u></a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="row">

        <?php if(\Auth::user()->type=="Super Admin"): ?>
             <?php if(isset($arrCount['owner'])): ?>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-school"></i>
                                        </div>
                                        <div class="ms-3">
                                            <small class="text-muted"><?php echo e(__('Total Owner')); ?></small>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <h4 class="m-0"><?php echo e($arrCount['owner']['owner']); ?></h4>
                                    <?php if(\Auth::user()->type == 'Super Admin'): ?>
                                        <small class="text-muted"><span class="text-success"><?php echo e(__('Paid Users')); ?> : </span> <?php echo e(number_format($arrCount['owner']['total'])); ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(isset($arrCount['order'])): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-warning">
                                                <i class="ti ti-shopping-cart"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Total Order')); ?></small>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0"><?php echo e($arrCount['order']['order']); ?></h4>
                                        <?php if(\Auth::user()->type == 'Super Admin'): ?>
                                            <small class="text-muted"><span class="text-success"><?php echo e(__('Total Order Amount')); ?> : </span> <?php echo e(number_format($arrCount['order']['total'])); ?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(isset($arrCount['plan'])): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-danger">
                                                <i class="ti ti-award"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Total Plan')); ?></small>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0"><?php echo e($arrCount['plan']['plan']); ?></h4>
                                        <?php if(\Auth::user()->type == 'Super Admin'): ?>
                                            <small class="text-muted"><span class="text-success"><?php echo e(__('Most purchase plan')); ?> : </span> <?php echo e(($arrCount['plan']['total']) ? $arrCount['plan']['total']->name : '-'); ?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

        <?php else: ?>
            <div class="col-xxl-7">
                <div class="row">
                    <?php
                    $class = '';
                    if(count($arrCount) < 4)
                    {
                        $class = 'col-lg-4 col-md-4';
                    }
                    else
                    {
                        $class = 'col-lg-3 col-md-3';
                    }
                    ?>

                    <?php if(isset($arrCount['client'])): ?>
                         <div class="<?php echo e($class); ?> col-6">
                            <div class="card dash1-card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-user"></i>
                                    </div>
                                    <p class="text-muted text-m mt-4 mb-4"><?php echo e(__('Total Client')); ?></p>
                                    <h3 class="mb-0"><?php echo e($arrCount['client']); ?></h3>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($arrCount['user'])): ?>
                        <div class="<?php echo e($class); ?> col-6">
                            <div class="card dash1-card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-info">
                                        <i class="ti ti-users"></i>
                                    </div>
                                    <p class="text-muted text-m mt-4 mb-4"><?php echo e(__('Total User')); ?></p>
                                    <h3 class="mb-0"><?php echo e($arrCount['user']); ?></h3>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($arrCount['deal'])): ?>
                        <div class="<?php echo e($class); ?> col-6">
                            <div class="card dash1-card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-warning">
                                        <i class="ti ti-rocket"></i>
                                    </div>
                                    <p class="text-muted text-m mt-4 mb-4"><?php echo e(__('Total Deal')); ?></p>
                                    <h3 class="mb-0"><?php echo e($arrCount['deal']); ?></h3>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($arrCount['invoice'])): ?>
                        <div class="<?php echo e($class); ?> col-6">
                            <div class="card dash1-card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-danger">
                                        <i class="ti ti-file-invoice"></i>
                                    </div>
                                    <p class="text-muted text-m mt-4 mb-4"><?php echo e(__('Total Invoice')); ?></p>
                                    <h3 class="mb-0"><?php echo e($arrCount['invoice']); ?></h3>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($arrCount['task'])): ?>
                        <div class="<?php echo e($class); ?> col-6">
                            <div class="card dash1-card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-danger">
                                        <i class="ti ti-subtask"></i>
                                    </div>
                                    <p class="text-muted text-m mt-4 mb-4"><?php echo e(__('Total Task')); ?></p>
                                    <h3 class="mb-0"><?php echo e($arrCount['task']); ?></h3>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>


                <div class="card top-card">
                    <div class="card-header">
                        <h5><?php echo e(__('Recently created deals')); ?></h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Deal Name')); ?></th>
                                        <th><?php echo e(__('Status')); ?></th>
                                        <th><?php echo e(__('Created At')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($deals)): ?>
                                        <?php $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($deal->name); ?></td>
                                                <td><?php echo e($deal->stage->name); ?></td>
                                                <td><?php echo e($deal->created_at); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center"><?php echo e(__('No data available in table')); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <div class="card top-card">
                    <div class="card-header">
                        <h5><?php echo e(__('Recently created deals')); ?></h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Deal Name')); ?></th>
                                        <th><?php echo e(__('Status')); ?></th>
                                        <th><?php echo e(__('Updated At')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($deals)): ?>
                                        <?php $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($deal->name); ?></td>
                                                <td><?php echo e($deal->stage->name); ?></td>
                                                <td><?php echo e($deal->updated_at); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center"><?php echo e(__('No data available in table')); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            <?php if($calenderTasks): ?>
             <div class="card">
                    <div class="card-header">
                        <h5>Calendar</h5>
                    </div>
                    <div class="card-body">
                        <div id='event_calendar' class='calendar' data-toggle="event_calendar"></div>
                    </div>
                </div>
            <?php endif; ?>
            </div>
        <?php endif; ?>


        <?php if(!empty($chartData)): ?>

            <div class="<?php echo e((\Auth::user()->type == 'Super Admin')? 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12' : 'col-xxl-5'); ?>">

                <div class="card">
                    <div class="card-header">
                        <?php if(\Auth::user()->type != 'Super Admin'): ?>
                        <h5><?php echo e(__('Invoice & Payment')); ?></h5>
                        <?php endif; ?>
                    </div>
                    <div class="card-body p-2">
                        <div id="myChart" data-color="primary"  data-height="100"></div>
                    </div>
                </div>

                <?php if(!empty($chartcall)): ?>

                <div class="card">
                    <div class="card-header ">
                        <?php if(\Auth::user()->type != 'Super Admin'): ?>
                        <h5><?php echo e(__('Deal calls by day')); ?></h5>
                        <?php endif; ?>
                    </div>
                    <div class="card-body p-2">
                        <div id="callchart" data-color="primary"  data-height="230"></div>
                    </div>
                </div>
            <?php endif; ?>


            <?php if(!empty($dealStageData)): ?>
            <div class="card">
                <div class="card-header ">
                    <?php if(\Auth::user()->type != 'Super Admin'): ?>
                    <h5><?php echo e(__('Deals by stage')); ?></h5>
                    <?php endif; ?>
                </div>
                <div class="card-body p-2">
                    <div id="deal_stage" data-color="primary"  data-height="230"></div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(!empty($dealdata)): ?>
                <?php if(\Auth::user()->type == 'Client'): ?>
                <div class="card">
                    <div class="card-header ">
                        <?php if(\Auth::user()->type != 'Super Admin'): ?>
                        <h5><?php echo e(__('Won Deals by day')); ?></h5>
                        <?php endif; ?>
                    </div>
                    <div class="card-body p-2">
                        <div id="deal_data" data-color="primary"  data-height="230"></div>
                    </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(\Auth::user()->type != 'Super Admin'): ?>
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo e(__('Top Due Payment')); ?></h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Date')); ?></th>
                                        <?php if(Auth::user()->type != 'Client'): ?>
                                            <th><?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Invoice')): ?><?php echo e(__('Action')); ?><?php endif; ?></th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php if(!empty($invoices)): ?>
                                        <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <span class="number-id"><?php echo e(Auth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></span><br> <?php echo e(__('Due Amount :')); ?> <?php echo e(Auth::user()->priceFormat($invoice->getDue())); ?>

                                                </td>
                                                <td><?php echo e(Auth::user()->dateFormat($invoice->issue_date)); ?></td>
                                                <?php if(Auth::user()->type != 'Client'): ?>
                                                    <td>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Invoice')): ?>
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="<?php echo e(route('invoices.show',$invoice->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-toggle="tooltip" data-original-title="<?php echo e(__('View')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('View')); ?>"><i class="ti ti-eye text-white"></i></a>
                                                        </div>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center"><?php echo e(__('No data available in table')); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/shadecrm/giftsociety.shadecrm.com/lead/main_file/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>