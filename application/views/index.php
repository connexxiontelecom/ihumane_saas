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
                    <h4>Payroll Overview</h4>
                    <div class="card-header-action">
                      <a href="<?php echo site_url('payroll_report') ?>" class="btn btn-primary">Payroll Reports</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart1" height="160"></canvas>
                    <div class="statistic-details mt-sm-4">
                      <div class="statistic-details-item">
                        <div class="detail-value"><span class="text-primary"><i class="fas fa-circle" style="font-size: 6px;"></i></span> &#8358;<?php echo number_format($total_income_month)?></div>
                        <div class="detail-name">This Month's Payments</div>
                      </div>
                      <div class="statistic-details-item">
                        <div class="detail-value"><span class="text-danger"><i class="fas fa-circle" style="font-size: 6px;"></i></span> &#8358;<?php echo number_format($total_deduction_month)?></div>
                        <div class="detail-name">This Month's Deductions</div>
                      </div>
                      <div class="statistic-details-item">
                        <div class="detail-value"><span class="text-primary"><i class="fas fa-circle" style="font-size: 6px;"></i></span> &#8358;<?php echo number_format($total_income_year)?></div>
                        <div class="detail-name">This Year's Payments</div>
                      </div>
                      <div class="statistic-details-item">
                        <div class="detail-value"><span class="text-danger"><i class="fas fa-circle" style="font-size: 6px;"></i></span> &#8358;<?php echo number_format($total_deduction_year)?></div>
                        <div class="detail-name">This Year's Deductions</div>
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
<!--                                             <div class="text-small float-right font-weight-bold text-muted">--><?php ////echo number_format($percentage_leave, 1)."%"
//                                                                                                                        ?>
<!--                          </div>-->
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
                <div class="list-group-item flex-column align-items-start p-4 mb-4" style="border-radius: 12px; border: none">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-4">Loan Management</h5>
                    <div class="dropleft">
                      <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item has-icon" href="<?php echo site_url('new_loan') ?>"><i class="fas fa-plus"></i>New Loan</a>
                        <a class="dropdown-item has-icon" href="<?php echo site_url('loans') ?>"><i class="fas fa-edit"></i>Manage Loans</a>
                      </div>
                    </div>
                  </div>
                  <p class="mb-1 font-weight-600"><?php echo $pending_loans?> Pending Loan Requests</p>
                  <small><?php echo $running_loans?> Running Loans </small>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="card" style="border-radius: 12px">
                      <div class="card-body text-center">
                        <h4 class="display-4 mt-2"><?php echo $personalized_employees ?></h4>
                        <h6>Personalized</h6>
                        <small>Salary Structures</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="card" style="border-radius: 12px">
                      <div class="card-body text-center">
                        <h4 class="display-4 mt-2"><?php echo $categorized_employees ?></h4>
                        <h6>Categorized</h6>
                        <small>Salary Structures</small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="card" style="border-radius: 12px">
                      <div class="card-body text-center">
                        <h4 class="display-4 mt-2"><?php echo $variational_payments ?></h4>
                        <h6>Variational</h6>
                        <small>Payments</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <?php if($is_payroll_routine_run): ?>
                      <div class="alert alert-success alert-has-icon" style="border-radius: 12px;">
                        <div class="alert-icon"><i class="far fa-check-circle"></i></div>
                        <div class="alert-body">
                          <div class="alert-title">Routine</div>
                          You have run this month's Payroll Routine
                        </div>
                      </div>
                    <?php else:?>
                      <div class="alert alert-warning alert-has-icon" style="border-radius: 12px;">
                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                        <div class="alert-body">
                          <div class="alert-title">Routine</div>
                          You have not run this month's Payroll Routine. Run it <a class="font-weight-bold font-italic" href="<?php echo site_url('payroll_routine') ?>">here</a>.
                        </div>
                      </div>
                    <?php endif?>
                  </div>
                </div>




