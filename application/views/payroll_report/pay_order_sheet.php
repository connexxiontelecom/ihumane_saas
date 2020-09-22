<?php
  $CI =& get_instance();
  $CI->load->model('salaries');
  $CI->load->model('payroll_configurations');
  include(APPPATH.'/views/stylesheet.php');
?>

<body>
<div id="app">
	<div class="main-wrapper">
		<div class="navbar-bg"></div>
		<?php include(APPPATH.'/views/topbar.php'); ?>
		<?php include(APPPATH.'/views/sidebar.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
          <div class="section-header-back">
            <a href="<?php echo site_url('pay_order')?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
          <h1>Pay Order Sheet</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo site_url('payroll_report')?>">Payroll Reports</a></div>
            <div class="breadcrumb-item active"><a href="<?php echo site_url('pay_order')?>">Pay Order</a></div>
            <div class="breadcrumb-item">Pay Order Sheet</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About the Pay Order For <?php echo date("F", mktime(0, 0, 0, $payroll_month, 10))." ".$payroll_year; ?> </div>
          <p class="section-lead">You can view and export pay order details here</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Employee Pay Order</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable-buttons-2" class="table table-striped table-bordered table-md">
                      <thead>
                        <tr>
                          <th>Bank Code</th>
                          <th>Bank Name</th>
                          <th>Account No</th>
                          <th>Account Name</th>
                          <th>Amount</th>
                          <th>Narration</th>
                          <th>Reference No</th>
                        </tr>
                      </thead>
                      <tbody>
		                  <?php
		                    $sn = 1;
		                    foreach($employees as $employee):
                          if($employee->employee_status == 0 || $employee->employee_status == 3):
                          else: ?>
                          <tr>
                            <td style="width: 12px;"> <?php echo $employee->bank_code; ?></td>
                            <td> <?php echo $employee->bank_name; ?></td>
                            <td> <?php echo $employee->employee_account_number; ?></td>
                            <td> <?php echo $employee->employee_first_name." ".$employee->employee_last_name." ".$employee->employee_other_name; ?></td>
                            <td>
						                  <?php
  						                  $gross_pay = 0;
						                    $salaries = $CI->salaries->get_employee_income($employee->employee_id, $payroll_month, $payroll_year, 1, $tenant_id);
						                    foreach ($salaries as $salary):
							                    $_gross_pay = $salary->salary_amount;
							                    $gross_pay = $gross_pay + $_gross_pay;
						                    endforeach;
						                    $total_deduction = 0;
						                    $salaries = $CI->salaries->get_employee_income($employee->employee_id, $payroll_month, $payroll_year, 0, $tenant_id);
						                    foreach ($salaries as $salary):
							                    $_total_deduction = $salary->salary_amount;
							                    $total_deduction = $total_deduction + $_total_deduction;
  						                  endforeach;
						                    echo number_format($gross_pay - $total_deduction);
						                  ?>
                            </td>
                            <td>
						                  <?php echo "Salary for ".date("F", mktime(0, 0, 0, $payroll_month, 10))." $payroll_year" ; ?>
                            </td>
                            <td>
                              <?php echo date("F", mktime(0, 0, 0, $payroll_month, 10))." $payroll_year" ?>
                            </td>
                          </tr>
			                  <?php
			                  endif;
			                  $sn++;
		                  endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer text-right bg-whitesmoke">
                  <button onclick="location.href='<?php echo site_url('pay_order');?>'" class="btn btn-danger" type="button">Go Back</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
		</div>
	</div>
</div>
<?php include(APPPATH.'/views/footer.php'); ?>
<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>
<script>
  $('title').html('Pay Order Sheet - IHUMANE')
</script>
