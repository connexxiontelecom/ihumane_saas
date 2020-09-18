<?php include('stylesheet.php'); ?>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <?php include('topbar.php'); ?>
      <?php include('sidebar.php'); ?>
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-md-6 col-12">
                <div class="card pt-3" style="height: 195px; border-radius: 12px">
                  <div class="card-body">
                    <h5 class="card-title">Hello, <?php echo $user_data->user_name; ?>!</h5>
                    <p class="card-text">Welcome back. You have <?php echo count($notifications)?> notifications.</p>
                    <a href="<?php echo site_url('employee') ?>" class="btn btn-primary">Manage Employees</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-md-6 col-12">
                <div class="row">
                  <div class="card card-statistic-2" style="border-radius: 12px;">
                    <div class="card-stats" >
                      <div class="card-stats-title" style="border-radius: 12px; !important;">Company Statistics -
                        <div class="dropdown d-inline">
                          <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">August</a>
                          <ul class="dropdown-menu dropdown-menu-sm">
                            <li class="dropdown-title">Select Month</li>
                            <li><a href="#" class="dropdown-item">January</a></li>
                            <li><a href="#" class="dropdown-item">February</a></li>
                            <li><a href="#" class="dropdown-item">March</a></li>
                            <li><a href="#" class="dropdown-item">April</a></li>
                            <li><a href="#" class="dropdown-item">May</a></li>
                            <li><a href="#" class="dropdown-item">June</a></li>
                            <li><a href="#" class="dropdown-item">July</a></li>
                            <li><a href="#" class="dropdown-item active">August</a></li>
                            <li><a href="#" class="dropdown-item">September</a></li>
                            <li><a href="#" class="dropdown-item">October</a></li>
                            <li><a href="#" class="dropdown-item">November</a></li>
                            <li><a href="#" class="dropdown-item">December</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-stats-items" style="border-radius: 12px;">
                        <div class="card-stats-item">
                          <div class="card-stats-item-count"><?php echo count($departments);?></div>
                          <div class="card-stats-item-label">Departments</div>
                        </div>
                        <div class="card-stats-item">
                          <div class="card-stats-item-count"><?php echo count($users); ?></div>
                          <div class="card-stats-item-label">Users</div>
                        </div>
                        <div class="card-stats-item">
                          <div class="card-stats-item-count"><?php echo count($online_users); ?></div>
                          <div class="card-stats-item-label">Online</div>
                        </div>
                      </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                      <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Total Employees</h4>
                      </div>
                      <div class="card-body">
                        <?php echo count($employees); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-md-6 col-12">
                <div class="card card-hero" style="height: 195px; border-radius: 12px;">
                  <div class="card-header" style="height: 195px; border-radius: 12px; !important;">
                    <h1><?php echo date('j')?></h1>
                    <h4><?php echo date('F')?></h4>
                    <h6 class="mt-2"><?php echo date('Y')?></h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                <div class="card" style="border-radius: 12px;">
                  <div class="card-header">
                    <h4>Statistics</h4>
                    <div class="card-header-action">
                      <div class="btn-group">
                        <a href="#" class="btn btn-primary">Week</a>
                        <a href="#" class="btn">Month</a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart" height="182"></canvas>
                    <div class="statistic-details mt-sm-4">
                      <div class="statistic-details-item">
                        <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</span>
                        <div class="detail-value">$243</div>
                        <div class="detail-name">Today's Sales</div>
                      </div>
                      <div class="statistic-details-item">
                        <span class="text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</span>
                        <div class="detail-value">$2,902</div>
                        <div class="detail-name">This Week's Sales</div>
                      </div>
                      <div class="statistic-details-item">
                        <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>9%</span>
                        <div class="detail-value">$12,821</div>
                        <div class="detail-name">This Month's Sales</div>
                      </div>
                      <div class="statistic-details-item">
                        <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</span>
                        <div class="detail-value">$92,142</div>
                        <div class="detail-name">This Year's Sales</div>
                      </div>
                    </div>
                  </div>
                </div>