<!--                <div class="list-group-item flex-column align-items-start p-4" style="border-radius: 12px; border: none">-->
<!--                  <div class="d-flex w-100 justify-content-between">-->
<!--                    <h5 class="mb-4">Loan Management</h5>-->
<!--                    <div class="dropleft">-->
<!--                      <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>-->
<!--                      <div class="dropdown-menu">-->
<!--                        <a class="dropdown-item has-icon" href="#"><i class="fas fa-eye"></i>View Employee</a>-->
<!--                        <a class="dropdown-item has-icon" href="#"><i class="fas fa-edit"></i>Update Employee</a>-->
<!--                        <a class="dropdown-item has-icon" href="#"><i class="fas fa-question"></i>Employee Queries</a>-->
<!--                        <div class="dropdown-divider"></div>-->
<!--                        <a class="dropdown-item has-icon text-danger" href="#"><i class="fas fa-times"></i>Terminate Employee</a>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <p class="mb-1 font-weight-600">0 Loans Are Running</p>-->
<!--                  <small>0 Pending Loan Requests</small>-->
<!--                </div>-->


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
<!--                                                 <div class="float-right text-primary">--><?php ////echo $present_employee->employee_first_name." ".$present_employee->employee_last_name;
//                                                                                                      ?>
<!--                              </div>-->
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
            <div class="row">
              <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                <form method="post" action="<?php echo site_url('add_memo') ?>" class="needs-validation" novalidate enctype="multipart/form-data">
                  <div class="card" style="border-radius: 12px">
                    <div class="card-header">
                      <h4>New Announcement</h4>
                      <div class="card-header-action">
                        <a href="<?php echo site_url('memo') ?>" class="btn btn-primary">View Announcements</a>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Subject</label><span style="color: red"> *</span>
                        <input type="text" class="form-control" name="memo_subject" required/>
                        <div class="invalid-feedback">
                          please fill in a subject
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Announcement Body</label><span style="color: red"> *</span>
                        <textarea class="summernote form-control" required name="memo_body"></textarea>
                        <div class="invalid-feedback">
                          please fill in a body
                        </div>
                      </div>
                      <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                      <div class=" text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                <div class="card" style="border-radius: 12px">
<!--                  <div class="card-header">-->
<!--                    <h4>Employee Leaves</h4>-->
<!--                  </div>-->
                  <div class="card-body">
                    <div class="summary">
                      <div class="summary-info">
                        <h4><?php echo $pending_leaves?> Pending Leaves</h4>
                        <div class="text-muted"><?php echo $approved_leaves?> Approved and <?php echo $finished_leaves?> Finished.</div>
                        <div class="d-block mt-2">
                          <a href="<?php echo site_url('employee_leave') ?>">View All</a>
                        </div>
                      </div>
                      <div class="summary-item">
<!--                        --><?php //print_r($upcoming_leaves[0])?>
                        <h6>Upcoming Leaves</h6>
                        <ul class="list-unstyled list-unstyled-border">
                          <?php if (!empty($upcoming_leaves)):?>
                            <?php foreach($upcoming_leaves as $upcoming_leave):?>
                            <li class="media">
                              <a href="#">
                                <img class="mr-3 rounded" width="50" src="<?php echo base_url().'uploads/employee_passports/'.$upcoming_leave->employee_passport?>" alt="passport">
                              </a>
                              <div class="media-body">
                                <div class="media-right">
                                  <div class="dropleft">
                                    <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item has-icon" href="<?php echo site_url('extend_leave').'/'.$upcoming_leave->employee_leave_id; ?>"><i class="fas fa-plane-departure"></i>Extend Leave</a>
                                    </div>
                                  </div>
                                </div>
                                <div class="media-title"><a href="<?php echo site_url('view_employee').'/'.$upcoming_leave->employee_id; ?>"><?php echo $upcoming_leave->employee_first_name.' '.$upcoming_leave->employee_last_name?></a></div>
                                <div class="text-muted text-small"><a href="<?php echo site_url('leave') ?>"><?php echo $upcoming_leave->leave_name?></a> <div class="bullet"></div> Starts <?php echo date('j/m/Y', strtotime($upcoming_leave->leave_start_date));?></div>
                              </div>
                            </li>
                            <?php endforeach;?>
                          <?php endif?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
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
      statistics();

      function timestamp() {
        $.ajax({
          url: '<?php echo site_url('timestamp') ?>',
          success: function(data) {
            $('#timestamp').html(data);
          }
        })
      }

      function statistics() {
        $.ajax({
          url: '<?php echo site_url('income_stats')?>',
          success: function(income){
            let income_stats = JSON.parse(income);
            let income_amounts = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            let i;
            for (i = 0; i < income_stats.length; i++) {
              income_amounts[income_stats[i].salary_pay_month - 1] += parseInt(income_stats[i].salary_amount);
            }
            $.ajax({
              url: '<?php echo site_url('deduction_stats')?>',
              success: function(deductions) {
                let deduction_stats = JSON.parse(deductions);
                let deduction_amounts = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                let i;
                for (i = 0; i < deduction_stats.length; i++) {
                  deduction_amounts[deduction_stats[i].salary_pay_month - 1] += parseInt(deduction_stats[i].salary_amount);
                }
                let statistics_chart = $('#myChart1')[0].getContext('2d');
                let chart = new Chart(statistics_chart, {
                  type: 'line',
                  data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                      label: 'Income Payments',
                      data: income_amounts,
                      borderWidth: 2,
                      borderColor: '#47c363',
                      backgroundColor: 'transparent',
                      pointBackgroundColor: '#fff',
                      pointBorderColor: '#47c363',
                      pointRadius: 1
                    },
                    {
                      label: 'Deductions',
                      data: deduction_amounts,
                      borderWidth: 2,
                      borderColor: '#fc544b',
                      backgroundColor: 'transparent',
                      pointBackgroundColor: '#fff',
                      pointBorderColor: '#fc544b',
                      pointRadius: 1
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
        })
      }
    });
  </script>
</body>

</html>