<!--                <div class="card">-->
<!--                  <div class="card-header">-->
<!--                    <h4>Employees On Leave</h4>-->
<!--                  </div>-->
<!--                  <div class="card-body">-->
<!--                    --><?php //foreach ($leaves as $leave) :
//                      if ($leave->leave_status == 2) :
//                      endif;
//
//                      if ($leave->leave_status == 1) :
//                    ?>
<!--                        --><?php
//                        $leave_end_date = new DateTime($leave->leave_end_date);
//                        $leave_start_date = new DateTime($leave->leave_start_date);
//                        $today = time();
//                        $percentage_leave = ((($today - $leave_start_date->getTimestamp()) / ($leave_end_date->getTimestamp() - $leave_start_date->getTimestamp())) * 100);
//                        ?>
<!---->
<!--                        <div class="mb-4">-->
<!--                          <div class="text-small float-right font-weight-bold text-muted">--><?php //echo timespan($today, $leave_end_date->getTimestamp(), 2) . ' left' ?><!-- (--><?php //echo number_format($percentage_leave) . "%" ?><!-- completed)</div>-->
<!--                                             <div class="text-small float-right font-weight-bold text-muted">-->--><?php ////echo number_format($percentage_leave, 1)."%"
//                                                                                                                        ?>
<!--                          </div>-->-->
<!--                          <div class="font-weight-bold mb-1">--><?php //echo $leave->employee_first_name . " " . $leave->employee_last_name; ?><!--</div>-->
<!--                          <div class="progress" data-height="3">-->
<!--                            <div class="progress-bar" role="progressbar" data-width="--><?php //echo $percentage_leave . "%" ?><!--" aria-valuenow="--><?php //echo $percentage_leave; ?><!--" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--                          </div>-->
<!--                          <div class="text-small text-muted">-->
<!--                            --><?php //echo $leave->leave_name; ?>
<!--                            <div class="bullet"></div>-->
<!--                            <span class="text-primary">--><?php //echo $leave->leave_end_date; ?><!--</span>-->
<!--                            <div class="bullet"></div>-->
<!--                            <span class="text-warning">--><?php //echo "On Leave";  ?><!--</span>-->
<!--                          </div>-->
<!--                        </div>-->
<!--                      --><?php
//                      endif;
//                      if ($leave->leave_status == 0) :
//                      ?>
<!--                        --><?php
//                        $leave_end_date = new DateTime($leave->leave_end_date);
//                        $leave_start_date = new DateTime($leave->leave_start_date);
//                        $today = time();
//                        $percentage_leave = ((($today - $leave_start_date->getTimestamp()) / ($leave_end_date->getTimestamp() - $leave_start_date->getTimestamp())) * 100);
//                        ?>
<!---->
<!--                        <div class="mb-4">-->
<!--                          <div class="badge badge-pill badge-danger mb-1 float-right">--><?php //echo "Leave Pending";  ?><!--</div>-->
<!--                          <div class="font-weight-bold mb-1">--><?php //echo $leave->employee_first_name . " " . $leave->employee_last_name; ?><!--</div>-->
<!--                          <div class="progress" data-height="3">-->
<!---->
<!--                            <div class="progress-bar" role="progressbar" data-width="0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--                          </div>-->
<!--                          <div class="text-small text-muted">--><?php //echo $leave->leave_name; ?><!-- <div class="bullet"></div> <span class="text-primary">--><?php //echo $leave->leave_end_date; ?><!--</span></div>-->
<!--                        </div>-->
<!--                    --><?php
//                      endif;
//                    endforeach; ?>
<!--                  </div>-->
<!--                </div>-->
              </div>
              <div class="col-lg-4 col-md-12 col-12 col-sm-12">
<!--                <div class="card">-->
<!--                  <div class="card-header">-->
<!--                    <h4>Present Employees</h4>-->
<!--                  </div>-->
<!--                  <div class="card-body">-->
<!--                    <ul class="list-unstyled list-unstyled-border">-->
<!--                      --><?php //$count = 0;
//                      foreach ($present_employees as $present_employee) :
//                        if ($count <= 5) :
//                      ?>
<!--                          <li class="media">-->
<!--                            <img class="mr-3 rounded-circle" width="50" src="--><?php //echo base_url(); ?><!--uploads/employee_passports/--><?php //echo $present_employee->employee_passport; ?><!--" alt="avatar">-->
<!--                            <div class="media-body">-->
<!--                                                 <div class="float-right text-primary">-->--><?php ////echo $present_employee->employee_first_name." ".$present_employee->employee_last_name;
//                                                                                                      ?>
<!--                              </div>-->-->
<!--                              <div class="media-title">--><?php //echo $present_employee->employee_first_name . " " . $present_employee->employee_last_name; ?><!--</div>-->
<!--                              <span class="text-small text-muted">--><?php //echo $present_employee->employee_biometrics_login_time; ?><!--</span>-->
<!--                            </div>-->
<!--                          </li>-->
<!--                      --><?php
//                          $count++;
//                        endif;
//                      endforeach; ?>
<!--                    </ul>-->
<!--                    <div class="text-center pt-1 pb-1">-->
<!--                      <a href="--><?php //echo site_url('today_present') ?><!--" class="btn btn-primary btn-lg btn-round">-->
<!--                        View All-->
<!--                      </a>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <?php include(APPPATH . '/views/footer.php'); ?>
  <?php include('js.php'); ?>
  <script>
    $('title').html('Dashboard - IHUMANE');
    $(document).ready(function() {
      setInterval(timestamp, 1000);
      income_statistics();

      function timestamp() {
        $.ajax({
          url: '<?php echo site_url('timestamp') ?>',
          success: function(data) {
            $('#timestamp').html(data);
          }
        })
      }

      function income_statistics() {
        $.ajax({
          url: '<?php echo site_url('income_stats')?>',
          success: function(data){
            let income_stats = JSON.parse(data);
            console.log(income_stats)
            let income_amounts = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            let i = 0;
            for (i = 0; i < income_stats.length; i++) {
              income_amounts[income_stats[i].salary_pay_month - 1] += parseInt(income_stats[i].salary_amount);
            }

            let statistics_chart = $('#myChart')[0].getContext('2d');
            let income_chart = new Chart(statistics_chart, {
              type: 'line',
              data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                datasets: [{
                  label: 'Income Payments',
                  data: income_amounts,
                  borderWidth: 5,
                  borderColor: '#51aa4c',
                  backgroundColor: 'transparent',
                  pointBackgroundColor: '#fff',
                  pointBorderColor: '#51aa4c',
                  pointRadius: 4
                }]
              },
              options: {
                legend: {
                  display: false
                },
                scales: {
                  yAxes: [{
                    gridLines: {
                      display: false,
                      drawBorder: false,
                    },
                    ticks: {
                      stepSize: 1000000
                    }
                  }],
                  xAxes: [{
                    gridLines: {
                      color: '#fbfbfb',
                      lineWidth: 2
                    }
                  }]
                },
              }
            })
          }
        })
      }
    });
  </script>
</body>

</html>
